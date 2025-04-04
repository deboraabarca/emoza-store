<?php
/**
 * Navigation
 */
$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_navigation',
	array(
		'title'    => esc_html__( 'Navigation', 'emoza-woocommerce' ),
		'priority' => 10,
	)
) );
//
// @priority 15 (Header)
//
// @priority 20 (Footer)
//
// @priority 30 (Sidebar)
//

/**
 * Site Styles
 */
$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_site_styles',
	array(
		'title'    => esc_html__( 'Site Styles', 'emoza-woocommerce' ),
		'priority' => 35,
		'divider'  => true,
	)
) );
//
// @priority 40 (Typography)
//
// @priority 45 (Colors)
//
$wp_customize->get_section( 'colors' )->priority    = 50;
$wp_customize->get_section( 'colors' )->description = esc_html__( 'Manage palettes and the default color of different global elements on the site.', 'emoza-woocommerce' );
//
// @priority 55 (Layout)
//
// @priority 60 (Background)
//
$wp_customize->get_section( 'background_image' )->title       = esc_html__( 'Background', 'emoza-woocommerce');
$wp_customize->get_section( 'background_image' )->description = esc_html__( 'Manage the syle of the background that appear behind the website content.', 'emoza-woocommerce');
$wp_customize->get_section( 'background_image' )->priority    = 60;

/**
 * Elements
 */
$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_elements',
	array(
		'title'    => esc_html__( 'Elements', 'emoza-woocommerce' ),
		'priority' => 65,
		'divider'  => true,
	)
) );
//
// @priority 70 (Buttons)
//
// @priority 75 (Scroll to Top)
//
// @priority 80 (Breadcrumbs)
//
// @priority 85 (Quick Links)
//

/**
 * WooCommerce
 */
if ( class_exists( 'WooCommerce' ) ) {

	$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_woocommerce',
		array(
			'title'    => esc_html__( 'WooCommerce', 'emoza-woocommerce' ),
			'priority' => 90,
			'divider'  => true,
		)
	) );
	//
	// @priority 95 (General)
	//
	// @priority 100 (Store Notice)
	//
	if ( $wp_customize->get_section( 'woocommerce_store_notice' ) ) {
		$wp_customize->get_section( 'woocommerce_store_notice' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_store_notice' )->description = esc_html__( 'Display a global notice message that\'s displayed site wide.', 'emoza-woocommerce' );
		$wp_customize->get_section( 'woocommerce_store_notice' )->priority = 100;
	}
	//
	// @priority 105 (Product Catalog)
	//
	if ( $wp_customize->get_section( 'woocommerce_product_catalog' ) ) {
		$wp_customize->get_section( 'woocommerce_product_catalog' )->panel       = null;
		$wp_customize->get_section( 'woocommerce_product_catalog' )->description = esc_html__( 'Manage the overall design and functionality from the shop archive pages.', 'emoza-woocommerce' );
		$wp_customize->get_section( 'woocommerce_product_catalog' )->priority    = 105;
	}
	//
	// @priority 110 (Single Products)
	//
	// @priority 115 (Checkout)
	//
	if ( $wp_customize->get_section( 'woocommerce_checkout' ) ) {
		$wp_customize->get_section( 'woocommerce_checkout' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_checkout' )->description = esc_html__( 'Manage the overall design and functionality from the shop checkout page.', 'emoza-woocommerce' );
		$wp_customize->get_section( 'woocommerce_checkout' )->priority = 115;
	}
	//
	// @priority 120 (Cart)
	//
	// @priority 125 (Search)
	//
	// @priority 130 (Wishlist)
	//
	// @priority 135 (Floating Mini Cart Icon)
	//
	// @priority 140 (Product Images)
	//
	if ( $wp_customize->get_section( 'woocommerce_product_images' ) ) {
		$wp_customize->get_section( 'woocommerce_product_images' )->panel    = null;
		$wp_customize->get_section( 'woocommerce_product_images' )->description = esc_html__( 'Manage the shop product images functionality and size.', 'emoza-woocommerce' );
		$wp_customize->get_section( 'woocommerce_product_images' )->priority = 140;
	}
	//
	// @priority 150 (Product Swatches)
	//

}

/**
 * Blog
 */
$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_blog',
	array(
		'title'    => esc_html__( 'Blog', 'emoza-woocommerce' ),
		'priority' => 160,
		'divider'  => true,
	)
) );
//
// @priority 165 (Blog Archives)
//
// @priority 170 (Single Posts)
//

/**
 * Extensions
 */
$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_extension',
	array(
		'title'    => esc_html__( 'Extensions', 'emoza-woocommerce' ),
		'priority' => 175,
		'divider'  => true,
	)
) );

//
// @priority 180 (Performance)
//
// @priority 185 (Modal Popup)
//
// @priority 190 (Hooks)

/**
 * Core
 */
$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_core',
	array(
		'title'    => esc_html__( 'Core', 'emoza-woocommerce' ),
		'priority' => 195,
		'divider'  => true,
	)
) );
//
// @priority 200 (Widgets)
//
if ( $wp_customize->get_panel( 'widgets' ) ) {
	$wp_customize->get_panel( 'widgets' )->priority = 200;
}
//
// @priority 205 (Menus)
//
if ( $wp_customize->get_panel( 'nav_menus' ) ) {
	$wp_customize->get_panel( 'nav_menus' )->priority = 205;
}
//
// @priority 210 (Homepage Settings)
//
if ( $wp_customize->get_section( 'static_front_page' ) ) {
	$wp_customize->get_section( 'static_front_page' )->priority = 210;
}
//
// @priority 215 (Additional CSS)
//
if ( $wp_customize->get_section( 'custom_css' ) ) {
	$wp_customize->get_section( 'custom_css' )->priority = 215;
}