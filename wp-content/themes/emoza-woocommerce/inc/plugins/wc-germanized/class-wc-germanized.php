<?php
/**
 * WC Germanized Compatibility File
 *
 * @package Emoza
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Emoza_Woocommerce_Germanized_Compatibility {

    /**
     * Constructor.
     * 
     */
    public function __construct() {
        $this->single_product();
    }

    /**
     * Single Product.
     * 
     */
    public function single_product() {
        add_action( 'wp', function() {
            if ( ! is_singular( 'product' ) ) {
                return;
            }

            Emoza_Woocommerce_Germanized_Single_Product::remove_plugin_actions();
        } );
        
        add_filter( 'emoza_default_single_product_components', array( 'Emoza_Woocommerce_Germanized_Single_Product', 'customizer_components' ) );
        add_filter( 'emoza_single_product_elements', array( 'Emoza_Woocommerce_Germanized_Single_Product', 'customizer_elements' ) );
    }
}

require get_template_directory() . '/inc/plugins/wc-germanized/class-wc-germanized-single-product.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
new Emoza_Woocommerce_Germanized_Compatibility();
