<?php
/**
 * Upsell Products
 *
 * @package Emoza
 */

/**
 * Hooks 
 */
function emoza_upsell_products_hooks() {
    $single_upsell = get_theme_mod( 'single_upsell_products', 1 );

	/**
	 * Hook 'emoza_woocommerce_after_single_product_summary_upsell_products_order'
	 *
	 * @since 1.0.0
	 */
	$hook_order    = apply_filters( 'emoza_woocommerce_after_single_product_summary_upsell_products_order', 15 );

    if ( !$single_upsell ) {
        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', $hook_order );
    } else {
        $shop_single_upsell_products_number         = get_theme_mod( 'shop_single_upsell_products_number', 3 );
        $shop_single_upsell_products_columns_number = get_theme_mod( 'shop_single_upsell_products_columns_number', 3 );
        $single_upsell_products_slider              = get_theme_mod( 'shop_single_upsell_products_slider', 0 );
        
        if( (int) $shop_single_upsell_products_columns_number === 2 ) {
            add_filter( 'single_product_archive_thumbnail_size', function(){ return 'emoza-large'; } );
        }

        if( (int) $shop_single_upsell_products_columns_number === 1 ) {
            add_filter( 'single_product_archive_thumbnail_size', function(){ return 'emoza-extra-large'; } );
        }
        
        if( $single_upsell_products_slider ) {
            remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', $hook_order );
            add_action( 'woocommerce_after_single_product_summary', 'emoza_woocommerce_output_upsell_products_slider', 15 );
        }

        // Columns number
        add_filter( 'woocommerce_upsells_columns', function() use ( $shop_single_upsell_products_columns_number ) { 
            return $shop_single_upsell_products_columns_number; 
        } );

        // Posts per page
        add_filter( 'woocommerce_upsells_total', function() use ( $shop_single_upsell_products_number ) { 
            return $shop_single_upsell_products_number; 
        } );
    }
}
add_action( 'wp', 'emoza_upsell_products_hooks' );

/**
 * Upsell products as slider
 */
function emoza_woocommerce_output_upsell_products_slider( $args = array() ) { 
	global $product;

	if ( ! $product ) {
		return;
	}

	
	$posts_per_page = get_theme_mod( 'shop_single_upsell_products_number', 3 );
	$columns        = get_theme_mod( 'shop_single_upsell_products_columns_number', 3 );
	$shop_single_upsell_products_slider_nav = get_theme_mod( 'shop_single_upsell_products_slider_nav', 'always-show' );
	
    $limit = $posts_per_page;
	$defaults = array(
		'orderby'        => 'rand',
		'order'          => 'desc',
	);

	$args = wp_parse_args( $args, $defaults );

    // Get visible upsells then sort them at random, then limit result set.
    $upsells = wc_products_array_orderby( array_filter( array_map( 'wc_get_product', $product->get_upsell_ids() ), 'wc_products_array_filter_visible' ), $args['orderby'], $args['order'] );
    $upsells = $limit > 0 ? array_slice( $upsells, 0, $limit ) : $upsells;

	if( count( $upsells ) === 0 ) {
		return;
	} ?>
	
	<section class="up-sells upsells products">

		<?php
		/**
		 * Hook 'emoza_woocommerce_product_upsell_products_heading'
		 *
		 * @since 1.0.0
		 */
		$heading = apply_filters( 'emoza_woocommerce_product_upsell_products_heading', __( 'You may also like...', 'emoza-woocommerce' ) );

		if ( $heading ) : ?>
			<h2><?php echo esc_html( $heading ); ?></h2>
		<?php endif; ?>
		
		<?php

		$wrapper_atts = array();
		$wrapper_classes = array( 'emoza-upsell-products' );

		wp_enqueue_script( 'emoza-carousel' );
		wp_localize_script( 'emoza-carousel', 'emoza_carousel', emoza_localize_carousel_options() ); 

		$wrapper_classes[] = 'emoza-carousel emoza-carousel-nav2';

		if( $shop_single_upsell_products_slider_nav === 'always-show' ) {
			$wrapper_classes[] = 'emoza-carousel-nav2-always-show';
		}

		$wrapper_atts[] = 'data-per-page="'. absint( $columns ) .'"';

		// Mount upsell posts wrapper class
		$wrapper_atts[] = 'class="'. esc_attr( implode( ' ', $wrapper_classes ) ) .'"';

		echo '<div '. implode( ' ', $wrapper_atts ) .'>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- previously escaped
			echo '<ul class="products columns-'. esc_attr( $columns ) .' row emoza-carousel-stage">';
				foreach ( $upsells as $upsell_product ) :
	
					$post_object = get_post( $upsell_product->get_id() );

					setup_postdata( $GLOBALS['post'] =& $post_object ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited, Squiz.PHP.DisallowMultipleAssignments.Found

					wc_get_template_part( 'content', 'product' );

				endforeach;
			echo '</ul>';
		echo '</div>';
		?>

	</section>
	
	<?php
}