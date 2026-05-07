<?php
add_filter( 'woocommerce_add_cart_item_data', function( $cart_item_data, $product_id ) {
    error_log( 'PE CART DATA: ' . print_r( $cart_item_data, true ) );
    return $cart_item_data;
}, 99, 2 );

add_action( 'woocommerce_add_to_cart', function( $cart_item_key, $product_id ) {
    error_log( 'PE ADDED TO CART: product=' . $product_id . ' key=' . $cart_item_key );
}, 10, 2 );

add_filter( 'woocommerce_add_to_cart_validation', function( $passed, $product_id ) {
    error_log( 'PE VALIDATION passed=' . var_export( $passed, true ) );
    return $passed;
}, 99, 2 );