<?php
/**
 * WooCommerce Brands Compatibility File
 *
 * @link https://woocommerce.com/document/woocommerce-brands/
 *
 * @package Emoza
 */

class Emoza_WC_Brands {
    public function __construct() {
        add_filter( 'emoza_shop_page_header_cats_query_args', array( $this, 'shop_page_header_cats_query_args' ) );
        add_filter( 'emoza_shop_page_header_sub_cats_query_args', array( $this, '_shop_page_header_sub_cats_query_args' ) );
        add_filter( 'emoza_default_single_product_components', array( $this, 'customizer_single_product_components_defaults' ) );
        add_filter( 'emoza_single_product_elements', array( $this, 'customizer_single_product_components' ) );
        add_action( 'customize_register', array( $this, 'customizer_options' ), 1000 );
    }

    /**
     * Extend shop archive 'Show Categories In The Header' query with brands.
     * 
     */
    public function shop_page_header_cats_query_args( $args ) {
        $cats_includes_brands = get_theme_mod( 'shop_archive_header_cats_includes_brands', 0 );
        
        if( $cats_includes_brands ) {
            $args[ 'taxonomy' ] = array( 'product_cat', 'product_brand' );
        }

        return $args;
    }

    /**
     * Extend shop archive 'Show Sub Categories In The Header' query with brands.
     * 
     */
    public function _shop_page_header_sub_cats_query_args( $args ) {
        $cats_includes_brands = get_theme_mod( 'shop_archive_header_cats_includes_brands', 0 );
        
        if( $cats_includes_brands ) {
            $args[ 'taxonomy' ] = array( 'product_cat', 'product_brand' );
        }

        return $args;
    }

    /**
     * Extend Single Product 'Elements' customizer default values.
     * 
     */
    public function customizer_single_product_components_defaults( $components ) {
        $components[] = 'emoza_wc_brands_brand';
        return $components;
    }

    /**
     * Extend Single Product 'Elements' customizer with 'Brand' option.
     * 
     */
    public function customizer_single_product_components( $elements ) {
        $elements[ 'emoza_wc_brands_brand' ] = esc_html__( 'Brand', 'emoza-woocommerce' );
        return $elements;
    }

    /**
     * Customizer callbacks.
     * 
     */
    public function is_brand_element_active() {
        $element  = 'emoza_wc_brands_brand';
        $elements = get_theme_mod( 'single_product_elements_order' );

        if ( in_array( $element, $elements ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function is_bp() {
        if( ! defined( 'EMOZA_PRO_VERSION' ) ) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Add WooCommerce Brands customizer options.
     * 
     */
    public function customizer_options( $wp_customize ) {

        /**
         * Shop Archive
         */
        // Tabs control
        if( $wp_customize->get_control( 'emoza_product_catalog_tabs' ) ) {
            $controls_general     = json_decode( $wp_customize->get_control( 'emoza_product_catalog_tabs' )->controls_general );
            $new_controls_general = array( '#customize-control-shop_archive_header_cats_includes_brands' );
            $wp_customize->get_control( 'emoza_product_catalog_tabs' )->controls_general = wp_json_encode( array_merge( $controls_general, $new_controls_general ) );
        }

        // Display brands with categories
        $wp_customize->add_setting(
            'shop_archive_header_cats_includes_brands',
            array(
                'default'           => 0,
                'sanitize_callback' => 'emoza_sanitize_checkbox',
            )
        );
        $wp_customize->add_control(
            new Emoza_Toggle_Control(
                $wp_customize,
                'shop_archive_header_cats_includes_brands',
                array(
                    'label'             => esc_html__( 'Include Brands On Categories', 'emoza-woocommerce' ),
                    'description'       => esc_html__( 'Check to filter and display product brands along with product categories', 'emoza-woocommerce' ),
                    'section'           => 'woocommerce_product_catalog',
                    'active_callback'   => array( $this, 'is_bp' ),
                    'priority'          => 22,
                )
            )
        );

        /**
         * Single Product
         */
        // Tabs control
        $controls_general     = json_decode( $wp_customize->get_control( 'emoza_single_product_layout_tabs' )->controls_general );
        $new_controls_general = array( '#customize-control-emoza_wc_brands_brand_image_width', '#customize-control-emoza_wc_brands_brand_image_height' );
        $wp_customize->get_control( 'emoza_single_product_layout_tabs' )->controls_general = wp_json_encode( array_merge( $controls_general, $new_controls_general ) );

        // Brand image width
        $wp_customize->add_setting( 
            'emoza_wc_brands_brand_image_width', 
            array(
                'default'           => 65,
                'sanitize_callback' => 'emoza_sanitize_text',
            ) 
        );          
        $wp_customize->add_control( 
            new Emoza_Responsive_Slider( 
                $wp_customize, 
                'emoza_wc_brands_brand_image_width',
                array(
                    'label'         => esc_html__( 'Brand Image Width', 'emoza-woocommerce' ),
                    'section'       => 'emoza_section_single_product_layout',
                    'active_callback' => array( $this, 'is_brand_element_active' ),
                    'is_responsive' => 0,
                    'settings'      => array(
                        'size_desktop'      => 'emoza_wc_brands_brand_image_width',
                    ),
                    'input_attrs' => array(
                        'min'   => 0,
                        'max'   => 300,
                        'step'  => 1,
                    ),
                    'priority'      => 91,
                )
            ) 
        );

        // Brand image height
        $wp_customize->add_setting( 
            'emoza_wc_brands_brand_image_height', 
            array(
                'default'           => 65,
                'sanitize_callback' => 'emoza_sanitize_text',
            ) 
        );          
        $wp_customize->add_control( 
            new Emoza_Responsive_Slider( 
                $wp_customize, 
                'emoza_wc_brands_brand_image_height',
                array(
                    'label'         => esc_html__( 'Brand Image Height', 'emoza-woocommerce' ),
                    'section'       => 'emoza_section_single_product_layout',
                    'active_callback' => array( $this, 'is_brand_element_active' ),
                    'is_responsive' => 0,
                    'settings'      => array(
                        'size_desktop'      => 'emoza_wc_brands_brand_image_height',
                    ),
                    'input_attrs' => array(
                        'min'   => 0,
                        'max'   => 300,
                        'step'  => 1,
                    ),
                    'priority'      => 91,
                )
            ) 
        );
    }
}

// Initialize the class
new Emoza_WC_Brands();

require get_template_directory() . '/inc/plugins/woocommerce-brands/woocommerce-brands-functions.php';
