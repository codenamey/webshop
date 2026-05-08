<?php

namespace PrintEngine\Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Manages the admin-curated image library.
 *
 * Images are stored as an array of WordPress attachment IDs
 * in the option `printengine_image_library`.
 */
class ImageLibrary {

	public static function register(): void {
		// Admin: settings page to manage the library.
		add_action( 'admin_menu', [ self::class, 'add_menu_page' ] );
		add_action( 'admin_post_printengine_save_library', [ self::class, 'handle_save' ] );
	}

	// -----------------------------------------------------------------------
	// Admin menu
	// -----------------------------------------------------------------------

	public static function add_menu_page(): void {
		add_submenu_page(
			'woocommerce',
			__( 'PrintEngine — kuvakirjasto', 'printengine-woocommerce-addon' ),
			__( 'Kuvakirjasto', 'printengine-woocommerce-addon' ),
			'manage_woocommerce',
			'printengine-image-library',
			[ self::class, 'render_page' ]
		);
	}

	public static function render_page(): void {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		$library = self::get_library();
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'PrintEngine — kuvakirjasto', 'printengine-woocommerce-addon' ); ?></h1>
			<p><?php esc_html_e( 'Add images that customers can choose from on the product page.', 'printengine-woocommerce-addon' ); ?></p>

			<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
				<input type="hidden" name="action" value="printengine_save_library" />
				<?php wp_nonce_field( 'printengine_save_library', 'printengine_nonce' ); ?>

				<div id="printengine-library-grid" style="display:flex;flex-wrap:wrap;gap:12px;margin:16px 0;">
					<?php foreach ( $library as $attachment_id ) : ?>
						<div class="printengine-library-item" style="position:relative;">
							<?php echo wp_get_attachment_image( $attachment_id, 'thumbnail' ); ?>
							<input type="hidden" name="printengine_library_ids[]" value="<?php echo esc_attr( $attachment_id ); ?>" />
							<button type="button" class="printengine-remove-image button"
								style="position:absolute;top:2px;right:2px;"
								data-id="<?php echo esc_attr( $attachment_id ); ?>">✕</button>
						</div>
					<?php endforeach; ?>
				</div>

				<button type="button" id="printengine-add-image" class="button">
					<?php esc_html_e( 'Add image', 'printengine-woocommerce-addon' ); ?>
				</button>

				<?php submit_button( __( 'Save library', 'printengine-woocommerce-addon' ) ); ?>
			</form>
		</div>

		<script>
		(function($) {
			var frame;
			$('#printengine-add-image').on('click', function() {
				if (frame) { frame.open(); return; }
				frame = wp.media({ title: 'Choose image', multiple: true, library: { type: 'image' } });
				frame.on('select', function() {
					frame.state().get('selection').each(function(attachment) {
						var a     = attachment.toJSON();
						var thumb = a.sizes && a.sizes.thumbnail ? a.sizes.thumbnail.url : a.url;
						var id    = String( parseInt( a.id, 10 ) ); // ensure numeric string

						// Build DOM nodes — no string concatenation to avoid XSS.
						var wrapper = document.createElement('div');
						wrapper.className = 'printengine-library-item';
						wrapper.style.cssText = 'position:relative;';

						var img = document.createElement('img');
						img.src    = thumb;
						img.width  = 150;
						img.height = 150;
						img.style.cssText = 'object-fit:cover;';
						img.alt = a.alt || a.filename || '';

						var input = document.createElement('input');
						input.type  = 'hidden';
						input.name  = 'printengine_library_ids[]';
						input.value = id;

						var btn = document.createElement('button');
						btn.type      = 'button';
						btn.className = 'printengine-remove-image button';
						btn.style.cssText = 'position:absolute;top:2px;right:2px;';
						btn.dataset.id = id;
						btn.textContent = '✕';

						wrapper.appendChild(img);
						wrapper.appendChild(input);
						wrapper.appendChild(btn);

						document.getElementById('printengine-library-grid').appendChild(wrapper);
					});
				});
				frame.open();
			});

			$(document).on('click', '.printengine-remove-image', function() {
				$(this).closest('.printengine-library-item').remove();
			});
		}(jQuery));
		</script>
		<?php
	}

	public static function handle_save(): void {
		if ( ! current_user_can( 'manage_woocommerce' ) ) {
			wp_die( esc_html__( 'No permission.', 'printengine-woocommerce-addon' ) );
		}

		check_admin_referer( 'printengine_save_library', 'printengine_nonce' );

		$raw_ids = isset( $_POST['printengine_library_ids'] )
			? (array) $_POST['printengine_library_ids']
			: [];

		$clean_ids = array_values(
			array_filter(
				array_map( 'absint', $raw_ids )
			)
		);

		update_option( 'printengine_image_library', $clean_ids );

		wp_safe_redirect(
			add_query_arg( 'updated', '1', admin_url( 'admin.php?page=printengine-image-library' ) )
		);
		exit;
	}

	// -----------------------------------------------------------------------
	// Public helpers
	// -----------------------------------------------------------------------

	/**
	 * Returns the array of attachment IDs in the library.
	 *
	 * @return int[]
	 */
	public static function get_library(): array {
		return array_filter(
			array_map( 'absint', (array) get_option( 'printengine_image_library', [] ) )
		);
	}
}