<?php
/**
 * General Customizer options
 *
 * @package Emoza
 */

/**
 * Scroll to top
 */
$wp_customize->add_section(
	'emoza_section_scrolltotop',
	array(
		'title'       => esc_html__( 'Scroll to Top', 'emoza-woocommerce'),
		'description' => esc_html__( 'A button that helps users quickly navigate to the top of the page.', 'emoza-woocommerce' ),
		'priority'    => 75,
	)
);

$wp_customize->add_setting(
	'emoza_scrolltop_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Emoza_Tab_Control (
		$wp_customize,
		'emoza_scrolltop_tabs',
		array(
			'label'            => '',
			'section'          => 'emoza_section_scrolltotop',
			'controls_general' => wp_json_encode( array(
				'#customize-control-enable_scrolltop',
				'#customize-control-scrolltop_type',
				'#customize-control-scrolltop_text',
				'#customize-control-scrolltop_icon',
				'#customize-control-scrolltop_radius',
				'#customize-control-scrolltop_divider_1',
				'#customize-control-scrolltop_position',
				'#customize-control-scrolltop_side_offset',
				'#customize-control-scrolltop_bottom_offset',
				'#customize-control-scrolltop_divider_2',
				'#customize-control-scrolltop_visibility',
			) ),
			'controls_design'  => wp_json_encode( array(
				'#customize-control-scrolltop',
				'#customize-control-scrolltop_bg',
				'#customize-control-scrolltop_divider_3',
				'#customize-control-scrolltop_divider_4',
				'#customize-control-scrolltop_icon_size',
				'#customize-control-scrolltop_padding',
			) ),
			'active_callback'  => 'emoza_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting(
	'enable_scrolltop',
	array(
		'default'           => 1,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'enable_scrolltop',
		array(
			'label'             => esc_html__( 'Enable scroll to top', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_scrolltotop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_type',
	array(
		'default'           => 'icon',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'scrolltop_type',
	array(
		'label'     => esc_html__( 'Type', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_scrolltotop',
		'choices'   => array(
			'icon'      => esc_html__( 'Icon', 'emoza-woocommerce' ),
			'text'      => esc_html__( 'Text + Icon', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );

$wp_customize->add_setting(
	'scrolltop_text',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( 'Back to top', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'scrolltop_text', array(
	'label'             => esc_html__( 'Text', 'emoza-woocommerce' ),
	'type'              => 'text',
	'section'           => 'emoza_section_scrolltotop',
	'active_callback'   => 'emoza_callback_scrolltop_text',
) );

$wp_customize->add_setting(
	'scrolltop_icon',
	array(
		'default'           => 'icon1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'scrolltop_icon',
		array(
			'label'     => esc_html__( 'Icon', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_scrolltotop',
			'cols'        => 4,
			'class'     => 'emoza-radio-images-medium',
			'choices'   => array(           
				'icon1'     => array(
					'label' => esc_html__( 'Icon 1', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/st1.svg',
				),
				'icon2' => array(
					'label' => esc_html__( 'Icon 2', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/st2.svg',
				),      
				'icon3' => array(
					'label' => esc_html__( 'Icon 3', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/st3.svg',
				),              
				'icon4' => array(
					'label' => esc_html__( 'Icon 4', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/st4.svg',
				),
			),
			'active_callback' => 'emoza_callback_scrolltop',
		)
	)
); 

$wp_customize->add_setting( 'scrolltop_radius', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'scrolltop_radius',
	array(
		'label'         => esc_html__( 'Button radius', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_scrolltotop',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'scrolltop_radius',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'scrolltop_divider_1',
		array(
			'section'       => 'emoza_section_scrolltotop',
			'active_callback' => 'emoza_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_position',
	array(
		'default'           => 'right',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'scrolltop_position',
	array(
		'label'     => esc_html__( 'Position', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_scrolltotop',
		'choices'   => array(
			'left'      => esc_html__( 'Left', 'emoza-woocommerce' ),
			'right'     => esc_html__( 'Right', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_side_offset_desktop', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'scrolltop_side_offset_tablet', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'scrolltop_side_offset_mobile', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'scrolltop_side_offset',
	array(
		'label'         => esc_html__( 'Side offset', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_scrolltotop',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'scrolltop_side_offset_desktop',
			'size_tablet'       => 'scrolltop_side_offset_tablet',
			'size_mobile'       => 'scrolltop_side_offset_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_bottom_offset_desktop', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );    
$wp_customize->add_setting( 'scrolltop_bottom_offset_tablet', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );    
$wp_customize->add_setting( 'scrolltop_bottom_offset_mobile', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'scrolltop_bottom_offset',
	array(
		'label'         => esc_html__( 'Bottom offset', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_scrolltotop',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'scrolltop_bottom_offset_desktop',
			'size_tablet'       => 'scrolltop_bottom_offset_tablet',
			'size_mobile'       => 'scrolltop_bottom_offset_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_divider_2',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'scrolltop_divider_2',
		array(
			'section'       => 'emoza_section_scrolltotop',
			'active_callback' => 'emoza_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_visibility', array(
	'sanitize_callback' => 'emoza_sanitize_select',
	'default'           => 'all',
) );

$wp_customize->add_control( 'scrolltop_visibility', array(
	'type'      => 'select',
	'section'   => 'emoza_section_scrolltotop',
	'label'     => esc_html__( 'Visibility', 'emoza-woocommerce' ),
	'choices' => array(
		'all'           => esc_html__( 'Show on all devices', 'emoza-woocommerce' ),
		'desktop-only'  => esc_html__( 'Desktop only', 'emoza-woocommerce' ),
		'mobile-only'   => esc_html__( 'Mobile/tablet only', 'emoza-woocommerce' ),
	),
	'active_callback' => 'emoza_callback_scrolltop',
) );

/**
 * Style
 */
$wp_customize->add_setting(
	'scrolltop_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'scrolltop_color_hover',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'scrolltop',
		array(
			'label'    => esc_html__( 'Icon color', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_scrolltotop',
			'settings' => array(
				'normal' => 'scrolltop_color',
				'hover'  => 'scrolltop_color_hover',
			),
			'active_callback' => 'emoza_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting(
	'scrolltop_bg_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'scrolltop_bg_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'scrolltop_bg',
		array(
			'label'    => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_scrolltotop',
			'settings' => array(
				'normal' => 'scrolltop_bg_color',
				'hover'  => 'scrolltop_bg_color_hover',
			),
			'active_callback' => 'emoza_callback_scrolltop',
		)
	)
);

$wp_customize->add_setting( 'scrolltop_icon_size', array(
	'default'           => 18,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'scrolltop_icon_size',
	array(
		'label'         => esc_html__( 'Icon size', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_scrolltotop',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'scrolltop_icon_size',
		),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 100,
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );

$wp_customize->add_setting( 'scrolltop_padding', array(
	'default'           => 15,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'scrolltop_padding',
	array(
		'label'         => esc_html__( 'Padding', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_scrolltotop',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'scrolltop_padding',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'active_callback' => 'emoza_callback_scrolltop',
	)
) );
