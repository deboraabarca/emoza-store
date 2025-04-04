<?php
/**
 * Wishlist
 *
 * @package Emoza
 */
if ( ! Emoza_Modules::is_module_active( 'wishlist' ) ) {
	return;
}

/**
 * Wishlist post class callback
 */
function emoza_wishlist_post_class( $classes ) {
	$wishlist_icon_show_on_hover = get_theme_mod( 'shop_product_wishlist_show_on_hover', 0 );
	if( $wishlist_icon_show_on_hover ) {
		$classes[] = 'emoza-wishlist-show-on-hover';
	}

	return $classes;
}
add_filter( 'woocommerce_post_class', 'emoza_wishlist_post_class' );

/**
 * Wishlist button
 */
function emoza_wishlist_button( $product = false, $do_echo = true  ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id          = $product->get_id(); 
	$is_wishlist_enabled = Emoza_Modules::is_module_active( 'wishlist' );
	$wishlist_layout     = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 
	if ( ! $is_wishlist_enabled || $is_wishlist_enabled && 'layout1' === $wishlist_layout ) {
		return '';
	}
	$shop_product_wishlist_tooltip = get_theme_mod( 'shop_product_wishlist_tooltip', 0 );
	$tooltip_text                  = $shop_product_wishlist_tooltip ? get_theme_mod( 'shop_product_wishlist_tooltip_text' ) : '';
	$wishlist_page_link            = get_the_permalink( get_option( 'emoza_wishlist_page_id' ) );

	if( $do_echo === false ) {
		ob_start();
	} ?>

	<a href="#" class="emoza-wishlist-button<?php echo ( $shop_product_wishlist_tooltip ) ? ' emoza-wishlist-button-tooltip' : ''; ?><?php echo ( emoza_product_is_inthe_wishlist( $product_id ) ) ? ' active' : ''; ?>" data-type="add" data-wishlist-link="<?php echo esc_url( $wishlist_page_link ); ?>" aria-label="<?php /* translators: %s: add to wishlist product title */ echo esc_attr( sprintf( __( 'Add the product %s to wishlist', 'emoza-woocommerce' ), get_the_title( $product_id ) ) ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'emoza-wishlist-nonce' ) ); ?>" data-emoza-wishlist-tooltip="<?php echo esc_attr( $tooltip_text ); ?>">
		<div class="emoza-wishlist-icon-wrapper" data-wishlist-remove-text="<?php echo esc_attr__( 'Remove from Wishlist', 'emoza-woocommerce' ); ?>">
			<svg class="emoza-wishlist-icon" width="17" height="17" viewBox="0 0 25 22" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M13.8213 2.50804L13.8216 2.5078C16.1161 0.140222 19.7976 -0.212946 22.2492 1.87607C25.093 4.30325 25.2444 8.66651 22.6933 11.2992L22.6932 11.2993L13.245 21.055C13.245 21.0551 13.245 21.0551 13.2449 21.0551C12.8311 21.4822 12.1652 21.4822 11.7514 21.0551C11.7513 21.0551 11.7513 21.0551 11.7513 21.055L2.30334 11.2995C-0.243225 8.66684 -0.0918835 4.30344 2.75181 1.8762C5.20368 -0.213127 8.88985 0.140465 11.1793 2.50744L11.1799 2.50804L12.1418 3.49925L12.5006 3.86899L12.8594 3.49925L13.8213 2.50804Z" stroke-width="3" stroke="#212121" fill="transparent"/>
			</svg>
			<div class="emoza-wishlist-loading-icon emozaAnimRotate emoza-anim-infinite">
				<?php emoza_get_svg_icon( 'icon-spinner', true ); ?>
			</div>
		</div>
	</a>

	<?php
	if( $do_echo === false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Wishlist button for single product and quick view
 */
function emoza_single_wishlist_button( $product = false, $do_echo = true  ) {
	if( $product == false ) {
		global $product; 
	}

	$product_id        = $product->get_id(); 
	$wishlist_layout   = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ); 
	if( 'layout1' === $wishlist_layout ) {
		return '';
	}

	$wishlist_page_link        = get_the_permalink( get_option( 'emoza_wishlist_page_id' ) );
	$product_is_inthe_wishlist = emoza_product_is_inthe_wishlist( $product_id );
	$button_text               = $product_is_inthe_wishlist ? __( 'View Wishlist', 'emoza-woocommerce' ) : __( 'Add to Wishlist', 'emoza-woocommerce' );
	
	if( $do_echo === false ) {
		ob_start();
	} ?>

	<div class="emoza-wishlist-wrapper">
		<a href="#" class="emoza-wishlist-button<?php echo ( $product_is_inthe_wishlist ) ? ' active' : ''; ?>" data-type="add" data-wishlist-link="<?php echo esc_url( $wishlist_page_link ); ?>" aria-label="<?php /* translators: %s: add to wishlist product title */ echo esc_attr__( 'Add to Wishlist', 'emoza-woocommerce' ); ?>" data-product-id="<?php echo absint( $product_id ); ?>" data-nonce="<?php echo esc_attr( wp_create_nonce( 'emoza-wishlist-nonce' ) ); ?>">
			<div class="emoza-wishlist-icon-wrapper" data-wishlist-remove-text="<?php echo esc_attr__( 'Remove from Wishlist', 'emoza-woocommerce' ); ?>">
				<svg class="emoza-wishlist-icon" width="17" height="17" viewBox="-2 -2 30 27" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M13.8213 2.50804L13.8216 2.5078C16.1161 0.140222 19.7976 -0.212946 22.2492 1.87607C25.093 4.30325 25.2444 8.66651 22.6933 11.2992L22.6932 11.2993L13.245 21.055C13.245 21.0551 13.245 21.0551 13.2449 21.0551C12.8311 21.4822 12.1652 21.4822 11.7514 21.0551C11.7513 21.0551 11.7513 21.0551 11.7513 21.055L2.30334 11.2995C-0.243225 8.66684 -0.0918835 4.30344 2.75181 1.8762C5.20368 -0.213127 8.88985 0.140465 11.1793 2.50744L11.1799 2.50804L12.1418 3.49925L12.5006 3.86899L12.8594 3.49925L13.8213 2.50804Z" stroke-width="3" stroke="#212121" fill="transparent"/>
				</svg>
				<div class="emoza-wishlist-loading-icon emozaAnimRotate emoza-anim-infinite">
					<?php emoza_get_svg_icon( 'icon-spinner', true ); ?>
				</div>
			</div>
			<span class="emoza-wishlist-text" data-wishlist-add-text="<?php echo esc_attr__( 'Add to Wishlist', 'emoza-woocommerce' ); ?>" data-wishlist-view-text="<?php echo esc_attr__( 'View Wishlist', 'emoza-woocommerce' ); ?>"><?php echo esc_html( $button_text ); ?></span>
		</a>
	</div>	

	<?php
	if( $do_echo === false ) {
		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Wishlist set no cache headers
 * The purpose is avoid caching issues with plugins and servers
 */
function emoza_set_nocache_headers() {
	if( ! headers_sent() ) { 
		if( isset( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ) {
			if( class_exists( 'WC_Cache_Helper' ) ) {
				WC_Cache_Helper::set_nocache_constants(true);
			}
			nocache_headers();
		}
	}
}
add_action( 'woocommerce_init', 'emoza_set_nocache_headers' );

/**
 * Wishlist button ajax callback
 * The cookie name needs to contain "woocommerce_items_in_cart" to avoid caching issues in some servers like kinsta. 
 * Reference: https://kinsta.com/blog/wordpress-cookies-php-sessions/#3-exclude-pages-from-cache-when-the-cookie-is-present
 */
function emoza_button_wishlist_callback_function(){
	check_ajax_referer( 'emoza-wishlist-nonce', 'nonce' );

	if( !isset( $_POST['product_id'] ) ) {
		return;
	}

	$qty = 1;

	if( isset( $_POST['type'] ) && 'add' === $_POST['type'] ) {
		if( isset( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ) {
			$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) );
			$arr               = explode( ',', $wishlist_products );
			$newvalue          = $wishlist_products . ',' . absint( $_POST['product_id'] );
			$qty               = count( $arr ) + 1;
	
			if( !in_array( $_POST['product_id'], $arr ) ) {

				/**
				 * Hook 'emoza_wishlist_cookie_expiration_time'
				 *
				 * @since 1.0.0
				 */
				setcookie( 'woocommerce_items_in_cart_emoza_wishlist', $newvalue, apply_filters( 'emoza_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
			}
		} else {

			/**
			 * Hook 'emoza_wishlist_cookie_expiration_time'
			 *
			 * @since 1.0.0
			 */
			setcookie( 'woocommerce_items_in_cart_emoza_wishlist', absint( $_POST['product_id'] ), apply_filters( 'emoza_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
		}
	} else {
		$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) );
		$arr               = explode( ',', $wishlist_products );
		$key               = array_search( $_POST['product_id'], $arr, true );

		unset( $arr[ $key ] );

		$newvalue = implode( ',', $arr );

		$qty = count( $arr );

		/**
		 * Hook 'emoza_wishlist_cookie_expiration_time'
		 *
		 * @since 1.0.0
		 */
		setcookie( 'woocommerce_items_in_cart_emoza_wishlist', $newvalue, apply_filters( 'emoza_wishlist_cookie_expiration_time', time()+2592000 ), COOKIEPATH ? COOKIEPATH : '/', COOKIE_DOMAIN );
	}

	wp_send_json( array(
		'status' => 'success',
		'qty'    => absint( $qty ),
	) );
}
add_action('wp_ajax_emoza_button_wishlist', 'emoza_button_wishlist_callback_function');
add_action( 'wp_ajax_nopriv_emoza_button_wishlist', 'emoza_button_wishlist_callback_function' );

/**
 * Wishlist - Check if the product is in the list
 */
function emoza_product_is_inthe_wishlist( $product_id ) {
	if( ! isset( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ) {
		return false;
	} 

	$wishlist_products = sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) );
	$products          = explode( ',', $wishlist_products );
	if( in_array( $product_id, $products ) ) {
		return true;
	}

	return false;
}
