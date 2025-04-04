<?php
/**
 * The template for displaying archive pages
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
