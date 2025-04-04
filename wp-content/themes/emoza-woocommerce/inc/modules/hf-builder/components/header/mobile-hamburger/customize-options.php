<?php
/**
 * Header/Footer Builder
 * Mobile Hamburger Component
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
 
// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'mobile_menu_icon',
    ),
    'style'   => array()
);

$wp_customize->add_section(
    new Emoza_Section_Hidden(
        $wp_customize,
        'emoza_section_hb_component__mobile_hamburger',
        array(
            'title'      => esc_html__( 'Menu Toggle', 'emoza-woocommerce' ),
            'panel'      => 'emoza_panel_header'
        )
    )
);

$wp_customize->add_setting(
    'emoza_section_hb_component__mobile_hamburger_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_hb_component__mobile_hamburger_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'emoza_section_hb_component__mobile_hamburger',
            'controls_general'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-ehfb_mobile_hamburger_visibility'
                    ),
                    array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
                ),
            ),
            'controls_design'		=> wp_json_encode(
                array_merge(
                    array(
                        '#customize-control-ehfb_mobile_hamburger_icon_color',
                        '#customize-control-ehfb_mobile_hamburger_padding',
                        '#customize-control-ehfb_mobile_hamburger_margin'
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
    'ehfb_mobile_hamburger_visibility_desktop',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_visibility_tablet',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_visibility_mobile',
    array(
        'default' 			=> 'visible',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    )
);
$wp_customize->add_control( 
    new Emoza_Radio_Buttons( 
        $wp_customize, 
        'ehfb_mobile_hamburger_visibility',
        array(
            'label'         => esc_html__( 'Visibility', 'emoza-woocommerce' ),
            'section'       => 'emoza_section_hb_component__mobile_hamburger',
            'is_responsive' => true,
            'settings' => array(
                'desktop' 		=> 'ehfb_mobile_hamburger_visibility_desktop',
                'tablet' 		=> 'ehfb_mobile_hamburger_visibility_tablet',
                'mobile' 		=> 'ehfb_mobile_hamburger_visibility_mobile'
            ),
            'choices'       => array(
                'visible' => esc_html__( 'Visible', 'emoza-woocommerce' ),
                'hidden'  => esc_html__( 'Hidden', 'emoza-woocommerce' )
            ),
            'priority'      => 30
        )
    ) 
);

// Icon Color
$wp_customize->add_setting(
	'ehfb_mobile_hamburger_icon_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'ehfb_mobile_hamburger_icon_color',
		array(
			'label'         	=> esc_html__( 'Icon color', 'emoza-woocommerce' ),
			'section'       	=> 'emoza_section_hb_component__mobile_hamburger',
			'priority'			=> 25
		)
	)
);

// Padding
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_padding_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_padding_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_padding_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_mobile_hamburger_padding',
        array(
            'label'           	=> __( 'Wrapper Padding', 'emoza-woocommerce' ),
            'section'         	=> 'emoza_section_hb_component__mobile_hamburger',
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
                'desktop' => 'ehfb_mobile_hamburger_padding_desktop',
                'tablet'  => 'ehfb_mobile_hamburger_padding_tablet',
                'mobile'  => 'ehfb_mobile_hamburger_padding_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Margin
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_margin_desktop',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_margin_tablet',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_setting( 
    'ehfb_mobile_hamburger_margin_mobile',
    array(
        'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'sanitize_callback' => 'emoza_sanitize_text',
        'transport'         => 'postMessage'
    ) 
);
$wp_customize->add_control( 
    new Emoza_Dimensions_Control( 
        $wp_customize, 
        'ehfb_mobile_hamburger_margin',
        array(
            'label'           	=> __( 'Wrapper Margin', 'emoza-woocommerce' ),
            'section'         	=> 'emoza_section_hb_component__mobile_hamburger',
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
                'desktop' => 'ehfb_mobile_hamburger_margin_desktop',
                'tablet'  => 'ehfb_mobile_hamburger_margin_tablet',
                'mobile'  => 'ehfb_mobile_hamburger_margin_mobile'
            ),
            'priority'	      	 => 72
        )
    )
);

// Move existing options.
$priority = 30;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
        
        $wp_customize->get_control( $option_name )->section  = 'emoza_section_hb_component__mobile_hamburger';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// Selective Refresh
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->get_setting( 'mobile_menu_icon' )->transport = 'postMessage';
    $wp_customize->selective_refresh->add_partial(
        'mobile_menu_icon',
        array(
            'selector'            => '.ehfb-component-mobile_hamburger',
            'container_inclusive' => true,
            'render_callback'     => function() {
                require get_template_directory() . '/inc/modules/hf-builder/components/header/mobile-hamburger/mobile-hamburger.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
            }
        )
    );
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound