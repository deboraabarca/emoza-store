<?php
/**
 * Template part for displaying ajax search categories item content.
 * 
 * This template can be overridden by copying it to yourtheme/template-parts/search/content-ajax-search-categories-item.php.
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

/**
 * Hook 'emoza_before_ajax_search_categories_item'
 *
 * @since 2.2.4
 */
do_action( 'emoza_before_ajax_search_categories_item' );

$category_item = $args['category'];

?>

<a class="emoza-ajax-search__item emoza-ajax-search__item-category" href="<?php echo esc_url( get_term_link( $category_item->term_id ) ); ?>">
	<div class="emoza-ajax-search__item-info">
		<h3><?php echo esc_html( $category_item->name ); ?></h3>
	</div>
</a>

<?php 
/**
 * Hook 'emoza_after_ajax_search_categories_item'
 *
 * @since 2.2.4
 */
do_action( 'emoza_after_ajax_search_categories_item' ); ?>