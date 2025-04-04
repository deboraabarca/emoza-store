<?php
/**
 * Woocommerce Cart Customizer options
 *
 * @package Emoza
 */

// Section
$wp_customize->add_section(
	'emoza_section_shop_cart',
	array(
		'title'       => esc_html__( 'Cart', 'emoza-woocommerce'),
		'description' => esc_html__( 'Manage the overall design and functionality from the shop cart page.', 'emoza-woocommerce' ),
		'priority'    => 120,
	)
);

// Cart Layout
if ( emoza_is_cart_block_layout() ) {
	$wp_customize->add_setting(
		'shop_cart_layout_edit_block_settings',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control(
		new Emoza_Text_Control(
			$wp_customize,
			'shop_cart_layout_edit_block_settings',
			array(
				'label'     => esc_html__( 'Layout', 'emoza-woocommerce' ),
				'description' => '<a class="emoza-to-widget-area-link" href="' . esc_url( get_admin_url() . 'post.php?post=' . wc_get_page_id( 'cart' ) . '&action=edit' ) . '" target="_blank">' . esc_html__( 'Edit cart layout', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
				'section' => 'emoza_section_shop_cart',
				'priority' => 20,
			)
		)
	);

	// Woo 8.3+ checkout/cart info
	$wp_customize->add_setting( 
		'woocommerce_cart_incompat_info',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( 
		new Emoza_Text_Control( 
			$wp_customize, 
			'woocommerce_cart_incompat_info',
			array(
				'label'           => '',
				'description'     => esc_html__( 'Your cart page is being rendered through the new WooCommerce 8.3.0 cart block. To have all Emoza cart features working, you must edit the cart page to use the classic cart shortcode instead.', 'emoza-woocommerce' ),
				'link_title'        => esc_html__( 'Learn More', 'emoza-woocommerce' ),
				'link'              => 'https://docs.emoza.org/',
				'check_white_label' => false,
				'section'         => 'emoza_section_shop_cart',
				'priority'        => 20,
			)
		)
	);
} else {
	$wp_customize->add_setting(
		'shop_cart_layout',
		array(
			'default'           => 'layout1',
			'sanitize_callback' => 'sanitize_key',
		)
	);
	$wp_customize->add_control(
		new Emoza_Radio_Images(
			$wp_customize,
			'shop_cart_layout',
			array(
				'label'     => esc_html__( 'Layout', 'emoza-woocommerce' ),
				'section'   => 'emoza_section_shop_cart',
				'cols'      => 2,
				'choices'  => array(
					'layout1' => array(
						'label' => esc_html__( 'Layout 1', 'emoza-woocommerce' ),
						'url'   => '%s/assets/img/cart1.svg',
					),
					'layout2' => array(
						'label' => esc_html__( 'Layout 2', 'emoza-woocommerce' ),
						'url'   => '%s/assets/img/cart2.svg',
					),      
				),
				'priority'   => 20,
			)
		)
	);

	// Cross Sell
	$wp_customize->add_setting(
		'shop_cart_show_cross_sell',
		array(
			'default'           => 1,
			'sanitize_callback' => 'emoza_sanitize_checkbox',
		)
	);
	$wp_customize->add_control(
		new Emoza_Toggle_Control(
			$wp_customize,
			'shop_cart_show_cross_sell',
			array(
				'label'             => esc_html__( 'Cross Sell', 'emoza-woocommerce' ),
				'section'           => 'emoza_section_shop_cart',
				'priority'          => 40,
			)
		)
	);

	// Display Coupon Form
	$wp_customize->add_setting(
		'shop_cart_show_coupon_form',
		array(
			'default'           => 1,
			'sanitize_callback' => 'emoza_sanitize_checkbox',
			'transport'         => 'postMessage',
		)
	);
	$wp_customize->add_control(
		new Emoza_Toggle_Control(
			$wp_customize,
			'shop_cart_show_coupon_form',
			array(
				'label'             => esc_html__( 'Display Coupon Form', 'emoza-woocommerce' ),
				'section'           => 'emoza_section_shop_cart',
				'priority'          => 41,
			)
		)
	);

	// Divider
	$wp_customize->add_setting( 'shop_cart_divider_1',
		array(
			'sanitize_callback' => 'esc_attr',
		)
	);
	$wp_customize->add_control( 
		new Emoza_Divider_Control( 
			$wp_customize, 
			'shop_cart_divider_1',
			array(
				'section'           => 'emoza_section_shop_cart',
				'priority'          => 50,
			)
		)
	);
}

// Mini Cart Title
$wp_customize->add_setting( 'mini_cart_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Emoza_Text_Control( 
	$wp_customize, 
	'mini_cart_title',
		array(
			'label'         => esc_html__( 'Mini Cart', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_shop_cart',
			'priority'      => 60,
		)
	)
);

// Mini Cart Style
$wp_customize->add_setting(
	'mini_cart_style',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'mini_cart_style',
		array(
			'label'     => esc_html__( 'Mini Cart Style', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_shop_cart',
			'cols'      => 2,
			'choices'  => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/mini-cart-style1.svg',
				),
				'side' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Side', 'emoza-woocommerce' ),
					'url'    => '%s/assets/img/mini-cart-style2.svg',
				),      
			),
			'priority'   => 61,
		)
	)
);

// Mini Car Cross Sell
$wp_customize->add_setting(
	'enable_mini_cart_cross_sell',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'enable_mini_cart_cross_sell',
		array(
			'label'             => esc_html__( 'Mini Cart Cross Sell', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_shop_cart',
			'active_callback'   => 'emoza_callback_header_show_minicart',
			'priority'          => 70,
		)
	)
);