<?php
/**
 * Shop Archive - Section Product Card Customizer Settings
 *
 * @package Emoza
 */

// Product Card Layout
$wp_customize->add_setting(
	'shop_product_card_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'shop_product_card_layout',
		array(
			'label'     => esc_html__( 'Layout', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_shop_archive_product_card',
			'cols'      => 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/pc1.svg',
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/pc2.svg',
				),      
			),
			'priority'   => 110,
		)
	)
); 

// Add To Cart Button Layout
$wp_customize->add_setting(
	'shop_product_add_to_cart_layout',
	array(
		'default'           => 'layout3',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'shop_product_add_to_cart_layout',
		array(
			'label'     => esc_html__( 'Add to cart button', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_shop_archive_product_card',
			'cols'      => 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/ac1.svg',
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/ac2.svg',
				),  
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/ac3.svg',
				),  
				'layout4' => array(
					'label' => esc_html__( 'Layout 4', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/ac4.svg',
				),                                      
			),
			'priority'   => 120,
		)
	)
);

// Out of stock text
$wp_customize->add_setting(
	'out_of_stock_text',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'out_of_stock_text', array(
	'label'       => esc_html__( 'Out of Stock Text', 'emoza-woocommerce' ),
	'description' => esc_html__( 'Controls the add to cart button text when product is out of stock. Default: "Read More"', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_shop_archive_product_card',
	'priority'    => 120,
) );

// Product Equal Height
$wp_customize->add_setting(
    'shop_product_equal_height',
    array(
        'default'           => 0,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'shop_product_equal_height',
        array(
            'label'    => esc_html__( 'Product Equal Height', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_shop_archive_product_card',
            'priority' => 120,
        )
    )
);

// Quick View
$wp_customize->add_setting(
	'shop_product_quickview_layout',
	array(
		'default'           => 'layout1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'shop_product_quickview_layout',
		array(
			'label'     => esc_html__( 'Quick view', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_shop_archive_product_card',
			'cols'      => 3,
			'choices'  => array(
				'layout1' => array(
					'label' => esc_html__( 'Layout 1', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/qw1.svg',
				),
				'layout2' => array(
					'label' => esc_html__( 'Layout 2', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/qw2.svg',
				),  
				'layout3' => array(
					'label' => esc_html__( 'Layout 3', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/qw3.svg',
				),                                      
			),
			'priority'   => 130,
		)
	)
);

// Product Card Elements
$wp_customize->add_setting( 'shop_card_elements', array(
	'default'   => array( 'emoza_shop_loop_product_title', 'woocommerce_template_loop_price' ),
	'sanitize_callback' => 'emoza_sanitize_product_loop_components',
) );
$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'shop_card_elements', array(
	'label'             => esc_html__( 'Card elements', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_shop_archive_product_card',

    /**
     * Hook 'emoza_shop_archive_product_card_elements'
     *
     * @since 1.0.0
     */
	'choices'           => apply_filters( 'emoza_shop_archive_product_card_elements', array(
		'emoza_shop_loop_product_title'            => esc_html__( 'Title', 'emoza-woocommerce' ),
		'woocommerce_template_loop_rating'          => esc_html__( 'Reviews', 'emoza-woocommerce' ),
		'woocommerce_template_loop_price'           => esc_html__( 'Price', 'emoza-woocommerce' ),
		'emoza_loop_product_category'              => esc_html__( 'Category', 'emoza-woocommerce' ),
		'emoza_loop_product_description'           => esc_html__( 'Short description', 'emoza-woocommerce' ),
	) ),
	'priority'   => 140,
) ) );

// Product Cart Display Reviews Count
$wp_customize->add_setting(
    'shop_product_display_reviews_count',
    array(
        'default'           => 0,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'shop_product_display_reviews_count',
        array(
            'label'    => esc_html__( 'Display Reviews Count', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_shop_archive_product_card',
            'priority' => 141,
            'active_callback' => function() {
                return in_array( 'woocommerce_template_loop_rating', get_theme_mod( 'shop_card_elements', emoza_get_default_shop_archive_card_elements() ), true );
            },
        )
    )
);

// Product Card Text Alignment
$wp_customize->add_setting( 'shop_product_alignment',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'shop_product_alignment',
	array(
		'label'   => esc_html__( 'Text alignment', 'emoza-woocommerce' ),
		'section' => 'emoza_section_shop_archive_product_card',
		'choices' => array(
			'left'      => '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h10v1H0zM0 4h16v1H0zM0 8h10v1H0zM0 12h16v1H0z"/></svg>',
			'center'    => '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M3 0h10v1H3zM0 4h16v1H0zM3 8h10v1H3zM0 12h16v1H0z"/></svg>',
			'right'     => '<svg width="16" height="13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6 0h10v1H6zM0 4h16v1H0zM6 8h10v1H6zM0 12h16v1H0z"/></svg>',
		),
		'priority'   => 150,
	)
) );

// Product Card Elements Spacing
$wp_customize->add_setting( 'shop_product_element_spacing', array(
	'default'           => 12,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'shop_product_element_spacing',
	array(
		'label'         => esc_html__( 'Elements spacing', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_shop_archive_product_card',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'shop_product_element_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'priority'   => 160,
	)
) );

/**
 * Styling
 * 
 */

// Product Card Style
$wp_customize->add_setting(
    'shop_product_card_style',
    array(
        'default'           => 'layout1',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control(
    new Emoza_Radio_Images(
        $wp_customize,
        'shop_product_card_style',
        array(
            'label'     => esc_html__( 'Card Style', 'emoza-woocommerce' ),
            'section'   => 'emoza_section_shop_archive_product_card',
            'cols'      => 3,
            'choices'  => array(
                'layout1' => array(
                    'label' => esc_html__( 'Layout 1', 'emoza-woocommerce' ),
                    'url'   => '%s/assets/img/card1.svg',
                ),
                'layout2' => array(
                    'label' => esc_html__( 'Layout 2', 'emoza-woocommerce' ),
                    'url'   => '%s/assets/img/card2.svg',
                ),
                'layout3' => array(
                    'label' => esc_html__( 'Layout 3', 'emoza-woocommerce' ),
                    'url'   => '%s/assets/img/card3.svg',
                ),                      
            ),
            'priority'   => 290,
        )
    )
); 

// Product Card Border Radius
$wp_customize->add_setting( 'shop_product_card_radius', array(
    'default'           => 0,
    'transport'         => 'postMessage',
    'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'shop_product_card_radius',
    array(
        'label'         => esc_html__( 'Card radius', 'emoza-woocommerce' ),
        'section'       => 'emoza_section_shop_archive_product_card',
        'is_responsive' => 0,
        'settings'      => array(
            'size_desktop'      => 'shop_product_card_radius',
        ),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 100,
        ),
        'priority'   => 300,
    )
) );

// Product Card Image Radius
$wp_customize->add_setting( 'shop_product_card_thumb_radius', array(
    'default'           => 0,
    'transport'         => 'postMessage',
    'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'shop_product_card_thumb_radius',
    array(
        'label'         => esc_html__( 'Image radius', 'emoza-woocommerce' ),
        'section'       => 'emoza_section_shop_archive_product_card',
        'is_responsive' => 0,
        'settings'      => array(
            'size_desktop'      => 'shop_product_card_thumb_radius',
        ),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 100,
        ),
        'priority'   => 310,
    )
) );

// Product Card Background
$wp_customize->add_setting(
    'shop_product_card_background',
    array(
        'default'           => '',
        'sanitize_callback' => 'emoza_sanitize_hex_rgba',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control(
    new Emoza_Alpha_Color(
        $wp_customize,
        'shop_product_card_background',
        array(
            'label'             => esc_html__( 'Card background', 'emoza-woocommerce' ),
            'section'           => 'emoza_section_shop_archive_product_card',
            'priority'          => 320,
        )
    )
);

// Product Card Border
$wp_customize->add_setting( 'shop_product_card_border_size', array(
    'default'           => 1,
    'transport'         => 'postMessage',
    'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'shop_product_card_border_size',
    array(
        'label'         => esc_html__( 'Border size', 'emoza-woocommerce' ),
        'section'       => 'emoza_section_shop_archive_product_card',
        'is_responsive' => 0,
        'settings'      => array(
            'size_desktop'      => 'shop_product_card_border_size',
        ),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 100,
        ),
        'priority'   => 350,
    )
) );

// Product Card Border Color
$wp_customize->add_setting(
    'shop_product_card_border_color',
    array(
        'default'           => '#eee',
        'sanitize_callback' => 'emoza_sanitize_hex_rgba',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control(
    new Emoza_Alpha_Color(
        $wp_customize,
        'shop_product_card_border_color',
        array(
            'label'             => esc_html__( 'Border color', 'emoza-woocommerce' ),
            'section'           => 'emoza_section_shop_archive_product_card',
            'priority'          => 360,
        )
    )
);

// Product Card Title
$wp_customize->add_setting( 'shop_product_title_title',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'shop_product_title_title',
    array(
        'label'    => esc_html__( 'Product Title', 'emoza-woocommerce' ),
        'section'  => 'emoza_section_shop_archive_product_card',
        'priority' => 365,
    ) )
);

// Typography
$wp_customize->add_setting( 
    'shop_product_title_font_style', 
    array(
        'default'           => 'heading',
        'sanitize_callback' => 'emoza_sanitize_select',
    ) 
);
$wp_customize->add_control( 
    'shop_product_title_font_style', 
    array(
        'type'      => 'select',
        'section'   => 'emoza_section_shop_archive_product_card',
        'label'     => esc_html__( 'Font Style', 'emoza-woocommerce' ),
        'choices'   => array(
            'heading' => esc_html__( 'Heading', 'emoza-woocommerce' ),
            'body'    => esc_html__( 'Body', 'emoza-woocommerce' ),
            'custom'  => esc_html__( 'Custom', 'emoza-woocommerce' ),
        ),
        'priority'  => 365,
    )
);

// Adobe Font
$wp_customize->add_setting( 'shop_product_title_adobe_font',
    array(
        'default'           => 'system-default|n4',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Emoza_Typography_Adobe_Control( $wp_customize, 'shop_product_title_adobe_font',
    array(
        'section'         => 'emoza_section_shop_archive_product_card',
        'active_callback' => 'emoza_shop_product_title_font_library_adobe_and_custom_style',
        'priority'        => 365,
    )
) );

// Custom Font
$wp_customize->add_setting( 'shop_product_title_custom_font',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_setting( 'shop_product_title_custom_font_weight',
    array(
        'default'           => '',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( new Emoza_Typography_Custom_Control( $wp_customize, 'shop_product_title_custom_font_typography',
    array(
        'section'         => 'emoza_section_shop_archive_product_card',
        'settings'        => array(
            'font-family' => 'shop_product_title_custom_font',
            'font-weight' => 'shop_product_title_custom_font_weight',
        ),
        'active_callback' => 'emoza_shop_product_title_font_library_custom_and_custom_style',
        'priority'        => 365,
    )
) );

// Product Title Font
$wp_customize->add_setting( 'shop_product_title_font',
    array(
        'default'           => '{"font":"System default","regularweight":"400","category":"sans-serif"}',
        'transport'         => 'postMessage',
        'sanitize_callback' => 'emoza_google_fonts_sanitize',
        'priority'          => 365,
    )
);
$wp_customize->add_control( new Emoza_Typography_Control( $wp_customize, 'shop_product_title_font',
    array(
        'section'  => 'emoza_section_shop_archive_product_card',
        'settings' => array(
            'family' => 'shop_product_title_font',
        ),
        'input_attrs' => array(
            'font_count'     => 'all',
            'orderby'        => 'alpha',
            'disableRegular' => false,
        ),
        'active_callback' => 'emoza_shop_product_title_font_library_google_and_custom_style',
        'priority'  => 365,
    )
) );

// Font Size
$wp_customize->add_setting( 'shop_product_title_size_desktop', array(
    'default'           => 16,
    'transport'         => 'postMessage',
    'sanitize_callback' => 'absint',
) );            
$wp_customize->add_setting( 'shop_product_title_size_tablet', array(
    'default'           => 16,
    'transport'         => 'postMessage',
    'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'shop_product_title_size_mobile', array(
    'default'           => 16,
    'transport'         => 'postMessage',
    'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'shop_product_title_size',
    array(
        'label'         => esc_html__( 'Font Size', 'emoza-woocommerce' ),
        'section'       => 'emoza_section_shop_archive_product_card',
        'is_responsive' => 1,
        'settings'      => array(
            'size_desktop'      => 'shop_product_title_size_desktop',
            'size_tablet'       => 'shop_product_title_size_tablet',
            'size_mobile'       => 'shop_product_title_size_mobile',
        ),
        'input_attrs' => array(
            'min'   => 0,
            'max'   => 200,
        ),
        'priority'   => 365,
    )
) );

// Text Style
$wp_customize->add_setting( 'shop_product_title_text_decoration', array(
    'default'           => 'none',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'emoza_sanitize_text',
) );
$wp_customize->add_setting( 'shop_product_title_text_transform', array(
    'default'           => 'none',
    'transport'         => 'postMessage',
    'sanitize_callback' => 'emoza_sanitize_text',
) );
$wp_customize->add_control( new Emoza_Text_Style_Control( $wp_customize, 'shop_product_title_text_style',
    array(
        'section'  => 'emoza_section_shop_archive_product_card',
        'settings' => array(
            'decoration' => 'shop_product_title_text_decoration',
            'transform'  => 'shop_product_title_text_transform',
        ),
        'priority' => 365,
    )
) );

// Product Title Color
$wp_customize->add_setting(
    'shop_product_product_title',
    array(
        'default'           => '',
        'sanitize_callback' => 'emoza_sanitize_hex_rgba',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting(
    'shop_product_product_title_hover',
    array(
        'default'           => '',
        'sanitize_callback' => 'emoza_sanitize_hex_rgba',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'shop_product_product',
        array(
            'label'    => esc_html__( 'Product Title Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_shop_archive_product_card',
            'settings' => array(
                'normal' => 'shop_product_product_title',
                'hover'  => 'shop_product_product_title_hover',
            ),
            'priority' => 365,
        )
    )
);

// Add To Car Button Title
$wp_customize->add_setting( 'shop_product_add_to_cart_button_title',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'shop_product_add_to_cart_button_title',
    array(
        'label'    => esc_html__( 'Add To Cart Button', 'emoza-woocommerce' ),
        'section'  => 'emoza_section_shop_archive_product_card',
        'priority' => 365,
    )
) );

// Add To Cart Button Width
$wp_customize->add_setting( 'shop_product_add_to_cart_button_width',
    array(
        'default'           => 'auto',
        'sanitize_callback' => 'emoza_sanitize_text',
    )
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'shop_product_add_to_cart_button_width',
    array(
        'label'   => esc_html__( 'Width', 'emoza-woocommerce' ),
        'section' => 'emoza_section_shop_archive_product_card',
        'choices' => array(
            'auto'   => esc_html__( 'Auto', 'emoza-woocommerce' ),
            'full-width'   => esc_html__( 'Full Width', 'emoza-woocommerce' ),
        ),
        'priority'   => 365,
    )
) );