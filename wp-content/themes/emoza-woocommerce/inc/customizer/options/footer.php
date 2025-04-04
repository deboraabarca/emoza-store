<?php
/**
 * Footer Customizer options
 *
 * @package Emoza
 */

/**
 * New controls need to also be specified in the tabs controls
 */

/**
 * Footer widgets
 */
$wp_customize->add_panel(
	'emoza_panel_footer',
	array(
		'title'    => esc_html__( 'Footer', 'emoza-woocommerce' ),
		'priority' => 20,
	)
);

/**
 * Footer widgets
 */
$wp_customize->add_section(
	'emoza_section_footer_widgets',
	array(
		'title'      => esc_html__( 'Footer widgets', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_footer',
	)
);

$wp_customize->add_setting(
	'emoza_footer_widgets_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Emoza_Tab_Control (
		$wp_customize,
		'emoza_footer_widgets_tabs',
		array(
			'label'                 => '',
			'section'               => 'emoza_section_footer_widgets',
			'controls_general'      => wp_json_encode( array( '#customize-control-footer_widgets_visibility', '#customize-control-footer_widgets_alignment', '#customize-control-footer_widget_sections', '#customize-control-footer_widgets', '#customize-control-footer_container', '#customize-control-footer_divider_1', '#customize-control-footer_divider_2' ) ),
			'controls_design'       => wp_json_encode( array( '#customize-control-footer_widgets_links_hover_color', '#customize-control-footer_widgets_links_color', '#customize-control-footer_widgets_text_color', '#customize-control-footer_widgets_title_color', '#customize-control-footer_widgets_title_size', '#customize-control-footer_divider_5', '#customize-control-footer_widgets_divider_width', '#customize-control-footer_widgets_divider_color', '#customize-control-footer_widgets_divider_size', '#customize-control-footer_divider_3', '#customize-control-footer_divider_4', '#customize-control-footer_widgets_divider', '#customize-control-footer_widgets_column_spacing', '#customize-control-footer_widgets_background', '#customize-control-footer_widgets_padding' ) ),
		)
	)
);

