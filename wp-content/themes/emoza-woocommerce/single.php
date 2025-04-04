<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Emoza
 */

get_header();

/**
 * Hook 'emoza_content_class'
 *
 * @since 1.0.0
 */
$content_class = apply_filters( 'emoza_content_class', '' );

?>

	<main id="primary" class="site-main <?php echo esc_attr( $content_class ); ?>" <?php emoza_schema( 'blog' ); ?>>
		<?php 
		/**
		 * Hook 'emoza_do_single_content'
		 *
		 * @since 1.0.0
		 */
		do_action( 'emoza_do_single_content' ); ?>
	</main><!-- #main -->

<?php
/**
 * Hook 'emoza_do_sidebar'
 *
 * @since 1.0.0
 */
do_action( 'emoza_do_sidebar' );
get_footer();
