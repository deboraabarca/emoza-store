<?php

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Starter Register Demos
 */
function emwc_demos_list() {

	$plugins = array();

	$plugins[] = array(
		'name'     => 'WooCommerce',
		'slug'     => 'woocommerce',
		'path'     => 'woocommerce/woocommerce.php',
		'required' => true
	);

	$demos = array(
		'fivar'      => array(
			'name'       => esc_html__( 'Fivar', 'emoza-starter-sites' ),
			'type'       => 'free',
			'categories' => array( 'ecommerce' ),
			'builders'   => array(
				'gutenberg',
				'elementor',
			),
			'preview'    => 'https://demo.emoza.org/products-fivar/',
			'thumbnail'  => 'https://demo.emoza.org/demo-content/products-fivar/preview.png', // thumbail url
			'plugins'    => array_merge(
				$plugins,
				array(
					array(
						'name'     => 'WPForms - Contact Form',
						'slug'     => 'wpforms-lite',
						'path'     => 'wpforms-lite/wpforms.php',
						'required' => false
					)
				),
				array(
					array(
						'name'     => 'Stackable - Gutenberg Blocks',
						'slug'     => 'stackable-ultimate-gutenberg-blocks',
						'path'     => 'stackable-ultimate-gutenberg-blocks/plugin.php',
						'required' => false
					)
				),
			),
			'import'         => array(
				'gutenberg'    => array(
					'content'    => EMWC_URL . 'demo-content/products-fivar/gutenberg/content.xml',
					'widgets'    => EMWC_URL . 'demo-content/products-fivar/gutenberg/widgets.wie',
					'customizer' => EMWC_URL . 'demo-content/products-fivar/gutenberg/customizer.dat'
				),
				'elementor'    => array(
					'content'    => EMWC_URL . 'demo-content/products-fivar/elementor/content-el.xml',
					'widgets'    => EMWC_URL . 'demo-content/products-fivar/elementor/widgets-el.wie',
					'customizer' => EMWC_URL . 'demo-content/products-fivar/elementor/customizer-el.dat'
				),
			),
		)
	);

	return $demos;

}
add_filter( 'emwc_register_demos_list', 'emwc_demos_list' );

/**
 * Define actions that happen after import
 */
function emwc_setup_after_import( $demo_id ) {

	// Disable WPForms modern markup.
	// This is needed because our demos was built with the old markup.
	if ( in_array( $demo_id, array( 'fivar' ) ) ) {
		$wpforms_settings                    = (array) get_option( 'wpforms_settings', [] );
		$wpforms_settings[ 'modern-markup' ] = false;
	
		update_option( 'wpforms_settings', $wpforms_settings );
	}

	// Assign the menu.
	$main_menu = get_term_by( 'name', 'Main', 'nav_menu' );
	if ( ! empty( $main_menu ) ) {
		$locations = get_theme_mod( 'nav_menu_locations', array() );
		$locations['primary'] = $main_menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// Fivar, Consmatic and Single Product Demo Extras
	if ( in_array( $demo_id, array( 'fivar' ) ) ) {

		// Set modules.
	  $modules = get_option( 'emoza-modules', array() );
		update_option( 'emoza-modules', array_merge( $modules, array( 'hf-builder' => true ) ) );

	}

	// "Footer" menu (menu name from import)
	$footer_menu_one = get_term_by( 'name', 'Footer', 'nav_menu' );
	if ( ! empty( $footer_menu_one ) ) {
		$nav_menu_widget = get_option( 'widget_nav_menu' );
		foreach ( $nav_menu_widget as $key => $widget ) {
			if ( $key !== '_multiwidget' ) {
				if ( ( ! empty( $nav_menu_widget[ $key ]['title'] ) && in_array( $nav_menu_widget[ $key ]['title'], array( 'Quick links', 'Quick Links' ) ) ) ) {
					$nav_menu_widget[ $key ]['nav_menu'] = $footer_menu_one->term_id;
					update_option( 'widget_nav_menu', $nav_menu_widget );
				}
			}
		}
	}

	// "Footer 2" menu (menu name from import)
	$footer_menu_two = get_term_by( 'name', 'Footer 2', 'nav_menu' );
	if ( ! empty( $footer_menu_two ) ) {
		$nav_menu_widget = get_option( 'widget_nav_menu' );
		foreach ( $nav_menu_widget as $key => $widget ) {
			if ( $key !== '_multiwidget' ) {
				if ( ! empty( $nav_menu_widget[ $key ]['title'] ) && in_array( $nav_menu_widget[ $key ]['title'], array( 'About' ) ) ) {
					$nav_menu_widget[ $key ]['nav_menu'] = $footer_menu_two->term_id;
					update_option( 'widget_nav_menu', $nav_menu_widget );
				}
			}
		}
	}

	// Asign the front as page.
	update_option( 'show_on_front', 'page' );

	// Asign the front page.
	$front_page = EMWC_Core_Helpers::emwc_get_page_by_title( 'Home' );
	if ( ! empty( $front_page ) ) {
		update_option( 'page_on_front', $front_page->ID );
	}

	// Asign the blog page.
	$blog_page  = EMWC_Core_Helpers::emwc_get_page_by_title( 'Blog' );
	if ( ! empty( $blog_page ) ) {
		update_option( 'page_for_posts', $blog_page->ID );
	}

	// My wishlist page
	$wishlist_page = EMWC_Core_Helpers::emwc_get_page_by_title( 'My Wishlist' );
	if ( ! empty( $wishlist_page ) ) {
		update_option( 'emoza_wishlist_page_id', $wishlist_page->ID );
	}

	// Asign the shop page.
	$shop_page = ( 'single-product' === $demo_id ) ? EMWC_Core_Helpers::emwc_get_page_by_title( 'Listing' ) : EMWC_Core_Helpers::emwc_get_page_by_title( 'Shop' );
	if ( ! empty( $shop_page ) ) {
		update_option( 'woocommerce_shop_page_id', $shop_page->ID );
	}

	// Asign the cart page.
	$cart_page = EMWC_Core_Helpers::emwc_get_page_by_title( 'Cart' );
	if ( ! empty( $cart_page ) ) {
		update_option( 'woocommerce_cart_page_id', $cart_page->ID );
	}

	// Asign the checkout page.
	$checkout_page  = EMWC_Core_Helpers::emwc_get_page_by_title( 'Checkout' );
	if ( ! empty( $checkout_page ) ) {
		update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
	}

	// Asign the myaccount page.
	$myaccount_page = EMWC_Core_Helpers::emwc_get_page_by_title( 'My Account' );
	if ( ! empty( $myaccount_page ) ) {
		update_option( 'woocommerce_myaccount_page_id', $myaccount_page->ID );
	}

	// Update custom CSS
	$custom_css = class_exists( 'Emoza_Custom_CSS' ) ? Emoza_Custom_CSS::get_instance() : null;
	if ( $custom_css instanceof Emoza_Custom_CSS ) {
		$custom_css->update_custom_css_file();
	}

	// Set current starter site
	emwc()->current_starter( '', $demo_id );

}
add_action( 'emwc_finish_import', 'emwc_setup_after_import' );

// Do not create default WooCommerce pages when plugin is activated
// The condition avoid the filter being applied in others pages
// Eg: Woo > Status > Tools > Create default pages
if ( isset( $_POST['action'] ) && $_POST['action'] === 'emwc_import_plugin' ) {
	add_filter( 'woocommerce_create_pages', '__return_empty_array' );
}
