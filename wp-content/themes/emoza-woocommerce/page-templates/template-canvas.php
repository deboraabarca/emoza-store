<?php
/**
 * Template Name: Emoza Canvas
 * Template for emoza canvas
 *
 * This tempalte won't display the header, footer and sidebar. But you can display them with the filter 'emoza_template_canvas_remove_header_footer'
 * 
 * @package Emoza
 */

/**
 * Hook 'emoza_template_canvas_remove_header_footer'
 *
 * @since 1.0.0
 */
if( apply_filters( 'emoza_template_canvas_remove_header_footer', true ) ) {
    remove_all_actions( 'emoza_header' );
    remove_all_actions( 'emoza_footer' );
}

get_header();

$hide_page_title = get_post_meta( $post->ID, '_emoza_hide_page_title', true );

/**
 * Hook 'emoza_content_class'
 *
 * @since 1.0.0
 */
$content_class = apply_filters( 'emoza_content_class', '' );
?>

<main id="primary" class="site-main <?php echo esc_attr( $content_class ); ?>">

    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );

        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>

</main><!-- #main -->

<?php 
get_footer();