<?php
/**
 * Footer Builder
 * Rows
 * 
 * @package Emoza_Pro
 */

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

/**
 * All Controls 
 */
foreach( $this->footer_rows as $row ) {
    $wp_customize->add_setting(
        'emoza_footer_row__' . $row['id'],
        array(
            'default'           => $row['default'],
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        'emoza_footer_row__' . $row['id'],
        array(
            'type'     => 'text',
            'label'    => esc_html( $row['label'] ),
            'section'  => $row['section'],
            'settings' => 'emoza_footer_row__' . $row['id'],
            'priority' => 10
        )
    );

    // Selective Refresh
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'emoza_footer_row__' . $row['id'],
            array(
                'selector'        => '.ehfb-desktop .ehfb-rows .ehfb-' . $row['id'],
                'settings'        => array( 
                    'emoza_footer_row__' . $row['id']
                ),
                'render_callback' => function() use( $row ) {
                    $this->rows_callback( 'footer', $row['id'], 'desktop' ); // phpcs:ignore PHPCompatibility.FunctionDeclarations.NewClosure.ThisFoundOutsideClass
                },
            )
        );
    }

    $wp_customize->add_setting(
        'emoza_footer_row__' . $row['id'] . '_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control(
        new Emoza_Tab_Control (
            $wp_customize,
            'emoza_footer_row__' . $row['id'] . '_tabs',
            array(
                'label' 				=> '',
                'section'       		=> $row['section'],
                'controls_general'		=> wp_json_encode( array( 
                    '#customize-control-emoza_footer_row__' . $row['id'] ,
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_height',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_columns_desktop',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_columns_layout_desktop',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_available_columns'
                ) ),
                'controls_design'		=> wp_json_encode( array( 
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_background_color',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_divider2',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_background_image',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_background_size',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_background_position',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_background_repeat',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_border_top',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_border_top_color',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_padding',
                    '#customize-control-emoza_footer_row__' . $row['id'] . '_margin'
                ) ),
                'priority' 				=> 20
            )
        )
    );

    /**
     * General
     */

    // Height.
    $default = Emoza_Header_Footer_Builder::get_row_height_default_customizer_value( $row[ 'id' ] );

    $wp_customize->add_setting( 'emoza_footer_row__' . $row['id'] . '_height_desktop', array(
        'default'   		=> $default,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );			
    $wp_customize->add_setting( 'emoza_footer_row__' . $row['id'] . '_height_tablet', array(
        'default'   		=> $default,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );
    $wp_customize->add_setting( 'emoza_footer_row__' . $row['id'] . '_height_mobile', array(
        'default'   		=> $default,
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );			
    
    $wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'emoza_footer_row__' . $row['id'] . '_height',
        array(
            'label' 		=> esc_html__( 'Height', 'emoza-woocommerce' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 1,
            'settings' 		=> array (
                'size_desktop' 		=> 'emoza_footer_row__' . $row['id'] . '_height_desktop',
                'size_tablet' 		=> 'emoza_footer_row__' . $row['id'] . '_height_tablet',
                'size_mobile' 		=> 'emoza_footer_row__' . $row['id'] . '_height_mobile',
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 1500
            ),
            'priority'              => 30
        )
    ) );

    // Columns.
    $wp_customize->add_setting( 'emoza_footer_row__' . $row['id'] . '_columns_desktop',
        array(
            'default' 			=> '3',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control( new Emoza_Radio_Buttons( $wp_customize, 'emoza_footer_row__' . $row['id'] . '_columns_desktop',
        array(
            'label'   => esc_html__( 'Columns', 'emoza-woocommerce' ),
            'section' => $row['section'],
            'choices' => array(
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '4',
                '5' => '5',
                '6' => '6'
            ),
            'priority'              => 35
        )
    ) );

    // Columns Layout.
    $wp_customize->add_setting(
        'emoza_footer_row__' . $row['id'] . '_columns_layout_desktop',
        array(
            'default'           => Emoza_Header_Footer_Builder::get_row_columns_layout_default_customizer_value( $row[ 'id' ] ),
            'sanitize_callback' => 'sanitize_key',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Emoza_Radio_Images(
            $wp_customize,
            'emoza_footer_row__' . $row['id'] . '_columns_layout_desktop',
            array(
                'label'    => esc_html__( 'Columns Layout', 'emoza-woocommerce' ),
                'section'  => $row['section'],
                'cols' 		=> 4,
                'class'    => 'emoza-radio-images-small',
                'choices'  => array(			
                    '1col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl1.svg'
                    ),
                    '2col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl2.svg'
                    ),		
                    '2col-bigleft' => array(
                        'label' => esc_html__( 'Big Left', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl3.svg'
                    ),				
                    '2col-bigright' => array(
                        'label' => esc_html__( 'Big Right', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl4.svg'
                    ),
                    '3col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl5.svg'
                    ),	
                    '3col-bigleft' => array(
                        'label' => esc_html__( 'Big Left', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl6.svg'
                    ),
                    '3col-bigright' => array(
                        'label' => esc_html__( 'Big Right', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl7.svg'
                    ),	
                    '4col-equal' => array(
                        'label' => esc_html__( 'Equal', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl8.svg'
                    ),	
                    '4col-bigleft' => array(
                        'label' => esc_html__( 'Big Left', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl9.svg'
                    ),
                    '4col-bigright' => array(
                        'label' => esc_html__( 'Big Right', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl10.svg'
                    ),
                    '5col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl11.svg'
                    ),
                    '6col-equal' => array(
                        'label' => esc_html__( 'Equal Width', 'emoza-woocommerce' ),
                        'url'   => '%s/assets/img/fl12.svg'
                    ),
                ),
                'priority' => 35
            )
        )
    );

    // Available Columns.
    $devices = array( 'desktop' );
    $desc    = '';
    foreach( $devices as $device ) {
        $desc .= '<div class="ehfb-available-columns ehfb-available-columns-'. esc_attr( $device ) .' ehfb-always-show">';
            $desc .= '<span class="customize-control-title ehfb-columns-control-title" style="font-style: normal;">'. esc_html__( 'Available Columns', 'emoza-woocommerce' ) .'</span>';
            $desc .= '<div class="ehfb-available-columns-items-wrapper">';
            for( $i=1;$i<=6;$i++ ) {
                $col_section_id = 'emoza_footer_row__' . $row['id'] . '_column' . $i;

                $desc .= '<a class="ehfb-available-columns-item" href="#" data-column="'. absint( $i ) .'" onClick="wp.customize.section(\''. esc_js( $col_section_id ) .'\').focus()">'. /* translators: 1: column number. */ sprintf( esc_html__( 'Column %s', 'emoza-woocommerce' ), absint( $i ) ) .'<span class="dashicons dashicons-arrow-right-alt2"></span></a>';
            }
            $desc .= '</div>';
        $desc .= '</div>';
    }

    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_available_columns',
        array(
            'default' 			=> '',
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control( 
        new Emoza_Text_Control( 
            $wp_customize, 
            'emoza_footer_row__' . $row['id'] . '_available_columns',
            array(
                'description' 	=> $desc,
                'section' 		=> $row['section'],
                'priority' 		=> 37
            )
        )
    );

    /**
     * Styling
     */

    // Background.
    $wp_customize->add_setting(
        'emoza_footer_row__' . $row['id'] . '_background_color',
        array(
            'default'           => '#F5F5F5',
            'sanitize_callback' => 'emoza_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Emoza_Alpha_Color(
            $wp_customize,
            'emoza_footer_row__' . $row['id'] . '_background_color',
            array(
                'label'         	=> esc_html__( 'Background Color', 'emoza-woocommerce' ),
                'section'       	=> $row['section'],
                'priority'			=> 32
            )
        )
    );

    // Divider
    $wp_customize->add_setting(
        'emoza_footer_row__' . $row['id'] . '_divider2',
        array(
            'sanitize_callback' => 'esc_attr'
        )
    );
    $wp_customize->add_control(
        new Emoza_Divider_Control(
            $wp_customize,
            'emoza_footer_row__' . $row['id'] . '_divider2',
            array(
                'section' 		=> $row['section'],
                'priority' 		=> 32
            )
        )
    );

    // Background Image
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_background_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'absint',
        ) 
    );
    $wp_customize->add_control( 
        new WP_Customize_Media_Control( 
            $wp_customize, 
            'emoza_footer_row__' . $row['id'] . '_background_image',
            array(
                'label'           => __( 'Background Image', 'emoza-woocommerce' ),
                'section'         => $row['section'],
                'mime_type'       => 'image',
                'priority'	      => 32
            )
        )
    );

    // Background Size
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_background_size',
        array(
            'default'           => 'cover',
            'sanitize_callback' => 'emoza_sanitize_select',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_control( 
        'emoza_footer_row__' . $row['id'] . '_background_size',
        array(
            'type' 		      => 'select',
            'label' 	      => esc_html__( 'Background Size', 'emoza-woocommerce' ),
            'choices'         => array(
                'cover'   => esc_html__( 'Cover', 'emoza-woocommerce' ),
                'contain' => esc_html__( 'Contain', 'emoza-woocommerce' )
            ),
            'section' 	      => $row['section'],
            'active_callback' => function() use ( $row ){ return get_theme_mod( 'emoza_footer_row__' . $row['id'] . '_background_image' ) ? true : false; },
            'priority'        => 32
        )
    );

    // Background Position
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_background_position',
        array(
            'default'           => 'center',
            'sanitize_callback' => 'emoza_sanitize_select',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_control( 
        'emoza_footer_row__' . $row['id'] . '_background_position',
        array(
            'type' 		      => 'select',
            'label' 	      => esc_html__( 'Background Position', 'emoza-woocommerce' ),
            'choices'         => array(
                'top'    => esc_html__( 'Top', 'emoza-woocommerce' ),
                'center' => esc_html__( 'Center', 'emoza-woocommerce' ),
                'bottom' => esc_html__( 'Bottom', 'emoza-woocommerce' )
            ),
            'section' 	      => $row['section'],
            'active_callback' => function() use ( $row ){ return get_theme_mod( 'emoza_footer_row__' . $row['id'] . '_background_image' ) ? true : false; },
            'priority'        => 32
        )
    );

    // Background Repeat
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_background_repeat',
        array(
            'default'           => 'no-repeat',
            'sanitize_callback' => 'emoza_sanitize_select',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_control( 
        'emoza_footer_row__' . $row['id'] . '_background_repeat',
        array(
            'type' 		      => 'select',
            'label' 	      => esc_html__( 'Background Repeat', 'emoza-woocommerce' ),
            'choices'         => array(
                'no-repeat' => esc_html__( 'No Repeat', 'emoza-woocommerce' ),
                'repeat'    => esc_html__( 'Repeat', 'emoza-woocommerce' )
            ),
            'section' 	      => $row['section'],
            'active_callback' => function() use ( $row ){ return get_theme_mod( 'emoza_footer_row__' . $row['id'] . '_background_image' ) ? true : false; },
            'priority'        => 32
        )
    );

    // Border Top.
    $wp_customize->add_setting( 'emoza_footer_row__' . $row['id'] . '_border_top_desktop', array(
        'default'   		=> Emoza_Header_Footer_Builder::get_row_border_default_customizer_value( $row[ 'id' ] ),
        'transport'			=> 'postMessage',
        'sanitize_callback' => 'absint'
    ) );						
    $wp_customize->add_control( new Emoza_Responsive_Slider( $wp_customize, 'emoza_footer_row__' . $row['id'] . '_border_top',
        array(
            'label' 		=> esc_html__( 'Border Top Size', 'emoza-woocommerce' ),
            'section' 		=> $row['section'],
            'is_responsive'	=> 0,
            'settings' 		=> array (
                'size_desktop' 		=> 'emoza_footer_row__' . $row['id'] . '_border_top_desktop'
            ),
            'input_attrs' => array (
                'min'	=> 0,
                'max'	=> 10
            ),
            'priority'              => 34
        )
    ) );

    // Border Bottom Color.
    $wp_customize->add_setting(
        'emoza_footer_row__' . $row['id'] . '_border_top_color',
        array(
            'default'           => '#EAEAEA',
            'sanitize_callback' => 'emoza_sanitize_hex_rgba',
            'transport'         => 'postMessage'
        )
    );
    $wp_customize->add_control(
        new Emoza_Alpha_Color_Border_Bottom(
            $wp_customize,
            'emoza_footer_row__' . $row['id'] . '_border_top_color',
            array(
                'label'         	=> esc_html__( 'Border Top Color', 'emoza-woocommerce' ),
                'section'       	=> $row['section'],
                'priority'			=> 36
            )
        )
    );

    // Padding
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_padding_desktop',
        array(
            'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_padding_tablet',
        array(
            'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_padding_mobile',
        array(
            'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_control( 
        new Emoza_Dimensions_Control( 
            $wp_customize, 
            'emoza_footer_row__' . $row['id'] . '_padding',
            array(
                'label'           	=> __( 'Padding', 'emoza-woocommerce' ),
                'section'         	=> $row['section'],
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
                    'desktop' => 'emoza_footer_row__' . $row['id'] . '_padding_desktop',
                    'tablet'  => 'emoza_footer_row__' . $row['id'] . '_padding_tablet',
                    'mobile'  => 'emoza_footer_row__' . $row['id'] . '_padding_mobile'
                ),
                'priority'	      	 => 36
            )
        )
    );

    // Margin
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_margin_desktop',
        array(
            'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_margin_tablet',
        array(
            'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_setting( 
        'emoza_footer_row__' . $row['id'] . '_margin_mobile',
        array(
            'default'           => '{ "unit": "px", "linked": false, "top": "", "right": "", "bottom": "", "left": "" }',
            'sanitize_callback' => 'emoza_sanitize_text',
            'transport'         => 'postMessage'
        ) 
    );
    $wp_customize->add_control( 
        new Emoza_Dimensions_Control( 
            $wp_customize, 
            'emoza_footer_row__' . $row['id'] . '_margin',
            array(
                'label'           	=> __( 'Margin', 'emoza-woocommerce' ),
                'section'         	=> $row['section'],
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
                    'desktop' => 'emoza_footer_row__' . $row['id'] . '_margin_desktop',
                    'tablet'  => 'emoza_footer_row__' . $row['id'] . '_margin_tablet',
                    'mobile'  => 'emoza_footer_row__' . $row['id'] . '_margin_mobile'
                ),
                'priority'	      	 => 36
            )
        )
    );
}

// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound