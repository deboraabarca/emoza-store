<?php
/**
 * Footer Builder
 * Button 1 Component
 * 
 * @package Emoza_Pro
 */ ?>

<div class="ehfb-builder-item ehfb-component-button" data-component-id="button">
    <?php $this->customizer_edit_button();
    
    // @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $text 	= get_theme_mod( 'ehfb_footer_button_text', esc_html__( 'Click me', 'emoza-woocommerce' ) );
    $url	= get_theme_mod( 'ehfb_footer_button_link', '#' );
    $class  = get_theme_mod( 'ehfb_footer_button_class', '' ); 
    $newtab = get_theme_mod( 'ehfb_footer_button_newtab', 0 );
    $open	= '';

    if ( $newtab ) {
        $open = 'target="_blank"';
    } 
    // @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    
    ?>
        <a <?php echo esc_html( $open ); ?> class="button<?php echo esc_attr( ( $class ? ' '. $class : '' ) ); ?>" href="<?php echo esc_url( $url ); ?>">
            <?php echo esc_html( $text ); ?>
        </a>
</div>