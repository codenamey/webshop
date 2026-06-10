<?php

namespace PrintEngine;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Value object representing a customer's print configuration.
 *
 * Canonical JSON structure (cart item key: printengine_print_config):
 * {
 *   "print_config": {
 *     "image":      "attachment-id or url",
 *     "size":       "L",
 *     "color":      "black",
 *     "print_area": "front",
 *     "mode":       "text | image",
 *     "text":       "free text (text mode only)",
 *     "meta":       {}
 *   }
 * }
 *
 * This structure is written once (cart) and read unchanged through
 * order meta and into the DTF pipeline — never transformed mid-flow.
 */
class PrintConfig {

	/** Cart item / order meta key */
	const CART_KEY = 'printengine_print_config';

	/** Valid print modes */
	const MODES = [ 'text', 'image' ];

	/** Valid print areas */
	const PRINT_AREAS = [ 'front', 'back' ];

	// Spec fields
	public string $image      = '';
	public string $size       = '';
	public string $color      = '';
	public string $print_area = 'front';
	public string $mode       = 'text';
	public string $text       = '';
	public array  $meta       = [];

	// Runtime-only (not serialised to JSON)
	public string $image_source  = ''; // 'upload' | 'library'
	public int    $attachment_id = 0;

	// Allowed values resolved at build time
	public array $allowed_print_areas = [ 'front' ];
	public array $allowed_sizes       = [];
	public array $allowed_colors      = [];

	// -----------------------------------------------------------------------
	// Factory — single entry point for building from POST data
	// -----------------------------------------------------------------------

	/**
	 * Build and return a validated PrintConfig from $_POST.
	 *
	 * Resolves size + color from the selected WooCommerce variation.
	 * Resolves print_area from product admin settings (PrintAreaSettings).
	 * Returns null only if product/variation context cannot be determined.
	 */
	public static function from_post(): ?self {
		$config = new self();

		$config->mode = in_array(
			sanitize_key( wp_unslash( $_POST['printengine_print_mode'] ?? 'text' ) ),
			self::MODES,
			true
		) ? sanitize_key( wp_unslash( $_POST['printengine_print_mode'] ) ) : 'text';

		// Resolve size + color from variation
		$variation_id = absint( $_POST['variation_id'] ?? 0 );
		if ( $variation_id ) {
			$variation = wc_get_product( $variation_id );
			if ( $variation instanceof \WC_Product_Variation ) {
				$config->size  = strtolower( sanitize_text_field(
					$variation->get_attribute( 'clothing_size' )
					?: $variation->get_attribute( 'pa_clothing_size' )
					?: ''
				) );
				$config->color = strtolower( sanitize_text_field(
					$variation->get_attribute( 'color' )
					?: $variation->get_attribute( 'pa_color' )
					?: ''
				) );

				$parent = wc_get_product( $variation->get_parent_id() );
				if ( $parent instanceof \WC_Product_Variable ) {
					foreach ( $parent->get_available_variations() as $v ) {
						$attrs = $v['attributes'];
						if ( ! empty( $attrs['attribute_pa_clothing_size'] ) ) {
							$config->allowed_sizes[] = strtolower( $attrs['attribute_pa_clothing_size'] );
						}
						if ( ! empty( $attrs['attribute_pa_color'] ) ) {
							$config->allowed_colors[] = strtolower( $attrs['attribute_pa_color'] );
						}
					}
					$config->allowed_sizes  = array_unique( $config->allowed_sizes );
					$config->allowed_colors = array_unique( $config->allowed_colors );
				}
			}
		}

		// Resolve print_area from product admin settings
		$product_id = absint( $_POST['add-to-cart'] ?? 0 );
		if ( $product_id ) {
			$areas                        = \PrintEngine\Product\PrintAreaSettings::get_areas( $product_id );
			$config->allowed_print_areas  = $areas;

			$submitted = sanitize_key( wp_unslash( $_POST['print_config_print_area'] ?? $areas[0] ) );
			$config->print_area = in_array( $submitted, $areas, true ) ? $submitted : $areas[0];
		}

		// Imprint content
		if ( $config->mode === 'text' ) {
			$config->text = sanitize_textarea_field( wp_unslash( $_POST['printengine_print_text'] ?? '' ) );
		} else {
			$config->image_source  = sanitize_text_field( wp_unslash( $_POST['printengine_image_source'] ?? '' ) );
			$config->attachment_id = absint( $_POST['printengine_library_attachment_id'] ?? 0 );
		}

		return $config;
	}

	/**
	 * Deserialise from the JSON string stored in cart/order meta.
	 */
	public static function from_json( string $json ): ?self {
		$data = json_decode( $json, true );
		if ( ! is_array( $data ) ) {
			return null;
		}

		$d = isset( $data['print_config'] ) ? $data['print_config'] : $data;

		$config             = new self();
		$config->image      = sanitize_text_field( $d['image']      ?? '' );
		$config->size       = sanitize_text_field( $d['size']       ?? '' );
		$config->color      = sanitize_text_field( $d['color']      ?? '' );
		$config->print_area = sanitize_key( $d['print_area']        ?? 'front' );
		$config->mode       = in_array( $d['mode'] ?? '', self::MODES, true ) ? $d['mode'] : 'text';
		$config->text       = sanitize_textarea_field( $d['text']   ?? '' );
		$config->meta       = is_array( $d['meta'] ?? null ) ? $d['meta'] : [];

		$config->image_source  = sanitize_text_field( $d['_image_source']  ?? '' );
		$config->attachment_id = absint( $d['_attachment_id'] ?? 0 );

		return $config;
	}

	/**
	 * Deserialise from a cart item array.
	 */
	public static function from_cart_item( array $cart_item ): ?self {
		if ( empty( $cart_item[ self::CART_KEY ] ) ) {
			return null;
		}
		return self::from_json( $cart_item[ self::CART_KEY ] );
	}

	// -----------------------------------------------------------------------
	// Serialisation
	// -----------------------------------------------------------------------

	/**
	 * Returns the canonical array matching the agreed spec.
	 * This is the single source of truth for the print_config structure.
	 */
	public function to_array(): array {
		return [
			'print_config' => [
				'image'      => $this->image,
				'size'       => $this->size,
				'color'      => $this->color,
				'print_area' => $this->print_area,
				'mode'       => $this->mode,
				'text'       => $this->text,
				'meta'       => $this->meta,
				// Runtime fields for display/pipeline use.
				'_image_source'  => $this->image_source,
				'_attachment_id' => $this->attachment_id,
			],
		];
	}

	/**
	 * Serialise to JSON for storage in cart/order meta.
	 */
	public function to_json(): string {
		return wp_json_encode( $this->to_array() );
	}

	// -----------------------------------------------------------------------
	// Validation
	// -----------------------------------------------------------------------

	/**
	 * Returns validation error strings. Empty array means valid.
	 *
	 * Validates:
	 * - print_area belongs to product's allowed areas
	 * - size belongs to product's available variation sizes (if known)
	 * - color belongs to product's available variation colors (if known)
	 * - text/image content per mode
	 *
	 * @return string[]
	 */
	public function errors( int $text_max_length = 100 ): array {
		$errors = [];

		if ( ! in_array( $this->print_area, $this->allowed_print_areas, true ) ) {
			$errors[] = __( 'Please select a valid print area.', 'printengine-woocommerce-addon' );
		}

		if ( ! empty( $this->allowed_sizes ) && ! in_array( $this->size, $this->allowed_sizes, true ) ) {
			$errors[] = __( 'Please select a valid size.', 'printengine-woocommerce-addon' );
		}

		if ( ! empty( $this->allowed_colors ) && ! in_array( $this->color, $this->allowed_colors, true ) ) {
			$errors[] = __( 'Please select a valid color.', 'printengine-woocommerce-addon' );
		}

		// Mode-specific content
		if ( $this->mode === 'text' ) {
			if ( empty( $this->text ) ) {
				$errors[] = __( 'Please enter imprint text before adding to cart.', 'printengine-woocommerce-addon' );
			} elseif ( mb_strlen( $this->text ) > $text_max_length ) {
				$errors[] = sprintf(
					/* translators: %d = max character count */
					__( 'Imprint text is too long (max %d characters).', 'printengine-woocommerce-addon' ),
					$text_max_length
				);
			}
		} elseif ( $this->mode === 'image' ) {
			if ( empty( $this->image ) && empty( $this->attachment_id ) ) {
				$errors[] = __( 'Please select or upload an imprint image.', 'printengine-woocommerce-addon' );
			}
		}

		return $errors;
	}

	public function is_valid( int $text_max_length = 100 ): bool {
		return empty( $this->errors( $text_max_length ) );
	}

	// -----------------------------------------------------------------------
	// Display helpers
	// -----------------------------------------------------------------------

	public function display_label(): string {
		return $this->mode === 'text' ? $this->text : $this->image;
	}
}