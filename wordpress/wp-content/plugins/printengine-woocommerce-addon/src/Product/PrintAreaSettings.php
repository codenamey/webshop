<?php

namespace PrintEngine\Product;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class PrintAreaSettings {

	const META_KEY    = '_printengine_print_areas';
	const VALID_AREAS = [ 'front', 'back' ];

	public static function register(): void {
		add_action( 'add_meta_boxes',                   [ self::class, 'add_meta_box' ] );
		add_action( 'woocommerce_process_product_meta', [ self::class, 'save_meta' ] );
	}

	public static function add_meta_box(): void {
		add_meta_box(
			'printengine-print-areas',
			__( 'PrintEngine — Print areas', 'printengine-woocommerce-addon' ),
			[ self::class, 'render_meta_box' ],
			'product',
			'side',
			'default'
		);
	}

	public static function render_meta_box( \WP_Post $post ): void {
		$saved = self::get_areas( $post->ID );
		wp_nonce_field( 'printengine_print_areas', 'printengine_print_areas_nonce' );
		?>
		<p style="margin-top:0;"><?php esc_html_e( 'Select which print areas are available for this product.', 'printengine-woocommerce-addon' ); ?></p>
		<?php foreach ( self::VALID_AREAS as $area ) : ?>
		<label style="display:block;margin-bottom:6px;">
			<input type="checkbox"
				name="printengine_print_areas[]"
				value="<?php echo esc_attr( $area ); ?>"
				<?php checked( in_array( $area, $saved, true ) ); ?> />
			<?php echo esc_html( ucfirst( $area ) ); ?>
		</label>
		<?php endforeach; ?>
		<?php
	}

	public static function save_meta( int $post_id ): void {
		if ( ! isset( $_POST['printengine_print_areas_nonce'] ) ) {
			return;
		}
		if ( ! wp_verify_nonce(
			sanitize_text_field( wp_unslash( $_POST['printengine_print_areas_nonce'] ) ),
			'printengine_print_areas'
		) ) {
			return;
		}
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
		$raw   = isset( $_POST['printengine_print_areas'] ) ? (array) $_POST['printengine_print_areas'] : [];
		$clean = array_values( array_intersect( $raw, self::VALID_AREAS ) );
		update_post_meta( $post_id, self::META_KEY, $clean );
	}

	public static function get_areas( int $product_id ): array {
		$areas = get_post_meta( $product_id, self::META_KEY, true );
		if ( ! is_array( $areas ) || empty( $areas ) ) {
			return [ 'front' ];
		}
		return array_values( array_intersect( $areas, self::VALID_AREAS ) );
	}
}
