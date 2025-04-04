<?php
/**
 * Footer Builder
 * Button 1 Component CSS Output
 * 
 * @package Emoza_Pro
 */

/**
 * Default State
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'ehfb_footer_button_visibility', 
    'visible', 
    '.ehfb.ehfb-footer .ehfb-builder-item.ehfb-component-button', 
    'display',
    ''
);

// Background Color
$css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_footer_button_background_color', '', '.ehfb-footer .ehfb-component-button .button' );

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'ehfb_footer_button_color', '', '.ehfb-footer .ehfb-component-button .button' );

// Border Color
$css .= Emoza_Custom_CSS::get_border_color_css( 'ehfb_footer_button_border_color', '', '.ehfb-footer .ehfb-component-button .button' );

/**
 * Hover State
 */

// Background Color
$css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_footer_button_background_color_hover', '', '.ehfb-footer .ehfb-component-button .button:hover' );

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'ehfb_footer_button_color_hover', '', '.ehfb-footer .ehfb-component-button .button:hover' );

// Border Color
$css .= Emoza_Custom_CSS::get_border_color_css( 'ehfb_footer_button_border_color_hover', '', '.ehfb-footer .ehfb-component-button .button:hover' );

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_footer_button_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-footer .ehfb-component-button', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_footer_button_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-footer .ehfb-component-button', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound