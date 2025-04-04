<?php
/**
 * Header/Footer Builder
 * Mobile Hamburger Component CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'ehfb_mobile_hamburger_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-mobile_hamburger', 
    'display',
    ''
);

// Icon Color
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_mobile_hamburger_icon_color', '', '.ehfb-component-mobile_hamburger .menu-toggle svg' );

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_mobile_hamburger_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-mobile_hamburger', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_mobile_hamburger_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-mobile_hamburger', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound