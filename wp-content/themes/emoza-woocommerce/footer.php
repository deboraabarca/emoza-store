<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emoza
 */

?>

	<?php 
	/**
	 * Main Wrapper
	 */

	/**
	 * Hook 'emoza_main_wrapper_end'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_main_wrapper_end' );

	/**
	 * Hook 'emoza_after_main_wrapper'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_after_main_wrapper' ); 
	
	/**
	 * Footer
	 */

	/**
	 * Hook 'emoza_footer_before'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_footer_before' );

	if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {

		/**
		 * Hook 'emoza_footer'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'emoza_footer' );
	}

	/**
	 * Hook 'emoza_footer_after'
	 * 
	 * @since 1.0.0
	 */
	do_action( 'emoza_footer_after' ); ?>

</div><!-- #page -->

<?php 
/**
 * Hook 'emoza_after_site'
 * 
 * @since 1.0.0
 */
do_action( 'emoza_after_site' ); ?>

<?php wp_footer(); ?>

</body>
</html>
