<?php
/**
 * Plugin Name: Webshop Cart Item Data Sanitizer
 * Description: Prevents Divi builder shortcodes from leaking into WooCommerce cart item metadata.
 */

if ( ! defined( 'ABSPATH' ) ) {
exit;
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
foreach ( array( 'key', 'name', 'value', 'display' ) as $field ) {
if ( isset( $item[ $field ] ) && is_string( $item[ $field ] ) && preg_match( '/\[\/?et_pb_[^\]]*/i', $item[ $field ] ) ) {
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
