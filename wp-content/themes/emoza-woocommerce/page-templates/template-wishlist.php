<?php
/**
 * Template Name: Emoza Wishlist
 * Template for emoza wishlist
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

		<section>
			<?php 
			/**
			 * Hook 'emoza_entry_header'
			 *
			 * @since 1.0.0
			 */
			if ( apply_filters( 'emoza_entry_header', true ) ) : ?>
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title page-title" '. emoza_get_schema( 'headline' ) .'>', '</h1>' ); ?>
			</header><!-- .page-header -->
			<?php endif; ?>

			<div class="page-content">

				<?php 
				while( have_posts() ) : the_post();
					the_content();
				endwhile; ?>

				<?php get_template_part( 'template-parts/content', 'wishlist' ); ?>
			</div><!-- .page-content -->
		</section>

	</main><!-- #main -->

<?php
/**
 * Hook 'emoza_do_sidebar'
 *
 * @since 1.0.0
 */
do_action( 'emoza_do_sidebar' );
get_footer();