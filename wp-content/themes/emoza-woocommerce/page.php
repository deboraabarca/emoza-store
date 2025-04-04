<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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

	<main id="primary" class="site-main <?php echo esc_attr( $content_class ); ?>">
		<?php 
		/**
		 * Hook 'emoza_do_page_content'
		 *
		 * @since 1.0.0
		 */
		do_action( 'emoza_do_page_content' ); ?>
	</main><!-- #main -->

<?php
/**
 * Hook 'emoza_do_sidebar'
 *
 * @since 1.0.0
 */
do_action( 'emoza_do_sidebar' );
get_footer();
