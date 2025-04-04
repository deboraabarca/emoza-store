<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Emoza
 */

?>

<?php
	$single_post_image_placement    = get_theme_mod( 'single_post_image_placement', 'below' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$single_post_meta_position      = get_theme_mod( 'single_post_meta_position', 'above-title' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php emoza_schema( 'article' ); ?>>
	
	<header class="entry-header">

		<?php if ( 'above' === $single_post_image_placement ) { //if featured image above title
			emoza_single_post_thumbnail();
		} ?>
		
		<?php 
		/**
		 * Hook 'emoza_before_title'
		 *
		 * @since 1.0.0
		 */
		do_action( 'emoza_before_title' ); ?>

		<?php if ( 'post' === get_post_type() && 'above-title' === $single_post_meta_position ) : ?>
			<?php emoza_single_post_meta( 'entry-meta-above' ); ?>
		<?php endif; ?>

		<?php the_title( '<h1 class="entry-title" '. emoza_get_schema( 'headline' ) .'>', '</h1>' );

		if ( 'post' === get_post_type() && 'below-title' === $single_post_meta_position ) : ?>
			<?php emoza_single_post_meta( 'entry-meta-below' ); ?>
		<?php endif; ?>

		<?php if ( 'below' === $single_post_image_placement ) { //if featured image below title
			emoza_single_post_thumbnail();
		} ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content" <?php emoza_schema( 'entry_content' ); ?>>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'emoza-woocommerce' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'emoza-woocommerce' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php emoza_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
