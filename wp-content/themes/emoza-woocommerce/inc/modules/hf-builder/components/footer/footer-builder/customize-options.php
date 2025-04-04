<?php
/**
 * Footer Builder
 * General Footer Settings
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'footer_container'
    ),
    'style'   => array()
);

/**
 * Tabs (Layout / Design)
 * 
 */
$wp_customize->add_setting(
    'emoza_section_fb_wrapper__footer_builder_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_fb_wrapper__footer_builder_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'emoza_section_fb_wrapper',
            'controls_general'		=> wp_json_encode(
				array_merge(
					array(
						'#customize-control-emoza_section_fb_wrapper__footer_builder_goto_sections',
						'#customize-control-header_transparent_fb_rows',
						'#customize-control-emoza_section_fb_wrapper__footer_builder_sticky_row'
					),
					array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
				)
            ),
            'controls_design'		=> wp_json_encode(
				array(
					'#customize-control-emoza_section_fb_wrapper__footer_builder_background_color',
					'#customize-control-emoza_section_fb_wrapper__footer_builder__divider2',
					'#customize-control-emoza_section_fb_wrapper__footer_builder_background_image',
					'#customize-control-emoza_section_fb_wrapper__footer_builder_background_size',
					'#customize-control-emoza_section_fb_wrapper__footer_builder_background_position',
					'#customize-control-emoza_section_fb_wrapper__footer_builder_background_repeat',
					'#customize-control-emoza_section_fb_wrapper__footer_builder_padding'
				)
            ),
            'priority' 				=> 10
        )
    )
);

/**
 * Layout (Tab Content)
 * 
 */

// Footer Section Shortcuts
$wp_customize->add_setting( 'emoza_section_fb_wrapper__footer_builder_goto_sections',
	array(
		'default'             => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'emoza_section_fb_wrapper__footer_builder_goto_sections',
		array(
			'description' 	=> '
				<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Global Footer', 'emoza-woocommerce' ) .'</span>
				<div class="customize-section-shortcuts">
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_fb_above_footer_row\' ).focus();">' . esc_html__( 'Top Row', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_fb_main_footer_row\' ).focus();">' . esc_html__( 'Main Row', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_fb_below_footer_row\' ).focus();">' . esc_html__( 'Bottom Row', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
				</div>
			',
			'section'  => 'emoza_section_fb_wrapper',
            'priority' => 20
		)
	)
);

/**
 * Design (Tab Content)
 * 
 */

// Background Color
$wp_customize->add_setting(
	'emoza_section_fb_wrapper__footer_builder_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'emoza_section_fb_wrapper__footer_builder_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'       	=> 'emoza_section_fb_wrapper',
			'priority'			=> 35
		)
	)
);

// Divider
$wp_customize->add_setting(
	'emoza_section_fb_wrapper__footer_builder__divider2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Emoza_Divider_Control(
		$wp_customize,
		'emoza_section_fb_wrapper__footer_builder__divider2',
		array(
			'section' 		=> 'emoza_section_fb_wrapper',
			'priority' 		=> 35
		)
	)
);

// Background Image
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_background_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new WP_Customize_Media_Control( 
		$wp_customize, 
		'emoza_section_fb_wrapper__footer_builder_background_image',
		array(
			'label'           => __( 'Background Image', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_fb_wrapper',
			'mime_type'       => 'image',
			'priority'	      => 35
		)
	)
);