//Layout
$wp_customize->add_setting(
	'footer_widgets',
	array(
		'default'           => 'col2',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'footer_widgets',
		array(
			'label'    => esc_html__( 'Footer widgets layout', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_footer_widgets',
			'cols'      => 3,
        'class'     => 'emoza-radio-images-medium',
			'choices'  => array(
				'disabled' => array(
					'label' => esc_html__( 'Disabled', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/disabled.svg',
				),              
				'col1' => array(
					'label' => esc_html__( '1 column', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl1.svg',
				),
				'col2' => array(
					'label' => esc_html__( '2 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl2.svg',
				),      
				'col2-bigleft' => array(
					'label' => esc_html__( '2 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl3.svg',
				),              
				'col2-bigright' => array(
					'label' => esc_html__( '2 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl4.svg',
				),
				'col3' => array(
					'label' => esc_html__( '3 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl5.svg',
				),  
				'col3-bigleft' => array(
					'label' => esc_html__( '3 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl6.svg',
				),
				'col3-bigright' => array(
					'label' => esc_html__( '3 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl7.svg',
				),  
				'col4' => array(
					'label' => esc_html__( '4 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl8.svg',
				),  
				'col4-bigleft' => array(
					'label' => esc_html__( '4 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl9.svg',
				),
				'col4-bigright' => array(
					'label' => esc_html__( '4 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl10.svg',
				),
			),
		)
	)
); 

$wp_customize->add_setting( 'footer_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_1',
		array(
			'section'       => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_container',
	array(
		'default'           => 'container',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'footer_container',
	array(
		'label'         => esc_html__( 'Container type', 'emoza-woocommerce' ),
		'section' => 'emoza_section_footer_widgets',
		'choices' => array(
			'container'         => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'container-fluid'   => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
	)
) );

$wp_customize->add_setting( 'footer_widgets_alignment',
	array(
		'default'           => 'top',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'footer_widgets_alignment',
	array(
		'label'         => esc_html__( 'Vertical alignment', 'emoza-woocommerce' ),
		'section' => 'emoza_section_footer_widgets',
		'choices' => array(
			'top'       => esc_html__( 'Top', 'emoza-woocommerce' ),
			'middle'    => esc_html__( 'Middle', 'emoza-woocommerce' ),
			'bottom'    => esc_html__( 'Bottom', 'emoza-woocommerce' ),
		),
	)
) );

$wp_customize->add_setting( 'footer_widgets_visibility', array(
	'sanitize_callback' => 'emoza_sanitize_select',
	'default'           => 'all',
) );

$wp_customize->add_control( 'footer_widgets_visibility', array(
	'type'      => 'select',
	'section'   => 'emoza_section_footer_widgets',
	'label'     => esc_html__( 'Visibility', 'emoza-woocommerce' ),
	'choices' => array(
		'all'           => esc_html__( 'Show on all devices', 'emoza-woocommerce' ),
		'desktop-only'  => esc_html__( 'Desktop only', 'emoza-woocommerce' ),
		'mobile-only'   => esc_html__( 'Mobile/tablet only', 'emoza-woocommerce' ),
	),
) );

$wp_customize->add_setting( 'footer_divider_2',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_2',
		array(
			'section'       => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widget_sections',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'footer_widget_sections',
		array(
			'description'   => '
				<span class="customize-control-title" style="font-style: normal;">' . esc_html__( 'Footer widget areas', 'emoza-woocommerce' ) . '</span>
				<div class="customize-section-shortcuts">
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-1\' ).focus();">' . esc_html__( 'Widget area 1', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-2\' ).focus();">' . esc_html__( 'Widget area 2', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-3\' ).focus();">' . esc_html__( 'Widget area 3', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
					<a class="emoza-to-widget-area-link" href="javascript:wp.customize.section( \'sidebar-widgets-footer-4\' ).focus();">' . esc_html__( 'Widget area 4', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>
				</div>
			',
			'section' => 'emoza_section_footer_widgets',
		)
	)
);

//Styling
$wp_customize->add_setting(
	'footer_widgets_background',
	array(
		'default'           => '#f5f5f5',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_widgets_background',
		array(
			'label'             => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_widgets_title_color',
		array(
			'label'             => esc_html__( 'Widget titles color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_text_color',
	array(
		'default'           => '#404040',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_widgets_text_color',
		array(
			'label'             => esc_html__( 'Widget text color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_links_color',
	array(
		'default'           => '#404040',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_widgets_links_color',
		array(
			'label'             => esc_html__( 'Links color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_links_hover_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_widgets_links_hover_color',
		array(
			'label'             => esc_html__( 'Links color (hover)', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_divider_3',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_3',
		array(
			'section'       => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting(
	'footer_widgets_divider',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'footer_widgets_divider',
		array(
			'label'             => esc_html__( 'Enable top divider', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_divider_size', array(
	'sanitize_callback' => 'absint',
	'default'           => 1,
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'footer_widgets_divider_size', array(
	'type'              => 'number',
	'section'           => 'emoza_section_footer_widgets',
	'label'             => esc_html__( 'Divider size', 'emoza-woocommerce' ),
	'active_callback'   => 'emoza_callback_footer_widgets_divider',
) );

$wp_customize->add_setting(
	'footer_widgets_divider_color',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_widgets_divider_color',
		array(
			'label'             => esc_html__( 'Divider color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_widgets',
			'active_callback'   => 'emoza_callback_footer_widgets_divider',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_divider_width',
	array(
		'default'           => 'contained',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'footer_widgets_divider_width',
	array(
		'label'     => esc_html__( 'Divider width', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_footer_widgets',
		'choices'   => array(
			'contained'     => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'fullwidth'     => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'active_callback'   => 'emoza_callback_footer_widgets_divider',
	)
) );

$wp_customize->add_setting( 'footer_divider_4',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_4',
		array(
			'section'       => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_padding_desktop', array(
	'default'           => 70,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_setting( 'footer_widgets_padding_tablet', array(
	'default'           => 40,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'footer_widgets_padding_mobile', array(
	'default'           => 40,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            


$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'footer_widgets_padding',
	array(
		'label'         => esc_html__( 'Vertical section padding', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_footer_widgets',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'footer_widgets_padding_desktop',
			'size_tablet'       => 'footer_widgets_padding_tablet',
			'size_mobile'       => 'footer_widgets_padding_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 200,
		),       
	)
) );

$wp_customize->add_setting( 'footer_widgets_column_spacing_desktop', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'footer_widgets_column_spacing',
	array(
		'label'         => esc_html__( 'Column spacing', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_footer_widgets',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'footer_widgets_column_spacing_desktop',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
	)
) );

$wp_customize->add_setting( 'footer_divider_5',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_5',
		array(
			'section'       => 'emoza_section_footer_widgets',
		)
	)
);

$wp_customize->add_setting( 'footer_widgets_title_size_desktop', array(
	'default'           => 20,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_setting( 'footer_widgets_title_size_tablet', array(
	'default'           => 20,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'footer_widgets_title_size_mobile', array(
	'default'           => 20,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            


$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'footer_widgets_title_size',
	array(
		'label'         => esc_html__( 'Widget titles size', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_footer_widgets',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'footer_widgets_title_size_desktop',
			'size_tablet'       => 'footer_widgets_title_size_tablet',
			'size_mobile'       => 'footer_widgets_title_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),       
	)
) );


/**
 * Footer credits
 */
$wp_customize->add_section(
	'emoza_section_footer_credits',
	array(
		'title'      => esc_html__( 'Copyright area', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_footer',
	)
);
$wp_customize->add_setting(
	'emoza_footer_credits_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Emoza_Tab_Control (
		$wp_customize,
		'emoza_footer_credits_tabs',
		array(
			'label'                 => '',
			'section'               => 'emoza_section_footer_credits',
			'controls_general'      => wp_json_encode( array( '#customize-control-footer_copyright_layout', '#customize-control-footer_divider_9', '#customize-control-footer_divider_8', '#customize-control-footer_credits_container', '#customize-control-footer_content_alignment', '#customize-control-footer_copyright_elements', '#customize-control-footer_credits', '#customize-control-footer_credits_position', '#customize-control-social_profiles_footer', '#customize-control-social_profiles_footer_position', '#customize-control-footer_html_content', '#customize-control-footer_html_position' ) ),
			'controls_design'       => wp_json_encode( array( '#customize-control-footer_credits_divider', '#customize-control-footer_credits_divider_size', '#customize-control-footer_credits_divider_color', '#customize-control-footer_credits_divider_width', '#customize-control-footer_divider_7', '#customize-control-footer_divider_6', '#customize-control-footer_credits_padding_bottom', '#customize-control-footer_credits_padding', '#customize-control-footer_credits_text_color', '#customize-control-footer_credits_links_color', '#customize-control-footer_credits_links_color_hover', '#customize-control-footer_credits_background' ) ),
		)
	)
);

$wp_customize->add_setting(
	'footer_copyright_layout',
	array(
		'default'           => 'col2',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'footer_copyright_layout',
		array(
			'label'    => esc_html__( 'Copyright Bar Layout', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_footer_credits',
			'cols'      => 3,
        'class'     => 'emoza-radio-images-medium',
			'choices'  => array(
				'col1' => array(
					'label' => esc_html__( '1 column', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl1.svg',
				),
				'col2' => array(
					'label' => esc_html__( '2 columns', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/fl2.svg',
				),
			),
		)
	)
);

$wp_customize->add_setting( 'footer_credits_container',
	array(
		'default'           => 'container',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'footer_credits_container',
	array(
		'label'         => esc_html__( 'Container type', 'emoza-woocommerce' ),
		'section' => 'emoza_section_footer_credits',
		'choices' => array(
			'container'         => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'container-fluid'   => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'priority' => 20,
	)
) );

$wp_customize->add_setting( 'footer_content_alignment',
	array(
		'default'           => 'center',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'footer_content_alignment',
	array(
		'label'           => esc_html__( 'Content Alignment', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_footer_credits',
		'active_callback' => 'emoza_callback_footer_copyright_alignment',
		'choices'         => array(
			'left'   => esc_html__( 'Left', 'emoza-woocommerce' ),
			'center' => esc_html__( 'Center', 'emoza-woocommerce' ),
			'right'  => esc_html__( 'Right', 'emoza-woocommerce' ),
		),
		'priority' => 20,
	)
) );

$wp_customize->add_setting( 
	'footer_copyright_elements', 
	array(
		'default'           => array( 
			'footer_credits', 
			'footer_social_profiles',
		),
		'sanitize_callback' => 'emoza_sanitize_footer_copyright_elements',
	) 
);
$wp_customize->add_control( 
	new \Kirki\Control\Sortable( 
		$wp_customize, 
		'footer_copyright_elements', 
		array(
			'label'   => esc_html__( 'Elements', 'emoza-woocommerce' ),
			'section' => 'emoza_section_footer_credits',
			'choices' => array(
				'footer_credits'         => esc_html__( 'Credits', 'emoza-woocommerce' ),
				'footer_social_profiles' => esc_html__( 'Social Profiles', 'emoza-woocommerce' ),
			),
			'priority' => 20,
		) 
	) 
);

$wp_customize->add_setting( 'footer_divider_8',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_8',
		array(
			'section'       => 'emoza_section_footer_credits',
			'priority'      => 30,
		)
	)
);

$wp_customize->add_setting(
	'footer_credits',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'emoza-woocommerce' ), '{copyright} {year} {site_title}', '{theme_author}' ), // phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
		'transport' => 'postMessage',
	)       
);
$wp_customize->add_control( 'footer_credits', array(
	'label'           => esc_html__( 'Footer credits', 'emoza-woocommerce' ),
	'description'     => esc_html__( 'You can use the following tags: {copyright}, {year}, {site_title}, {theme_author}', 'emoza-woocommerce' ),
	'type'            => 'textarea',
	'section'         => 'emoza_section_footer_credits',
	'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_credits' ); },
	'priority'        => 40,
) );

$wp_customize->add_setting( 
	'footer_credits_position',
	array(
		'default'           => 'right',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( 
	new Emoza_Radio_Buttons( 
		$wp_customize, 
		'footer_credits_position',
		array(
			'label'           => esc_html__( 'Position', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_footer_credits',
			'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_credits', true ); },
			'choices'         => array(
				'left'   => esc_html__( 'Left', 'emoza-woocommerce' ),
				'right'  => esc_html__( 'Right', 'emoza-woocommerce' ),
			),
			'priority' => 40,
		)
	) 
);

$wp_customize->add_setting( 'footer_divider_9',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_9',
		array(
			'section'         => 'emoza_section_footer_credits',
			'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_credits' ); },
			'priority'        => 50,
		)
	)
);

$wp_customize->add_setting( 'social_profiles_footer',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_urls',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Repeater_Control( $wp_customize, 'social_profiles_footer',
	array(
		'label'           => esc_html__( 'Social profile', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_footer_credits',
		'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_social_profiles' ); },
		'button_labels'   => array(
			'add' => esc_html__( 'Add new', 'emoza-woocommerce' ),
		),
		'priority'        => 60,
	)
) );

$wp_customize->add_setting( 
	'social_profiles_footer_position',
	array(
		'default'           => 'left',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( 
	new Emoza_Radio_Buttons( 
		$wp_customize, 
		'social_profiles_footer_position',
		array(
			'label'           => esc_html__( 'Position', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_footer_credits',
			'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_social_profiles', true ); },
			'choices'         => array(
				'left'   => esc_html__( 'Left', 'emoza-woocommerce' ),
				'right'  => esc_html__( 'Right', 'emoza-woocommerce' ),
			),
			'priority' => 60,
		)
	) 
);

// HTML field content
$wp_customize->add_setting(
	'footer_html_content',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => '',
	)       
);
$wp_customize->add_control( 
	'footer_html_content', 
	array(
		'label'           => esc_html__( 'HTML Content', 'emoza-woocommerce' ),
		'type'            => 'textarea',
		'section'         => 'emoza_section_footer_credits',
		'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_html' ); },
		'priority'        => 61,
	) 
);

// HTML field position
$wp_customize->add_setting( 
	'footer_html_position',
	array(
		'default'           => 'right',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( 
	new Emoza_Radio_Buttons( 
		$wp_customize, 
		'footer_html_position',
		array(
			'label'           => esc_html__( 'Position', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_footer_credits',
			'choices'         => array(
				'left'   => esc_html__( 'Left', 'emoza-woocommerce' ),
				'right'  => esc_html__( 'Right', 'emoza-woocommerce' ),
			),
			'active_callback' => function(){ return emoza_callback_footer_copyright_elements( 'footer_html', true ); },
			'priority'        => 61,
		)
	) 
);

//Styling
$wp_customize->add_setting(
	'footer_credits_background',
	array(
		'default'           => '#f5f5f5',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_credits_background',
		array(
			'label'             => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_credits',
			'priority'          => 70,
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_text_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_credits_text_color',
		array(
			'label'             => esc_html__( 'Text color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_credits',
			'priority'          => 80,
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_links_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_credits_links_color',
		array(
			'label'             => esc_html__( 'Links color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_credits',
			'priority'          => 80,
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_links_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_credits_links_color_hover',
		array(
			'label'             => esc_html__( 'Links color hover', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_credits',
			'priority'          => 80,
		)
	)
);

$wp_customize->add_setting( 'footer_divider_6',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_6',
		array(
			'section'       => 'emoza_section_footer_credits',
			'priority'      => 90,
		)
	)
);

$wp_customize->add_setting(
	'footer_credits_divider',
	array(
		'default'           => 1,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'footer_credits_divider',
		array(
			'label'             => esc_html__( 'Enable top divider', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_credits',
			'priority'          => 100,
		)
	)
);

$wp_customize->add_setting( 'footer_credits_divider_size', array(
	'sanitize_callback' => 'absint',
	'default'           => 1,
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'footer_credits_divider_size', array(
	'type'              => 'number',
	'section'           => 'emoza_section_footer_credits',
	'label'             => esc_html__( 'Divider size', 'emoza-woocommerce' ),
	'active_callback'   => 'emoza_callback_footer_credits_divider',
	'priority'          => 110,
) );

$wp_customize->add_setting(
	'footer_credits_divider_color',
	array(
		'default'           => 'rgba(33,33,33,0.1)',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'footer_credits_divider_color',
		array(
			'label'             => esc_html__( 'Divider color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_footer_credits',
			'active_callback'   => 'emoza_callback_footer_credits_divider',
			'priority'          => 120,
		)
	)
);

$wp_customize->add_setting( 'footer_credits_divider_width',
	array(
		'default'           => 'contained',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'footer_credits_divider_width',
	array(
		'label'     => esc_html__( 'Divider width', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_footer_credits',
		'choices'   => array(
			'contained'     => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'fullwidth'     => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'active_callback'   => 'emoza_callback_footer_credits_divider',
		'priority'          => 130,
	)
) );

$wp_customize->add_setting( 'footer_divider_7',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'footer_divider_7',
		array(
			'section'       => 'emoza_section_footer_credits',
			'priority'      => 140,
		)
	)
);

$wp_customize->add_setting( 'footer_credits_padding_desktop', array(
	'default'           => 30,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'footer_credits_padding',
	array(
		'label'         => esc_html__( 'Top padding', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_footer_credits',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'footer_credits_padding_desktop',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 200,
		),
		'priority' => 150,       
	)
) );

$wp_customize->add_setting( 'footer_credits_padding_bottom_desktop', array(
	'default'           => 60,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'footer_credits_padding_bottom',
	array(
		'label'         => esc_html__( 'Bottom padding', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_footer_credits',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'footer_credits_padding_bottom_desktop',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 200,
		),
		'priority' => 160,   
	)
) );