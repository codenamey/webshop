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

register_activation_hook( __FILE__, function () {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	// Future activation logic here.
} );

register_deactivation_hook( __FILE__, function () {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	// Future deactivation logic here.
} );