<?php
/**
 * Adobe Typekit Customize Options
 *
 * @package Emoza
 */

if ( $wp_customize->get_control( 'fonts_library' ) !== NULL ) {
	$wp_customize->get_control( 'fonts_library' )->choices['adobe'] = esc_html__( 'Adobe Fonts', 'emoza-woocommerce' );
}

$wp_customize->add_setting( 
	'adobe_fonts_kits_generator',
	array(
		'default'           => '',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 
	new Emoza_Typography_Adobe_Kits_Control( 
		$wp_customize, 
		'adobe_fonts_kits_generator',
		array(
			'section'         => 'emoza_section_typography_general',
			'active_callback' => 'emoza_font_library_adobe',
		)
	) 
);
