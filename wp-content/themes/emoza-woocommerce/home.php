<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emoza
 */

get_header();
?>
	<?php 
	/**
	 * Hook 'emoza_content_class'
	 *
	 * @since 1.0.0
	 */
	$emoza_content_class = apply_filters( 'emoza_content_class', '' );
	?>
	<main id="primary" class="site-main <?php echo esc_attr( $emoza_content_class ); ?>" <?php emoza_schema( 'blog' ); ?>>
		<?php 
		/**
		 * Hook 'emoza_do_archive_content'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'emoza_do_archive_content' ); ?>
	</main><!-- #main -->

<?php
/**
 * Hook 'emoza_do_sidebar'
 * 
 * @since 1.0.0
 */
do_action( 'emoza_do_sidebar' );
get_footer();
