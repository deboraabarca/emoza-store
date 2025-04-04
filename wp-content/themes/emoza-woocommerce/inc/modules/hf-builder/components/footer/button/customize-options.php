<?php
/**
 * Footer Builder
 * Button 1 Component
 * 
 * @package Emoza_Pro
 */

$wp_customize->add_section(
    new Emoza_Section_Hidden(
        $wp_customize,
        'emoza_section_fb_component__button',
        array(
            'title'      => esc_html__( 'Button 1', 'emoza-woocommerce' ),
            'panel'      => 'emoza_panel_footer',
        )
    )
);

$wp_customize->add_setting(
    'emoza_section_fb_component__button_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_fb_component__button_tabs',
        array(
            'label'                 => '',
            'section'               => 'emoza_section_fb_component__button',
            'controls_general'      => wp_json_encode(
                array(
                    '#customize-control-ehfb_footer_button_text',
                    '#customize-control-ehfb_footer_button_link',
                    '#customize-control-ehfb_footer_button_class',
                    '#customize-control-ehfb_footer_button_newtab',
                    '#customize-control-ehfb_footer_button_visibility',
                )
            ),
            'controls_design'       => wp_json_encode(
                array(
                    '#customize-control-ehfb_footer_button_colors_title',
                    '#customize-control-ehfb_footer_button_background',
                    '#customize-control-ehfb_footer_button',
                    '#customize-control-ehfb_footer_button_border',
					'#customize-control-ehfb_footer_button_padding',
					'#customize-control-ehfb_footer_button_margin',
                )
            ),
            'priority'              => 20,
        )
    )
);

// Button Text
$wp_customize->add_setting(
	'ehfb_footer_button_text',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( 'Click me', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'ehfb_footer_button_text', array(
	'label'       => esc_html__( 'Button text', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_fb_component__button',
	'priority'          => 25,
) );

// Button Link
$wp_customize->add_setting(
	'ehfb_footer_button_link',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'ehfb_footer_button_link', array(
	'label'       => esc_html__( 'Button link', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_fb_component__button',
	'priority'          => 30,
) );

// Button Class
$wp_customize->add_setting(
	'ehfb_footer_button_class',
	array(
		'sanitize_callback' => 'esc_attr',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'ehfb_footer_button_class', array(
	'label'       => esc_html__( 'Button Class', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_fb_component__button',
	'priority'          => 35,
) );

// Button Target
$wp_customize->add_setting(
	'ehfb_footer_button_newtab',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'ehfb_footer_button_newtab',
		array(
			'label'             => esc_html__( 'Open in a new tab?', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_fb_component__button',
			'priority'          => 40,
		)
	)
);

// Visibility
$wp_customize->add_setting( 
    'ehfb_footer_button_visibility_desktop',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'ehfb_footer_button_visibility_tablet',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'ehfb_footer_button_visibility_mobile',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control( 
    new Emoza_Radio_Buttons( 
        $wp_customize, 
        'ehfb_footer_button_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'emoza-woocommerce' ),
            'section'       => 'emoza_section_fb_component__button',
            'is_responsive' => true,
            'settings' => array(
                'desktop'       => 'ehfb_footer_button_visibility_desktop',
                'tablet'        => 'ehfb_footer_button_visibility_tablet',
                'mobile'        => 'ehfb_footer_button_visibility_mobile',
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'emoza-woocommerce' ),
                'hidden'  => esc_html__( 'Hidden', 'emoza-woocommerce' ),
            ),
            'priority'      => 42,
        )
    ) 
);

// Colors Title.
$wp_customize->add_setting( 'ehfb_footer_button_colors_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'ehfb_footer_button_colors_title',
		array(
			'label'         => esc_html__( 'Colors', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_fb_component__button',
            'priority'      => 45,
		)
	)
);

// Background Color.
$wp_customize->add_setting(
	'ehfb_footer_button_background_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'ehfb_footer_button_background_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_footer_button_background',
        array(
            'label'    => esc_html__( 'Background Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_fb_component__button',
            'settings' => array(
                'normal' => 'ehfb_footer_button_background_color',
                'hover'  => 'ehfb_footer_button_background_color_hover',
            ),
            'priority' => 50,
        )
    )
);

// Text Color.
$wp_customize->add_setting(
	'ehfb_footer_button_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'ehfb_footer_button_color_hover',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_footer_button',
        array(
            'label'    => esc_html__( 'Text Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_fb_component__button',
            'settings' => array(
                'normal' => 'ehfb_footer_button_color',
                'hover'  => 'ehfb_footer_button_color_hover',
            ),
            'priority' => 55,
        )
    )
);

// Border Color.
$wp_customize->add_setting(
	'ehfb_footer_button_border_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'ehfb_footer_button_border_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_footer_button_border',
        array(
            'label'    => esc_html__( 'Border Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_fb_component__button',
            'settings' => array(
                'normal' => 'ehfb_footer_button_border_color',
                'hover'  => 'ehfb_footer_button_border_color_hover',
            ),
            'priority' => 60,
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'ehfb_footer_button_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'ehfb_footer_button_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'ehfb_footer_button_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_footer_button_padding',
        array(
            'label'             => __( 'Wrapper Padding', 'emoza-woocommerce' ),
            'section'           => 'emoza_section_fb_component__button',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true,
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'      => true,
            'settings'           => array(
                'desktop' => 'ehfb_footer_button_padding_desktop',
                'tablet'  => 'ehfb_footer_button_padding_tablet',
                'mobile'  => 'ehfb_footer_button_padding_mobile',
            ),
            'priority'           => 72,
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'ehfb_footer_button_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'ehfb_footer_button_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'ehfb_footer_button_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_footer_button_margin',
        array(
            'label'             => __( 'Wrapper Margin', 'emoza-woocommerce' ),
            'section'           => 'emoza_section_fb_component__button',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true,
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'      => true,
            'settings'           => array(
                'desktop' => 'ehfb_footer_button_margin_desktop',
                'tablet'  => 'ehfb_footer_button_margin_tablet',
                'mobile'  => 'ehfb_footer_button_margin_mobile',
            ),
            'priority'           => 72,
        )
    )
);