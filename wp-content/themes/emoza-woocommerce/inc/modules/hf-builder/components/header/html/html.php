<?php
/**
 * Header/Footer Builder
 * HTML Component
 * 
 * @package Emoza_Pro
 */ 

$header_html_content = get_theme_mod( 'header_html_content', '' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
if( ! $header_html_content ) {
    return '';
} ?>

<div class="ehfb-builder-item ehfb-component-html" data-component-id="html">
    <?php $this->customizer_edit_button(); ?>
    <div class="header-html">
        <?php echo wp_kses_post( $header_html_content ); ?>
    </div>
</div>