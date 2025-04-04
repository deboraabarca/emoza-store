<?php
/**
 * Header/Footer Builder
 * Search Component CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'ehfb_search_icon_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-search, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-search', 
    'display',
    ''
);

// Icon Color
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_search_icon_color', '#212121', '.ehfb-component-search .header-search svg' );
$css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_search_icon_color', '#212121', '.ehfb-component-search .header-search .emoza-image.is-svg' );

// Icon Color Hover
$css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_search_icon_color_hover', '#757575', '.ehfb-component-search .header-search:hover svg' );
$css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_search_icon_color_hover', '#757575', '.ehfb-component-search .header-search:hover .emoza-image.is-svg' );

if( emoza_sticky_header_enabled() ) {
    // Sticky Header - Icon Color
    $css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_search_icon_sticky_color', '#212121', '.sticky-header-active .ehfb-component-search .header-search svg' );
    $css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_search_icon_sticky_color', '#212121', '.sticky-header-active .ehfb-component-search .header-search .emoza-image.is-svg' );

    // Sticky Header - Icon Color Hover
    $css .= Emoza_Custom_CSS::get_fill_css( 'ehfb_search_icon_sticky_color_hover', '#757575', '.sticky-header-active .ehfb-component-search .header-search:hover svg' );
    $css .= Emoza_Custom_CSS::get_background_color_css( 'ehfb_search_icon_sticky_color_hover', '#757575', '.sticky-header-active .ehfb-component-search .header-search:hover .emoza-image.is-svg' );
}

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_search_icon_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-search', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'ehfb_search_icon_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-search', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound