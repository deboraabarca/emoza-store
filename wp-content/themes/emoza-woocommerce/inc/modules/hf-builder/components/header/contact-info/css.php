<?php
/**
 * Header/Footer Builder
 * Contact Info Component CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'ehfb_contact_info_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-contact_info, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-contact_info', 
    'display',
    ''
);

// Icons Color
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_contact_info_icon_color', '#212121', '.ehfb-component-contact_info .header-contact > a svg' );

// Icons Color Hover
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_contact_info_icon_color_hover', '#757575', '.ehfb-component-contact_info .header-contact > a:hover svg' );

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'ehfb_contact_info_text_color', '#212121', '.ehfb-component-contact_info .header-contact > a' );

// Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'ehfb_contact_info_text_color_hover', '#757575', '.ehfb-component-contact_info .header-contact > a:hover' );

// Sticky Header Active
if( emoza_sticky_header_enabled() ) {

    // Icons Color
    $css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_contact_info_icon_sticky_color', '#212121', '.sticky-header-active .ehfb-component-contact_info .header-contact > a svg' );

    // Icons Color Hover
    $css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_contact_info_icon_sticky_color_hover', '#757575', '.sticky-header-active .ehfb-component-contact_info .header-contact > a:hover svg' );

    // Text Color
    $css .= Emoza_Custom_CSS::get_color_css( 'ehfb_contact_info_text_sticky_color', '#212121', '.sticky-header-active .ehfb-component-contact_info .header-contact > a' );

    // Text Color Hover
    $css .= Emoza_Custom_CSS::get_color_css( 'ehfb_contact_info_text_sticky_color_hover', '#757575', '.sticky-header-active .ehfb-component-contact_info .header-contact > a:hover' );

}

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_contact_info_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-contact_info', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_contact_info_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-contact_info', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound