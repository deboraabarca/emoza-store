<?php
/**
 * Footer Builder
 * Columns
 * 
 * @package Emoza_Pro
 */

/**
 * Columns
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

foreach( $this->footer_rows as $row ) {

    // Up to 6 columns.
    for( $i=1; $i<=6; $i++ ) {
        $section_id = 'emoza_footer_row__' . $row['id'] . '_column' . $i;

        // Section.
        $wp_customize->add_section(
            new Emoza_Section_Hidden(
				$wp_customize,
                $section_id,
                array(
                    /* translators: 1: column number. */
                    'title'      => sprintf( esc_html__( 'Column %s', 'emoza-woocommerce' ), $i ),
                    'panel'      => 'emoza_panel_footer'
                )
            )
        );

        /**
         * Tabs (Layout / Design)
         * 
         */
        $wp_customize->add_setting(
            $section_id . '_tabs',
            array(
                'default'           => '',
                'sanitize_callback' => 'esc_attr'
            )
        );
        $wp_customize->add_control(
            new Emoza_Tab_Control (
                $wp_customize,
                $section_id . '_tabs',
                array(
                    'label' 				=> '',
                    'section'       		=> $section_id,
                    'controls_general'		=> wp_json_encode(
                        array(
                            "#customize-control-{$section_id}_vertical_alignment",
                            "#customize-control-{$section_id}_inner_layout",
                            "#customize-control-{$section_id}_horizontal_alignment",
                            "#customize-control-{$section_id}_elements_spacing",
                        ),
                    ),
                    'controls_design'		=> wp_json_encode(
                        array(
                            "#customize-control-{$section_id}_padding",
                            "#customize-control-{$section_id}_margin",
                        )
                    ),
                    'priority' 				=> 10
                )
            )
        );

        /**
         * Layout (Tab Content)
         * 
         */

        // Vertical Alignment.
        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment_desktop',
            array(
                'default' 			=> 'top',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment_tablet',
            array(
                'default' 			=> 'top',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_vertical_alignment_mobile',
            array(
                'default' 			=> 'top',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Emoza_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_vertical_alignment',
                array(
                    'label'   => esc_html__( 'Vertical Alignment', 'emoza-woocommerce' ),
                    'section' => $section_id,
                    'is_responsive' => true,
                    'settings' 		=> array (
                        'desktop' 		=> $section_id . '_vertical_alignment_desktop',
                        'tablet' 		=> $section_id . '_vertical_alignment_tablet',
                        'mobile' 		=> $section_id . '_vertical_alignment_mobile'
                    ),
                    'choices' => array(
                        'top'    => esc_html__( 'Top', 'emoza-woocommerce' ),
                        'middle' => esc_html__( 'Middle', 'emoza-woocommerce' ),
                        'bottom' => esc_html__( 'Bottom', 'emoza-woocommerce' )
                    ),
                    'priority'              => 20
                )
            ) 
        );

        // Inner Elements Layout.
        $wp_customize->add_setting( 
            $section_id . '_inner_layout_desktop',
            array(
                'default' 			=> 'stack',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_inner_layout_tablet',
            array(
                'default' 			=> 'stack',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_inner_layout_mobile',
            array(
                'default' 			=> 'stack',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Emoza_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_inner_layout',
                array(
                    'label'   => esc_html__( 'Inner Elements Layout', 'emoza-woocommerce' ),
                    'section' => $section_id,
                    'is_responsive' => true,
                    'settings' 		=> array (
                        'desktop' 		=> $section_id . '_inner_layout_desktop',
                        'tablet' 		=> $section_id . '_inner_layout_tablet',
                        'mobile' 		=> $section_id . '_inner_layout_mobile'
                    ),
                    'choices' => array(
                        'stack'  => esc_html__( 'Stack', 'emoza-woocommerce' ),
                        'inline' => esc_html__( 'Inline', 'emoza-woocommerce' )
                    ),
                    'priority'              => 25
                )
            ) 
        );
    
        // Horizontal Alignment.
        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment_desktop',
            array(
                'default' 			=> 'start',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment_tablet',
            array(
                'default' 			=> 'start',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_setting( 
            $section_id . '_horizontal_alignment_mobile',
            array(
                'default' 			=> 'start',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            )
        );
        $wp_customize->add_control( 
            new Emoza_Radio_Buttons( 
                $wp_customize, 
                $section_id . '_horizontal_alignment',
                array(
                    'label'         => esc_html__( 'Horizontal Alignment', 'emoza-woocommerce' ),
                    'section'       => $section_id,
                    'is_responsive' => true,
                    'settings' 		=> array (
                        'desktop' 		=> $section_id . '_horizontal_alignment_desktop',
                        'tablet' 		=> $section_id . '_horizontal_alignment_tablet',
                        'mobile' 		=> $section_id . '_horizontal_alignment_mobile'
                    ),
                    'choices'       => array(
                        'start'  => esc_html__( 'Start', 'emoza-woocommerce' ),
                        'center' => esc_html__( 'Center', 'emoza-woocommerce' ),
                        'end'    => esc_html__( 'End', 'emoza-woocommerce' )
                    ),
                    'priority'      => 30
                )
            ) 
        );

        // Elements Spacing.
        $wp_customize->add_setting( 
            $section_id . '_elements_spacing_desktop',
            array(
                'default'   		=> 25,
                'transport'			=> 'postMessage',
                'sanitize_callback' => 'absint'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_elements_spacing_tablet',
            array(
                'default'   		=> 25,
                'transport'			=> 'postMessage',
                'sanitize_callback' => 'absint'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_elements_spacing_mobile',
            array(
                'default'   		=> 25,
                'transport'			=> 'postMessage',
                'sanitize_callback' => 'absint'
            ) 
        );
        
        $wp_customize->add_control( 
            new Emoza_Responsive_Slider( 
                $wp_customize, 
                $section_id . '_elements_spacing',
                array(
                    'label' 		=> esc_html__( 'Elements Spacing', 'emoza-woocommerce' ),
                    'section' 		=> $section_id,
                    'is_responsive'	=> true,
                    'settings' 		=> array (
                        'size_desktop' 		=> $section_id . '_elements_spacing_desktop',
                        'size_tablet' 		=> $section_id . '_elements_spacing_tablet',
                        'size_mobile' 		=> $section_id . '_elements_spacing_mobile'
                    ),
                    'input_attrs' => array (
                        'min'	=> 0,
                        'max'	=> 150,
                        'step'  => 1
                    ),
                    'priority'     => 30
                )
            ) 
        );

        /**
         * Design (Tab Content)
         * 
         */

        // Padding
        $wp_customize->add_setting( 
            $section_id . '_padding_desktop',
            array(
                'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_padding_tablet',
            array(
                'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_padding_mobile',
            array(
                'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            ) 
        );
        $wp_customize->add_control( 
            new Emoza_Dimensions_Control( 
                $wp_customize, 
                $section_id . '_padding',
                array(
                    'label'           	=> __( 'Padding', 'emoza-woocommerce' ),
                    'section'         	=> $section_id,
                    'sides'             => array(
                        'top'    => true,
                        'right'  => true,
                        'bottom' => true,
                        'left'   => true
                    ),
                    'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
                    'link_values_toggle' => true,
                    'is_responsive'   	 => true,
                    'settings'        	 => array(
                        'desktop' => $section_id . '_padding_desktop',
                        'tablet'  => $section_id . '_padding_tablet',
                        'mobile'  => $section_id . '_padding_mobile'
                    ),
                    'priority'	      	 => 32
                )
            )
        );

        // Margin
        $wp_customize->add_setting( 
            $section_id . '_margin_desktop',
            array(
                'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_margin_tablet',
            array(
                'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            ) 
        );
        $wp_customize->add_setting( 
            $section_id . '_margin_mobile',
            array(
                'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
                'sanitize_callback' => 'emoza_sanitize_text',
                'transport'         => 'postMessage'
            ) 
        );
        $wp_customize->add_control( 
            new Emoza_Dimensions_Control( 
                $wp_customize, 
                $section_id . '_margin',
                array(
                    'label'           	=> __( 'Margin', 'emoza-woocommerce' ),
                    'section'         	=> $section_id,
                    'sides'             => array(
                        'top'    => true,
                        'right'  => true,
                        'bottom' => true,
                        'left'   => true
                    ),
                    'units'              => array( 'px', '%', 'rem', 'em', 'vw', 'vh' ),
                    'link_values_toggle' => true,
                    'is_responsive'   	 => true,
                    'settings'        	 => array(
                        'desktop' => $section_id . '_margin_desktop',
                        'tablet'  => $section_id . '_margin_tablet',
                        'mobile'  => $section_id . '_margin_mobile'
                    ),
                    'priority'	      	 => 32
                )
            )
        );

    }
    
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound