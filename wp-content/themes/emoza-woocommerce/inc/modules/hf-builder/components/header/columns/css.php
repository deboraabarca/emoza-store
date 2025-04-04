<?php
/**
 * Header Builder
 * Columns CSS Output
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

$rows = array( 'above_header_row', 'main_header_row', 'below_header_row' );
foreach( $rows as $row ) {

    // Up to 6 columns.
    for( $i=1; $i<=6; $i++ ) {
        $section_id      = "emoza_header_row__{$row}_column$i";
        $column_selector = ".ehfb-header .ehfb-$row .ehfb-column-$i"; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

        // Vertical Alignment.
        $default = Emoza_Header_Footer_Builder::get_row_column_default_customizer_value( $row, $i, 'vertical_alignment' );
        $css .= Emoza_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_vertical_alignment', 
            array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
            $column_selector,
            'align-items',
            '',
            $row,
            $section_id
        );

        // Inner Layout.
        $default = Emoza_Header_Footer_Builder::get_row_column_default_customizer_value( $row, $i, 'inner_layout' );
        $css .= Emoza_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_inner_layout', 
            array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
            $column_selector,
            'flex-direction',
            '',
            $row,
            $section_id
        );

        // Horizontal Alignment.
        $default = Emoza_Header_Footer_Builder::get_row_column_default_customizer_value( $row, $i, 'horizontal_alignment' );
        $css .= Emoza_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_horizontal_alignment', 
            array( 'desktop' => $default, 'tablet' => $default, 'mobile' => $default ), 
            $column_selector,
            'justify-content',
            '',
            $row,
            $section_id
        );

        // Elements Spacing.
        $css .= Emoza_Header_Footer_Builder::get_responsive_css( 
            $section_id . '_elements_spacing', 
            array( 'desktop' => '25', 'tablet' => '25', 'mobile' => '25' ), 
            "$column_selector .ehfb-builder-item + .ehfb-builder-item",
            is_rtl() ? 'margin-right' : 'margin-left',
            'px',
            $row,
            $section_id
        );

        // Padding
        $css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
            $section_id . '_padding',
            array(
                'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            ), 
            $column_selector, 
            'padding'
        );

        // Margin
        $css .= Emoza_Custom_CSS::get_responsive_dimensions_css( 
            $section_id . '_margin',
            array(
                'desktop' => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'tablet'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'mobile'  => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            ), 
            $column_selector, 
            'margin'
        );
    }

}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound