<?php
/**
 * Header/Footer Builder
 * WooCommerce Icons component
 * 
 * @package Emoza_Pro
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    return;
}

echo '<div class="ehfb-builder-item ehfb-component-woo_icons" data-component-id="woo_icons">'; 
    $this->customizer_edit_button();
    
    echo emoza_woocommerce_header_cart(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    
echo '</div>';