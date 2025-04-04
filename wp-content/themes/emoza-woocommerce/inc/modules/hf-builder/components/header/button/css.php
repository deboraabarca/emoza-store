<?php
/**
 * Header/Footer Builder
 * Button Component CSS Output
 * 
 * @package Emoza_Pro
 */

/**
 * Default State
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'ehfb_button_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-button, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-button', 
    'display',
    ''
);

// Background Color
$css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_button_background_color', '#212121', '.ehfb-component-button .button' );

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'ehfb_button_color', '#FFF', '.ehfb-component-button .button' );

// Border Color
$css .= Emoza_Custom_CSS::get_border_color_css( 'ehfb_button_border_color', '#212121', '.ehfb-component-button .button' );

/**
 * Hover State
 */

// Background Color
$css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_button_background_color_hover', '#757575', '.ehfb-component-button .button:hover' );

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'ehfb_button_color_hover', '#FFF', '.ehfb-component-button .button:hover' );

// Border Color
$css .= Emoza_Custom_CSS::get_border_color_css( 'ehfb_button_border_color_hover', '#757575', '.ehfb-component-button .button:hover' );

/**
 * Sticky Header Active State
 */
if( emoza_sticky_header_enabled() ) {

    /**
     * Default State
     */

    // Background Color
    $css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_button_sticky_background_color', '#212121', '.sticky-header-active .ehfb-component-button .button' );

    // Text Color
    $css .= Emoza_Custom_CSS::get_color_css( 'ehfb_button_sticky_color', '#FFF', '.sticky-header-active .ehfb-component-button .button' );

    // Border Color
    $css .= Emoza_Custom_CSS::get_border_color_css( 'ehfb_button_sticky_border_color', '#212121', '.sticky-header-active .ehfb-component-button .button' );

    /**
     * Hover State
     */

    // Background Color
    $css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_button_sticky_background_color_hover', '#757575', '.sticky-header-active .ehfb-component-button .button:hover' );

    // Text Color
    $css .= Emoza_Custom_CSS::get_color_css( 'ehfb_button_sticky_color_hover', '#757575', '.sticky-header-active .ehfb-component-button .button:hover' );

    // Border Color
    $css .= Emoza_Custom_CSS::get_border_color_css( 'ehfb_button_sticky_border_color_hover', '#757575', '.sticky-header-active .ehfb-component-button .button:hover' );

}

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_button_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-button', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_button_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-button', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound