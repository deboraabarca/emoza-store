<?php
/**
 * Footer Builder
 * Copyright/credits Component
 * 
 * @package Emoza_Pro
 */ 

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>

<div class="ehfb-builder-item ehfb-component-copyright" data-component-id="copyright">
    <?php $this->customizer_edit_button(); 
    /* translators: %1$1s, %2$2s theme copyright tags*/
    $credits 	= get_theme_mod( 'footer_credits', sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'emoza-woocommerce' ), '{copyright} {year} {site_title}', '{theme_author}' ) );

    $tags 		= array( '{theme_author}', '{site_title}', '{copyright}', '{year}' );
    $replace 	= array( '<a rel="nofollow" href="https://emoza.org/theme/emoza-woocommerce/">' . esc_html__( 'Emoza', 'emoza-woocommerce' ) . '</a>', get_bloginfo( 'name' ), '&copy;', date('Y') );

    // White Label
    if( defined( 'EMOZA_WL_ACTIVE' ) ) {
        $wl_data = emoza_wl_get_data();
        $replace[0] = '<a rel="nofollow" href="'. esc_url( $wl_data[ 'wl_agency_url' ] ) .'">' . esc_html( $wl_data[ 'wl_agency_name' ] ) . '</a>';
    }

    $credits 	= str_replace( $tags, $replace, $credits ); ?>
    <div class="emoza-credits">
        <?php echo apply_filters( 'emoza_footer_builder_copyright_component_output', $credits ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
</div>

<?php
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound