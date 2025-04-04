<?php
/**
 * Header/Footer Builder
 * WooCommerce Icons Component
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = apply_filters( 'emoza_hfb_header_component_wc_icons_opts_to_move', array(
    'general' => array(
        'main_header_cart_account_title',
        'enable_header_cart',
        'enable_header_account'
    ),
    'style'   => array(
        'main_header_minicart_count_background_color',
        'main_header_minicart_count_text_color'
    )
) );

$wp_customize->add_section(
    new Emoza_Section_Hidden(
        $wp_customize,
        'emoza_section_hb_component__woo_icons',
        array(
            'title'      => esc_html__( 'WooCommerce Icons', 'emoza-woocommerce' ),
            'panel'      => 'emoza_panel_header'
        )
    )
);

$wp_customize->add_setting(
    'emoza_section_hb_component__woo_icons_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_hb_component__woo_icons_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'emoza_section_hb_component__woo_icons',
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-ehfb_woo_icons_visibility',
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                ),
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-ehfb_woo_icons',
                        '#customize-control-ehfb_woo_icons_sticky_title',
                        '#customize-control-ehfb_woo_icons_sticky',
                        '#customize-control-ehfb_woo_icons_space_between_icons',
                        '#customize-control-ehfb_woo_icons_padding',
                        '#customize-control-ehfb_woo_icons_margin'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

// Visibility
$wp_customize->add_setting( 
    'ehfb_woo_icons_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'ehfb_woo_icons_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'ehfb_woo_icons_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Emoza_Radio_Buttons( 
        $wp_customize, 
        'ehfb_woo_icons_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'emoza-woocommerce' ),
            'section'       => 'emoza_section_hb_component__woo_icons',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'ehfb_woo_icons_visibility_desktop',
                'tablet' 		=> 'ehfb_woo_icons_visibility_tablet',
                'mobile' 		=> 'ehfb_woo_icons_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'emoza-woocommerce' ),
                'hidden'  => esc_html__( 'Hidden', 'emoza-woocommerce' )
            ),
            'priority'      => 60
        )
    ) 
);

// Icon Color
$wp_customize->add_setting(
	'ehfb_woo_icons_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'ehfb_woo_icons_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_woo_icons',
        array(
            'label'    => esc_html__( 'Icons Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_hb_component__woo_icons',
            'settings' => array(
                'normal' => 'ehfb_woo_icons_color',
                'hover'  => 'ehfb_woo_icons_color_hover',
            ),
            'priority' => 25
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'ehfb_woo_icons_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Emoza_Text_Control( 
        $wp_customize, 
        'ehfb_woo_icons_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'emoza-woocommerce' ),
            'section' 		  => 'emoza_section_hb_component__woo_icons',
            'active_callback' => 'emoza_sticky_header_enabled',
            'priority'	 	  => 51
        )
    )
);

// Sticky Header - Icon Color
$wp_customize->add_setting(
	'ehfb_woo_icons_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'ehfb_woo_icons_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_woo_icons_sticky',
        array(
            'label'    => esc_html__( 'Icons Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_hb_component__woo_icons',
            'settings' => array(
                'normal' => 'ehfb_woo_icons_sticky_color',
                'hover'  => 'ehfb_woo_icons_sticky_color_hover',
            ),
            'active_callback'   => 'emoza_sticky_header_enabled',
            'priority' => 52
        )
    )
);

// Elements spacing.
$wp_customize->add_setting('ehfb_woo_icons_space_between_icons_desktop', array(
	'default'           => 25,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('ehfb_woo_icons_space_between_icons_tablet', array(
	'default'           => 25,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));

$wp_customize->add_setting('ehfb_woo_icons_space_between_icons_mobile', array(
	'default'           => 25,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
));
$wp_customize->add_control(new Emoza_Responsive_Slider(
	$wp_customize,
	'ehfb_woo_icons_space_between_icons',
	array(
		'label'         => esc_html__('Elements spacing', 'emoza-woocommerce'),
		'section'       => 'emoza_section_hb_component__woo_icons',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'ehfb_woo_icons_space_between_icons_desktop',
			'size_tablet'       => 'ehfb_woo_icons_space_between_icons_tablet',
			'size_mobile'       => 'ehfb_woo_icons_space_between_icons_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 200,
		),
        'priority' => 71
	)
));

// Padding
$wp_customize->add_setting( 
    'ehfb_woo_icons_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_woo_icons_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_woo_icons_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_woo_icons_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'emoza-woocommerce' ),
            'section'         	=> 'emoza_section_hb_component__woo_icons',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'ehfb_woo_icons_padding_desktop',
                'tablet'  => 'ehfb_woo_icons_padding_tablet',
                'mobile'  => 'ehfb_woo_icons_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'ehfb_woo_icons_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_woo_icons_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_woo_icons_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_woo_icons_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'emoza-woocommerce' ),
            'section'         	=> 'emoza_section_hb_component__woo_icons',
            'sides'             => array(
                'top'    => true,
                'right'  => true,
                'bottom' => true,
                'left'   => true
            ),
            'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
            'link_values_toggle' => true,
            'is_responsive'   	 => true,
            'settings'        	 => array(
                'desktop' => 'ehfb_woo_icons_margin_desktop',
                'tablet'  => 'ehfb_woo_icons_margin_tablet',
                'mobile'  => 'ehfb_woo_icons_margin_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Move existing options.
$priority = 35;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {
        
        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }

        $wp_customize->get_control( $option_name )->section  = 'emoza_section_hb_component__woo_icons';
        $wp_customize->get_control( $option_name )->priority = $priority;

        if( in_array( $option_name, array( 'enable_header_cart', 'enable_header_account' ) ) ) {
            $wp_customize->get_control( $option_name )->active_callback  = function(){};
        }
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound