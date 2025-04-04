<?php
/**
 * Single Product - Layout Section Customizer Settings
 *
 * @package Emoza
 */

$wp_customize->add_setting(
    'single_product_gallery',
    array(
        'default' => 'gallery-default',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control(
    new Emoza_Radio_Images(
        $wp_customize,
        'single_product_gallery',
        array(
            'label' => esc_html__('Product Image', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'cols' => 2,
            'choices' => array(
                'gallery-default' => array(
                    'label' => esc_html__('Layout 1', 'emoza-woocommerce'),
                    'url' => '%s/assets/img/sg1.svg',
                ),
                'gallery-single' => array(
                    'label' => esc_html__('Layout 2', 'emoza-woocommerce'),
                    'url' => '%s/assets/img/sg2.svg',
                ),
                'gallery-vertical' => array(
                    'label' => esc_html__('Layout 3', 'emoza-woocommerce'),
                    'url' => '%s/assets/img/sg3.svg',
                ),
                'gallery-grid' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Layout 4', 'emoza-woocommerce' ),
                    'url'    => '%s/assets/img/sg4.svg',
                ),
                'gallery-scrolling' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Layout 5', 'emoza-woocommerce' ),
                    'url'    => '%s/assets/img/sg5.svg',
                ),
                'gallery-showcase' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Layout 6', 'emoza-woocommerce' ),
                    'url'    => '%s/assets/img/sg6.svg',
                ),
                'gallery-full-width' => array(
                    'is_pro' => true,
                    'label'  => esc_html__( 'Layout 7', 'emoza-woocommerce' ),
                    'url'    => '%s/assets/img/sg7.svg',
                ),
            ),
            'priority' => 20,
        )
    )
);

$wp_customize->add_setting(
    'single_gallery_slider',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_gallery_slider',
        array(
            'label' => esc_html__('Gallery thumbnail slider', 'emoza-woocommerce'),
            'description' => esc_html__('Requires page refresh after saving', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 30,
        )
    )
);

$wp_customize->add_setting(
    'single_zoom_effects',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_zoom_effects',
        array(
            'label' => esc_html__('Image zoom effects', 'emoza-woocommerce'),
            'description' => esc_html__('Requires page refresh after saving', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 40,
        )
    )
);

$wp_customize->add_setting(
    'single_product_image_lightbox',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_product_image_lightbox',
        array(
            'label' => esc_html__('Lightbox effect', 'emoza-woocommerce'),
            'description' => esc_html__('Requires page refresh after saving', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 41,
        )
    )
);

