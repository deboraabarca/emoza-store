<?php
/**
 * Header/Footer Builder
 * Rows CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Site TItle Color
$css .= Emoza_Custom_CSS::get_color_css( 'site_title_color', '', '.ehfb .site-title a' );

// Site Description Color
$css .= Emoza_Custom_CSS::get_color_css( 'site_description_color', '', '.ehfb .site-description' );

// Site Logo Size
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'site_logo_size', 
    array( 'desktop' => 120, 'tablet' => 100, 'mobile' => 100 ), 
    '.custom-logo-link img',
    'width',
    'px' 
);

// Text Alignment
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'emoza_section_hb_component__logo_text_alignment', 
    array( 'desktop' => 'center', 'tablet' => 'center', 'mobile' => 'center' ), 
    '.ehfb.ehfb-header .ehfb-component-logo',
    'text-align',
    '' 
);

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'emoza_section_hb_component__logo_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-logo, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-logo', 
    'display',
    ''
);

if( emoza_sticky_header_enabled() ) {
    // Sticky Header - Site TItle Color
    $css .= Emoza_Custom_CSS::get_color_css( 'site_title_sticky_color', '', '.sticky-header-active .ehfb .site-title a' );
    
    // Sticky Header - Site Description Color
    $css .= Emoza_Custom_CSS::get_color_css( 'site_description_sticky_color', '', '.sticky-header-active .ehfb .site-description' );
}

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_component__logo_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-logo', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_component__logo_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-logo', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound