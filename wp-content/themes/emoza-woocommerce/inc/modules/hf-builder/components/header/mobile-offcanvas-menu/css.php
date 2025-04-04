<?php
/**
 * Header/Footer Builder
 * Mobile Offcanvas Menu Component CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'mobile_offcanvas_menu_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-mobile_offcanvas_menu, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-mobile_offcanvas_menu', 
    'display',
    ''
);

// Link Separator Color and Size.
$mobile_menu_link_separator 	= get_theme_mod( 'mobile_menu_link_separator', 0 );
if ( $mobile_menu_link_separator ) {
    $link_separator_color 			= get_theme_mod( 'link_separator_color', '#eeeeee' );
    $mobile_header_separator_width	= get_theme_mod( 'mobile_header_separator_width', 1 );

    $css .= ".emoza-offcanvas-menu .emoza-dropdown ul li { padding-top: 5px; border-bottom: " . intval( $mobile_header_separator_width ) . "px solid " . esc_attr( $link_separator_color ) . ";}";
}

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_color', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_color', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation a.emoza-dropdown-link + .dropdown-symbol svg' );

// Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_color_hover', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_color_hover', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Submenu Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_submenu_color', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_submenu_color', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'mobile_offcanvas_menu_submenu_color_hover', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'mobile_offcanvas_menu_submenu_color_hover', '', '.ehfb.ehfb-mobile_offcanvas .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'mobile_offcanvas_menu_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-mobile_offcanvas_menu', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'mobile_offcanvas_menu_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-component-mobile_offcanvas_menu', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound