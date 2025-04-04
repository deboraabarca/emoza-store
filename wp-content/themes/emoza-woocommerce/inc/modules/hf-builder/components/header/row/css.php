<?php
/**
 * Header/Footer Builder
 * Rows CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$sticky_header_type = get_theme_mod( 'sticky_header_type', 'always' );
$sticky_row         = get_theme_mod( 'emoza_section_hb_wrapper__header_builder_sticky_row', 'main-header-row' );

$rows = array( 'above_header_row', 'main_header_row', 'below_header_row' );
foreach( $rows as $row ) {

    // Height
    $css .= Emoza_Custom_CSS::get_responsive_css( 
        "emoza_header_row__{$row}_height", 
        array( 'desktop' => 100, 'tablet' => 100, 'mobile' => 100 ), 
        ".ehfb-$row",
        'min-height',
        'px' 
    );

    // Background Color
    $css .= Emoza_Custom_CSS::get_background_color_css( "emoza_header_row__{$row}_background_color", '#FFF', ".ehfb-$row" );
    
    // Background Image
    $background_image = get_theme_mod( "emoza_header_row__{$row}_background_image", '' );
    if( $background_image ) {
        $image_url           = wp_get_attachment_image_url( $background_image, 'full' );
        $background_size     = get_theme_mod( "emoza_header_row__{$row}_background_size", 'cover' );
        $background_position = get_theme_mod( "emoza_header_row__{$row}_background_position", 'center' );
        $background_repeat   = get_theme_mod( "emoza_header_row__{$row}_background_repeat", 'no-repeat' );

        $css .= ".ehfb-$row { background-image: url(" . esc_url( $image_url ) . "); }";
        $css .= Emoza_Custom_CSS::get_css( 
            "emoza_header_row__{$row}_background_size", 
            'cover', 
            ".ehfb-$row", 
            'background-size', 
            '' 
        );
        $css .= Emoza_Custom_CSS::get_css( 
            "emoza_header_row__{$row}_background_position", 
            'center', 
            ".ehfb-$row", 
            'background-position', 
            '' 
        );
        $css .= Emoza_Custom_CSS::get_css( 
            "emoza_header_row__{$row}_background_repeat", 
            'no-repeat', 
            ".ehfb-$row", 
            'background-repeat', 
            '' 
        );
    }

    // Border Bottom
    $css .= Emoza_Custom_CSS::get_css( 
        "emoza_header_row__{$row}_border_bottom_desktop",
        1, 
        ".ehfb-$row",
        array(
            array(
                'prop' => 'border-bottom-width',
                'unit' => 'px'
            )
        )
    );
    $css .= ".ehfb-$row { border-bottom-style: solid; }";
    $css .= Emoza_Custom_CSS::get_border_bottom_color_rgba_css( "emoza_header_row__{$row}_border_bottom_color", '#EAEAEA', ".ehfb-$row", 0.1 );

    // Padding
    $css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
        "emoza_header_row__{$row}_padding",
        array(
            'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        ), 
        ".ehfb-$row", 
        'padding'
    );

    // Margin
    $css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
        "emoza_header_row__{$row}_margin",
        array(
            'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
        ), 
        ".ehfb-$row", 
        'margin'
    );

    /**
     * Stick Header State
     * 
     */

    if( emoza_sticky_header_enabled() ) {
        
        // Sticky Header - Background Color
        $css .= Emoza_Custom_CSS::get_background_color_css( "emoza_header_row__{$row}_sticky_background_color", '', ".sticky-header-active .has-sticky-header .ehfb-$row" ); 

        // Sticky Header - Border Bottom Color
        $css .= Emoza_Custom_CSS::get_border_bottom_color_rgba_css( "emoza_header_row__{$row}_sticky_border_bottom_color", '#EAEAEA', ".sticky-header-active .has-sticky-header .ehfb-$row" );

    }

}

// Sticky Header
// Generate the gap on top of page for when sticky is active
if( emoza_sticky_header_enabled() ) {
    $sticky_gap = 0;

    foreach( $rows as $row ) {
        if( Emoza_Header_Footer_Builder::get_row_data( $row, 'header' ) !== NULL ) {
            if( ! (int) Emoza_Header_Footer_Builder::is_row_empty( Emoza_Header_Footer_Builder::get_row_data( $row, 'header' )->desktop ) ) {
                $sticky_gap = $sticky_gap + get_theme_mod( "emoza_header_row__{$row}_height_desktop", 100 ) + get_theme_mod( "emoza_header_row__{$row}_border_bottom", 1 );
            }
        }
    }
    
    if( get_theme_mod( 'site_layout', 'default' ) === 'padded' ) {
        $sticky_gap = $sticky_gap + get_theme_mod( 'padded_layout_spacing_desktop', 20 );
    }

    if( $sticky_row === 'all' ) {
        $css .= '@media(min-width: 1025px) { body.has-ehfb-builder:not(.header-transparent) { padding-top: '. esc_attr( $sticky_gap ) .'px; } }';
    }

    if( $sticky_row === 'main-header-row' || $sticky_row === 'below-header-row' ) {
        $sticky_gap = is_admin_bar_showing() ? $sticky_gap + 42 : $sticky_gap;
        $css .= '@media(min-width: 1025px) { body.has-ehfb-builder.sticky-header-active:not(.header-transparent) { padding-top: '. esc_attr( $sticky_gap ) .'px; } }';
    }
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound