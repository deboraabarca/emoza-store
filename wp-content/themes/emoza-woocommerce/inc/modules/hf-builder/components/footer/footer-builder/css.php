<?php
/**
 * Header/Footer Builder
 * Header Builder CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_fb_wrapper__footer_builder_padding', 
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-footer', 
    'padding'
);

// Background Image
$fb_background_image = get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_image', '' );
if( $fb_background_image ) {
    $image_url           = wp_get_attachment_image_url( $fb_background_image, 'full' );
    $background_size     = get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_size', 'cover' );
    $background_position = get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_position', 'center' );
    $background_repeat   = get_theme_mod( 'emoza_section_fb_wrapper__footer_builder_background_repeat', 'no-repeat' );

    $css .= '.ehfb-footer { background-image: url(' . esc_url( $image_url ) . '); }';
    $css .= Emoza_Custom_CSS::get_css( 
        'emoza_section_fb_wrapper__footer_builder_background_size', 
        'cover', 
        '.ehfb-footer', 
        'background-size', 
        '' 
    );
    $css .= Emoza_Custom_CSS::get_css( 
        'emoza_section_fb_wrapper__footer_builder_background_position', 
        'center', 
        '.ehfb-footer', 
        'background-position', 
        '' 
    );
    $css .= Emoza_Custom_CSS::get_css( 
        'emoza_section_fb_wrapper__footer_builder_background_repeat', 
        'no-repeat', 
        '.ehfb-footer', 
        'background-repeat', 
        '' 
    );
}

// Background Color
$css .= Emoza_Custom_CSS::get_background_color_css( 'emoza_section_fb_wrapper__footer_builder_background_color', '', '.ehfb-footer' );

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound