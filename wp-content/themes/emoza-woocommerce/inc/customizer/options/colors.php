<?php
/**
 * Colors Customizer options
 *
 * @package Emoza
 */


$emoza_palettes = emoza_global_color_palettes();

$wp_customize->add_setting( 'color_palettes', array(
	'default'           => 'palette1',
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_select',
));     

$wp_customize->add_control( new Emoza_Color_Palettes_Control($wp_customize, 'color_palettes', array(
	'label'         => esc_html__( 'Color palettes', 'emoza-woocommerce' ),
	'section'       => 'colors',
	'choices'       => $emoza_palettes,
	'priority'      => -1,
)));

$wp_customize->add_setting(
	'custom_palette_toggle',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_checkbox',
	)
);
$wp_customize->add_control(
	new Emoza_Toggle_Control(
		$wp_customize,
		'custom_palette_toggle',
		array(
			'label'             => esc_html__( 'Create your own palette', 'emoza-woocommerce' ),
			'section'           => 'colors',
			'priority'  => 0,
		)
	)
);

for ( $emoza_i = 0; $emoza_i < 8; $emoza_i++ ) { 
	$wp_customize->add_setting( 'custom_color' . ( $emoza_i + 1 ), array(
		'default'           => $emoza_palettes['palette1'][$emoza_i],
		'transport'         => 'postMessage',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
	));
}

$wp_customize->add_control( new Emoza_Custom_Palettes_Control( $wp_customize, 'custom_palette', array(
	'label'     => esc_html__( 'Choose the colors for your palette:', 'emoza-woocommerce' ),
	'section' => 'colors',
	'settings'  => array(
		'custom_color1' => 'custom_color1',
		'custom_color2' => 'custom_color2',
		'custom_color3' => 'custom_color3',
		'custom_color4' => 'custom_color4',
		'custom_color5' => 'custom_color5',
		'custom_color6' => 'custom_color6',
		'custom_color7' => 'custom_color7',
		'custom_color8' => 'custom_color8',
	),
	'priority'  => 0,
	'active_callback'   => 'emoza_callback_custom_palette',
)));

//General
$wp_customize->add_setting( 'general_color_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'general_color_title',
		array(
			'label'         => esc_html__( 'General', 'emoza-woocommerce' ),
			'section'       => 'colors',
			'priority'          => 9,
		)
	)
);

$wp_customize->add_setting(
	'background_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'esc_attr',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'background_color',
		array(
			'label'   => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section' => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_body_text',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_body_text',
		array(
			'label'             => esc_html__( 'Body text', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'content_cards_background',
	array(
		'default'           => '#f2f2f2',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'content_cards_background',
		array(
			'label'             => esc_html__( 'Content cards background', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'content_background_color',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'content_background_color',
		array(
			'label'   => esc_html__( 'Content Background Color', 'emoza-woocommerce' ),
			'section' => 'colors',
			'active_callback' => 'emoza_callback_site_layout_boxed_padded',
		)
	)
);


//Links
$wp_customize->add_setting( 'links_color_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'links_color_title',
		array(
			'label'         => esc_html__( 'Links', 'emoza-woocommerce' ),
			'section'       => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_link_default',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);

$wp_customize->add_setting(
	'color_link_hover',
	array(
		'default'           => '#757575',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Color_Group(
		$wp_customize,
		'color_link',
		array(
			'label'    => esc_html__( 'Link Color', 'emoza-woocommerce' ),
			'section'  => 'colors',
			'settings' => array(
				'normal' => 'color_link_default',
				'hover'  => 'color_link_hover',
			),
		)
	)
);

//Headings
$wp_customize->add_setting( 'headings_color_title',
	array(
		'default'       => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'headings_color_title',
		array(
			'label'         => esc_html__( 'Headings', 'emoza-woocommerce' ),
			'section'       => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_heading_1',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_heading_1',
		array(
			'label'             => esc_html__( 'Heading 1', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading_2',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_heading_2',
		array(
			'label'             => esc_html__( 'Heading 2', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading_3',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_heading_3',
		array(
			'label'             => esc_html__( 'Heading 3', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading_4',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_heading_4',
		array(
			'label'             => esc_html__( 'Heading 4', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading_5',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_heading_5',
		array(
			'label'             => esc_html__( 'Heading 5', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);
$wp_customize->add_setting(
	'color_heading_6',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_heading_6',
		array(
			'label'             => esc_html__( 'Heading 6', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

//Forms
$wp_customize->add_setting( 'forms_color_title',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);

$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'forms_color_title',
		array(
			'label'         => esc_html__( 'Form fields', 'emoza-woocommerce' ),
			'section'       => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_forms_text',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_forms_text',
		array(
			'label'             => esc_html__( 'Text color', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_forms_background',
	array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_forms_background',
		array(
			'label'             => esc_html__( 'Background color', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_forms_borders',
	array(
		'default'           => '#212121',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_forms_borders',
		array(
			'label'             => esc_html__( 'Border color', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_forms_dividers',
	array(
		'default'           => '#dddddd',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_forms_dividers',
		array(
			'label'             => esc_html__( 'Divider color', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

$wp_customize->add_setting(
	'color_forms_placeholder',
	array(
		'default'           => '#848484',
		'sanitize_callback' => 'emoza_sanitize_hex_rgba',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control(
	new Emoza_Alpha_Color(
		$wp_customize,
		'color_forms_placeholder',
		array(
			'label'             => esc_html__( 'Placeholder color', 'emoza-woocommerce' ),
			'section'           => 'colors',
		)
	)
);

//Reset
$wp_customize->add_setting( 'reset_colors',
	array(
		'default'           => '',
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Emoza_Text_Control( $wp_customize, 'reset_colors',
		array(
			'label'   => esc_html__( 'Reset Styles to Defaults', 'emoza-woocommerce' ),
			'section' => 'colors',
		)
	)
);