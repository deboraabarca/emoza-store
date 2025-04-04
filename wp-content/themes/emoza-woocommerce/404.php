<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Emoza
 */

get_header();
?>

	<main id="primary" class="site-main">
		<?php 
		/**
		 * Hook 'emoza_404_content'
		 * 
		 * @since 1.0.0
		 */
		do_action( 'emoza_404_content' ); ?>
	</main><!-- #main -->

<?php
get_footer();
