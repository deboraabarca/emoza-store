<?php
/**
 * Header Customizer options
 *
 * @package Emoza
 */

/**
 * Header image
 */
$wp_customize->add_panel(
	'emoza_panel_header',
	array(
		'title'       => esc_html__( 'Header', 'emoza-woocommerce' ),
		'description' => esc_html__( 'Build your own header or choose from layout options.', 'emoza-woocommerce' ),
		'priority'    => 15,
	)
);

/**
 * Header image
 */

// Header image section description
$wp_customize->get_section( 'header_image' )->description = esc_html__( 'A prominent image at the top of the page that\'s useful to highlight any information.', 'emoza-woocommerce' );

// Header Image Display Conditions
$wp_customize->add_setting(
    'header_image_display_conditions',
    array(
        'default'           => '[{"type":"include","condition":"all","id":null}]',
        'sanitize_callback' => 'sanitize_textarea_field',
    )
);
$wp_customize->add_control(
    new Emoza_Display_Conditions_Control(
        $wp_customize,
        'header_image_display_conditions',
        array(
            'label'           => esc_html__( 'Header Image Display Conditions', 'emoza-woocommerce' ),
            'section'         => 'header_image',
        )
    )
);

/**
 * Site identity
 */
$wp_customize->add_setting( 'site_logo_size_desktop', array(
	'default'           => 180,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_setting( 'site_logo_size_tablet', array(
	'default'           => 100,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'site_logo_size_mobile', array(
	'default'           => 100,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            


$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'site_logo_size',
	array(
		'label'         => esc_html__( 'Logo width', 'emoza-woocommerce' ),
		'section'       => 'title_tagline',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'site_logo_size_desktop',
			'size_tablet'       => 'site_logo_size_tablet',
			'size_mobile'       => 'site_logo_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 500,
		),       
	)
) );


$wp_customize->add_setting(
	'site_title_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'site_title_color',
		array(
			'label'             => esc_html__( 'Site title color', 'emoza-woocommerce' ),
			'section'           => 'title_tagline',
		)
	)
);

$wp_customize->add_setting(
	'site_description_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'site_description_color',
		array(
			'label'             => esc_html__( 'Site description color', 'emoza-woocommerce' ),
			'section'           => 'title_tagline',
		)
	)
);

/**
 * Main header
 */
$wp_customize->add_section(
	'emoza_section_main_header',
	array(
		'title'      => esc_html__( 'Main header', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_header',
	)
);

$wp_customize->add_setting(
	'emoza_main_header_tabs',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control(
	new Emoza_Tab_Control (
		$wp_customize,
		'emoza_main_header_tabs',
		array(
			'label'                 => '',
			'section'               => 'emoza_section_main_header',
			'controls_general'      => wp_json_encode( array( '#customize-control-header_layout_desktop', '#customize-control-header_transparent', '#customize-control-topbar_transparent', '#customize-control-header_transparent_display_rules_title', '#customize-control-header_transparent_display_on', '#customize-control-header_divider_1', '#customize-control-main_header_settings_title', '#customize-control-main_header_menu_position', '#customize-control-header_container', '#customize-control-enable_sticky_header', '#customize-control-sticky_header_type', '#customize-control-sitcky_header_logo', '#customize-control-header_divider_2', '#customize-control-main_header_elements_title', '#customize-control-header_components_l1', '#customize-control-header_components_l3left', '#customize-control-header_components_l3right', '#customize-control-header_components_l4top', '#customize-control-header_components_l4bottom', '#customize-control-header_components_l5topleft', '#customize-control-header_components_l5topright', '#customize-control-header_components_l5bottom', '#customize-control-header_divider_3', '#customize-control-main_header_cart_account_title', '#customize-control-enable_header_cart', '#customize-control-enable_header_account', '#customize-control-header_html_content_title', '#customize-control-header_html_content', '#customize-control-header_divider_4', '#customize-control-main_header_button_title', '#customize-control-header_button_text', '#customize-control-header_button_link', '#customize-control-header_button_class', '#customize-control-header_button_newtab', '#customize-control-header_divider_5', '#customize-control-main_header_contact_info_title', '#customize-control-header_contact_mail', '#customize-control-header_contact_phone' ) ),
			'controls_design'       => wp_json_encode( array( '#customize-control-main_header_submenu', '#customize-control-main_header_divider_10', '#customize-control-main_header_minicart_count_background_color', '#customize-control-main_header_minicart_count_text_color', '#customize-control-main_header_submenu_background', '#customize-control-main_header_bottom_padding', '#customize-control-main_header_bottom_background', '#customize-control-main_header_bottom_color', '#customize-control-main_header_bottom_color_hover', '#customize-control-main_header_divider_9', '#customize-control-main_header_divider_7', '#customize-control-main_header_background', '#customize-control-main_header', '#customize-control-main_header_divider_11', '#customize-control-main_header_divider_6', '#customize-control-main_header_padding', '#customize-control-main_header_divider_size', '#customize-control-main_header_divider_color', '#customize-control-main_header_divider_width', '#customize-control-main_header_sticky_active_title_1', '#customize-control-main_header_sticky_active_background', '#customize-control-main_header_sticky_active', '#customize-control-main_header_sticky_active_submenu_background_color', '#customize-control-main_header_sticky_active_submenu_color', '#customize-control-main_header_sticky_active_submenu_color_hover' ) ),
		)
	)
);

//Layout
$choices = emoza_header_layouts(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$wp_customize->add_setting(
	'header_layout_desktop',
	array(
		'default'           => 'header_layout_1',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'header_layout_desktop',
		array(
			'label'     => esc_html__( 'Layout', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_main_header',
			'cols'      => 2,
			'choices'   => $choices,
			'priority'  => 20,
		)
	)
);

$wp_customize->add_setting(
	'enable_sticky_header',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'enable_sticky_header',
		array(
			'label'             => esc_html__( 'Enable sticky header', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => 'emoza_callback_header_layout_not_6',
			'priority'          => 21,
		)
	)
);

$wp_customize->add_setting( 'sticky_header_type',
	array(
		'default'           => 'always',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'sticky_header_type',
	array(
		'label'         => esc_html__( 'Sticky header type', 'emoza-woocommerce' ),
		'section' => 'emoza_section_main_header',
		'choices' => array(
			'always'        => esc_html__( 'Always Sticky', 'emoza-woocommerce' ),
			'scrolltop'     => esc_html__( 'Scroll Back', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_callback_sticky_header',
		'priority'        => 21,
	)
) );

$wp_customize->add_setting( 
	'sitcky_header_logo',
	array(
		'default'           => '',
		'sanitize_callback' => 'absint',
	) 
);
$wp_customize->add_control( 
	new WP_Customize_Media_Control( 
		$wp_customize, 
		'sitcky_header_logo',
		array(
			'label'           => __( 'Sticky Header Logo', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_main_header',
			'mime_type'       => 'image',
			'active_callback' => 'emoza_callback_sticky_header_logo',
			'priority'        => 21,
		)
	)
);

$wp_customize->add_setting(
	'header_transparent',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'header_transparent',
		array(
			'label'             => esc_html__( 'Enable transparent header', 'emoza-woocommerce' ),
			'description'       => esc_html__( 'The header stays over the content. You need to manually change the background color from header to be transparent.', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'priority'          => 21,
		)
	)
);

$wp_customize->add_setting(
	'topbar_transparent',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'topbar_transparent',
		array(
			'label'             => esc_html__( 'Enable transparent top bar', 'emoza-woocommerce' ),
			'description'       => esc_html__( 'The top bar stays over the content. You need manually change the background color from top bar to be transparent.', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => 'emoza_header_transparent_enabled',
			'priority'          => 21,
		)
	)
);

// Header Transparent Display Conditions
$wp_customize->add_setting(
    'header_transparent_display_on',
    array(
        'default'           => '[]',
        'sanitize_callback' => 'sanitize_textarea_field',
    )
);
$wp_customize->add_control(
    new Emoza_Display_Conditions_Control(
        $wp_customize,
        'header_transparent_display_on',
        array(
            'label'           => esc_html__( 'Header Transparent Display Conditions', 'emoza-woocommerce' ),
            'section'         => 'emoza_section_main_header',
			'active_callback' => 'emoza_header_transparent_enabled',
            'priority'        => 22,
        )
    )
);

$wp_customize->add_setting( 'header_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'header_divider_1',
		array(
			'section'       => 'emoza_section_main_header',
			'priority'      => 30,
		)
	)
);

//General
$wp_customize->add_setting( 'main_header_settings_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'main_header_settings_title',
		array(
			'label'         => esc_html__( 'Settings', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_main_header',
			'priority'      => 40,
		)
	)
);

$wp_customize->add_setting( 'main_header_menu_position',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'main_header_menu_position',
	array(
		'label'         => esc_html__( 'Menu position', 'emoza-woocommerce' ),
		'section' => 'emoza_section_main_header',
		'choices' => array(
			'left'      => esc_html__( 'Left', 'emoza-woocommerce' ),
			'center'    => esc_html__( 'Center', 'emoza-woocommerce' ),
			'right'     => esc_html__( 'Right', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_callback_header_layout_not_1',
		'priority'        => 50,
	)
) );

$wp_customize->add_setting( 'header_container',
	array(
		'default'           => 'container-fluid',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'header_container',
	array(
		'label'         => esc_html__( 'Container type', 'emoza-woocommerce' ),
		'section' => 'emoza_section_main_header',
		'choices' => array(
			'container'         => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'container-fluid'   => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_callback_header_layout_not_6',
		'priority'        => 60,
	)
) );

$wp_customize->add_setting( 'header_divider_2',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'header_divider_2',
		array(
			'section'       => 'emoza_section_main_header',
			'priority'      => 90,
		)
	)
);

$wp_customize->add_setting( 'main_header_elements_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'main_header_elements_title',
		array(
			'label'         => esc_html__( 'Elements', 'emoza-woocommerce' ),
			'section'       => 'emoza_section_main_header',
			'priority'      => 100,
		)
	)
);

$header_components  = emoza_header_elements(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$default_components = emoza_get_default_header_components(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

//Layout 1&2 elements
$wp_customize->add_setting( 'header_components_l1', array(
	'default'           => $default_components['l1'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l1', array(
	'label'             => '',
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_1_2',
	'priority'          => 110,
) ) );

//Layout 3 elements
$wp_customize->add_setting( 'header_components_l3left', array(
	'default'           => $default_components['l3left'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l3left', array(
	'label'             => esc_html__( 'Left', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_3',
	'priority'          => 120,
) ) );

$wp_customize->add_setting( 'header_components_l3right', array(
	'default'           => $default_components['l3right'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l3right', array(
	'label'             => esc_html__( 'Right', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_3',
	'priority'          => 130,
) ) );

//Layout 4 elements
$wp_customize->add_setting( 'header_components_l4top', array(
	'default'           => $default_components['l4top'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l4top', array(
	'label'             => esc_html__( 'Top row', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_4',
	'priority'          => 140,
) ) );

$wp_customize->add_setting( 'header_components_l4bottom', array(
	'default'           => $default_components['l4bottom'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l4bottom', array(
	'label'             => esc_html__( 'Bottom row', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_4',
	'priority'          => 150,
) ) );

//Layout 5 elements
$wp_customize->add_setting( 'header_components_l5topleft', array(
	'default'           => $default_components['l5topleft'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l5topleft', array(
	'label'             => esc_html__( 'Top left', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_5',
	'priority'          => 160,
) ) );

$wp_customize->add_setting( 'header_components_l5topright', array(
	'default'           => $default_components['l5topleft'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l5topright', array(
	'label'             => esc_html__( 'Top right', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_5',
	'priority'          => 170,
) ) );

$wp_customize->add_setting( 'header_components_l5bottom', array(
	'default'           => $default_components['l5topleft'],
	'sanitize_callback' => 'emoza_sanitize_header_components',
) );

$wp_customize->add_control( new \Kirki\Control\Sortable( $wp_customize, 'header_components_l5bottom', array(
	'label'             => esc_html__( 'Bottom', 'emoza-woocommerce' ),
	'section'           => 'emoza_section_main_header',
	'choices'           => $header_components,
	'active_callback'   => 'emoza_callback_header_layout_5',
	'priority'          => 180,
) ) );

/**
 * Elements
 */
//Cart&account icons
$wp_customize->add_setting( 'header_divider_3',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'header_divider_3',
		array(
			'section'       => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'woocommerce_icons' ); },
			'priority'          => 190,
		)
	)
);

$wp_customize->add_setting( 'main_header_cart_account_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'main_header_cart_account_title',
		array(
			'label'             => esc_html__( 'Cart &amp; account icons', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'woocommerce_icons' ); },
			'priority'          => 200,
		)
	)
);

$wp_customize->add_setting(
	'enable_header_cart',
	array(
		'default'           => 1,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'enable_header_cart',
		array(
			'label'             => esc_html__( 'Enable cart icon', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'woocommerce_icons' ); },
			'priority'          => 210,
		)
	)
);

$wp_customize->add_setting(
	'enable_header_account',
	array(
		'default'           => 1,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'enable_header_account',
		array(
			'label'             => esc_html__( 'Enable account icon', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'woocommerce_icons' ); },
			'priority'          => 220,
		)
	)
);

// HTML field content title
$wp_customize->add_setting( 
	'header_html_content_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( 
	new Emoza_Text_Control( 
		$wp_customize, 
		'header_html_content_title',
		array(
			'label'           => esc_html__( 'HTML Content', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_main_header',
			'active_callback' => function() { return emoza_callback_header_elements( 'html' ); },
			'priority'        => 221,
		)
	)
);

// HTML field content
$wp_customize->add_setting(
	'header_html_content',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => '',
	)       
);
$wp_customize->add_control( 
	'header_html_content', 
	array(
		'label'           => '',
		'type'            => 'textarea',
		'section'         => 'emoza_section_main_header',
		'active_callback' => function() { return emoza_callback_header_elements( 'html' ); },
		'priority'        => 221,
	) 
);

//Button
$wp_customize->add_setting( 'header_divider_4',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'header_divider_4',
		array(
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'button' ); },
			'priority'          => 230,
		)
	)
);

$wp_customize->add_setting( 'main_header_button_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'main_header_button_title',
		array(
			'label'             => esc_html__( 'Button', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'button' ); },
			'priority'          => 240,
		)
	)
);

$wp_customize->add_setting(
	'header_button_text',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( 'Click me', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'header_button_text', array(
	'label'       => esc_html__( 'Button text', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_main_header',
	'active_callback'   => function() { return emoza_callback_header_elements( 'button' ); },
	'priority'          => 250,
) );

$wp_customize->add_setting(
	'header_button_link',
	array(
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '#',
	)       
);
$wp_customize->add_control( 'header_button_link', array(
	'label'       => esc_html__( 'Button link', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_main_header',
	'active_callback'   => function() { return emoza_callback_header_elements( 'button' ); },
	'priority'          => 260,
) );

$wp_customize->add_setting(
	'header_button_class',
	array(
		'sanitize_callback' => 'esc_attr',
		'default'           => '',
	)       
);
$wp_customize->add_control( 'header_button_class', array(
	'label'       => esc_html__( 'Button Class', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_main_header',
	'active_callback'   => function() { return emoza_callback_header_elements( 'button' ); },
	'priority'          => 260,
) );

$wp_customize->add_setting(
	'header_button_newtab',
	array(
		'default'           => 0,
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'header_button_newtab',
		array(
			'label'             => esc_html__( 'Open in a new tab?', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'button' ); },
			'priority'          => 270,
		)
	)
);

//Contact info
$wp_customize->add_setting( 'header_divider_5',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'header_divider_5',
		array(
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'contact_info' ); },
			'priority'          => 280,
		)
	)
);

$wp_customize->add_setting( 'main_header_contact_info_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'main_header_contact_info_title',
		array(
			'label'             => esc_html__( 'Contact info', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => function() { return emoza_callback_header_elements( 'contact_info' ); },
			'priority'          => 290,
		)
	)
);

$wp_customize->add_setting(
	'header_contact_mail',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( 'office@example.org', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'header_contact_mail', array(
	'label'       => esc_html__( 'Email address', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_main_header',
	'active_callback'   => function() { return emoza_callback_header_elements( 'contact_info' ); },
	'priority'          => 300,
) );

$wp_customize->add_setting(
	'header_contact_phone',
	array(
		'sanitize_callback' => 'emoza_sanitize_text',
		'default'           => esc_html__( '111222333', 'emoza-woocommerce' ),
	)       
);
$wp_customize->add_control( 'header_contact_phone', array(
	'label'       => esc_html__( 'Phone number', 'emoza-woocommerce' ),
	'type'        => 'text',
	'section'     => 'emoza_section_main_header',
	'active_callback'   => function() { return emoza_callback_header_elements( 'contact_info' ); },
	'priority'          => 310,
) );

/**
 * Styling
 */
$wp_customize->add_setting(
	'main_header_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_background',
		array(
			'label'             => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'priority'          => 320,
		)
	)
);

$wp_customize->add_setting(
	'main_header_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'main_header_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'main_header',
		array(
			'label'    => esc_html__( 'Text Color', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_main_header',
			'settings' => array(
				'normal' => 'main_header_color',
				'hover'  => 'main_header_color_hover',
			),
			'priority' => 330,
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_11',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'main_header_divider_11',
		array(
			'section'           => 'emoza_section_main_header',
			'priority'          => 331,
		)
	)
);

$wp_customize->add_setting(
	'main_header_bottom_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_bottom_background',
		array(
			'label'             => esc_html__( 'Bottom row background color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
            'active_callback'   => 'emoza_callback_header_bottom',
			'priority'          => 340,
		)
	)
);

$wp_customize->add_setting(
	'main_header_bottom_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_bottom_color',
		array(
			'label'             => esc_html__( 'Bottom row text color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
            'active_callback'   => 'emoza_callback_header_bottom',
			'priority'          => 350,
		)
	)
);

$wp_customize->add_setting(
	'main_header_bottom_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_bottom_color_hover',
		array(
			'label'             => esc_html__( 'Bottom row text color hover', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
            'active_callback'   => 'emoza_callback_header_bottom',
			'priority'          => 350,
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_9',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'main_header_divider_9',
		array(
			'section'           => 'emoza_section_main_header',
			'active_callback'   => 'emoza_callback_header_bottom',
			'priority'          => 351,
		)
	)
);

$wp_customize->add_setting(
	'main_header_submenu_background',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_submenu_background',
		array(
			'label'             => esc_html__( 'Submenu background', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'priority'          => 360,
		)
	)
);

$wp_customize->add_setting(
	'main_header_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'main_header_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'main_header_submenu',
		array(
			'label'    => esc_html__( 'Submenu Color', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_main_header',
			'settings' => array(
				'normal' => 'main_header_submenu_color',
				'hover'  => 'main_header_submenu_color_hover',
			),
			'priority' => 370,
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_10',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'main_header_divider_10',
		array(
			'section'           => 'emoza_section_main_header',
			'priority'          => 371,
		)
	)
);

$wp_customize->add_setting(
	'main_header_minicart_count_background_color',
	array(
		'default'           => '#ff5858',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_minicart_count_background_color',
		array(
			'label'             => esc_html__( 'Mini Cart Background Color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'priority'          => 371,
		)
	)
);

$wp_customize->add_setting(
	'main_header_minicart_count_text_color',
	array(
		'default'           => '#FFF',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_minicart_count_text_color',
		array(
			'label'             => esc_html__( 'Mini Cart Text Color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'priority'          => 371,
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_6',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'main_header_divider_6',
		array(
			'section'           => 'emoza_section_main_header',
			'priority'          => 380,
		)
	)
);

$wp_customize->add_setting( 'main_header_padding', array(
	'default'           => 15,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'main_header_padding',
	array(
		'label'           => esc_html__( 'Padding', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_main_header',
		'is_responsive'   => 0,
		'settings'        => array(
			'size_desktop'      => 'main_header_padding',
		),
		'input_attrs'     => array(
			'min'   => 0,
			'max'   => 100,
		),
		'priority'        => 390,
	)
) );

$wp_customize->add_setting( 'main_header_bottom_padding', array(
	'default'           => 15,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'main_header_bottom_padding',
	array(
		'label'         => esc_html__( 'Bottom row padding', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_main_header',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'main_header_bottom_padding',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 100,
		),
		'active_callback'   => 'emoza_callback_header_bottom',
		'priority'          => 400,
	)
) );


$wp_customize->add_setting( 'main_header_divider_7',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'main_header_divider_7',
		array(
			'section'           => 'emoza_section_main_header',
			'active_callback'   => 'emoza_callback_header_layout_not_6_7_8',
			'priority'          => 410,
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_size', array(
	'sanitize_callback' => 'absint',
	'default'           => 0,
) );

$wp_customize->add_control( 'main_header_divider_size', array(
	'type'              => 'number',
	'section'           => 'emoza_section_main_header',
	'label'             => esc_html__( 'Border size', 'emoza-woocommerce' ),
	'active_callback' => 'emoza_callback_header_layout_not_6',
	'priority'          => 420,
) );

$wp_customize->add_setting(
	'main_header_divider_color',
	array(
		'default'           => 'rgba(33,33,33,0.1)',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_divider_color',
		array(
			'label'             => esc_html__( 'Border color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback' => 'emoza_callback_header_layout_not_6',
			'priority'          => 430,
		)
	)
);

$wp_customize->add_setting( 'main_header_divider_width',
	array(
		'default'           => 'fullwidth',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);
$wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'main_header_divider_width',
	array(
		'label'     => esc_html__( 'Border width', 'emoza-woocommerce' ),
		'section'   => 'emoza_section_main_header',
		'choices'   => array(
			'contained'     => esc_html__( 'Contained', 'emoza-woocommerce' ),
			'fullwidth'     => esc_html__( 'Full-width', 'emoza-woocommerce' ),
		),
		'active_callback' => 'emoza_callback_header_layout_not_6',
		'priority'          => 440,
	)
) );

$wp_customize->add_setting( 
	'main_header_sticky_active_title_1',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( 
	new Emoza_Text_Control( 
		$wp_customize, 
		'main_header_sticky_active_title_1',
		array(
			'label'           => esc_html__( 'Sticky Header Active State', 'emoza-woocommerce' ),
			'section'         => 'emoza_section_main_header',
			'active_callback' => 'emoza_callback_sticky_header',
			'priority'        => 440,
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_background',
	array(
		'default'           => '#fff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_background',
		array(
			'label'             => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => 'emoza_callback_sticky_header',
			'priority'          => 440,
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'main_header_sticky_active_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'main_header_sticky_active',
		array(
			'label'    => esc_html__( 'Text Color', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_main_header',
			'settings' => array(
				'normal' => 'main_header_sticky_active_color',
				'hover'  => 'main_header_sticky_active_color_hover',
			),
			'active_callback' => 'emoza_callback_sticky_header',
			'priority' => 440,
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_submenu_background_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'main_header_sticky_active_submenu_background_color',
		array(
			'label'             => esc_html__( 'Submenu Background', 'emoza-woocommerce' ),
			'section'           => 'emoza_section_main_header',
			'active_callback'   => 'emoza_callback_sticky_header',
			'priority'          => 560,
		)
	)
);

$wp_customize->add_setting(
	'main_header_sticky_active_submenu_color',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting(
	'main_header_sticky_active_submenu_color_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'main_header_sticky_active_submenu',
		array(
			'label'    => esc_html__( 'Submenu Text Color', 'emoza-woocommerce' ),
			'section'  => 'emoza_section_main_header',
			'settings' => array(
				'normal' => 'main_header_sticky_active_submenu_color',
				'hover'  => 'main_header_sticky_active_submenu_color_hover',
			),
			'active_callback' => 'emoza_callback_sticky_header',
			'priority' => 560,
		)
	)
);
