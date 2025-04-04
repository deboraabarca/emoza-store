<?php
/**
 * Woocommerce Search Customizer options
 *
 * @package Emoza
 */

/**
 * Search
 */
$wp_customize->add_section(
	'emoza_section_shop_search',
	array(
		'title'       => esc_html__( 'Search', 'emoza-woocommerce'),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop search page.', 'emoza-woocommerce' ),
		'priority'    => 125,
	)
);

$wp_customize->add_setting(
	'shop_search_enable_ajax',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'shop_search_enable_ajax',
		array(
			'label'             => esc_html__( 'Enable AJAX On Search Fields', 'emoza-woocommerce' ),
			'description'       => esc_html__( 'Allow your customers to search and get results in real time without loading other pages.', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_shop_search',
			'priority'          => 10,
		)
	)
);

$wp_customize->add_setting(
	'shop_search_ajax_enable_search_by_sku',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'shop_search_ajax_enable_search_by_sku',
		array(
			'label'             => esc_html__( 'Enable search by SKU', 'emoza-woocommerce' ),
			'description'       => esc_html__( 'Return search results based on either product name or SKU.', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_shop_search',
			'priority'          => 11,
		)
	)
);

$wp_customize->add_setting( 
	'shop_search_ajax_posts_per_page', 
	array(
		'default'           => 15,
		'sanitize_callback' => 'absint',
	) 
);          
$wp_customize->add_control( 
	new Emoza_Responsive_Slider( 
		$wp_customize, 
		'shop_search_ajax_posts_per_page',
		array(
			'label'         => esc_html__( 'Results Amount per Search', 'emoza-woocommerce' ),
			'description'   => esc_html__( 'Control the maximum amount of products to show in the search results.', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_shop_search',
			'active_callback' => 'emoza_shop_search_ajax_is_enabled',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_search_ajax_posts_per_page',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 100,
				'unit'  => '',
			),
			'priority'   => 20,
		)
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_desc_content', 
	array(
		'sanitize_callback' => 'emoza_sanitize_select',
		'default'           => 'product-post-content',
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_desc_content', 
	array(
		'type'        => 'select',
		'section'     => 'emoza_section_shop_search',
		'label'       => esc_html__( 'Results Description', 'emoza-woocommerce' ),
		'description' => esc_html__( 'Save/publish the changes is required to see this option working in the customizer preview.', 'emoza-woocommerce' ),
		'choices'     => array(
			'product-post-content'      => esc_html__( 'Product Description', 'emoza-woocommerce' ),
			'product-short-description' => esc_html__( 'Product Short Description', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_shop_search_ajax_is_enabled',
		'priority'   => 30,
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_desc_excerpt_length', 
	array(
		'default'           => 10,
		'sanitize_callback' => 'absint',
	) 
);          
$wp_customize->add_control( 
	new Emoza_Responsive_Slider( 
		$wp_customize, 
		'shop_search_ajax_desc_excerpt_length',
		array(
			'label'         => esc_html__( 'Results Description Length', 'emoza-woocommerce' ),
			'description'   => esc_html__( 'The number of words to show in the results description. Save/publish the changes is required to see this option working in the customizer preview.', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_shop_search',
			'active_callback' => 'emoza_shop_search_ajax_is_enabled',
			'is_responsive' => 0,
			'settings'      => array(
				'size_desktop'      => 'shop_search_ajax_desc_excerpt_length',
			),
			'input_attrs' => array(
				'min'   => 1,
				'max'   => 100,
				'unit'  => '',
			),
			'priority'   => 30,
		)
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_orderby', 
	array(
		'sanitize_callback' => 'emoza_sanitize_select',
		'default'           => 'title',
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_orderby', 
	array(
		'type'      => 'select',
		'section'   => 'emoza_section_shop_search',
		'label'     => esc_html__( 'Results Order By', 'emoza-woocommerce' ),
		'choices' => array(
			'none'      => esc_html__( 'None', 'emoza-woocommerce' ),
			'title'     => esc_html__( 'Product Name', 'emoza-woocommerce' ),
			'date'      => esc_html__( 'Published Date', 'emoza-woocommerce' ),
			'modified'  => esc_html__( 'Modified Date', 'emoza-woocommerce' ),
			'rand'      => esc_html__( 'Random', 'emoza-woocommerce' ),
			'price'     => esc_html__( 'Product Price', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_shop_search_ajax_is_enabled',
		'priority'   => 30,
	) 
);

$wp_customize->add_setting( 
	'shop_search_ajax_order', 
	array(
		'sanitize_callback' => 'emoza_sanitize_select',
		'default'           => 'asc',
	) 
);
$wp_customize->add_control( 
	'shop_search_ajax_order', 
	array(
		'type'      => 'select',
		'section'   => 'emoza_section_shop_search',
		'label'     => esc_html__( 'Results Order', 'emoza-woocommerce' ),
		'choices' => array(
			'asc'   => esc_html__( 'Ascendant', 'emoza-woocommerce' ),
			'desc'  => esc_html__( 'Descendant', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_shop_search_ajax_is_enabled',
		'priority'   => 40,
	) 
);

$wp_customize->add_setting(
	'shop_search_ajax_show_categories',
	array(
		'default'           => 1,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'shop_search_ajax_show_categories',
		array(
			'label'             => esc_html__( 'Display Categories', 'emoza-woocommerce' ),
			'description'       => esc_html__( 'Display product categories in the results if the searched term matches with category name.', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_shop_search',
			'active_callback'   => 'emoza_shop_search_ajax_is_enabled',
			'priority'          => 50,
		)
	)
);

$wp_customize->add_setting(
	'shop_search_ajax_display_see_all',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'shop_search_ajax_display_see_all',
		array(
			'label'             => esc_html__( 'Display See All Products Link', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_shop_search',
			'active_callback'   => 'emoza_shop_search_ajax_is_enabled',
			'priority'          => 51,
		)
	)
);

$wp_customize->add_setting(
	'shop_search_enable_popular_products',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'shop_search_enable_popular_products',
		array(
			'label'       => esc_html__( 'Enable Popular Products', 'emoza-woocommerce' ),
			'description' => esc_html__( 'Show popular products if no products found in search results page.', 'emoza-woocommerce' ),
			'section'     => 'emoza_section_shop_search',
			'priority'    => 55,
		)
	)
);