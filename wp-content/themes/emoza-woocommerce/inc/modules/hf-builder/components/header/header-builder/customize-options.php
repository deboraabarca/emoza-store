<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Options
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// List of options we'll need to move.
$opts_to_move = array(
    'general' => array(
        'enable_sticky_header',
        'sticky_header_type',
        'header_transparent',
        'header_transparent_display_rules_title',
        'header_transparent_display_on',
        'header_container'
    ),
    'style'   => array()
);

/**
 * Tabs (Layout / Design)
 * 
 */
$wp_customize->add_setting(
    'emoza_section_hb_wrapper__header_builder_tabs',
    array(
        'default'           => '',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    new Emoza_Tab_Control (
        $wp_customize,
        'emoza_section_hb_wrapper__header_builder_tabs',
        array(
            'label' 				=> '',
            'section'       		=> 'emoza_section_hb_wrapper',
            'controls_general'		=> wp_json_encode(
				array_merge(
					array(
						'#customize-control-emoza_section_hb_wrapper__header_builder_goto_sections',
						'#customize-control-header_transparent_hb_rows',
						'#customize-control-emoza_section_hb_wrapper__header_builder_sticky_row'
					),
					array_map( function( $name ){ return "#customize-control-$name"; }, $opts_to_move[ 'general' ] )
				)
            ),
            'controls_design'		=> wp_json_encode(
				array(
					'#customize-control-emoza_section_hb_wrapper__header_builder_background_color',
					'#customize-control-emoza_section_hb_wrapper__header_builder_divider2',
					'#customize-control-emoza_section_hb_wrapper__header_builder_background_image',
					'#customize-control-emoza_section_hb_wrapper__header_builder_background_size',
					'#customize-control-emoza_section_hb_wrapper__header_builder_background_position',
					'#customize-control-emoza_section_hb_wrapper__header_builder_background_repeat',
					'#customize-control-emoza_section_hb_wrapper__header_builder_padding'
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

// Header Section Shortcuts
$wp_customize->add_setting( 'emoza_section_hb_wrapper__header_builder_goto_sections',
	array(
		'default'             => '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'emoza_section_hb_wrapper__header_builder_goto_sections',
		array(
			'description' 	=> '
				<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Global Header', 'emoza-woocommerce' ) .'</span>
				<div class="customize-section-shortcuts">
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_hb_presets\' ).focus();" data-goto-section="emoza_section_hb_presets">' . esc_html__( 'Header Layouts', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_hb_above_header_row\' ).focus();" data-goto-section="emoza_section_hb_above_header_row">' . esc_html__( 'Top Row', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_hb_main_header_row\' ).focus();" data-goto-section="emoza_section_hb_main_header_row">' . esc_html__( 'Main Row', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_hb_below_header_row\' ).focus();" data-goto-section="emoza_section_hb_below_header_row">' . esc_html__( 'Bottom Row', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'emoza_section_hb_mobile_offcanvas\' ).focus();" data-goto-section="emoza_section_hb_mobile_offcanvas">' . esc_html__( 'Mobile Header', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'header_image\' ).focus();" data-goto-section="header_image">' . esc_html__( 'Header Image', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
				</div>
			',
			'section' 		=> 'emoza_section_hb_wrapper',
            'priority' 		=> 20
		)
	)
);

// Header Transparent - Apply transparent header to
$wp_customize->add_setting(
	'header_transparent_hb_rows',
	array(
		'default'           => 'main-row',
		'sanitize_callback' => 'emoza_sanitize_select2'
	)
);
$wp_customize->add_control(
	new Emoza_Select2_Control(
		$wp_customize,
		'header_transparent_hb_rows',
		array(
			'label'           => esc_html__( 'Apply Transparent Header To', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_hb_wrapper',
			'select2_options' => '{ "selectionCssClass": "emoza-select2" }',
			'multiple'        => true,
			'choices'         => array(
				'main-row' 		=> __( 'Main Row', 'emoza-woocommerce' ),
				'top-row' 		=> __( 'Top Row', 'emoza-woocommerce' ),
				'bottom-row'  	=> __( 'Bottom Row', 'emoza-woocommerce' )
			),
			'active_callback' => 'emoza_header_transparent_enabled',
			'priority'		  => 27
		)
	)
);

// Sticky Header Row
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_sticky_row', 
	array(
		'sanitize_callback' => 'emoza_sanitize_select',
		'default' 			=> 'main-header-row'
	) 
);
$wp_customize->add_control( 
	'emoza_section_hb_wrapper__header_builder_sticky_row', 
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Header Row To Sticky', 'emoza-woocommerce' ),
		'choices'         => array(
            'all' 	            => esc_html__( 'All Rows', 'emoza-woocommerce' ),
			'main-header-row' 	=> esc_html__( 'Main Row', 'emoza-woocommerce' ),
            'below-header-row' 	=> esc_html__( 'Bottom Row', 'emoza-woocommerce' )
		),
        'section' 	      => 'emoza_section_hb_wrapper',
        'active_callback' => 'emoza_sticky_header_enabled',
        'priority'        => 26
	) 
);

// Mobile breakpoint.
$wp_customize->add_setting( 'mobile_breakpoint', array(
	'default'           => 1024,
	'sanitize_callback' => 'absint',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'mobile_breakpoint',
	array(
		'label'           => esc_html__( 'Mobile Breakpoint', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_hb_wrapper',
		'is_responsive'   => 0,
		'settings'        => array(
			'size_desktop'      => 'mobile_breakpoint',
		),
		'input_attrs'     => array(
			'min'   => 0,
			'max'   => 2000,
		),
		'priority'        => 20,
	)
) );

/**
 * Design (Tab Content)
 * 
 */

// Background Color
$wp_customize->add_setting(
	'emoza_section_hb_wrapper__header_builder_background_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'emoza_section_hb_wrapper__header_builder_background_color',
		array(
			'label'         	=> esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'       	=> 'emoza_section_hb_wrapper',
			'priority'			=> 35
		)
	)
);

// Divider
$wp_customize->add_setting(
	'emoza_section_hb_wrapper__header_builder_divider2',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Emoza_Divider_Control(
		$wp_customize,
		'emoza_section_hb_wrapper__header_builder_divider2',
		array(
			'section' 		=> 'emoza_section_hb_wrapper',
			'priority' 		=> 35
		)
	)
);

// Background Image
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_background_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new WP_Customize_Media_Control( 
		$wp_customize, 
		'emoza_section_hb_wrapper__header_builder_background_image',
		array(
			'label'           => __( 'Background Image', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_hb_wrapper',
			'mime_type'       => 'image',
			'priority'	      => 35
		)
	)
);

// Background Size
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_background_size',
	array(
		'default'           => 'cover',
		'sanitize_callback' => 'emoza_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'emoza_section_hb_wrapper__header_builder_background_size',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Size', 'emoza-woocommerce' ),
		'choices'         => array(
			'cover'   => esc_html__( 'Cover', 'emoza-woocommerce' ),
			'contain' => esc_html__( 'Contain', 'emoza-woocommerce' )
		),
		'section' 	      => 'emoza_section_hb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'emoza_section_hb_wrapper__header_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Background Position
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_background_position',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'emoza_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'emoza_section_hb_wrapper__header_builder_background_position',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Position', 'emoza-woocommerce' ),
		'choices'         => array(
			'top'    => esc_html__( 'Top', 'emoza-woocommerce' ),
			'center' => esc_html__( 'Center', 'emoza-woocommerce' ),
			'bottom' => esc_html__( 'Bottom', 'emoza-woocommerce' )
		),
		'section' 	      => 'emoza_section_hb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'emoza_section_hb_wrapper__header_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Background Repeat
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_background_repeat',
	array(
		'default'           => 'no-repeat',
		'sanitize_callback' => 'emoza_sanitize_select',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	'emoza_section_hb_wrapper__header_builder_background_repeat',
	array(
		'type' 		      => 'select',
		'label' 	      => esc_html__( 'Background Repeat', 'emoza-woocommerce' ),
		'choices'         => array(
			'no-repeat' => esc_html__( 'No Repeat', 'emoza-woocommerce' ),
			'repeat'    => esc_html__( 'Repeat', 'emoza-woocommerce' )
		),
		'section' 	      => 'emoza_section_hb_wrapper',
		'active_callback' => function(){ return get_theme_mod( 'emoza_section_hb_wrapper__header_builder_background_image' ) ? true : false; },
		'priority'        => 35
	)
);

// Padding
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_padding_desktop',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'emoza_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_padding_tablet',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'emoza_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_setting( 
	'emoza_section_hb_wrapper__header_builder_padding_mobile',
	array(
		'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
		'sanitize_callback' => 'emoza_sanitize_text',
		'transport'         => 'postMessage'
	) 
);
$wp_customize->add_control( 
	new Emoza_Dimensions_Control( 
		$wp_customize, 
		'emoza_section_hb_wrapper__header_builder_padding',
		array(
			'label'           	=> __( 'Padding', 'emoza-woocommerce' ),
			'section'         	=> 'emoza_section_hb_wrapper',
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
				'desktop' => 'emoza_section_hb_wrapper__header_builder_padding_desktop',
				'tablet'  => 'emoza_section_hb_wrapper__header_builder_padding_tablet',
				'mobile'  => 'emoza_section_hb_wrapper__header_builder_padding_mobile'
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
	'emoza_section_hb_wrapper__header_builder_divider1',
	array(
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control(
	new Emoza_Divider_Control(
		$wp_customize,
		'emoza_section_hb_wrapper__header_builder_divider1',
		array(
			'section' 		=> 'emoza_section_hb_wrapper',
			'priority' 		=> 40
		)
	)
);

// Available Header Components Area
$wp_customize->add_setting( 'emoza_section_hb_wrapper__header_builder_available_components',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'emoza_section_hb_wrapper__header_builder_available_components',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Components', 'emoza-woocommerce' ) .'</span><div class="ehfb-available-components emoza-header-builder-available-components emoza-ehfb-area"></div>',
			'section' 		=> 'emoza_section_hb_wrapper',
            'priority' 		=> 40
		)
	)
);

// Available Header Mobile Components Area
$wp_customize->add_setting( 'emoza_section_hb_wrapper__header_builder_available_mobile_components',
	array(
		'default' 			=> '',
		'sanitize_callback' => 'esc_attr'
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'emoza_section_hb_wrapper__header_builder_available_mobile_components',
		array(
			'description' 	=> '<span class="customize-control-title" style="font-style: normal;">'. esc_html__( 'Available Components', 'emoza-woocommerce' ) .'</span><div class="ehfb-available-components emoza-header-builder-available-mobile-components emoza-ehfb-area"></div>',
			'section' 		=> 'emoza_section_hb_wrapper',
            'priority' 		=> 40
		)
	)
);

// Upsell
if( ! defined( 'EMOZA_WL_ACTIVE' ) && ! defined( 'EMOZA_PRO_VERSION' ) ) {
	$wp_customize->add_setting( 
		'emoza_section_hb_wrapper__header_builder_upsell',
		array(
			'default'           => '',
			'sanitize_callback' => 'emoza_sanitize_text'
		)
	);
	
	$wp_customize->add_control( 
		new Emoza_Upsell_Message( 
			$wp_customize, 
			'emoza_section_hb_wrapper__header_builder_upsell',
			array(
				'title'         => esc_html__( 'Do more with your headers with Emoza Pro!', 'emoza-woocommerce' ),
				'features_list' => array(
					esc_html__( 'An extra HTML component', 'emoza-woocommerce' ),
					esc_html__( 'A shortcode component', 'emoza-woocommerce' ),
					esc_html__( 'A login button', 'emoza-woocommerce' ),
					esc_html__( 'Polylang/WPML language switcher component', 'emoza-woocommerce' )
				),
				'section'       => 'emoza_section_hb_wrapper',
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

		if( $option_name === 'header_transparent' ) {
			$wp_customize->get_control( $option_name )->description = esc_html__( 'The header stays over the content. You need to manually change the background color from each header builder row to be transparent.', 'emoza-woocommerce' );
		}

        $wp_customize->get_control( $option_name )->section  = 'emoza_section_hb_wrapper';
        $wp_customize->get_control( $option_name )->priority = $priority;
        
        $priority++;
    }
}

/**
 * Header Presets Section
 * 
 */
$wp_customize->add_section(
	new Emoza_Section_Hidden(
        $wp_customize,
		'emoza_section_hb_presets',
		array(
			'title'       => esc_html__( 'Header Layouts', 'emoza-woocommerce' ),
			'description' => esc_html__( 'Choose a header layout to start with.', 'emoza-woocommerce' ),
			'panel'       => 'emoza_panel_header'
		)
	)
);

$choices = emoza_header_layouts();
$wp_customize->add_setting(
	'emoza_section_hb_presets__header_preset_layout',
	array(
		'default'           => 'header_layout_1',
		'sanitize_callback' => 'sanitize_key',
        'transport'         => 'postMessage'
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'emoza_section_hb_presets__header_preset_layout',
		array(
			'label'    	=> esc_html__( 'Layout', 'emoza-woocommerce' ),
			'section'  	=> 'emoza_section_hb_presets',
			'cols'		=> 2,
			'choices'  	=> $choices,
			'priority'	=> 20
		)
	)
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound