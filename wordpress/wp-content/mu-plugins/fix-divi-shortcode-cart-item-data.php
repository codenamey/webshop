<?php
/**
 * Plugin Name: Webshop Cart Item Data Sanitizer
 * Description: Prevents Divi builder shortcodes from leaking into WooCommerce cart item metadata.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WEBSHOP_DIVI_SHORTCODE_PATTERN' ) ) {
	define( 'WEBSHOP_DIVI_SHORTCODE_PATTERN', '/\[\/?et_pb_[^\]]*?\]/i' );
}

add_filter(
	'woocommerce_get_item_data',
	static function ( $item_data ) {
		if ( ! is_array( $item_data ) ) {
			return $item_data;
		}

		$sanitized_item_data = array();

		foreach ( $item_data as $item ) {
			if ( ! is_array( $item ) ) {
				$sanitized_item_data[] = $item;
				continue;
			}

			$contains_divi_shortcode = false;
			foreach ( array( 'value', 'display', 'key', 'name' ) as $field ) {
				if ( isset( $item[ $field ] ) && is_string( $item[ $field ] ) && preg_match( WEBSHOP_DIVI_SHORTCODE_PATTERN, $item[ $field ] ) ) {
					$contains_divi_shortcode = true;
					break;
				}
			}

			if ( ! $contains_divi_shortcode ) {
				$sanitized_item_data[] = $item;
			}
		}

		return $sanitized_item_data;
	},
	20
);
