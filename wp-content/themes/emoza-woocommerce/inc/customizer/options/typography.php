<?php
/**
 * Typography Customizer options
 *
 * @package Emoza
 */
/**
 * Typography
 */
$wp_customize->add_panel(
	'emoza_panel_typography',
	array(
		'title'    => esc_html__( 'Typography', 'emoza-woocommerce' ),
		'priority' => 40,
		'description' => esc_html__( 'Manage the typography settings for different elements.', 'emoza-woocommerce' ),
	)
);

$wp_customize->add_section( new Emoza_Title_Section( $wp_customize, 'emoza_global_text_styles',
	array(
		'title'    => esc_html__( 'Global Text Styles', 'emoza-woocommerce' ),
		'panel'    => 'emoza_panel_typography',
		'priority' => 21,
	)
) );

/**
 * General
 */
$wp_customize->add_section(
	'emoza_section_typography_general',
	array(
		'panel'      => 'emoza_panel_typography',
		'title'      => esc_html__( 'Fonts Library', 'emoza-woocommerce'),
	)
);

$wp_customize->add_setting( 
	'fonts_library', 
	array(
		'sanitize_callback' => 'emoza_sanitize_select',
		'default'           => 'google',
	) 
);
$wp_customize->add_control( 
	'fonts_library', 
	array(
		'type'     => 'select',
		'section'  => 'emoza_section_typography_general',
		'label'    => esc_html__( 'Fonts Library', 'emoza-woocommerce' ),
		'choices'  => array(
			'google' => esc_html__( 'Google Fonts', 'emoza-woocommerce' ),
		),
	) 
);

/**
 * Header Menu
 */
$wp_customize->add_section(
	'emoza_section_typography_header_menu',
	array(
		'title'      => esc_html__( 'Header Menu', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_typography',
	)
);

// Header Menu Typography Preview
$wp_customize->add_setting( 
	'emoza_header_menu_typography_preview',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Emoza_Typography_Preview_Control( $wp_customize, 'emoza_header_menu_typography_preview',
	array(
		'section' => 'emoza_section_typography_header_menu',
		'options' => array(
			'google_font'     => 'emoza_header_menu_font',
			'adobe_font'      => 'emoza_header_menu_adobe_font',
			'custom_font'     => 'emoza_header_menu_custom_font',
			'font-style'      => 'header_menu_font_style',
			'line-height'     => 'header_menu_line_height',
			'letter-spacing'  => 'header_menu_letter_spacing',
			'text-transform'  => 'header_menu_text_transform',
			'text-decoration' => 'header_menu_text_decoration',
		),
	)
) );

$wp_customize->add_setting( 'emoza_header_menu_font',
	array(
		'default'           => get_theme_mod( 'emoza_body_font', '{"font":"System default","regularweight":"400","category":"sans-serif"}' ),
		'sanitize_callback' => 'emoza_google_fonts_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Control( $wp_customize, 'emoza_header_menu_font',
	array(
		'section' => 'emoza_section_typography_header_menu',
		'settings' => array(
			'family' => 'emoza_header_menu_font',
		),
		'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'emoza_font_library_google',
	)
) );

// Adobe Fonts
$wp_customize->add_setting( 'emoza_header_menu_adobe_font',
	array(
		'default'           => get_theme_mod( 'emoza_body_adobe_font', 'system-default|n4' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Adobe_Control( $wp_customize, 'emoza_header_menu_adobe_font',
	array(
		'section' => 'emoza_section_typography_header_menu',
		'active_callback' => 'emoza_font_library_adobe',
	)
) );

// Custom Fonts
$wp_customize->add_setting( 'emoza_header_menu_custom_font',
	array(
		'default'           => get_theme_mod( 'emoza_body_custom_font', '' ),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting( 'emoza_header_menu_custom_font_weight',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Custom_Control( $wp_customize, 'emoza_header_menu_custom_font_typography',
	array(
		'section' => 'emoza_section_typography_header_menu',
		'settings' => array(
			'font-family' => 'emoza_header_menu_custom_font',
			'font-weight' => 'emoza_header_menu_custom_font_weight',
		),
		'active_callback' => 'emoza_font_library_custom',
	)
) );

$wp_customize->add_setting( 'header_menu_font_style', array(
	'sanitize_callback' => 'emoza_sanitize_select',
	'default'           => get_theme_mod( 'body_font_style', 'normal' ),
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'header_menu_font_style', array(
	'type'      => 'select',
	'section'   => 'emoza_section_typography_header_menu',
	'label'     => esc_html__( 'Font style', 'emoza-woocommerce' ),
	'choices' => array(
		'normal'    => esc_html__( 'Normal', 'emoza-woocommerce' ),
		'italic'    => esc_html__( 'Italic', 'emoza-woocommerce' ),
		'oblique'   => esc_html__( 'Oblique', 'emoza-woocommerce' ),
	),
) );

$wp_customize->add_setting( 'header_menu_font_size_desktop', array(
	'default'           => get_theme_mod( 'body_font_size_desktop', 16 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'header_menu_font_size_tablet', array(
	'default'           => get_theme_mod( 'body_font_size_tablet', 16 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'header_menu_font_size_mobile', array(
	'default'           => get_theme_mod( 'body_font_size_mobile', 16 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'header_menu_font_size',
	array(
		'label'         => esc_html__( 'Font size', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_header_menu',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'header_menu_font_size_desktop',
			'size_tablet'       => 'header_menu_font_size_tablet',
			'size_mobile'       => 'header_menu_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 40,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'header_menu_line_height', array(
	'default'           => get_theme_mod( 'body_line_height', 1.68 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'header_menu_line_height',
	array(
		'label'         => esc_html__( 'Line height', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_header_menu',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'header_menu_line_height',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.01,
			'unit' => 'em',
		),
	)
) );

$wp_customize->add_setting( 'header_menu_letter_spacing', array(
	'default'           => get_theme_mod( 'body_letter_spacing', 0 ),
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'header_menu_letter_spacing',
	array(
		'label'         => esc_html__( 'Letter spacing', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_header_menu',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'header_menu_letter_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.5,
		),
	)
) );

$wp_customize->add_setting( 'header_menu_text_transform', array(
	'default'           => get_theme_mod( 'body_text_transform', 'none' ),
  	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );

$wp_customize->add_setting( 'header_menu_text_decoration', array(
	'default'           => get_theme_mod( 'body_text_decoration', 'none' ),
  	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );

$wp_customize->add_control( new Emoza_Text_Style_Control( $wp_customize, 'header_menu_text',
    array(
    'section'  => 'emoza_section_typography_header_menu',
    'settings' => array(
        'transform'  => 'header_menu_text_transform',
        'decoration' => 'header_menu_text_decoration',
    ),
    )
) );

/**
 * Headings
 */
$wp_customize->add_section(
	'emoza_section_typography_headings',
	array(
		'title'      => esc_html__( 'Headings', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_typography',
	)
);

// Heading Typography Preview
$wp_customize->add_setting( 
	'emoza_headings_typography_preview',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Emoza_Typography_Preview_Control( $wp_customize, 'emoza_headings_typography_preview',
	array(
		'section' => 'emoza_section_typography_headings',
		'options' => array(
			'google_font'     => 'emoza_headings_font',
			'adobe_font'      => 'emoza_headings_adobe_font',
			'custom_font'     => 'emoza_headings_custom_font',
			'font-style'      => 'headings_font_style',
			'line-height'     => 'headings_line_height',
			'letter-spacing'  => 'headings_letter_spacing',
			'text-transform'  => 'headings_text_transform',
			'text-decoration' => 'headings_text_decoration',
		),
	)
) );

// Custom Fonts
$wp_customize->add_setting( 'emoza_headings_custom_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting( 'emoza_headings_custom_font_weight',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Custom_Control( $wp_customize, 'emoza_headings_custom_font_typography',
	array(
		'section' => 'emoza_section_typography_headings',
		'settings' => array(
			'font-family' => 'emoza_headings_custom_font',
			'font-weight' => 'emoza_headings_custom_font_weight',
		),
		'active_callback' => 'emoza_font_library_custom',
	)
) );

// Adobe Fonts
$wp_customize->add_setting( 'emoza_headings_adobe_font',
	array(
		'default'           => 'system-default|n4',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Adobe_Control( $wp_customize, 'emoza_headings_adobe_font',
	array(
		'section' => 'emoza_section_typography_headings',
		'active_callback' => 'emoza_font_library_adobe',
	)
) );

// Google Fonts
$wp_customize->add_setting( 'emoza_headings_font',
	array(
		'default'           => '{"font":"System default","regularweight":"700","category":"sans-serif"}',
		'sanitize_callback' => 'emoza_google_fonts_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Control( $wp_customize, 'emoza_headings_font',
	array(
		'section' => 'emoza_section_typography_headings',
		'settings' => array(
			'family' => 'emoza_headings_font',
		),
		'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'emoza_font_library_google',
	)
) );

$wp_customize->add_setting( 'headings_font_style', array(
	'sanitize_callback' => 'emoza_sanitize_select',
	'default'           => 'normal',
	'transport'         => 'postMessage',
) );
$wp_customize->add_control( 'headings_font_style', array(
	'type'      => 'select',
	'section'   => 'emoza_section_typography_headings',
	'label'     => esc_html__( 'Font style', 'emoza-woocommerce' ),
	'choices' => array(
		'normal'    => esc_html__( 'Normal', 'emoza-woocommerce' ),
		'italic'    => esc_html__( 'Italic', 'emoza-woocommerce' ),
		'oblique'   => esc_html__( 'Oblique', 'emoza-woocommerce' ),
	),
) );

$wp_customize->add_setting( 'headings_line_height', array(
	'default'           => 1.2,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'headings_line_height',
	array(
		'label'         => esc_html__( 'Line height', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'headings_line_height',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.01,
			'unit' => 'em',
		),
	)
) );

$wp_customize->add_setting( 'headings_letter_spacing', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );            
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'headings_letter_spacing',
	array(
		'label'         => esc_html__( 'Letter spacing', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'headings_letter_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.5,
		),
	)
) );

$wp_customize->add_setting( 'headings_text_transform', array(
	'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );

$wp_customize->add_setting( 'headings_text_decoration', array(
	'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );

$wp_customize->add_control( new Emoza_Text_Style_Control( $wp_customize, 'headings_text',
    array(
    'section'  => 'emoza_section_typography_headings',
    'settings' => array(
        'transform'  => 'headings_text_transform',
        'decoration' => 'headings_text_decoration',
    ),
    )
) );

$wp_customize->add_setting( 'typography_divider_1',
	array(
		'sanitize_callback' => 'esc_attr',
	)
);
$wp_customize->add_control( new Emoza_Divider_Control( $wp_customize, 'typography_divider_1',
		array(
			'section'       => 'emoza_section_typography_headings',
		)
	)
);

$wp_customize->add_setting( 'h1_font_size_desktop', array(
	'default'           => 64,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h1_font_size_tablet', array(
	'default'           => 42,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h1_font_size_mobile', array(
	'default'           => 32,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'h1_font_size',
	array(
		'label'         => esc_html__( 'Heading 1', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h1_font_size_desktop',
			'size_tablet'       => 'h1_font_size_tablet',
			'size_mobile'       => 'h1_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h2_font_size_desktop', array(
	'default'           => 48,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h2_font_size_tablet', array(
	'default'           => 32,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h2_font_size_mobile', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'h2_font_size',
	array(
		'label'         => esc_html__( 'Heading 2', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h2_font_size_desktop',
			'size_tablet'       => 'h2_font_size_tablet',
			'size_mobile'       => 'h2_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h3_font_size_desktop', array(
	'default'           => 32,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h3_font_size_tablet', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h3_font_size_mobile', array(
	'default'           => 20,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'h3_font_size',
	array(
		'label'         => esc_html__( 'Heading 3', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h3_font_size_desktop',
			'size_tablet'       => 'h3_font_size_tablet',
			'size_mobile'       => 'h3_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h4_font_size_desktop', array(
	'default'           => 24,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h4_font_size_tablet', array(
	'default'           => 18,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h4_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'h4_font_size',
	array(
		'label'         => esc_html__( 'Heading 4', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h4_font_size_desktop',
			'size_tablet'       => 'h4_font_size_tablet',
			'size_mobile'       => 'h4_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h5_font_size_desktop', array(
	'default'           => 18,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h5_font_size_tablet', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h5_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'h5_font_size',
	array(
		'label'         => esc_html__( 'Heading 5', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h5_font_size_desktop',
			'size_tablet'       => 'h5_font_size_tablet',
			'size_mobile'       => 'h5_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'h6_font_size_desktop', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h6_font_size_tablet', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_setting( 'h6_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );
$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'h6_font_size',
	array(
		'label'         => esc_html__( 'Heading 6', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_headings',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'h6_font_size_desktop',
			'size_tablet'       => 'h6_font_size_tablet',
			'size_mobile'       => 'h6_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 12,
			'max'   => 100,
			'step'  => 1,
		),
	)
) );

/**
 * Body
 */
$wp_customize->add_section(
	'emoza_section_typography_body',
	array(
		'title'      => esc_html__( 'Paragraphs', 'emoza-woocommerce'),
		'panel'      => 'emoza_panel_typography',
	)
);

// Body Typography Preview
$wp_customize->add_setting( 
	'emoza_body_typography_preview',
	array(
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( new Emoza_Typography_Preview_Control( $wp_customize, 'emoza_body_typography_preview',
	array(
		'section' => 'emoza_section_typography_body',
		'options' => array(
			'google_font'     => 'emoza_body_font',
			'adobe_font'      => 'emoza_body_adobe_font',
			'custom_font'     => 'emoza_body_custom_font',
			'font-style'      => 'body_font_style',
			'line-height'     => 'body_line_height',
			'letter-spacing'  => 'body_letter_spacing',
			'text-transform'  => 'body_text_transform',
			'text-decoration' => 'body_text_decoration',
		),
	)
) );

$wp_customize->add_setting( 'emoza_body_font',
	array(
		'default'           => '{"font":"System default","regularweight":"400","category":"sans-serif"}',
		'sanitize_callback' => 'emoza_google_fonts_sanitize',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Control( $wp_customize, 'emoza_body_font',
	array(
		'section' => 'emoza_section_typography_body',
		'settings' => array(
			'family' => 'emoza_body_font',
		),
		'input_attrs' => array(
			'font_count'    => 'all',
			'orderby'       => 'alpha',
			'disableRegular' => false,
		),
		'active_callback' => 'emoza_font_library_google',
	)
) );

// Custom Fonts
$wp_customize->add_setting( 'emoza_body_custom_font',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_setting( 'emoza_body_custom_font_weight',
	array(
		'default'           => '',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Custom_Control( $wp_customize, 'emoza_body_custom_font_typography',
	array(
		'section' => 'emoza_section_typography_body',
		'settings' => array(
			'font-family' => 'emoza_body_custom_font',
			'font-weight' => 'emoza_body_custom_font_weight',
		),
		'active_callback' => 'emoza_font_library_custom',
	)
) );

// Adobe Fonts
$wp_customize->add_setting( 'emoza_body_adobe_font',
	array(
		'default'           => 'system-default|n4',
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	)
);
$wp_customize->add_control( new Emoza_Typography_Adobe_Control( $wp_customize, 'emoza_body_adobe_font',
	array(
		'section' => 'emoza_section_typography_body',
		'active_callback' => 'emoza_font_library_adobe',
	)
) );

$wp_customize->add_setting( 'body_font_style', array(
	'sanitize_callback' => 'emoza_sanitize_select',
	'default'           => 'normal',
	'transport'         => 'postMessage',
) );

$wp_customize->add_control( 'body_font_style', array(
	'type'      => 'select',
	'section'   => 'emoza_section_typography_body',
	'label'     => esc_html__( 'Font style', 'emoza-woocommerce' ),
	'choices' => array(
		'normal'    => esc_html__( 'Normal', 'emoza-woocommerce' ),
		'italic'    => esc_html__( 'Italic', 'emoza-woocommerce' ),
		'oblique'   => esc_html__( 'Oblique', 'emoza-woocommerce' ),
	),
) );

$wp_customize->add_setting( 'body_font_size_desktop', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'body_font_size_tablet', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_setting( 'body_font_size_mobile', array(
	'default'           => 16,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'absint',
) );

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'body_font_size',
	array(
		'label'         => esc_html__( 'Font Size', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_body',
		'is_responsive' => 1,
		'settings'      => array(
			'size_desktop'      => 'body_font_size_desktop',
			'size_tablet'       => 'body_font_size_tablet',
			'size_mobile'       => 'body_font_size_mobile',
		),
		'input_attrs' => array(
			'min'   => 10,
			'max'   => 40,
			'step'  => 1,
		),
	)
) );

$wp_customize->add_setting( 'body_line_height', array(
	'default'           => 1.68,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'body_line_height',
	array(
		'label'         => esc_html__( 'Line height', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_body',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'body_line_height',
		),
		'input_attrs' => array(
			'min'  => 0,
			'max'  => 5,
			'step' => 0.01,
			'unit' => 'em',
		),
	)
) );

$wp_customize->add_setting( 'body_letter_spacing', array(
	'default'           => 0,
	'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );            

$wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'body_letter_spacing',
	array(
		'label'         => esc_html__( 'Letter spacing', 'emoza-woocommerce' ),
		'section'       => 'emoza_section_typography_body',
		'is_responsive' => 0,
		'settings'      => array(
			'size_desktop'      => 'body_letter_spacing',
		),
		'input_attrs' => array(
			'min'   => 0,
			'max'   => 5,
			'step'  => 0.5,
		),
	)
) );

$wp_customize->add_setting( 'body_text_transform', array(
    'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );

$wp_customize->add_setting( 'body_text_decoration', array(
    'default'           => 'none',
    'transport'         => 'postMessage',
	'sanitize_callback' => 'emoza_sanitize_text',
) );

$wp_customize->add_control( new Emoza_Text_Style_Control( $wp_customize, 'body_text',
    array(
    'section'  => 'emoza_section_typography_body',
    'settings' => array(
        'transform'  => 'body_text_transform',
        'decoration' => 'body_text_decoration',
    ),
    )
) );