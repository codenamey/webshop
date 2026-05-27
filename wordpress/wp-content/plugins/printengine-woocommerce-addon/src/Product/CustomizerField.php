<?php

namespace PrintEngine\Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Renders the print-image picker on the product page and persists
 * the customer's choice through cart → order → admin/confirmation.
 */
class CustomizerField {

	public static function register(): void {
		// Front end — product page.
		add_action( 'woocommerce_before_add_to_cart_button', [ self::class, 'render_field' ] );
		add_action( 'wp_enqueue_scripts',                    [ self::class, 'enqueue_assets' ] );
		add_action( 'wp_enqueue_scripts',                    [ self::class, 'enqueue_block_cart_assets' ] );

		// Disable AJAX add-to-cart so the full form (including file upload) is submitted normally.
		add_filter( 'woocommerce_is_purchasable',            '__return_true' );
		add_filter( 'woocommerce_product_supports',          [ self::class, 'disable_ajax_add_to_cart' ], 10, 3 );

		// Validate before adding to cart.
		add_filter( 'woocommerce_add_to_cart_validation',    [ self::class, 'validate' ], 10, 2 );

		// Persist through cart.
		add_filter( 'woocommerce_add_cart_item_data',        [ self::class, 'save_to_cart' ], 10, 2 );
		add_filter( 'woocommerce_get_item_data',             [ self::class, 'display_in_cart' ], 10, 2 );

		// Persist to order line item.
		add_action( 'woocommerce_checkout_create_order_line_item', [ self::class, 'save_to_order' ], 10, 4 );

		// Show in admin order view.
		add_action( 'woocommerce_after_order_itemmeta',      [ self::class, 'display_in_admin_order' ], 10, 3 );

		// Show in customer order confirmation / account.
		add_filter( 'woocommerce_order_item_display_meta_value', [ self::class, 'display_meta_value' ], 10, 3 );
	}

	/**
	 * Disable AJAX add-to-cart for all products so our file upload
	 * is submitted via a standard multipart form POST.
	 */
	public static function disable_ajax_add_to_cart( bool $supported, string $feature, \WC_Product $product ): bool {
		if ( $feature === 'ajax_add_to_cart' ) {
			return false;
		}
		return $supported;
	}

	// -----------------------------------------------------------------------
	// Assets
	// -----------------------------------------------------------------------

	public static function enqueue_assets(): void {
		if ( ! is_product() ) {
			return;
		}

		wp_enqueue_style(
			'printengine-customizer',
			PRINTENGINE_WC_ADDON_URL . 'assets/css/customizer.css',
			[],
			PRINTENGINE_WC_ADDON_VERSION
		);

		wp_enqueue_script(
			'printengine-customizer',
			PRINTENGINE_WC_ADDON_URL . 'assets/js/customizer.js',
			[ 'jquery' ],
			PRINTENGINE_WC_ADDON_VERSION,
			true
		);

		wp_localize_script(
			'printengine-customizer',
			'PrintEngineData',
			[
				'maxFileSize'   => 10 * 1024 * 1024,
				'maxTextLength' => self::TEXT_MAX_LENGTH,
				'allowedTypes'  => [ 'image/jpeg', 'image/png', 'image/svg+xml' ],
				'i18n' => [
					'fileTooLarge'  => __( 'File is too large (max 10 Mt).', 'printengine-woocommerce-addon' ),
					'invalidType'   => __( 'Allowed file types: JPG, PNG, SVG.', 'printengine-woocommerce-addon' ),
					'textTooLong'   => __( 'Text is too long (max 20 characters).', 'printengine-woocommerce-addon' ),
					'requiredText'  => __( 'Write custom text.', 'printengine-woocommerce-addon' ),
					'requiredImage' => __( 'Choose or upload custom image.', 'printengine-woocommerce-addon' ),
				],
			]
		);
	}

	public static function enqueue_block_cart_assets(): void {
		if ( ! is_cart() ) {
			return;
		}

		wp_enqueue_script(
			'printengine-block-cart',
			PRINTENGINE_WC_ADDON_URL . 'assets/js/block-cart.js',
			[],
			PRINTENGINE_WC_ADDON_VERSION,
			true
		);

		wp_localize_script(
			'printengine-block-cart',
			'PrintEngineBlockData',
			[
				'i18n' => [
					'printText'  => __( 'Custom text', 'printengine-woocommerce-addon' ),
					'printImage' => __( 'Custom image', 'printengine-woocommerce-addon' ),
				],
			]
		);
	}

	// -----------------------------------------------------------------------
	// Render
	// -----------------------------------------------------------------------

	/** Maximum characters allowed in the print text field. */
	const TEXT_MAX_LENGTH = 20;

