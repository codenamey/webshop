<?php

/**
 * Plugin Name: PrintEngine WooCommerce Addon
 * Description: WooCommerce addon for custom print configuration and PrintEngine integration.
 * Version: 0.1.0
 * Author: PrintGen
 * Text Domain: printengine-woocommerce-addon
 * Requires at least: 6.0
 * Requires PHP: 8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PRINTENGINE_WC_ADDON_FILE', __FILE__ );
define( 'PRINTENGINE_WC_ADDON_PATH', plugin_dir_path( __FILE__ ) );
define( 'PRINTENGINE_WC_ADDON_URL', plugin_dir_url( __FILE__ ) );
define( 'PRINTENGINE_WC_ADDON_VERSION', '0.1.0' );

add_action( 'plugins_loaded', function () {
	if ( ! class_exists( 'WooCommerce' ) ) {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-error"><p>';
			echo esc_html__( 'PrintEngine WooCommerce Addon requires WooCommerce to be installed and activated.', 'printengine-woocommerce-addon' );
			echo '</p></div>';
		} );
		return;
	}

	$plugin_class  = PRINTENGINE_WC_ADDON_PATH . 'src/Plugin.php';
	$resolved_path = realpath( $plugin_class );
	$base_path     = realpath( PRINTENGINE_WC_ADDON_PATH );

	if ( $resolved_path && $base_path && str_starts_with( $resolved_path, $base_path ) ) {
		require_once $resolved_path;
	}

	if ( class_exists( '\PrintEngine\Plugin' ) ) {
		\PrintEngine\Plugin::init();
	}
} );

add_action( 'woocommerce_order_status_completed', function( $order_id ) {
    $order = wc_get_order( $order_id );

    foreach ( $order->get_items() as $item ) {
        $attachment_id = $item->get_meta( '_printengine_attachment_id', true );
        if ( $attachment_id ) {
            delete_post_meta( $attachment_id, '_printengine_temp_upload' );
        }
    }
});

add_action( 'printengine_cleanup_temp_uploads', 'printengine_cleanup_temp_uploads_callback' );

function printengine_cleanup_temp_uploads_callback() {

    $days = 3;
    $threshold = time() - ( $days * DAY_IN_SECONDS );

    $query = new WP_Query([
        'post_type'      => 'attachment',
        'posts_per_page' => -1,
        'meta_query'     => [
            [
                'key'     => '_printengine_temp_upload',
                'value'   => $threshold,
                'compare' => '<',
                'type'    => 'NUMERIC',
            ],
        ],
        'fields' => 'ids',
    ]);

    foreach ( $query->posts as $attachment_id ) {
        wp_delete_attachment( $attachment_id, true );
    }
}



register_activation_hook( __FILE__, function () {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	if ( ! wp_next_scheduled( 'printengine_cleanup_temp_uploads' ) ) {
    wp_schedule_event( time(), 'daily', 'printengine_cleanup_temp_uploads' );
	}

	// Future activation logic here.
} );

register_deactivation_hook( __FILE__, function () {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	// Future deactivation logic here.
} );