<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emoza
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
	
</head>

<body <?php body_class(); ?> <?php emoza_schema( 'html' ); ?>>
<?php wp_body_open(); ?>

<?php 
/**
 * Hook 'emoza_before_site'
 * 
 * @since 1.0.0
 */
do_action( 'emoza_before_site' ); ?>

<div id="page" class="site">

	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'emoza-woocommerce' ); ?></a>

	<?php 
	/**
	 * Header
	 */
	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'header' ) ) {
		/**
		 * Hook 'emoza_header'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'emoza_header' );
	}

	/**
	 * Page Header
	 */

	/**
	 * Hook 'emoza_before_page_header'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_before_page_header' );

	/**
	 * Hook 'emoza_page_header'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_page_header' );

	/**
	 * Hook 'emoza_after_page_header'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_after_page_header' );
	
	/**
	 * Main Wrapper
	 */

	/**
	 * Hook 'emoza_before_main_wrapper'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_before_main_wrapper' );

	/**
	 * Hook 'emoza_main_wrapper_start'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_main_wrapper_start' );