$wp_customize->add_setting('single_gallery_divider_1',
    array(
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control(new Emoza_Divider_Control($wp_customize, 'single_gallery_divider_1',
    array(
        'section' => 'emoza_section_single_product_layout',
        'priority' => 45,
    )
)
);

$wp_customize->add_setting(
    'single_breadcrumbs',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_breadcrumbs',
        array(
            'label' => esc_html__('Breadcrumbs', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 50,
        )
    )
);

$wp_customize->add_setting(
    'single_breadcrumbs_hide_title',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_breadcrumbs_hide_title',
        array(
            'label' => esc_html__('Breadcrumbs - Hide Product Title', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'active_callback' => function () {return get_theme_mod('single_breadcrumbs', 1) === 1;},
            'priority' => 50,
        )
    )
);

$wp_customize->add_setting(
    'single_ajax_add_to_cart',
    array(
        'default' => 0,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_ajax_add_to_cart',
        array(
            'label' => esc_html__('Ajax Add To Cart', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 55,
        )
    )
);

// Sidebar Layout
$wp_customize->add_setting(
    'single_product_sidebar',
    array(
        'default'           => 'no-sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control(
    new Emoza_Radio_Images(
        $wp_customize,
        'single_product_sidebar',
        array(
            'label'   => esc_html__( 'Sidebar Layout', 'emoza-woocommerce' ),
            'section' => 'emoza_section_single_product_layout',
            'cols'    => 3,
            'choices' => array(
                'no-sidebar'    => array(
                    'is_pro'    => false,
                    'label'     => esc_html__( 'No Sidebar', 'emoza-woocommerce' ),
                    'url'       => '%s/assets/img/meta-sidebar-none.svg',
                ),
                'sidebar-left'  => array(
                    'is_pro'    => true,
                    'label'     => esc_html__( 'Left', 'emoza-woocommerce' ),
                    'url'       => '%s/assets/img/meta-sidebar-left.svg',
                ),
                'sidebar-right' => array(
                    'is_pro'    => true,
                    'label'     => esc_html__( 'Right', 'emoza-woocommerce' ),
                    'url'       => '%s/assets/img/meta-sidebar-right.svg',
                ),  
            ),
            'priority' => 60,
        )
    )
);

$emoza_defaults = emoza_get_default_single_product_components();
$emoza_choices = emoza_single_product_elements();

$wp_customize->add_setting(
    'single_product_elements_order',
    array(
        'default' => $emoza_defaults,
        'sanitize_callback' => 'emoza_sanitize_single_product_components',
    )
);

$wp_customize->add_control(new \Kirki\Control\Sortable(
    $wp_customize,
    'single_product_elements_order',
    array(
        'label' => esc_html__('Elements', 'emoza-woocommerce'),
        'section' => 'emoza_section_single_product_layout',
        'choices' => $emoza_choices,
        'active_callback' => 'emoza_single_product_elements_show',
        'priority' => 65,
    ))
);

$wp_customize->add_setting(
    'single_product_sku',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_product_sku',
        array(
            'label' => esc_html__('SKU', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'active_callback' => function () {return emoza_callback_single_product_elements('woocommerce_template_single_meta');},
            'priority' => 65,
        )
    )
);

$wp_customize->add_setting(
    'single_product_categories',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_product_categories',
        array(
            'label' => esc_html__('Categories', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'active_callback' => function () {return emoza_callback_single_product_elements('woocommerce_template_single_meta');},
            'priority' => 70,
        )
    )
);

$wp_customize->add_setting(
    'single_product_tags',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_product_tags',
        array(
            'label' => esc_html__('Tags', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'active_callback' => function () {return emoza_callback_single_product_elements('woocommerce_template_single_meta');},
            'priority' => 80,
        )
    )
);

$wp_customize->add_setting(
    'single_upsell_products_top_divider',
    array(
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control(new Emoza_Divider_Control(
    $wp_customize,
    'single_upsell_products_top_divider',
    array(
        'section' => 'emoza_section_single_product_layout',
        'priority' => 100,
    )
)
);

$wp_customize->add_setting(
    'single_upsell_products',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_upsell_products',
        array(
            'label' => esc_html__('Upsell products', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 101,
        )
    )
);

$wp_customize->add_setting(
    'single_recently_viewed_top_divider',
    array(
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control(new Emoza_Divider_Control(
    $wp_customize,
    'single_recently_viewed_top_divider',
    array(
        'section' => 'emoza_section_single_product_layout',
        'priority' => 103,
    )
)
);

$wp_customize->add_setting(
    'single_recently_viewed_products',
    array(
        'default' => 0,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_recently_viewed_products',
        array(
            'label' => esc_html__('Recently Viewed Products', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 104,
        )
    )
);

$wp_customize->add_setting(
    'single_recently_viewed_bottom_divider',
    array(
        'sanitize_callback' => 'esc_attr',
    )
);

$wp_customize->add_control(new Emoza_Divider_Control(
    $wp_customize,
    'single_recently_viewed_bottom_divider',
    array(
        'section' => 'emoza_section_single_product_layout',
        'priority' => 105,
    )
)
);

$wp_customize->add_setting(
    'single_related_products',
    array(
        'default' => 1,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'single_related_products',
        array(
            'label' => esc_html__('Related products', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 110,
        )
    )
);

/**
 * Styling
 */

// Product Title
$wp_customize->add_setting('single_product_title_title',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Emoza_Text_Control(
        $wp_customize,
        'single_product_title_title',
        array(
            'label' => esc_html__('Product Title', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 145,
        )
    )
);

// Typography
$wp_customize->add_setting(
    'single_product_title_font_style',
    array(
        'default' => 'heading',
        'sanitize_callback' => 'emoza_sanitize_select',
    )
);
$wp_customize->add_control(
    'single_product_title_font_style',
    array(
        'type' => 'select',
        'section' => 'emoza_section_single_product_layout',
        'label' => esc_html__('Font Style', 'emoza-woocommerce'),
        'choices' => array(
            'heading' => esc_html__('Heading', 'emoza-woocommerce'),
            'body' => esc_html__('Body', 'emoza-woocommerce'),
            'custom' => esc_html__('Custom', 'emoza-woocommerce'),
        ),
        'priority' => 145,
    )
);

$wp_customize->add_setting('single_product_title_adobe_font',
    array(
        'default' => 'system-default|n4',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(new Emoza_Typography_Adobe_Control($wp_customize, 'single_product_title_adobe_font',
    array(
        'section' => 'emoza_section_single_product_layout',
        'active_callback' => 'emoza_single_product_title_font_library_adobe_and_custom_style',
        'priority' => 145,
    )
));

$wp_customize->add_setting('single_product_title_custom_font',
    array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_setting('single_product_title_custom_font_weight',
    array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control(new Emoza_Typography_Custom_Control($wp_customize, 'single_product_title_custom_font_typography',
    array(
        'section' => 'emoza_section_single_product_layout',
        'settings' => array(
            'font-family' => 'single_product_title_custom_font',
            'font-weight' => 'single_product_title_custom_font_weight',
        ),
        'active_callback' => 'emoza_single_product_title_font_library_custom_and_custom_style',
        'priority' => 145,
    )
));

$wp_customize->add_setting('single_product_title_font',
    array(
        'default' => '{"font":"System default","regularweight":"400","category":"sans-serif"}',
        'transport' => 'postMessage',
        'sanitize_callback' => 'emoza_google_fonts_sanitize',
        'priority' => 145,
    )
);
$wp_customize->add_control(new Emoza_Typography_Control($wp_customize, 'single_product_title_font',
    array(
        'section' => 'emoza_section_single_product_layout',
        'settings' => array(
            'family' => 'single_product_title_font',
        ),
        'input_attrs' => array(
            'font_count' => 'all',
            'orderby' => 'alpha',
            'disableRegular' => false,
        ),
        'active_callback' => 'emoza_single_product_title_font_library_google_and_custom_style',
        'priority' => 145,
    )
));

// Font Size
$wp_customize->add_setting('single_product_title_size_desktop', array(
    'default' => 32,
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_setting('single_product_title_size_tablet', array(
    'default' => 32,
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_setting('single_product_title_size_mobile', array(
    'default' => 32,
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Emoza_Responsive_Slider($wp_customize, 'single_product_title_size',
    array(
        'label' => esc_html__('Font Size', 'emoza-woocommerce'),
        'section' => 'emoza_section_single_product_layout',
        'is_responsive' => 1,
        'settings' => array(
            'size_desktop' => 'single_product_title_size_desktop',
            'size_tablet' => 'single_product_title_size_tablet',
            'size_mobile' => 'single_product_title_size_mobile',
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 200,
        ),
        'priority' => 145,
    )
));

// Text Style
$wp_customize->add_setting('single_product_title_text_decoration', array(
    'default' => 'none',
    'transport' => 'postMessage',
    'sanitize_callback' => 'emoza_sanitize_text',
));
$wp_customize->add_setting('single_product_title_text_transform', array(
    'default' => 'none',
    'transport' => 'postMessage',
    'sanitize_callback' => 'emoza_sanitize_text',
));
$wp_customize->add_control(new Emoza_Text_Style_Control($wp_customize, 'single_product_title_text_style',
    array(
        'section' => 'emoza_section_single_product_layout',
        'settings' => array(
            'decoration' => 'single_product_title_text_decoration',
            'transform' => 'single_product_title_text_transform',
        ),
        'priority' => 145,
    )
));

// Product Title Color
$wp_customize->add_setting(
    'single_product_title_color',
    array(
        'default' => '#212121',
        'sanitize_callback' => 'emoza_sanitize_hex_rgba',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(
    new Emoza_Alpha_Color(
        $wp_customize,
        'single_product_title_color',
        array(
            'label' => esc_html__('Product title color', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 145,
        )
    )
);

// Divider
$wp_customize->add_setting( 
	'single_product_title_and_price_divider',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( 
	new Emoza_Divider_Control( 
		$wp_customize, 
		'single_product_title_and_price_divider',
		array(
			'section'         => 'emoza_section_single_product_layout',
			'priority'        => 145,
		)
	)
);

// Product Price Title
$wp_customize->add_setting('single_product_price_title',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(new Emoza_Text_Control($wp_customize, 'single_product_price_title',
    array(
        'label' => esc_html__('Product Price', 'emoza-woocommerce'),
        'section' => 'emoza_section_single_product_layout',
        'priority' => 145,
    )
)
);

// Product Price Font Size
$wp_customize->add_setting('single_product_price_size_desktop', array(
    'default' => 24,
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_setting('single_product_price_size_tablet', array(
    'default' => 24,
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_setting('single_product_price_size_mobile', array(
    'default' => 24,
    'transport' => 'postMessage',
    'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Emoza_Responsive_Slider($wp_customize, 'single_product_price_size',
    array(
        'label' => esc_html__('Font Size', 'emoza-woocommerce'),
        'section' => 'emoza_section_single_product_layout',
        'is_responsive' => 1,
        'settings' => array(
            'size_desktop' => 'single_product_price_size_desktop',
            'size_tablet' => 'single_product_price_size_tablet',
            'size_mobile' => 'single_product_price_size_mobile',
        ),
        'input_attrs' => array(
            'min' => 0,
            'max' => 200,
        ),
        'priority' => 145,
    )
));

// Product Price Color
$wp_customize->add_setting(
    'single_product_price_color',
    array(
        'default' => '',
        'sanitize_callback' => 'emoza_sanitize_hex_rgba',
        'transport' => 'postMessage',
    )
);
$wp_customize->add_control(
    new Emoza_Alpha_Color(
        $wp_customize,
        'single_product_price_color',
        array(
            'label' => esc_html__('Product price color', 'emoza-woocommerce'),
            'section' => 'emoza_section_single_product_layout',
            'priority' => 145,
        )
    )
);
