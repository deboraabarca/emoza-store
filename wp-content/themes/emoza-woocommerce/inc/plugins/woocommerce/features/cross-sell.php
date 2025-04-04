<?php
/**
 * Cross Sell
 *
 * @package Emoza
 */

/**
 * Enqueue cross sell scripts
 */
function emoza_cross_sell_scripts() {
	$layout                      = get_theme_mod( 'shop_cart_layout', 'layout1' );
	$shop_cart_show_cross_sell   = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
	$enable_mini_cart_cross_sell = get_theme_mod( 'enable_mini_cart_cross_sell', 0 );

	if( 
		( is_cart() && $shop_cart_show_cross_sell && count( WC()->cart->get_cross_sells() ) > 2 ) ||
		( ! is_cart() && $enable_mini_cart_cross_sell ) 
	) {
		// We need register this script again because the order of 'wp_enqueue_scripts'
		wp_register_script( 'emoza-carousel', get_template_directory_uri() . '/assets/js/emoza-carousel.min.js', NULL, EMOZA_VERSION, false );
		wp_enqueue_script( 'emoza-carousel' );
	}
}
add_action( 'wp_enqueue_scripts', 'emoza_cross_sell_scripts', 9 );

/**
 * Hooks 
 */
function emoza_cross_sell_hooks() {
    if ( is_cart() ) {
		add_filter( 'emoza_content_class', function( $content_class ) { 
			$shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );
			$layout                    = get_theme_mod( 'shop_cart_layout', 'layout1' ); 

			if( $shop_cart_show_cross_sell && count( WC()->cart->get_cross_sells() ) > 2 ) {
				$content_class .= ' has-cross-sells-carousel';
			}
			
			return $content_class; 
		} );

        //Cart cross sell
        $cart_layout               = get_theme_mod( 'shop_cart_layout', 'layout1' );
        $shop_cart_show_cross_sell = get_theme_mod( 'shop_cart_show_cross_sell', 1 );

        if( !$shop_cart_show_cross_sell ) {
            remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
        }
        add_filter( 'woocommerce_cross_sells_columns', function() use ($cart_layout) {
            return 'layout1' === $cart_layout ? 2 : 4;
        } );
	}
	
	add_filter( 'woocommerce_cross_sells_total', function() {
		return -1;
	} );
}
add_action( 'wp', 'emoza_cross_sell_hooks' );

/**
 * Mini cart cross sell
 */
function emoza_mini_cart_cross_sell() {
	if( is_cart() ) {
		return;
	}

	$enable_mini_cart_cross_sell = get_theme_mod( 'enable_mini_cart_cross_sell', 0 );
	if( ! $enable_mini_cart_cross_sell || count( WC()->cart->get_cross_sells() ) === 0 ) {
		return;
	} ?>
	
	<div class="emoza-woocommerce-mini-cart__cross-sell">
		<?php woocommerce_cross_sell_display(); ?>
	</div>

	<?php
}
add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'emoza_mini_cart_cross_sell' );