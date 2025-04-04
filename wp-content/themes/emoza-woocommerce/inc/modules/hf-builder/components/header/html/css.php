<?php
/**
 * Header/Footer Builder
 * HTML Component CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Text Alignment
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'emoza_section_hb_component__html_text_align', 
    array( 'desktop' => 'left', 'tablet' => 'left', 'mobile' => 'left' ), 
    '.ehfb.ehfb-header .ehfb-component-html',
    'text-align',
    '' 
);

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'emoza_section_hb_component__html_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-html, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-html', 
    'display',
    ''
);

/**
 * Colors Default State
 */

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'emoza_section_hb_component__html_text_color', '', '.ehfb.ehfb-header .ehfb-component-html' );

// Links Color
$css .= Emoza_Custom_CSS::get_color_css( 'emoza_section_hb_component__html_link_color', '', '.ehfb.ehfb-header .ehfb-component-html a' );

// Links Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'emoza_section_hb_component__html_link_color_hover', '', '.ehfb.ehfb-header .ehfb-component-html a:hover' );

/** 
 * Colors Sticky Header State
 */

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'emoza_section_hb_component__html_sticky_text_color', '', '.sticky-header-active .ehfb.ehfb-header .ehfb-component-html' );

// Links Color
$css .= Emoza_Custom_CSS::get_color_css( 'emoza_section_hb_component__html_sticky_link_color', '', '.sticky-header-active .ehfb.ehfb-header .ehfb-component-html a' );

// Links Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'emoza_section_hb_component__html_sticky_link_color_hover', '', '.sticky-header-active .ehfb.ehfb-header .ehfb-component-html a:hover' );

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_component__html_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb.ehfb-header .ehfb-component-html', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_component__html_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb.ehfb-header .ehfb-component-html', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound