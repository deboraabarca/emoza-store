<?php
/**
 * Mini Cart
 *
 * @package Emoza
 */

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'emoza_woocommerce_header_cart' ) ) {
			emoza_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'emoza_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function emoza_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		?>

		<span class="cart-count"><i class="ws-svg-icon"><?php emoza_get_header_icon( 'cart', true ); ?></i><span class="count-number"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span></span>

		<?php
		$fragments['.cart-count'] = ob_get_clean();

		return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'emoza_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'emoza_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function emoza_woocommerce_cart_link() {
		$mini_cart_style = get_theme_mod( 'mini_cart_style', 'default' );

		$extra_atts = '';
		if( $mini_cart_style === 'side' && ! is_cart() && ! is_checkout() ) {
			$extra_atts = ' onclick="emoza.toggleClass.init(event, this, \'side-mini-cart-toggle\');" data-emoza-selector=".emoza-side-mini-cart" data-emoza-toggle-class="show"';
		}

		$link = '<a class="cart-contents" href="' . esc_url( wc_get_cart_url() ) . '" title="' . esc_attr__( 'View your shopping cart', 'emoza-woocommerce' ) . '"'. $extra_atts .'>';
		$link .= '<span class="cart-count"><i class="ws-svg-icon">' . emoza_get_header_icon( 'cart' ) . '</i><span class="count-number">' . esc_html( WC()->cart->get_cart_contents_count() ) . '</span></span>';
		$link .= '</a>';

		return $link;
	}
}

if ( ! function_exists( 'emoza_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function emoza_woocommerce_header_cart() {
		get_template_part( 'template-parts/header/content-header', 'icons' );
	}
}