<?php
/**
 * Top bar Customizer options
 *
 * @package Emoza
 */

/**
 * Top bar
 */
$wp_customize->add_section(
	'emoza_section_top_bar',
	array(
		'title'      => esc_html__( 'Top bar', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_header',
	)
);

$wp_customize->add_setting(
	'emoza_topbar_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Emoza_Tab_Control (
		$wp_customize,
		'emoza_topbar_tabs',
		array(
			'label'                 => '',
			'section'               => 'emoza_section_top_bar',
			'controls_general'      => wp_json_encode( array( '#customize-control-center_top_bar_contents', '#customize-control-enable_top_bar', '#customize-control-topbar_container', '#customize-control-topbar_delimiter', '#customize-control-topbar_visibility', '#customize-control-topbar_divider_1', '#customize-control-topbar_elements_title', '#customize-control-topbar_components_left', '#customize-control-topbar_components_right', '#customize-control-topbar_divider_2', '#customize-control-topbar_contact_info_title', '#customize-control-topbar_contact_mail', '#customize-control-topbar_contact_phone', '#customize-control-topbar_divider_3', '#customize-control-topbar_social_title', '#customize-control-social_profiles_topbar', '#customize-control-topbar_divider_4', '#customize-control-topbar_text_title', '#customize-control-topbar_text', '#customize-control-topbar_divider_5', '#customize-control-topbar_nav_title', '#customize-control-topbar_nav_link' ) ),
			'controls_design'       => wp_json_encode( array( '#customize-control-topbar_divider_7', '#customize-control-topbar_background', '#customize-control-topbar_color', '#customize-control-topbar_color_hover', '#customize-control-topbar_submenu_background_color', '#customize-control-topbar_divider_6', '#customize-control-topbar_padding', '#customize-control-topbar_divider_size', '#customize-control-topbar_divider_color', '#customize-control-topbar_divider_width' ) ),
			'priority'              => 10,
		)
	)
);

$wp_customize->add_setting(
	'enable_top_bar',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'enable_top_bar',
		array(
			'label'             => esc_html__( 'Enable top bar', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'priority'          => 20,
		)
	)
);

$wp_customize->add_setting( 'topbar_container',
	array(
		'default'           => 'container-fluid',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'topbar_container',
	array(
		'label'         => esc_html__( 'Container type', 'emoza-woocommerce' ),
		'section' => 'emoza_section_top_bar',
		'choices' => array(
			'container'         => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'container-fluid'   => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'priority'          => 30,
	)
) );

$wp_customize->add_setting( 'topbar_delimiter',
	array(
		'default'           => 'none',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'topbar_delimiter',
	array(
		'label'     => esc_html__( 'Delimiter style', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_top_bar',
		'choices'   => array(
			'none'      => esc_html__( 'None', 'emoza-woocommerce' ),
			'dot'       => '&middot;',
			'vertical'  => '&#124;',
			'horizontal'=> '&#x23AF;',
		),
		'priority'          => 40,
	)
) );

$wp_customize->add_setting( 'topbar_visibility', array(
	'sanitize_callback' => 'emoza_sanitize_select',
	'default'           => 'desktop-only',
) );

$wp_customize->add_control( 'topbar_visibility', array(
	'type'      => 'select',
	'section'   => 'emoza_section_top_bar',
	'label'     => esc_html__( 'Visibility', 'emoza-woocommerce' ),
	'choices' => array(
		'all'           => esc_html__( 'Show on all devices', 'emoza-woocommerce' ),
		'desktop-only'  => esc_html__( 'Desktop only', 'emoza-woocommerce' ),
		'mobile-only'   => esc_html__( 'Mobile/tablet only', 'emoza-woocommerce' ),
	),
	'priority'          => 50,
) );

$wp_customize->add_setting( 'topbar_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_1',
		array(
			'section'       => 'emoza_section_top_bar',
			'priority'      => 60,
		)
	)
);

$wp_customize->add_setting( 'topbar_elements_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'topbar_elements_title',
		array(
			'label'         => esc_html__( 'Elements', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_top_bar',
			'priority'      => 70,
		)
	)
);

$emoza_topbar_components  = emoza_topbar_elements();
$emoza_default_components = emoza_get_default_topbar_components();

//Left
$wp_customize->add_setting( 'topbar_components_left', array(
	'default'           => $emoza_default_components['left'],
	'sanitize_callback' => 'emoza_sanitize_topbar_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'topbar_components_left', array(
	'label'             => esc_html__( 'Left side', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_top_bar',
	'choices'           => $emoza_topbar_components,
	'priority'          => 80,
) ) );

//Right
$wp_customize->add_setting( 'topbar_components_right', array(
	'default'           => $emoza_default_components['right'],
	'sanitize_callback' => 'emoza_sanitize_topbar_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'topbar_components_right', array(
	'label'             => esc_html__( 'Right side', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_top_bar',
	'choices'           => $emoza_topbar_components,
	'priority'          => 90,
) ) );

$wp_customize->add_setting(
	'center_top_bar_contents',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'center_top_bar_contents',
		array(
			'label'             => esc_html__( 'Center the content?', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => 'emoza_callback_topbar_center_contents',
			'priority'          => 100,
		)
	)
);

//Contact info
$wp_customize->add_setting( 'topbar_divider_2',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_2',
		array(
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'contact_info' ); },
			'priority'          => 110,
		)
	)
);

$wp_customize->add_setting( 'topbar_contact_info_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'topbar_contact_info_title',
		array(
			'label'             => esc_html__( 'Contact info', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'contact_info' ); },
			'priority'          => 120,
		)
	)
);