	public static function render_field(): void {
		$library = ImageLibrary::get_library();
		?>
		<div class="printengine-customizer" id="printengine-customizer">

			<p class="printengine-customizer__title">
				<strong><?php esc_html_e( 'Imprint', 'printengine-woocommerce-addon' ); ?></strong>
			</p>

			<!-- Tab navigation — always shown (text + upload; library added when available) -->
			<div class="printengine-tabs" role="tablist">
				<button type="button" role="tab" aria-selected="true"
					class="printengine-tab printengine-tab--active"
					data-tab="text">
					<?php esc_html_e( 'Text', 'printengine-woocommerce-addon' ); ?>
				</button>
				<button type="button" role="tab" aria-selected="false"
					class="printengine-tab"
					data-tab="upload">
					<?php esc_html_e( 'Upload image', 'printengine-woocommerce-addon' ); ?>
				</button>
				<?php if ( ! empty( $library ) ) : ?>
				<button type="button" role="tab" aria-selected="false"
					class="printengine-tab"
					data-tab="library">
					<?php esc_html_e( 'Choose image from library', 'printengine-woocommerce-addon' ); ?>
				</button>
				<?php endif; ?>
			</div>

			<!-- Text panel -->
			<div class="printengine-panel" id="printengine-panel-text">
				<label for="printengine_print_text">
					<?php
					printf(
						/* translators: %d = max character count */
						esc_html__( 'Printed text (max %d characters)', 'printengine-woocommerce-addon' ),
						self::TEXT_MAX_LENGTH
					);
					?>
				</label>
				<textarea
					id="printengine_print_text"
					name="printengine_print_text"
					rows="3"
					maxlength="<?php echo esc_attr( self::TEXT_MAX_LENGTH ); ?>"
					placeholder="<?php esc_attr_e( 'Write your text here…', 'printengine-woocommerce-addon' ); ?>"></textarea>
				<p class="printengine-char-count" id="printengine-text-count" aria-live="polite">
					<span id="printengine-text-remaining"><?php echo esc_html( self::TEXT_MAX_LENGTH ); ?></span>
					<?php esc_html_e( 'characters left', 'printengine-woocommerce-addon' ); ?>
				</p>
				<p class="printengine-error" id="printengine-text-error" hidden></p>
			</div>

			<!-- Upload panel -->
			<div class="printengine-panel" id="printengine-panel-upload" hidden>
				<label for="printengine_upload">
					<?php esc_html_e( 'Upload image (JPG, PNG tai SVG, max 10 Mt)', 'printengine-woocommerce-addon' ); ?>
				</label>
				<input type="file"
					id="printengine_upload"
					name="printengine_upload"
					accept="image/jpeg,image/png,image/svg+xml" />
				<div id="printengine-upload-preview" class="printengine-preview" hidden></div>
				<p class="printengine-error" id="printengine-upload-error" hidden></p>
			</div>

			<?php if ( ! empty( $library ) ) : ?>
			<!-- Library panel -->
			<div class="printengine-panel" id="printengine-panel-library" hidden>
				<div class="printengine-library-grid" role="listbox"
					aria-label="<?php esc_attr_e( 'Image library', 'printengine-woocommerce-addon' ); ?>">
					<?php foreach ( $library as $attachment_id ) :
						$url   = wp_get_attachment_url( $attachment_id );
						$thumb = wp_get_attachment_image_url( $attachment_id, 'thumbnail' );
						$title = get_the_title( $attachment_id );
						if ( ! $url ) continue;
					?>
					<button type="button"
						class="printengine-library-item"
						role="option"
						aria-selected="false"
						data-url="<?php echo esc_url( $url ); ?>"
						data-id="<?php echo esc_attr( $attachment_id ); ?>"
						title="<?php echo esc_attr( $title ); ?>">
						<img src="<?php echo esc_url( $thumb ); ?>"
							alt="<?php echo esc_attr( $title ); ?>"
							loading="lazy" />
					</button>
					<?php endforeach; ?>
				</div>
				<div id="printengine-library-preview" class="printengine-preview" hidden></div>
			</div>
			<?php endif; ?>

			<!-- Hidden fields posted with Add to cart -->
			<input type="hidden" id="printengine_image_source" name="printengine_image_source" value="" />
			<input type="hidden" id="printengine_library_attachment_id" name="printengine_library_attachment_id" value="" />
			<input type="hidden" id="printengine_print_mode" name="printengine_print_mode" value="text" />

		</div>
		<?php
	}

	// -----------------------------------------------------------------------
	// Validation
	// -----------------------------------------------------------------------

