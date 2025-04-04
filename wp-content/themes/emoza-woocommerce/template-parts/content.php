<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emoza
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php emoza_schema( 'article' ); ?>>

	<?php 
	/**
	 * Hook 'emoza_loop_post'
	 *
	 * @since 1.0.0
	 */
	do_action( 'emoza_loop_post' ); ?>

</article><!-- #post-<?php the_ID(); ?> -->
