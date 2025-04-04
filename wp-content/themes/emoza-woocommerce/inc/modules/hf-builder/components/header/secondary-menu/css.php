<?php
/**
 * Header/Footer Builder
 * Secondary Menu CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

// Visibility
$css .= Emoza_Custom_CSS::get_responsive_css( 
    'secondary_menu_visibility', 
    'visible', 
    '.ehfb.ehfb-header .ehfb-builder-item.ehfb-component-secondary_menu, .ehfb-mobile_offcanvas .ehfb-builder-item.ehfb-component-secondary_menu', 
    'display',
    ''
);

// Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_color', '#212121', '.ehfb .secondary-navigation a.emoza-dropdown-link' );
$css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_color', '#212121', '.ehfb .secondary-navigation a.emoza-dropdown-link + .dropdown-symbol svg' );

// Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_color_hover', '#757575', '.ehfb .secondary-navigation a.emoza-dropdown-link:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_color_hover', '#757575', '.ehfb .secondary-navigation a.emoza-dropdown-link:hover + .dropdown-symbol svg' );

// Submenu Background
$css .= Emoza_Custom_CSS::get_background_color_css( 'secondary_menu_submenu_background', '#FFF', '.ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul, .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul li.emoza-dropdown-li' );

// Submenu Text Color
$css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_submenu_color', '#212121', '.ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a' );
$css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_submenu_color', '#212121', '.ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a + .dropdown-symbol svg' );

// Submenu Text Color Hover
$css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_submenu_color_hover', '#757575', '.ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a:hover' );
$css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_submenu_color_hover', '#757575', '.ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a:hover + .dropdown-symbol svg' );

if( emoza_sticky_header_enabled() ) {
    // Sticky Header - Text Color
    $css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_sticky_color', '#212121', '.sticky-header-active .ehfb .secondary-navigation a.emoza-dropdown-link' );
    $css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_sticky_color', '#212121', '.sticky-header-active .ehfb .secondary-navigation a.emoza-dropdown-link + .dropdown-symbol svg' );
    
    // Sticky Header - Text Color Hover
    $css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_sticky_color_hover', '#757575', '.sticky-header-active .ehfb .secondary-navigation a.emoza-dropdown-link:hover' );
    $css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_sticky_color_hover', '#757575', '.sticky-header-active .ehfb .secondary-navigation a.emoza-dropdown-link:hover + .dropdown-symbol svg' );
    
    // Sticky Header - Submenu Background
    $css .= Emoza_Custom_CSS::get_background_color_css( 'secondary_menu_sticky_submenu_background', '#FFF', '.sticky-header-active .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul, .sticky-header-active .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul li.emoza-dropdown-li' );
    
    // Sticky Header - Submenu Text Color
    $css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_sticky_submenu_color', '#212121', '.sticky-header-active .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a' );
    $css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_sticky_submenu_color', '#212121', '.sticky-header-active .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a + .dropdown-symbol svg' );
    
    // Sticky Header - Submenu Text Color Hover
    $css .= Emoza_Custom_CSS::get_color_css( 'secondary_menu_sticky_submenu_color_hover', '#757575', '.sticky-header-active .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a:hover' );
    $css .= Emoza_Custom_CSS::get_fill_css( 'secondary_menu_sticky_submenu_color_hover', '#757575', '.sticky-header-active .ehfb .secondary-navigation .sub-menu.emoza-dropdown-ul a:hover + .dropdown-symbol svg' );
}

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'secondary_menu_padding',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb .secondary-navigation', 
    'padding'
);

// Margin
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'secondary_menu_margin',
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb .secondary-navigation', 
    'margin',
    true
);

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound