<?php

namespace PrintEngine;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Value object representing a customer's print configuration.
 *
 * Serialises to / deserialises from the JSON structure:
 * {
 *   "image": "attachment-id-or-url",
 *   "size":  "L",
 *   "color": "black",
 *   "print_area": "front",
 *   "meta": {}
 * }
 */
class PrintConfig {

	const PRINT_AREAS = [ 'front', 'back' ];

	public string $image      = '';   // attachment ID (cast to string) or URL
	public string $size       = '';
	public string $color      = '';
	public string $print_area = 'front';
	public array  $meta       = [];
	public array  $available_print_areas = [ 'front' ];

	// Internal — not part of the JSON spec but needed for cart/order handling.
	public string $mode             = 'image'; // 'text' | 'image'
	public string $text             = '';
	public string $image_source     = ''; // 'upload' | 'library'
	public int    $attachment_id    = 0;

	// -----------------------------------------------------------------------
	// Factory
	// -----------------------------------------------------------------------

	/**
	 * Build a PrintConfig from raw $_POST data + WooCommerce variation context.
	 *
	 * size and color are resolved from the selected variation, not from
	 * customer-facing fields. print_area is resolved from product admin settings.
	 */
	public static function from_post(): ?self {
		$config = new self();

		$config->mode = sanitize_key( wp_unslash( $_POST['printengine_print_mode'] ?? 'text' ) );

		// Resolve size + color from the selected WooCommerce variation.
		$variation_id = absint( $_POST['variation_id'] ?? 0 );
		if ( $variation_id ) {
			$variation = wc_get_product( $variation_id );
			if ( $variation instanceof \WC_Product_Variation ) {
				$config->size  = sanitize_text_field( $variation->get_attribute( 'size' )  ?: $variation->get_attribute( 'pa_size' )  ?: '' );
				$config->color = sanitize_text_field( $variation->get_attribute( 'color' ) ?: $variation->get_attribute( 'pa_color' ) ?: '' );
			}
		}

		// Resolve print_area from product admin settings.
		$product_id = absint( $_POST['add-to-cart'] ?? 0 );
		if ( $product_id ) {
			$areas              = \PrintEngine\Product\PrintAreaSettings::get_areas( $product_id );
			$config->print_area = count( $areas ) === 1
				? $areas[0]
				: sanitize_key( wp_unslash( $_POST['print_config_print_area'] ?? $areas[0] ) );

			if ( ! in_array( $config->print_area, $areas, true ) ) {
				$config->print_area = $areas[0];
			}
		}

		$config->available_print_areas = isset( $product_id )
			? \PrintEngine\Product\PrintAreaSettings::get_areas( $product_id )
			: [ 'front' ];

		if ( $config->mode === 'text' ) {
			$config->text = sanitize_textarea_field( wp_unslash( $_POST['printengine_print_text'] ?? '' ) );
		} else {
			$config->image_source  = sanitize_text_field( wp_unslash( $_POST['printengine_image_source'] ?? '' ) );
			$config->attachment_id = absint( $_POST['printengine_library_attachment_id'] ?? 0 );
		}

		return $config;
	}

	/**
	 * Deserialise from a JSON string stored in cart/order meta.
	 */
	public static function from_json( string $json ): ?self {
		$data = json_decode( $json, true );
		if ( ! is_array( $data ) ) {
			return null;
		}

		$config             = new self();
		$config->image      = sanitize_text_field( $data['image']      ?? '' );
		$config->size       = sanitize_text_field( $data['size']       ?? '' );
		$config->color      = sanitize_text_field( $data['color']      ?? '' );
		$config->print_area = sanitize_key( $data['print_area'] ?? 'front' );
		$config->meta       = is_array( $data['meta'] ?? null ) ? $data['meta'] : [];
		$config->mode       = sanitize_key( $data['_mode']        ?? 'image' );
		$config->text       = sanitize_textarea_field( $data['_text'] ?? '' );
		$config->image_source  = sanitize_text_field( $data['_image_source'] ?? '' );
		$config->attachment_id = absint( $data['_attachment_id'] ?? 0 );

		return $config;
	}

	/**
	 * Deserialise from a cart item array.
	 */
	public static function from_cart_item( array $cart_item ): ?self {
		if ( empty( $cart_item['print_config'] ) ) {
			return null;
		}
		return self::from_json( $cart_item['print_config'] );
	}

	// -----------------------------------------------------------------------
	// Serialisation
	// -----------------------------------------------------------------------

	/**
	 * Serialise to the canonical JSON structure for storage.
	 */
	public function to_json(): string {
		return wp_json_encode( $this->to_array() );
	}

	/**
	 * Returns the canonical array — matches the spec exactly.
	 */
	public function to_array(): array {
		return [
			'image'      => $this->image,
			'size'       => $this->size,
			'color'      => $this->color,
			'print_area' => $this->print_area,
			'meta'       => $this->meta,
			// Internal fields prefixed with _ so they're clearly non-spec.
			'_mode'          => $this->mode,
			'_text'          => $this->text,
			'_image_source'  => $this->image_source,
			'_attachment_id' => $this->attachment_id,
		];
	}

	// -----------------------------------------------------------------------
	// Validation
	// -----------------------------------------------------------------------

	/**
	 * Returns a list of validation error strings, empty if valid.
	 *
	 * @param int $text_max_length
	 * @return string[]
	 */
	public function errors( int $text_max_length = 20 ): array {
		$errors = [];

		// print_area must be one of the product's allowed areas.
		if ( ! in_array( $this->print_area, $this->available_print_areas, true ) ) {
			$errors[] = __( 'Please select a valid print area.', 'printengine-woocommerce-addon' );
		}

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
		}

		return $errors;
	}

	/**
	 * Returns true if the config is valid.
	 */
	public function is_valid( int $text_max_length = 20 ): bool {
		return empty( $this->errors( $text_max_length ) );
	}

	// -----------------------------------------------------------------------
	// Display helpers
	// -----------------------------------------------------------------------

	/**
	 * Human-readable label for cart / order display.
	 */
	public function display_label(): string {
		if ( $this->mode === 'text' ) {
			return $this->text;
		}
		return $this->image;
	}
}