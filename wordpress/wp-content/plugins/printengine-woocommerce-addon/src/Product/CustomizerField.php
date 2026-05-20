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

		// Stay on product page after add to cart — show notice instead of redirecting.
		add_filter( 'woocommerce_add_to_cart_redirect', [ self::class, 'stay_on_product_page' ], 10, 2 );
		add_filter( 'wc_add_to_cart_message_html',      [ self::class, 'add_to_cart_message' ], 10, 2 );
	}

	/**
	 * Redirect back to the product page instead of the cart after adding to cart.
	 */
	public static function stay_on_product_page( string $url, ?\WC_Product $product ): string {
		if ( ! $product ) {
			return $url;
		}
		if ( is_product() || isset( $_POST['add-to-cart'] ) ) {
			return get_permalink( $product->get_id() );
		}
		return $url;
	}

	/**
	 * Customise the "added to cart" notice to include a cart link.
	 */
	public static function add_to_cart_message( string $message, array $products ): string {
		$cart_url = wc_get_cart_url();
		$message  = sprintf(
			'%s <a href="%s" class="button wc-forward">%s</a>',
			__( '"Product" has been added to your cart.', 'printengine-woocommerce-addon' ),
			esc_url( $cart_url ),
			__( 'View cart', 'printengine-woocommerce-addon' )
		);
		return $message;
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
					'fileTooLarge'  => __( 'File is too large (max 10 MB).', 'printengine-woocommerce-addon' ),
					'invalidType'   => __( 'Allowed file types: JPG, PNG, SVG.', 'printengine-woocommerce-addon' ),
					'textTooLong'   => __( 'Text is too long (max 20 characters).', 'printengine-woocommerce-addon' ),
					'requiredText'  => __( 'Please enter imprint text.', 'printengine-woocommerce-addon' ),
					'requiredImage' => __( 'Please select or upload an imprint image.', 'printengine-woocommerce-addon' ),
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
					'printText'  => __( 'Imprint text', 'printengine-woocommerce-addon' ),
					'printImage' => __( 'Imprint image', 'printengine-woocommerce-addon' ),
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
		global $product;
		$library    = ImageLibrary::get_library();
		$product_id = $product instanceof \WC_Product ? $product->get_id() : get_the_ID();
		$areas      = \PrintEngine\Product\PrintAreaSettings::get_areas( $product_id );
		$multi_area = count( $areas ) > 1;
		?>
		<div class="printengine-customizer" id="printengine-customizer">

			<p class="printengine-customizer__title">
				<strong><?php esc_html_e( 'Imprint', 'printengine-woocommerce-addon' ); ?></strong>
			</p>

			<?php if ( $multi_area ) : ?>
			<!-- Print area — only shown when product has multiple areas configured -->
			<div class="printengine-field-row">
				<label for="print_config_print_area"><?php esc_html_e( 'Print area', 'printengine-woocommerce-addon' ); ?></label>
				<select id="print_config_print_area" name="print_config_print_area">
					<?php foreach ( $areas as $area ) : ?>
						<option value="<?php echo esc_attr( $area ); ?>"><?php echo esc_html( ucfirst( $area ) ); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<?php else : ?>
			<input type="hidden" name="print_config_print_area" value="<?php echo esc_attr( $areas[0] ); ?>" />
			<?php endif; ?>

			<!-- Tab navigation -->
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
					<?php esc_html_e( 'Choose from library', 'printengine-woocommerce-addon' ); ?>
				</button>
				<?php endif; ?>
			</div>

			<!-- Text panel -->
			<div class="printengine-panel" id="printengine-panel-text">
				<label for="printengine_print_text">
					<?php
					printf(
						/* translators: %d = max character count */
						esc_html__( 'Imprint text (max %d characters)', 'printengine-woocommerce-addon' ),
						self::TEXT_MAX_LENGTH
					);
					?>
				</label>
				<textarea
					id="printengine_print_text"
					name="printengine_print_text"
					rows="3"
					maxlength="<?php echo esc_attr( self::TEXT_MAX_LENGTH ); ?>"
					placeholder="<?php esc_attr_e( 'Enter imprint text…', 'printengine-woocommerce-addon' ); ?>"></textarea>
				<p class="printengine-char-count" id="printengine-text-count" aria-live="polite">
					<span id="printengine-text-remaining"><?php echo esc_html( self::TEXT_MAX_LENGTH ); ?></span>
					<?php esc_html_e( 'characters remaining', 'printengine-woocommerce-addon' ); ?>
				</p>
				<p class="printengine-error" id="printengine-text-error" hidden></p>
			</div>

			<!-- Upload panel -->
			<div class="printengine-panel" id="printengine-panel-upload" hidden>
				<label for="printengine_upload">
					<?php esc_html_e( 'Upload image (JPG, PNG or SVG, max 10 MB)', 'printengine-woocommerce-addon' ); ?>
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

			<!-- Hidden fields -->
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
		$nonce = sanitize_text_field( wp_unslash( $_POST['woocommerce-add-to-cart-nonce'] ?? '' ) );
		if ( $nonce && ! wp_verify_nonce( $nonce, 'woocommerce-add-to-cart' ) ) {
			return false;
		}

		$config = \PrintEngine\PrintConfig::from_post();

		// SVG content check for uploaded files.
		$mode = sanitize_key( wp_unslash( $_POST['printengine_print_mode'] ?? 'text' ) );
		if ( $mode !== 'text' ) {
			$source = sanitize_text_field( wp_unslash( $_POST['printengine_image_source'] ?? '' ) );

			if ( $source === 'upload' ) {
				if ( empty( $_FILES['printengine_upload']['tmp_name'] ) ) {
					wc_add_notice( __( 'Please add an imprint image before adding to cart.', 'printengine-woocommerce-addon' ), 'error' );
					return false;
				}

				$mime    = mime_content_type( $_FILES['printengine_upload']['tmp_name'] );
				$allowed = [ 'image/jpeg', 'image/png', 'image/svg+xml' ];

				if ( ! in_array( $mime, $allowed, true ) ) {
					wc_add_notice( __( 'Allowed file types: JPG, PNG, SVG.', 'printengine-woocommerce-addon' ), 'error' );
					return false;
				}

				if ( $mime === 'image/svg+xml' ) {
					$svg = file_get_contents( $_FILES['printengine_upload']['tmp_name'] );
					if ( $svg === false
						|| preg_match( '/<script/i', $svg )
						|| preg_match( '/\bon\w+\s*=/i', $svg )
						|| preg_match( '/javascript\s*:/i', $svg )
					) {
						wc_add_notice( __( 'SVG file contains prohibited content.', 'printengine-woocommerce-addon' ), 'error' );
						return false;
					}
				}
			}

			if ( $source === 'library' ) {
				$attachment_id = absint( $_POST['printengine_library_attachment_id'] ?? 0 );
				if ( ! $attachment_id || ! in_array( $attachment_id, ImageLibrary::get_library(), true ) ) {
					wc_add_notice( __( 'Please select an image from the library before adding to cart.', 'printengine-woocommerce-addon' ), 'error' );
					return false;
				}
			}
		}

		foreach ( $config->errors( self::TEXT_MAX_LENGTH ) as $error ) {
			wc_add_notice( $error, 'error' );
			return false;
		}

		return $passed;
	}

	// -----------------------------------------------------------------------
	// Cart
	// -----------------------------------------------------------------------

	public static function save_to_cart( array $cart_item_data, int $product_id ): array {
		$config = \PrintEngine\PrintConfig::from_post();

		// Handle file upload — resolve attachment ID before serialising.
		if ( $config->mode !== 'text' && $config->image_source === 'upload'
			&& ! empty( $_FILES['printengine_upload']['tmp_name'] ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/media.php';
			require_once ABSPATH . 'wp-admin/includes/image.php';

			$attachment_id = media_handle_upload( 'printengine_upload', 0 );
			if ( ! is_wp_error( $attachment_id ) ) {
				$config->attachment_id = $attachment_id;
				$config->image         = (string) $attachment_id;
			}
		}

		if ( $config->mode !== 'text' && $config->image_source === 'library' && $config->attachment_id ) {
			$config->image = (string) $config->attachment_id;
		}

		$cart_item_data['print_config'] = $config->to_json();

		// Keep legacy fields for backwards compatibility with block-cart integration.
		$cart_item_data['printengine_print_mode'] = $config->mode;
		if ( $config->mode === 'text' ) {
			$cart_item_data['printengine_print_text'] = $config->text;
		} else {
			$cart_item_data['printengine_image_attachment_id'] = $config->attachment_id;
			$cart_item_data['printengine_image_url']           = wp_get_attachment_url( $config->attachment_id ) ?: '';
			$cart_item_data['printengine_image_source']        = $config->image_source;
		}

		return $cart_item_data;
	}

	public static function display_in_cart( array $item_data, array $cart_item ): array {
		$config = \PrintEngine\PrintConfig::from_cart_item( $cart_item );
		if ( ! $config ) {
			return $item_data;
		}

		if ( $config->size ) {
			$item_data[] = [ 'key' => __( 'Size', 'printengine-woocommerce-addon' ), 'value' => esc_html( strtoupper( $config->size ) ) ];
		}
		if ( $config->color ) {
			$item_data[] = [ 'key' => __( 'Color', 'printengine-woocommerce-addon' ), 'value' => esc_html( ucfirst( $config->color ) ) ];
		}
		$item_data[] = [ 'key' => __( 'Print area', 'printengine-woocommerce-addon' ), 'value' => esc_html( ucfirst( $config->print_area ) ) ];

		if ( $config->mode === 'text' && $config->text ) {
			$item_data[] = [ 'key' => __( 'Imprint text', 'printengine-woocommerce-addon' ), 'value' => esc_html( $config->text ) ];
		} elseif ( $config->mode !== 'text' && $config->attachment_id ) {
			$thumb = wp_get_attachment_image( $config->attachment_id, 'thumbnail' );
			$item_data[] = [ 'key' => __( 'Imprint image', 'printengine-woocommerce-addon' ), 'value' => $thumb ?: esc_url( wp_get_attachment_url( $config->attachment_id ) ) ];
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
		if ( empty( $values['print_config'] ) ) {
			return;
		}

		// Store the full PrintConfig JSON for DTF pipeline.
		$item->add_meta_data( '_print_config', $values['print_config'], true );

		// Human-readable fields for emails / order confirmation.
		$config = \PrintEngine\PrintConfig::from_json( $values['print_config'] );
		if ( ! $config ) {
			return;
		}

		if ( $config->size ) {
			$item->add_meta_data( __( 'Size', 'printengine-woocommerce-addon' ), strtoupper( $config->size ), true );
		}
		if ( $config->color ) {
			$item->add_meta_data( __( 'Color', 'printengine-woocommerce-addon' ), ucfirst( $config->color ), true );
		}
		$item->add_meta_data( __( 'Print area', 'printengine-woocommerce-addon' ), ucfirst( $config->print_area ), true );

		if ( $config->mode === 'text' && $config->text ) {
			$item->add_meta_data( __( 'Imprint text', 'printengine-woocommerce-addon' ), $config->text, true );
		} elseif ( $config->attachment_id ) {
			$item->add_meta_data( __( 'Imprint image', 'printengine-woocommerce-addon' ), $config->attachment_id, true );
		}
	}

	/**
	 * Replace the raw attachment ID with a thumbnail in order emails
	 * and the My Account order view.
	 */
	public static function display_meta_value( $value, \WC_Meta_Data $meta, \WC_Order_Item $item ) {
		if ( $meta->key !== __( 'Imprint image', 'printengine-woocommerce-addon' ) ) {
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
		$json = $item->get_meta( '_print_config' );
		if ( ! $json ) {
			return;
		}

		$config = \PrintEngine\PrintConfig::from_json( $json );
		if ( ! $config ) {
			return;
		}

		echo '<div class="printengine-admin-image" style="margin-top:8px;font-size:0.9em;">';
		echo '<strong>' . esc_html__( 'Print config', 'printengine-woocommerce-addon' ) . '</strong><br />';

		if ( $config->size ) {
			echo esc_html__( 'Size', 'printengine-woocommerce-addon' ) . ': <strong>' . esc_html( strtoupper( $config->size ) ) . '</strong><br />';
		}
		if ( $config->color ) {
			echo esc_html__( 'Color', 'printengine-woocommerce-addon' ) . ': <strong>' . esc_html( ucfirst( $config->color ) ) . '</strong><br />';
		}
		echo esc_html__( 'Print area', 'printengine-woocommerce-addon' ) . ': <strong>' . esc_html( ucfirst( $config->print_area ) ) . '</strong><br />';

		if ( $config->mode === 'text' ) {
			echo esc_html__( 'Imprint text', 'printengine-woocommerce-addon' ) . ': <strong>' . esc_html( $config->text ) . '</strong>';
		} elseif ( $config->attachment_id ) {
			$img  = wp_get_attachment_image( $config->attachment_id, 'thumbnail' );
			$url  = wp_get_attachment_url( $config->attachment_id );
			$src  = $config->image_source === 'library'
				? __( 'from library', 'printengine-woocommerce-addon' )
				: __( 'customer upload', 'printengine-woocommerce-addon' );
			echo esc_html__( 'Imprint image', 'printengine-woocommerce-addon' ) . ' <em>(' . esc_html( $src ) . ')</em>:<br />';
			echo '<a href="' . esc_url( $url ) . '" target="_blank" rel="noopener">' . wp_kses_post( $img ) . '</a>';
		}

		echo '</div>';
	}
}