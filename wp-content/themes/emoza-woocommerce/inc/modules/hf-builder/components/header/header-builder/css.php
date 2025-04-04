<?php
/**
 * Header/Footer Builder
 * Header Builder CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$header_transparent         = get_theme_mod( 'header_transparent', 0 );
$header_transparent_hb_rows = get_theme_mod( 'header_transparent_hb_rows', 'main-row' );

// Apply Header Transparent To
if( $header_transparent ) {

    if( $header_transparent_hb_rows ) {
        $rows = explode( ',', $header_transparent_hb_rows );

        if( in_array( 'top-row', $rows ) ) {
            $css .= 'body:not(.sticky-header-active) .header-transparent-wrapper .ehfb-header.ehfb-desktop .ehfb-above_header_row { background-color: transparent; }';
        }

        if( in_array( 'main-row', $rows ) ) {
            $css .= 'body:not(.sticky-header-active) .header-transparent-wrapper .ehfb-header.ehfb-desktop .ehfb-main_header_row { background-color: transparent; }';
        }

        if( in_array( 'bottom-row', $rows ) ) {
            $css .= 'body:not(.sticky-header-active) .header-transparent-wrapper .ehfb-header.ehfb-desktop .ehfb-below_header_row { background-color: transparent; }';
        }

    }

}

// Mobile breakpoint.
$mobile_breakpoint = absint( get_theme_mod( 'mobile_breakpoint', 1024 ) );
$min_width         = $mobile_breakpoint + 1;

// Some of the CSS below is already present in the .CSS files. However we have to duplicate it here 
// because the breakpoint in those static CSS files are not dynamic.
$css .= "
    @media (max-width: {$mobile_breakpoint}px) {
        .ehfb-header.ehfb-mobile,
        .emoza-offcanvas-menu {
            display: block;
        }
        .ehfb-header.ehfb-desktop {
            display: none;
        }
        .emoza-offcanvas-menu .emoza-dropdown .emoza-dropdown-ul .emoza-dropdown-ul {
            -webkit-transform: none;
            transform: none;
            opacity: 1;
        }

        .emoza-mega-menu-column {
            margin-left: -10px;
        }
        .emoza-mega-menu-column > .emoza-dropdown-link,
        .emoza-mega-menu-column > span {
            display: none !important;
        }
        .emoza-mega-menu-column > .sub-menu.emoza-dropdown-ul{
            display: block !important;
        }
        .is-mega-menu:not(.is-mega-menu-vertical) .emoza-mega-menu-column .is-mega-menu-heading {
            display: none !important;
        }
    }

    @media (min-width: {$min_width}px) {
        .ehfb-header.ehfb-mobile {
            display: none;
        }
        .ehfb-header.ehfb-desktop {
            display: block;
        }
        .ehfb-header .emoza-dropdown > .emoza-dropdown-ul,
        .ehfb-header .emoza-dropdown > div > .emoza-dropdown-ul {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
    }
";

// Padding
$css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
    'emoza_section_hb_wrapper__header_builder_padding', 
    array(
        'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
    ), 
    '.ehfb-header.ehfb-desktop, .ehfb-header.ehfb-mobile', 
    'padding'
);

// Background Image
$hb_background_image = get_theme_mod( 'emoza_section_hb_wrapper__header_builder_background_image', '' );
if( $hb_background_image ) {
    $image_url           = wp_get_attachment_image_url( $hb_background_image, 'full' );

    $css .= '.ehfb-header.ehfb-desktop, .ehfb-header.ehfb-mobile { background-image: url(' . esc_url( $image_url ) . '); }';
    $css .= Emoza_Custom_CSS::get_css( 
        'emoza_section_hb_wrapper__header_builder_background_size', 
        'cover', 
        '.ehfb-header.ehfb-desktop, .ehfb-header.ehfb-mobile', 
        'background-size', 
        '' 
    );
    $css .= Emoza_Custom_CSS::get_css( 
        'emoza_section_hb_wrapper__header_builder_background_position', 
        'center', 
        '.ehfb-header.ehfb-desktop, .ehfb-header.ehfb-mobile', 
        'background-position', 
        '' 
    );
    $css .= Emoza_Custom_CSS::get_css( 
        'emoza_section_hb_wrapper__header_builder_background_repeat', 
        'no-repeat', 
        '.ehfb-header.ehfb-desktop, .ehfb-header.ehfb-mobile', 
        'background-repeat', 
        '' 
    );
}

// Background Color
$css .= Emoza_Custom_CSS::get_background_color_css( 'emoza_section_hb_wrapper__header_builder_background_color', '', '.ehfb-header.ehfb-desktop, .ehfb-header.ehfb-mobile' );

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound