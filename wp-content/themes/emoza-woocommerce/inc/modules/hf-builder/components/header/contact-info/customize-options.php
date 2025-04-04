<?php
/**
 * Header/Footer Builder
 * Contact Info Component
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'header_contact_mail',
        'header_contact_phone'
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Emoza_Section_Hidden(
        $wp_customize,
        'emoza_section_hb_component__contact_info',
        array(
            'title'      => esc_html__( 'Contact Info', 'emoza-woocommerce' ),
            'panel'      => 'emoza_panel_header'
        )
    )
);

$wp_customize->add_setting(
    'emoza_section_hb_component__contact_info_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_hb_component__contact_info_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'emoza_section_hb_component__contact_info',
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-ehfb_contact_info_display_inline',
                        '#customize-control-ehfb_contact_info_visibility'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                )
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-ehfb_contact_info_icon',
                        '#customize-control-ehfb_contact_info_text',

                        // Sticky Active State
                        '#customize-control-ehfb_contact_info_sticky_title',
                        '#customize-control-ehfb_contact_info_icon_sticky',
                        '#customize-control-ehfb_contact_info_text_sticky',
                        '#customize-control-ehfb_contact_info_padding',
                        '#customize-control-ehfb_contact_info_margin'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'style' ] )
                )
            ),
            'priority' 				=> 20
        )
    )
);

/**
 * Layout (Tab Content)
 * 
 */

$wp_customize->add_setting(
    'ehfb_contact_info_display_inline',
    array(
        'default'           => 0,
        'sanitize_callback' => 'emoza_sanitize_checkbox',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control(
    new Emoza_Toggle_Control(
        $wp_customize,
        'ehfb_contact_info_display_inline',
        array(
            'label'         	=> esc_html__( 'Display Inline', 'emoza-woocommerce' ),
            'section'       	=> 'emoza_section_hb_component__contact_info',
            'priority' 			=> 21
        )
    )
);

// Visibility
$wp_customize->add_setting( 
    'ehfb_contact_info_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'ehfb_contact_info_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'ehfb_contact_info_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Emoza_Radio_Buttons( 
        $wp_customize, 
        'ehfb_contact_info_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'emoza-woocommerce' ),
            'section'       => 'emoza_section_hb_component__contact_info',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'ehfb_contact_info_visibility_desktop',
                'tablet' 		=> 'ehfb_contact_info_visibility_tablet',
                'mobile' 		=> 'ehfb_contact_info_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'emoza-woocommerce' ),
                'hidden'  => esc_html__( 'Hidden', 'emoza-woocommerce' )
            ),
            'priority'      => 55
        )
    ) 
);

/**
 * Style (Tab Content)
 * 
 */

// Icons Color
$wp_customize->add_setting(
	'ehfb_contact_info_icon_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'ehfb_contact_info_icon_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_contact_info_icon',
        array(
            'label'    => esc_html__( 'Icons Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_hb_component__contact_info',
            'settings' => array(
                'normal' => 'ehfb_contact_info_icon_color',
                'hover'  => 'ehfb_contact_info_icon_color_hover',
            ),
            'priority' => 25
        )
    )
);

// Text Color
$wp_customize->add_setting(
	'ehfb_contact_info_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'ehfb_contact_info_text_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_contact_info_text',
        array(
            'label'    => esc_html__( 'Text Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_hb_component__contact_info',
            'settings' => array(
                'normal' => 'ehfb_contact_info_text_color',
                'hover'  => 'ehfb_contact_info_text_color_hover',
            ),
            'priority' => 35
        )
    )
);

// Sticky Header - Title
$wp_customize->add_setting( 
    'ehfb_contact_info_sticky_title',
    array(
        'default' 			=> '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control( 
    new Emoza_Text_Control( 
        $wp_customize, 
        'ehfb_contact_info_sticky_title',
        array(
            'label'			  => esc_html__( 'Sticky Header - Active State', 'emoza-woocommerce' ),
            'section' 		  => 'emoza_section_hb_component__contact_info',
            'active_callback' => 'emoza_sticky_header_enabled',
            'priority'	 	  => 42
        )
    )
);

// Sticky Header - Icons Color
$wp_customize->add_setting(
	'ehfb_contact_info_icon_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'ehfb_contact_info_icon_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_contact_info_icon_sticky',
        array(
            'label'    => esc_html__( 'Icons Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_hb_component__contact_info',
            'settings' => array(
                'normal' => 'ehfb_contact_info_icon_sticky_color',
                'hover'  => 'ehfb_contact_info_icon_sticky_color_hover',
            ),
			'active_callback' => 'emoza_sticky_header_enabled',
            'priority' => 43
        )
    )
);

// Sticky Header - Text Color
$wp_customize->add_setting(
	'ehfb_contact_info_text_sticky_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_setting(
	'ehfb_contact_info_text_sticky_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
    new Emoza_Color_Group(
        $wp_customize,
        'ehfb_contact_info_text_sticky',
        array(
            'label'    => esc_html__( 'Text Color', 'emoza-woocommerce' ),
            'section'  => 'emoza_section_hb_component__contact_info',
            'settings' => array(
                'normal' => 'ehfb_contact_info_text_sticky_color',
                'hover'  => 'ehfb_contact_info_text_sticky_color_hover',
            ),
            'active_callback' => 'emoza_sticky_header_enabled',
            'priority' => 45
        )
    )
);

// Padding
$wp_customize->add_setting( 
    'ehfb_contact_info_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_contact_info_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_contact_info_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_contact_info_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'emoza-woocommerce' ),
            'section'         	=> 'emoza_section_hb_component__contact_info',
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
                'desktop' => 'ehfb_contact_info_padding_desktop',
                'tablet'  => 'ehfb_contact_info_padding_tablet',
                'mobile'  => 'ehfb_contact_info_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'ehfb_contact_info_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_contact_info_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_contact_info_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_contact_info_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'emoza-woocommerce' ),
            'section'         	=> 'emoza_section_hb_component__contact_info',
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
                'desktop' => 'ehfb_contact_info_margin_desktop',
                'tablet'  => 'ehfb_contact_info_margin_tablet',
                'mobile'  => 'ehfb_contact_info_margin_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Move existing options.
$priority = 50;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

		if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
		
        $wp_customize->get_control( $option_name )->section  = 'emoza_section_hb_component__contact_info';
        $wp_customize->get_control( $option_name )->priority = $priority;
        $wp_customize->get_control( $option_name )->active_callback  = function(){};
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound