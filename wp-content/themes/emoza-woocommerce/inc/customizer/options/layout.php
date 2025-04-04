<?php
/**
 * Layout Customizer options
 *
 * @package Emoza
 */

/**
 * Layout
 */
$wp_customize->add_section(
	'emoza_section_layout',
	array(
		'title'       => esc_html__( 'Layout', 'emoza-woocommerce'),
		'description' => esc_html__( 'Manage the overall layout of the website.', 'emoza-woocommerce'),
		'priority'    => 55,
	)
);


$wp_customize->add_setting( 'site_layout',
	array(
		'default'           => 'default',
		'sanitize_callback' => 'sanitize_key',
	)
);

$wp_customize->add_control(
	new Emoza_Radio_Images(
		$wp_customize,
		'site_layout',
		array(
			'label'     => esc_html__( 'Site Layout', 'emoza-woocommerce' ),
			'section'   => 'emoza_section_layout',
			'cols'      => 2,
			'choices'   => array(
				'default' => array(
					'label' => esc_html__( 'Default', 'emoza-woocommerce' ),
					'url'   => '%s/assets/img/site-layout-default.svg',
				),
				'boxed' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Boxed', 'emoza-woocommerce' ),
					'url'    => '%s/assets/img/site-layout-boxed.svg',
				),
				'padded' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Padded', 'emoza-woocommerce' ),
					'url'    => '%s/assets/img/site-layout-padded.svg',
				),
				'fluid' => array(
					'is_pro' => true,
					'label'  => esc_html__( 'Fluid', 'emoza-woocommerce' ),
					'url'    => '%s/assets/img/site-layout-fluid.svg',
				),
			),
			'priority'  => 20,
		)
	)
); 

$wp_customize->add_setting( 'content_max_width', array(
	'default' => 1140,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'content_max_width',
	array(
		'label'           => esc_html__( 'Content Width', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_layout',
		'active_callback' => 'emoza_callback_site_layout_default_boxed_padded',
		'is_responsive'   => 0,
		'settings'        => array(
			'size_desktop'  => 'content_max_width',
		),
		'input_attrs' => array(
			'min'   => 768,
			'max'   => 2000,
		),
		'priority' => 30,
	)
) );

$wp_customize->add_setting( 'boxed_max_width', array(
	'default' => 1000,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'boxed_max_width',
	array(
		'label'           => esc_html__( 'Boxed Layout Width', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_layout',
		'active_callback' => 'emoza_callback_site_layout_boxed',
		'is_responsive'   => 0,
		'settings'        => array(
			'size_desktop'  => 'boxed_max_width',
		),
		'input_attrs' => array(
			'min'   => 768,
			'max'   => 2000,
		),
		'priority' => 30,
	)
) );

$wp_customize->add_setting( 'padded_layout_spacing_desktop', array(
	'default'           => 20,
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_setting( 'padded_layout_spacing_tablet', array(
	'default'           => 10,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'padded_layout_spacing_mobile', array(
	'default'           => 10,
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'padded_layout_spacing',
	array(
		'label'           => esc_html__( 'Padded Layout Spacing', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_layout',
		'active_callback' => 'emoza_callback_site_layout_padded',
		'is_responsive'   => 1,
		'settings'        => array(
			'size_desktop'  => 'padded_layout_spacing_desktop',
			'size_tablet'   => 'padded_layout_spacing_tablet',
			'size_mobile'   => 'padded_layout_spacing_mobile',
		),
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
		),
		'priority' => 30,
	)
) );

$wp_customize->add_setting( 'fluid_layout_spacing_desktop', array(
	'default'           => 15,
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_setting( 'fluid_layout_spacing_tablet', array(
	'default'           => 15,
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'fluid_layout_spacing_mobile', array(
	'default'           => 15,
	'sanitize_callback' => 'absint',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'fluid_layout_spacing',
	array(
		'label'           => esc_html__( 'Fluid Layout Spacing', 'emoza-woocommerce' ),
		'section'         => 'emoza_section_layout',
		'active_callback' => 'emoza_callback_site_layout_fluid',
		'is_responsive'   => 1,
		'settings'        => array(
			'size_desktop'  => 'fluid_layout_spacing_desktop',
			'size_tablet'   => 'fluid_layout_spacing_tablet',
			'size_mobile'   => 'fluid_layout_spacing_mobile',
		),
		'input_attrs' => array(
			'min' => 0,
			'max' => 100,
		),
		'priority' => 30,
	)
) );