$wp_customize->add_setting(
	'topbar_contact_mail',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( 'office@example.org', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'topbar_contact_mail', array(
	'label'       => esc_html__( 'Email address', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_top_bar',
	'active_callback'   => function() { return emoza_callback_topbar_elements( 'contact_info' ); },
	'priority'          => 130,
) );

$wp_customize->add_setting(
	'topbar_contact_phone',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( '111222333', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'topbar_contact_phone', array(
	'label'       => esc_html__( 'Phone number', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_top_bar',
	'active_callback'   => function() { return emoza_callback_topbar_elements( 'contact_info' ); },
	'priority'          => 140,
) );


//Social
$wp_customize->add_setting( 'topbar_divider_3',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_3',
		array(
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'social' ); },
			'priority'          => 150,
		)
	)
);

$wp_customize->add_setting( 'topbar_social_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'topbar_social_title',
		array(
			'label'             => esc_html__( 'Social', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'social' ); },
			'priority'          => 160,
		)
	)
);

$wp_customize->add_setting( 'social_profiles_topbar',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_urls',
	)
);
$wp_customize->add_control( new Emoza_Repeater_Control( $wp_customize, 'social_profiles_topbar',
	array(
		'label'         => esc_html__( 'Social profile', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_top_bar',
		'button_labels' => array(
			'add' => esc_html__( 'Add new', 'emoza-woocommerce' ),
		),
		'active_callback'   => function() { return emoza_callback_topbar_elements( 'social' ); },
		'priority'          => 170,
	)
) );

//text
$wp_customize->add_setting( 'topbar_divider_4',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_4',
		array(
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'text' ); },
			'priority'          => 180,
		)
	)
);

$wp_customize->add_setting( 'topbar_text_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'topbar_text_title',
		array(
			'label'             => esc_html__( 'Text', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'text' ); },
			'priority'          => 190,
		)
	)
);

$wp_customize->add_setting(
	'topbar_text',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( 'Your text here', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'topbar_text', array(
	'label'       => '',
	'type'        => 'text',
	'section'     => 'emoza_section_top_bar',
	'active_callback'   => function() { return emoza_callback_topbar_elements( 'text' ); },
	'priority'          => 200,
) );

//nav
$wp_customize->add_setting( 'topbar_divider_5',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_5',
		array(
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'secondary_nav' ); },
			'priority'          => 210,
		)
	)
);

$wp_customize->add_setting( 'topbar_nav_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'topbar_nav_title',
		array(
			'label'             => esc_html__( 'Secondary menu', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'secondary_nav' ); },
			'priority'          => 220,
		)
	)
);

$wp_customize->add_setting( 'topbar_nav_link',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'topbar_nav_link',
		array(
			'description'   => '<a class="emoza-to-widget-area-link" href="javascript:wp.customize.panel( \'nav_menus\' ).focus();">' . esc_html__( 'Configure menu', 'emoza-woocommerce' ) . '<span class="dashicons dashicons-arrow-right-alt2"></span></a>',
			'section'       => 'emoza_section_top_bar',
			'active_callback'   => function() { return emoza_callback_topbar_elements( 'secondary_nav' ); },
			'priority'          => 230,
		)
	)
);

/**
 * Styling
 */
$wp_customize->add_setting(
	'topbar_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'topbar_background',
		array(
			'label'             => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'priority'          => 240,
		)
	)
);

$wp_customize->add_setting(
	'topbar_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'topbar_color',
		array(
			'label'             => esc_html__( 'Text color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'priority'          => 250,
		)
	)
);

$wp_customize->add_setting(
	'topbar_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'topbar_color_hover',
		array(
			'label'             => esc_html__( 'Text color hover', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'priority'          => 250,
		)
	)
);

$wp_customize->add_setting(
	'topbar_submenu_background_color',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'topbar_submenu_background_color',
		array(
			'label'             => esc_html__( 'Submenu background', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'priority'          => 250,
		)
	)
);

$wp_customize->add_setting( 'topbar_divider_6',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_6',
		array(
			'section'           => 'emoza_section_top_bar',
			'priority'          => 260,
		)
	)
);

$wp_customize->add_setting( 'topbar_padding', array(
	'default'           => 15,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'topbar_padding',
	array(
		'label'         => esc_html__( 'Top &amp; bottom padding', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_top_bar',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'topbar_padding',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'priority'      => 270,
	)
) );

$wp_customize->add_setting( 'topbar_divider_7',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'topbar_divider_7',
		array(
			'section'           => 'emoza_section_top_bar',
			'priority'          => 280,
		)
	)
);

$wp_customize->add_setting( 'topbar_divider_size', array(
	'sanitize_callback' => 'absint',
	'default'           => 1,
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'topbar_divider_size', array(
	'type'              => 'number',
	'section'           => 'emoza_section_top_bar',
	'label'             => esc_html__( 'Border size', 'emoza-woocommerce' ),
	'priority'          => 290,
) );

$wp_customize->add_setting(
	'topbar_divider_color',
	array(
		'default'           => 'rgba(33,33,33,0.1)',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'topbar_divider_color',
		array(
			'label'             => esc_html__( 'Border color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_top_bar',
			'priority'          => 300,
		)
	)
);

$wp_customize->add_setting( 'topbar_divider_width',
	array(
		'default'           => 'fullwidth',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'topbar_divider_width',
	array(
		'label'     => esc_html__( 'Border width', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_top_bar',
		'choices'   => array(
			'contained'     => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'fullwidth'     => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'priority'          => 310,
	)
) );