	public static function validate( bool $passed, int $product_id ): bool {
		// Verify WooCommerce's own add-to-cart nonce only if it is present.
		// Some themes do not include it, so we only reject if it exists but is invalid.
		$nonce = sanitize_text_field( wp_unslash( $_POST['woocommerce-add-to-cart-nonce'] ?? '' ) );
		if ( $nonce && ! wp_verify_nonce( $nonce, 'woocommerce-add-to-cart' ) ) {
			return false;
		}

		$mode = isset( $_POST['printengine_print_mode'] )
			? sanitize_key( wp_unslash( $_POST['printengine_print_mode'] ) )
			: 'text';

		// Text mode validation.
		if ( $mode === 'text' ) {
			$text = isset( $_POST['printengine_print_text'] )
				? sanitize_textarea_field( wp_unslash( $_POST['printengine_print_text'] ) )
				: '';

			if ( $text === '' ) {
				wc_add_notice(
					__( 'Write custom text before adding to cart.', 'printengine-woocommerce-addon' ),
					'error'
				);
				return false;
			}

			if ( mb_strlen( $text ) > self::TEXT_MAX_LENGTH ) {
				wc_add_notice(
					sprintf(
						/* translators: %d = max character count */
						__( 'Custom text is too long (max %d characters).', 'printengine-woocommerce-addon' ),
						self::TEXT_MAX_LENGTH
					),
					'error'
				);
				return false;
			}

			return $passed;
		}

		// Image mode validation.
		$source = isset( $_POST['printengine_image_source'] )
			? sanitize_text_field( wp_unslash( $_POST['printengine_image_source'] ) )
			: '';

		// Uploaded file — server-side type and SVG content check.
		if ( $source === 'upload' ) {
			if ( empty( $_FILES['printengine_upload']['tmp_name'] ) ) {
				wc_add_notice(
					__( 'Choose an image before adding to cart.', 'printengine-woocommerce-addon' ),
					'error'
				);
				return false;
			}

			$mime    = mime_content_type( $_FILES['printengine_upload']['tmp_name'] );
			$allowed = [ 'image/jpeg', 'image/png', 'image/svg+xml' ];

			if ( ! in_array( $mime, $allowed, true ) ) {
				wc_add_notice(
					__( 'Allowed file types: JPG, PNG, SVG.', 'printengine-woocommerce-addon' ),
					'error'
				);
				return false;
			}

			// SVG-specific: reject files containing inline scripts or event handlers.
			if ( $mime === 'image/svg+xml' ) {
				$svg = file_get_contents( $_FILES['printengine_upload']['tmp_name'] );
				if ( $svg === false
					|| preg_match( '/<script/i', $svg )
					|| preg_match( '/\bon\w+\s*=/i', $svg )
					|| preg_match( '/javascript\s*:/i', $svg )
				) {
					wc_add_notice(
						__( 'SVG files must not contain inline scripts or event handlers.', 'printengine-woocommerce-addon' ),
						'error'
					);
					return false;
				}
			}
		}

		// Library selection.
		if ( $source === 'library' ) {
			$attachment_id = absint( $_POST['printengine_library_attachment_id'] ?? 0 );

			if ( ! $attachment_id || ! in_array( $attachment_id, ImageLibrary::get_library(), true ) ) {
				wc_add_notice(
					__( 'Choose an image before adding to cart.', 'printengine-woocommerce-addon' ),
					'error'
				);
				return false;
			}
		}

		return $passed;
	}

	// -----------------------------------------------------------------------
	// Cart
	// -----------------------------------------------------------------------

	public static function save_to_cart( array $cart_item_data, int $product_id ): array {
		$mode = isset( $_POST['printengine_print_mode'] )
			? sanitize_key( wp_unslash( $_POST['printengine_print_mode'] ) )
			: 'text';

		$cart_item_data['printengine_print_mode'] = $mode;

		// Text mode.
		if ( $mode === 'text' ) {
			$text = isset( $_POST['printengine_print_text'] )
				? sanitize_textarea_field( wp_unslash( $_POST['printengine_print_text'] ) )
				: '';

			if ( $text !== '' ) {
				$cart_item_data['printengine_print_text'] = mb_substr( $text, 0, self::TEXT_MAX_LENGTH );
			}

			return $cart_item_data;
		}

		// Image mode.
		$source = isset( $_POST['printengine_image_source'] )
			? sanitize_text_field( wp_unslash( $_POST['printengine_image_source'] ) )
			: '';

		if ( $source === 'upload' && ! empty( $_FILES['printengine_upload']['tmp_name'] ) ) {
			// Move uploaded file to WP uploads via the media API.
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';

			$attachment_id = media_handle_upload( 'printengine_upload', 0 );

			if ( ! is_wp_error( $attachment_id ) ) {
				$cart_item_data['printengine_image_attachment_id'] = $attachment_id;
				$cart_item_data['printengine_image_url']           = wp_get_attachment_url( $attachment_id );
				$cart_item_data['printengine_image_source']        = 'upload';
			}
		}

		if ( $source === 'library' ) {
			$attachment_id = absint( $_POST['printengine_library_attachment_id'] ?? 0 );

			if ( $attachment_id && in_array( $attachment_id, ImageLibrary::get_library(), true ) ) {
				$cart_item_data['printengine_image_attachment_id'] = $attachment_id;
				$cart_item_data['printengine_image_url']           = wp_get_attachment_url( $attachment_id );
				$cart_item_data['printengine_image_source']        = 'library';
			}
		}

		return $cart_item_data;
	}

