<?php
/**
 * Header/Footer Builder
 * Primary Menu CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'emoza_section_hb_component__menu_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-menu', 
    'display',
    ''
);

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_color', '', '.ehfb .main-navigation a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_color', '', '.ehfb .main-navigation a.emoza-dropdown-link + .dropdown-symbol svg' );

// Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_color_hover', '', '.ehfb .main-navigation a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_color_hover', '', '.ehfb .main-navigation a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Submenu Background
$css .= Emoza_Custom_CSS::get_background_color_css( 'main_header_submenu_background', '', '.ehfb .sub-menu.emoza-dropdown-ul, .ehfb .sub-menu.emoza-dropdown-ul li.emoza-dropdown-li' );

// Submenu Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_submenu_color', '', '.ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_submenu_color', '', '.ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_submenu_color_hover', '', '.ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_submenu_color_hover', '', '.ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Sticky Header - Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_sticky_active_color', '', '.sticky-header-active .ehfb .main-navigation a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_sticky_active_color', '', '.sticky-header-active .ehfb .main-navigation a.emoza-dropdown-link + .dropdown-symbol svg' );

// Sticky Header - Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_sticky_active_color_hover', '', '.sticky-header-active .ehfb .main-navigation a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_sticky_active_color_hover', '', '.sticky-header-active .ehfb .main-navigation a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Sticky Header - Submenu Background
$css .= Emoza_Custom_CSS::get_background_color_css( 'main_header_sticky_active_submenu_background_color', '', '.sticky-header-active .ehfb .sub-menu.emoza-dropdown-ul, .sticky-header-active .ehfb .sub-menu.emoza-dropdown-ul li.emoza-dropdown-li' );

// Sticky Header - Submenu Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_sticky_active_submenu_color', '', '.sticky-header-active .ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_sticky_active_submenu_color', '', '.sticky-header-active .ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link + .dropdown-symbol svg' );

// Sticky Header - Submenu Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'main_header_sticky_active_submenu_color_hover', '', '.sticky-header-active .ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'main_header_sticky_active_submenu_color_hover', '', '.sticky-header-active .ehfb .main-navigation .sub-menu.emoza-dropdown-ul a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_component__menu_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-menu', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_component__menu_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header .ehfb-component-menu', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound