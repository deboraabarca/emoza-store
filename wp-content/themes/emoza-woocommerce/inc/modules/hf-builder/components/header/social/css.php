<?php
/**
 * Header/Footer Builder
 * Social Icons Component CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'ehfb_social_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-social, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-social',
    'display',
    ''
);

// Icon Color
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_social_color', '#212121', '.ehfb-component-social .social-profile > a svg' );

// Icon Color Hover
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_social_color_hover', '#757575', '.ehfb-component-social .social-profile > a:hover svg' );

if( emoza_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_social_sticky_color', '#212121', '.sticky-header-active .ehfb-component-social .social-profile > a svg' );
    
    // Sticky Header - Icon Color Hover
    $css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_social_sticky_color_hover', '#757575', '.sticky-header-active .ehfb-component-social .social-profile > a:hover svg' );
}

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_social_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-social', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_social_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-social', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound