<?php
/**
 * Template part for displaying ajax search categories wrapper.
 * 
 * This template can be overridden by copying it to yourtheme/template-parts/search/content-ajax-search-categories.php.
 *
 * HOWEVER, on occasion Emoza will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen.
 *
 * @package Emoza\Templates
 * @version 2.2.4
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$terms = $args['terms'];

/**
 * Hook 'emoza_before_ajax_search_categories'
 *
 * @since 1.0.0
 */
do_action( 'emoza_before_ajax_search_categories' );

?>

<h2 class="emoza-ajax-search__heading-title"><?php echo esc_html__( 'Categories', 'emoza-woocommerce' ); ?></h2>
<hr class="emoza-ajax-search__divider">
<div class="emoza-ajax-search-categories">

	<?php foreach( $terms as $category ) : 
		emoza_get_template_part( 'template-parts/search/content', 'ajax-search-categories-item', array( 'category' => $category ) );
	endforeach; ?>

</div>

<?php 
/**
 * Hook 'emoza_after_ajax_search_categories'
 *
 * @since 1.0.0
 */
do_action( 'emoza_after_ajax_search_categories' ); ?>