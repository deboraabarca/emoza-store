<?php
/**
 * Sanitize functions
 *
 * @package Emoza
 */


/**
 * Selects
 */
function emoza_sanitize_select( $input, $setting ){
          
    $input = sanitize_key($input);

    $choices = $setting->manager->get_control( $setting->id )->choices;
                      
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );                
}

/**
 * Select2
 */
function emoza_sanitize_select2( $input, $setting ){        
    if( empty( $input ) ) {
        return '';
    }

    $input   = strpos( $input, ',' ) !== FALSE ? explode( ',', $input ) : array( $input );
    $choices = $setting->manager->get_control( $setting->id )->choices;

    foreach( $input as $key => $value ) {
        $input[ $key ] = sanitize_key( $value );

        if( ! array_key_exists( $input[ $key ], $choices ) ) {
            return $setting->default;
        }
    }

    return implode( ',', $input );
}

/**
 * Sanitize blog elements
 */
function emoza_sanitize_blog_meta_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'post_date', 'post_categories', 'post_author', 'post_comments' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

function emoza_sanitize_single_meta_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'emoza_posted_on', 'emoza_posted_by', 'emoza_post_categories', 'emoza_entry_comments', 'emoza_post_reading_time' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize header components
 */
function emoza_sanitize_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( emoza_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

function emoza_sanitize_header_components_layout_7_8( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( emoza_header_elements_layout_7_8() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize mobile header components
 */
function emoza_sanitize_mobile_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( emoza_mobile_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize mobile off-canvas header components
 */
function emoza_sanitize_mobile_offcanvas_header_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( emoza_mobile_offcanvas_header_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize loop product components
 */
function emoza_sanitize_product_loop_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();

    /**
     * Hook 'emoza_sanitize_product_loop_components'
     *
     * @since 1.0.0
     */
    $elements   = apply_filters( 'emoza_sanitize_product_loop_components', array( 'emoza_shop_loop_product_title', 'woocommerce_template_loop_rating', 'woocommerce_template_loop_price', 'emoza_loop_product_category', 'emoza_loop_product_description' ) );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize single product components
 */
function emoza_sanitize_single_product_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = emoza_get_default_single_product_components();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize single product sitcky add to cart elements
 */
function emoza_sanitize_single_add_to_cart_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'emoza_sticky_add_to_cart_product_image', 'emoza_sticky_add_to_cart_product_title', 'emoza_single_product_price', 'emoza_sticky_add_to_cart_product_addtocart' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize footer copyright elements
 */
function emoza_sanitize_footer_copyright_elements( $input ) {
    $input     = (array) $input;
    $sanitized = array();

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, array( 'footer_credits', 'footer_social_profiles', 'footer_payment_icons', 'footer_navigation_menu', 'footer_html', 'footer_shortcode' ) ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;
}

/**
 * Sanitize top bar components
 */
function emoza_sanitize_topbar_components( $input ) {
    $input      = (array) $input;
    $sanitized  = array();
    $elements   = array_keys( emoza_topbar_elements() );

    foreach ( $input as $sub_value ) {
        if ( in_array( $sub_value, $elements ) ) {
            $sanitized[] = $sub_value;
        }
    }
    return $sanitized;    
}

/**
 * Sanitize text
 */
function emoza_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}


/**
 * Sanitize URLs
 */
function emoza_sanitize_urls( $input ) {
    if ( strpos( $input, ',' ) !== false) {
        $input = explode( ',', $input );
    }
    if ( is_array( $input ) ) {
        foreach ($input as $key => $value) {
            $input[$key] = esc_url_raw( $value );
        }
        $input = implode( ',', $input );
    }
    else {
        $input = esc_url_raw( $input );
    }
    return $input;
}

/**
 * Sanitize hex and rgba
 */
function emoza_sanitize_hex_rgba( $input, $setting ) {
    if ( empty( $input ) || is_array( $input ) ) {
        return $setting->default;
    }

    // RGB
    if ( strpos( $input, 'rgb(' ) !== false ) {
        $input = str_replace( ' ', '', $input );
        sscanf( $input, 'rgb(%d,%d,%d)', $red, $green, $blue );
        $input = 'rgb(' . emoza_in_range( $red, 0, 255 ) . ',' . emoza_in_range( $green, 0, 255 ) . ',' . emoza_in_range( $blue, 0, 255 ) . ')';

        return $input;
    }

    // RGBA
    if ( strpos( $input, 'rgba(' ) !== false ) {
        $input = str_replace( ' ', '', $input );
        sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
        $input = 'rgba(' . emoza_in_range( $red, 0, 255 ) . ',' . emoza_in_range( $green, 0, 255 ) . ',' . emoza_in_range( $blue, 0, 255 ) . ',' . emoza_in_range( $alpha, 0, 1 ) . ')';

        return $input;
    }

    // HEX
    return sanitize_hex_color( $input );
}

/**
 * Helper function to check if value is in range
 */
function emoza_in_range( $input, $min, $max ){
    if ( $input < $min ) {
        $input = $min;
    }
    if ( $input > $max ) {
        $input = $max;
    }
    return $input;
}

/**
 * Sanitize checkboxes
 */
function emoza_sanitize_checkbox( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/**
 * Sanitize fonts
 */
function emoza_google_fonts_sanitize( $input ) {
    $val =  json_decode( $input, true );
    if( is_array( $val ) ) {
        foreach ( $val as $key => $value ) {
            $val[$key] = sanitize_text_field( $value );
        }
        $input = wp_json_encode( $val );
    }
    else {
        $input = wp_json_encode( sanitize_text_field( $val ) );
    }
    return $input;
}