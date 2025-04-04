<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

/**
 * Hook 'emoza_blog_layout_class'
 *
 * @since 1.0.0
 */
$blog_layout_class = apply_filters( 'emoza_blog_layout_class', 'layout3' );

?>

	<main id="primary" class="site-main <?php echo esc_attr( $content_class ); ?>" <?php emoza_schema( 'search' ); ?>>
		<?php
		if ( have_posts() ) : ?>
			<header class="page-header">
				<h1 class="page-title" <?php emoza_schema( 'headline' ); ?>>
					<?php
					/* translators: %s: search query. */
					printf( esc_html__( 'Search Results for: %s', 'emoza-woocommerce' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>
			</header><!-- .page-header -->

			<div class="posts-archive <?php echo esc_attr( $blog_layout_class ); ?>" <?php emoza_masonry_data(); ?>>
				<div class="row">
				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/*
					* Include the Post-Type-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Type name) and that will be used instead.
					*/
					get_template_part( 'template-parts/content', 'post' );

				endwhile; ?>
				</div>
			</div>
		<?php
		the_posts_pagination( array(
			'mid_size'  => 1,
			'prev_text' => '&#x2190;',
			'next_text' => '&#x2192;',
		) );

		/**
		 * Hook 'emoza_after_the_posts_pagination'
		 *
		 * @since 1.0.0
		 */
		do_action( 'emoza_after_the_posts_pagination' );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
	</main><!-- #main -->

<?php
/**
 * Hook 'emoza_do_sidebar'
 *
 * @since 1.0.0
 */
do_action( 'emoza_do_sidebar' );
get_footer();
