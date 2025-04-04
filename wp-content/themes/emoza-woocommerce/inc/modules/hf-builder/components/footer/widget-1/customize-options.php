<?php
/**
 * Footer Builder
 * Widget 1 Component
 * 
 * @package Emoza_Pro
 */

$wp_customize->add_section(
    new Emoza_Section_Hidden(
        $wp_customize,
        'emoza_section_fb_component__widget1',
        array(
            'title'      => esc_html__( 'Widget Area 1', 'emoza-woocommerce' ),
            'panel'      => 'emoza_panel_footer',
        )
    )
);

$wp_customize->add_setting(
    'emoza_section_fb_component__widget1_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_fb_component__widget1_tabs',
        array(
            'section'               => 'emoza_section_fb_component__widget1',
            'controls_general'      => wp_json_encode(
                array(
                    '#customize-control-emoza_section_fb_component__widget1_goto_edit',
                    '#customize-control-emoza_section_fb_component__widget1_visibility',
                )
            ),
            'controls_design'       => wp_json_encode(
                array(
                    '#customize-control-emoza_section_fb_component__widget1_title_color',
                    '#customize-control-emoza_section_fb_component__widget1_text_color',
                    '#customize-control-emoza_section_fb_component__widget1_links',
					'#customize-control-emoza_section_fb_component__widget1_padding',
					'#customize-control-emoza_section_fb_component__widget1_margin',
                )
            ),
            'priority'              => 20,
        )
    )
);

// Go to button (edit widget)
$wp_customize->add_setting( 'emoza_section_fb_component__widget1_goto_edit',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'emoza_section_fb_component__widget1_goto_edit',
		array(
			'description'   => '<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-1\' ).active(true); wp.customize.section( \'sidebar-widgets-footer-1\' ).focus();">' . esc_html__( 'Footer Widget Area 1', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section'       => 'emoza_section_fb_component__widget1',
            'priority'      => 30,
		)
	)
);

// Visibility
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_visibility_desktop',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_visibility_tablet',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_visibility_mobile',
    array(
        'default'           => 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    )
);
$wp_customize->add_control( 
    new Emoza_Radio_Buttons( 
        $wp_customize, 
        'emoza_section_fb_component__widget1_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'emoza-woocommerce' ),
            'section'       => 'emoza_section_fb_component__widget1',
            'is_responsive' => true,
            'settings' => array(
                'desktop'       => 'emoza_section_fb_component__widget1_visibility_desktop',
                'tablet'        => 'emoza_section_fb_component__widget1_visibility_tablet',
                'mobile'        => 'emoza_section_fb_component__widget1_visibility_mobile',
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'emoza-woocommerce' ),
                'hidden'  => esc_html__( 'Hidden', 'emoza-woocommerce' ),
            ),
            'priority'      => 42,
        )
    ) 
);

// Widget Title Color
$wp_customize->add_setting(
	'emoza_section_fb_component__widget1_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'emoza_section_fb_component__widget1_title_color',
		array(
			'label'             => esc_html__( 'Widget Title Color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_fb_component__widget1',
			'priority'          => 50,
		)
	)
);

// Text Color
$wp_customize->add_setting(
	'emoza_section_fb_component__widget1_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'emoza_section_fb_component__widget1_text_color',
		array(
			'label'             => esc_html__( 'Text Color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_fb_component__widget1',
			'priority'          => 50,
		)
	)
);

// Links Color
$wp_customize->add_setting(
	'emoza_section_fb_component__widget1_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'emoza_section_fb_component__widget1_links_color_hover',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'emoza_section_fb_component__widget1_links',
        array(
            'label'    => esc_html__( 'Links Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_fb_component__widget1',
            'settings' => array(
                'normal' => 'emoza_section_fb_component__widget1_links_color',
                'hover'  => 'emoza_section_fb_component__widget1_links_color_hover',
            ),
            'priority' => 50,
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'emoza_section_fb_component__widget1_padding',
        array(
            'label'             => __( 'Wrapper Padding', 'emoza-woocommerce' ),
            'section'           => 'emoza_section_fb_component__widget1',
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
                'desktop' => 'emoza_section_fb_component__widget1_padding_desktop',
                'tablet'  => 'emoza_section_fb_component__widget1_padding_tablet',
                'mobile'  => 'emoza_section_fb_component__widget1_padding_mobile',
            ),
            'priority'           => 72,
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_setting( 
    'emoza_section_fb_component__widget1_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage',
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'emoza_section_fb_component__widget1_margin',
        array(
            'label'             => __( 'Wrapper Margin', 'emoza-woocommerce' ),
            'section'           => 'emoza_section_fb_component__widget1',
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
                'desktop' => 'emoza_section_fb_component__widget1_margin_desktop',
                'tablet'  => 'emoza_section_fb_component__widget1_margin_tablet',
                'mobile'  => 'emoza_section_fb_component__widget1_margin_mobile',
            ),
            'priority'           => 72,
        )
    )
);