	public static function display_in_cart( array $item_data, array $cart_item ): array {
		$mode = $cart_item['printengine_print_mode'] ?? '';

		if ( $mode === 'text' && ! empty( $cart_item['printengine_print_text'] ) ) {
			$item_data[] = [
				'key'   => __( 'Custom text', 'printengine-woocommerce-addon' ),
				'value' => esc_html( $cart_item['printengine_print_text'] ),
			];
		}

		if ( $mode !== 'text' && ! empty( $cart_item['printengine_image_url'] ) ) {
			$thumb = wp_get_attachment_image(
				$cart_item['printengine_image_attachment_id'],
				'thumbnail'
			);

			$item_data[] = [
				'key'   => __( 'Custom image', 'printengine-woocommerce-addon' ),
				'value' => $thumb ?: esc_url( $cart_item['printengine_image_url'] ),
			];
		}

		return $item_data;
	}

	// -----------------------------------------------------------------------
	// Order
	// -----------------------------------------------------------------------

	public static function save_to_order(
		\WC_Order_Item_Product $item,
		string $cart_item_key,
		array $values,
		\WC_Order $order
	): void {
		$mode = $values['printengine_print_mode'] ?? '';
		$item->add_meta_data( '_printengine_print_mode', sanitize_key( $mode ), true );

		if ( $mode === 'text' && ! empty( $values['printengine_print_text'] ) ) {
			$text = sanitize_textarea_field( $values['printengine_print_text'] );
			$item->add_meta_data( '_printengine_print_text', $text, true );
			$item->add_meta_data( __( 'Custom text', 'printengine-woocommerce-addon' ), $text, true );
			return;
		}

		if ( ! empty( $values['printengine_image_attachment_id'] ) ) {
			$item->add_meta_data( '_printengine_image_attachment_id', absint( $values['printengine_image_attachment_id'] ), true );
			$item->add_meta_data( '_printengine_image_url', esc_url_raw( $values['printengine_image_url'] ), true );
			$item->add_meta_data( '_printengine_image_source', sanitize_text_field( $values['printengine_image_source'] ), true );

			// Human-readable label for emails / confirmation page.
			$item->add_meta_data(
				__( 'Custom image', 'printengine-woocommerce-addon' ),
				absint( $values['printengine_image_attachment_id'] ),
				true
			);
		}
	}

	/**
	 * Replace the raw attachment ID with a thumbnail in order emails
	 * and the My Account order view.
	 */
	public static function display_meta_value( $value, \WC_Meta_Data $meta, \WC_Order_Item $item ) {
		if ( $meta->key !== __( 'Custom image', 'printengine-woocommerce-addon' ) ) {
			return $value;
		}

		$attachment_id = absint( $value );
		$img           = wp_get_attachment_image( $attachment_id, 'thumbnail' );

		return $img ?: $value;
	}

	// -----------------------------------------------------------------------
	// Admin order view
	// -----------------------------------------------------------------------

	public static function display_in_admin_order( int $item_id, \WC_Order_Item $item, $product ): void {
		$mode = $item->get_meta( '_printengine_print_mode' );

		if ( $mode === 'text' ) {
			$text = $item->get_meta( '_printengine_print_text' );
			if ( ! $text ) {
				return;
			}
			echo '<div class="printengine-admin-image" style="margin-top:8px;">';
			echo '<strong>' . esc_html__( 'Custom text', 'printengine-woocommerce-addon' ) . '</strong><br />';
			echo '<span>' . esc_html( $text ) . '</span>';
			echo '</div>';
			return;
		}

		$attachment_id = absint( $item->get_meta( '_printengine_image_attachment_id' ) );

		if ( ! $attachment_id ) {
			return;
		}

		$img    = wp_get_attachment_image( $attachment_id, 'thumbnail' );
		$url    = wp_get_attachment_url( $attachment_id );
		$source = $item->get_meta( '_printengine_image_source' );
		$label  = $source === 'library'
			? __( 'from library', 'printengine-woocommerce-addon' )
			: __( 'uploaded by customer', 'printengine-woocommerce-addon' );

		echo '<div class="printengine-admin-image" style="margin-top:8px;">';
		echo '<strong>' . esc_html__( 'Custom image', 'printengine-woocommerce-addon' ) . '</strong>';
		echo ' <em>(' . esc_html( $label ) . ')</em><br />';
		echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . wp_kses_post( $img ) . '</a>';
		echo '</div>';
	}
}