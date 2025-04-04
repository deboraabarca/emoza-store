<?php
/**
 * WC Vendors Compatibility File
 *
 * @package Emoza
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Add vendor profile link to emoza header login register dropdown
 */
function emoza_wcvendors_header_login_register_vendor_profile_link( $output ) {
    if( ! is_user_logged_in() ) {
        return;
    } 
    
    if( ! WCV_Vendors::is_vendor( get_current_user_id() ) ) {
        return;
    }
    
    $output .= '<a href="'. esc_url( get_the_permalink( get_option( 'wcvendors_vendor_dashboard_page_id' ) ) ) .'">'. esc_html__( 'Vendor Dashboard', 'emoza-woocommerce' ) .'</a>';

    return $output;
}
add_filter( 'emoza_header_login_register_before_logout_dropdown_item', 'emoza_wcvendors_header_login_register_vendor_profile_link' );
