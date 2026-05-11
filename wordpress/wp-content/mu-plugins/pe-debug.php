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

add_action( 'woocommerce_cart_loaded_from_session', function() {
    error_log( 'PE SESSION cart contents: ' . print_r( WC()->cart->get_cart(), true ) );
    error_log( 'PE SESSION id: ' . WC()->session->get_customer_id() );
});

add_action( 'woocommerce_add_to_cart', function( $cart_item_key, $product_id ) {
    error_log( 'PE AFTER ADD cart contents: ' . print_r( WC()->cart->get_cart(), true ) );
}, 10, 2 );