<?php
/**
 * WooCommerce Ajax Callbacks
 *
 * @package Emoza
 */

/**
 * Emoza custom add to cart ajax callback
 */
function emoza_custom_addtocart_callback_function(){
	check_ajax_referer( 'emoza-custom-addtocart-nonce', 'nonce' );

	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	WC()->cart->add_to_cart( absint( $_POST['product_id'] ) );

	wp_die();
}
add_action('wp_ajax_emoza_custom_addtocart', 'emoza_custom_addtocart_callback_function');
add_action( 'wp_ajax_nopriv_emoza_custom_addtocart', 'emoza_custom_addtocart_callback_function' );