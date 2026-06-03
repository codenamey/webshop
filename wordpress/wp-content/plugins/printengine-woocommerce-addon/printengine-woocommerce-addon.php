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
	} else {
		add_action( 'admin_notices', static function () {
			echo '<div class="notice notice-error"><p>';
			echo esc_html__( 'PrintEngine WooCommerce Addon failed to load its bootstrap file.', 'printengine-woocommerce-addon' );
			echo '</p></div>';
		} );
		return;
	}

	if ( class_exists( '\PrintEngine\Plugin' ) ) {
		\PrintEngine\Plugin::init();
	}
} );

register_activation_hook( __FILE__, function () {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	if ( version_compare( PHP_VERSION, '8.0', '<' ) ) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( esc_html__( 'PrintEngine WooCommerce Addon requires PHP 8.0 or higher.', 'printengine-woocommerce-addon' ) );
	}

	add_option( 'printengine_wc_addon_version', PRINTENGINE_WC_ADDON_VERSION );

	if ( false === get_option( 'printengine_image_library' ) ) {
		add_option( 'printengine_image_library', [] );
	}

	if ( function_exists( 'wc_create_attribute' ) ) {
		if ( ! taxonomy_exists( 'pa_clothing_size' ) ) {
			$size_id = wc_create_attribute( [
				'name'         => 'Clothing size',
				'slug'         => 'clothing_size',
				'type'         => 'select',
				'order_by'     => 'menu_order',
				'has_archives' => false,
			] );
			if ( ! is_wp_error( $size_id ) ) {
				register_taxonomy( 'pa_clothing_size', 'product' );
				foreach ( [ 'S', 'M', 'L', 'XL', 'XXL' ] as $term ) {
					if ( ! term_exists( $term, 'pa_clothing_size' ) ) {
						wp_insert_term( $term, 'pa_clothing_size' );
					}
				}
			}
		}

		if ( ! taxonomy_exists( 'pa_color' ) ) {
			$color_id = wc_create_attribute( [
				'name'         => 'Color',
				'slug'         => 'color',
				'type'         => 'select',
				'order_by'     => 'menu_order',
				'has_archives' => false,
			] );
			if ( ! is_wp_error( $color_id ) ) {
				register_taxonomy( 'pa_color', 'product' );
				foreach ( [ 'Black', 'White', 'Gray' ] as $term ) {
					if ( ! term_exists( $term, 'pa_color' ) ) {
						wp_insert_term( $term, 'pa_color' );
					}
				}
			}
		}
	}
} );

register_deactivation_hook( __FILE__, function () {
	// wp_clear_scheduled_hook( 'printengine_cleanup_orphan_uploads' );
} );