// Background Size
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_background_size',
	array(
		'default'           => 'cover',
		'sanitize_callback' => 'emoza_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'emoza_section_fb_wrapper__footer_builder_background_size',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Size', 'emoza-woocommerce' ),
		'choices'         => array(
			'cover'   => esc_html__( 'Cover', 'emoza-woocommerce' ),
			'contain' => esc_html__( 'Contain', 'emoza-woocommerce' )
		),
		'section' 	      => 'emoza_section_fb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Background Position
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_background_position',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'emoza_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'emoza_section_fb_wrapper__footer_builder_background_position',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Position', 'emoza-woocommerce' ),
		'choices'         => array(
			'top'    => esc_html__( 'Top', 'emoza-woocommerce' ),
			'center' => esc_html__( 'Center', 'emoza-woocommerce' ),
			'bottom' => esc_html__( 'Bottom', 'emoza-woocommerce' )
		),
		'section' 	      => 'emoza_section_fb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Background Repeat
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_background_repeat',
	array(
		'default'           => 'no-repeat',
		'sanitize_callback' => 'emoza_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'emoza_section_fb_wrapper__footer_builder_background_repeat',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Repeat', 'emoza-woocommerce' ),
		'choices'         => array(
			'no-repeat' => esc_html__( 'No Repeat', 'emoza-woocommerce' ),
			'repeat'    => esc_html__( 'Repeat', 'emoza-woocommerce' )
		),
		'section' 	      => 'emoza_section_fb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Padding
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_padding_desktop',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'emoza_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_padding_tablet',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'emoza_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_setting( 
	'emoza_section_fb_wrapper__footer_builder_padding_mobile',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'emoza_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	new Emoza_Dimensions_Control( 
		$wp_customize, 
		'emoza_section_fb_wrapper__footer_builder_padding',
		array(
			'label'           	=> __( 'Padding', 'emoza-woocommerce' ),
			'section'         	=> 'emoza_section_fb_wrapper',
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
				'desktop' => 'emoza_section_fb_wrapper__footer_builder_padding_desktop',
				'tablet'  => 'emoza_section_fb_wrapper__footer_builder_padding_tablet',
				'mobile'  => 'emoza_section_fb_wrapper__footer_builder_padding_mobile'
			),
			'priority'	      	 => 35
		)
	)
);

/**
 * Layout / Design
 * Is not assigned to any tab, so it will display in both tabs
 * 
 */

// Divider
$wp_customize->add_setting(
	'emoza_section_fb_wrapper__footer_builder_divider1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Emoza_Divider_Control(
		$wp_customize,
		'emoza_section_fb_wrapper__footer_builder_divider1',
		array(
			'section' 		=> 'emoza_section_fb_wrapper',
			'priority' 		=> 40
		)
	)
);

// Available Footer Components Area
$wp_customize->add_setting( 'emoza_section_fb_wrapper__footer_builder_available_footer_components',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'emoza_section_fb_wrapper__footer_builder_available_footer_components',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Components', 'emoza-woocommerce' ) .'</span><div class="ehfb-available-components emoza-footer-builder-available-footer-components emoza-ehfb-area"></div>',
			'section' 		=> 'emoza_section_fb_wrapper',
            'priority' 		=> 40
		)
	)
);

// Upsell
if( ! defined( 'EMOZA_WL_ACTIVE' ) && ! defined( 'EMOZA_PRO_VERSION' ) ) {
	$wp_customize->add_setting( 
		'emoza_section_fb_wrapper__footer_builder_upsell',
		array(
			'default'           => '',
			'sanitize_callback' => 'emoza_sanitize_text'
		)
	);
	
	$wp_customize->add_control( 
		new Emoza_Upsell_Message( 
			$wp_customize, 
			'emoza_section_fb_wrapper__footer_builder_upsell',
			array(
				'title'         => esc_html__( 'Create a more information-rich footer with Emoza Pro!', 'emoza-woocommerce' ),
				'features_list' => array(
					esc_html__( 'An extra HTML component', 'emoza-woocommerce' ),
					esc_html__( 'A shortcode component', 'emoza-woocommerce' ),
					esc_html__( 'An additional button component', 'emoza-woocommerce' ),
					esc_html__( 'An additional footer menu', 'emoza-woocommerce' )
				),
				'section'       => 'emoza_section_fb_wrapper',
				'priority'      => 999
			)
		) 
	);
}

// Move existing options.
$priority = 25;
foreach( $opts_to_move as $control_tabs ) {
    foreach( $control_tabs as $option_name ) {

        if( $wp_customize->get_control( $option_name ) === NULL ) {
            continue;
        }
        
        $wp_customize->get_control( $option_name )->section  = 'emoza_section_fb_wrapper';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound