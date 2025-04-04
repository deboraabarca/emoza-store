<?php
/**
 * Woocommerce Single Product Customizer options
 *
 * @package Emoza
 */

/**
 * Panel
 */
$wp_customize->add_panel(
    'emoza_panel_single_product',
    array(
        'title' => esc_html__('Single Product', 'emoza-woocommerce'),
        'priority' => 110,
        'description' => esc_html__('Manage the overall design and functionality from the shop single product pages.', 'emoza-woocommerce'),
    )
);

/**
 * Layout Section
 */

// Section
$wp_customize->add_section(
    'emoza_section_single_product_layout',
    array(
        'panel'       => 'emoza_panel_single_product',
        'title'       => esc_html__('Layout', 'emoza-woocommerce'),
        'description' => esc_html__( 'Manage the overall design and functionality from the shop single product pages.', 'emoza-woocommerce' ),
    )
);

// Tabs (Control)
$wp_customize->add_setting(
    'emoza_single_product_layout_tabs',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control(
        $wp_customize,
        'emoza_single_product_layout_tabs',
        array(
            'label' => '',
            'section' => 'emoza_section_single_product_layout',
            'controls_general' => wp_json_encode(array(
                '#customize-control-single_gallery_slider',
                '#customize-control-single_product_gallery',
                '#customize-control-single_zoom_effects',
                '#customize-control-single_gallery_divider_1',
                '#customize-control-single_breadcrumbs',
                '#customize-control-single_breadcrumbs_hide_title',
                '#customize-control-single_ajax_add_to_cart',
                '#customize-control-single_product_sidebar',
                '#customize-control-single_product_elements_order',
                '#customize-control-single_upsell_products_top_divider',
                '#customize-control-single_upsell_products',
                '#customize-control-single_recently_viewed_top_divider',
                '#customize-control-single_recently_viewed_products',
                '#customize-control-single_recently_viewed_bottom_divider',
                '#customize-control-single_related_products',
                '#customize-control-single_product_sku',
                '#customize-control-single_product_categories',
                '#customize-control-single_product_tags',
            )),
            'controls_design' => wp_json_encode(array(
                '#customize-control-single_product_title_title',
                '#customize-control-single_product_title_font_style',
                '#customize-control-single_product_title_adobe_font',
                '#customize-control-single_product_title_font',
                '#customize-control-single_product_title_size',
                '#customize-control-single_product_title_text_style',
                '#customize-control-single_product_title_color',
                '#customize-control-single_product_styling_divider_1',
				'#customize-control-single_product_title_and_price_divider',
                '#customize-control-single_product_price_title',
                '#customize-control-single_product_price_size',
                '#customize-control-single_product_price_color',
            )),
        )
    )
);

// Layout Settings
require 'single-product/section-layout.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

/**
 * Tabs Section
 */

// Section
$wp_customize->add_section(
    'emoza_section_single_product_tabs',
    array(
        'panel'       => 'emoza_panel_single_product',
        'title'       => esc_html__('Product Tab', 'emoza-woocommerce'),
        'description' => esc_html__( 'Manage the overall design and functionality from the shop single product tabs.', 'emoza-woocommerce' ),
    )
);

// Tabs (Control)
if( defined( 'EMOZA_PRO_VERSION' ) ) {
    $wp_customize->add_setting(
        'emoza_single_product_tabs_tabs',
        array(
            'default' => '',
            'sanitize_callback' => 'esc_attr',
        )
    );
    $wp_customize->add_control(
        new Emoza_Tab_Control(
            $wp_customize,
            'emoza_single_product_tabs_tabs',
            array(
                'label' => '',
                'section' => 'emoza_section_single_product_tabs',
                'controls_general' => wp_json_encode(array(
                    '#customize-control-single_product_tabs',
                )),
                'controls_design' => wp_json_encode(array()),
            )
        )
    );
}

// Product Tabs Settings
require 'single-product/section-tabs.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
