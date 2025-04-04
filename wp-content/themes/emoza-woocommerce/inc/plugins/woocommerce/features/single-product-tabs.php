<?php
/**
 * Single Product Tabs
 *
 * @package Emoza
 */

/**
 * WC Hooks 
 */
function emoza_single_product_tabs_wc_hooks() {

	//Single product
	if ( is_product() ) {
		$single_tabs = get_theme_mod( 'single_product_tabs', 1 );

		//Content class
		add_filter( 'emoza_content_class', 'emoza_single_product_tabs_wc_single_layout' );

		//Product tabs
		$tabs_position = get_theme_mod( 'single_product_tabs_position', 'default' );

        remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs' );
		
        if ( $single_tabs ) {
			if( $tabs_position === 'product-summary' ) {
				add_action( 'woocommerce_single_product_summary', 'emoza_single_product_tabs_output', 55 );
			} else {
                add_action( 'woocommerce_after_single_product_summary', 'emoza_single_product_tabs_output' );
            }
		}
	}
}
add_action( 'wp', 'emoza_single_product_tabs_wc_hooks' );

/**
 * Woocommerce tabs titles
 */
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );
add_filter( 'woocommerce_product_description_heading', '__return_false' );

/**
 * Layout single product
 */
function emoza_single_product_tabs_wc_single_layout( $tabs_class ) {
	$single_product_tabs_layout    = get_theme_mod( 'single_product_tabs_layout', 'style1' );
	$single_product_tabs_alignment = get_theme_mod( 'single_product_tabs_alignment', 'left' );
	$tabs_position                 = get_theme_mod( 'single_product_tabs_position', 'default' );

	$tabs_class .= ' emoza-tabs-' . $single_product_tabs_layout . ' emoza-tabs-align-' . $single_product_tabs_alignment . ' emoza-tabs-position-' . $tabs_position;

    return $tabs_class;
}

/**
 * Tabs output
 */
function emoza_single_product_tabs_output() { 
    $single_product_tabs_layout = get_theme_mod( 'single_product_tabs_layout', 'style1' );

    if( $single_product_tabs_layout !== 'style6' ) {
        emoza_woocommerce_output_product_data_tabs();
    } else {
        emoza_single_product_tabs_as_accordion_output();
    } 
}

/**
 * Tabs default style
 */
function emoza_woocommerce_output_product_data_tabs() {
    
    /**
     * Hook 'woocommerce_product_tabs'
     *
     * @since 1.0.0
     */
    $product_tabs = apply_filters( 'woocommerce_product_tabs', array() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

    if ( ! empty( $product_tabs ) ) : ?>

        <div class="woocommerce-tabs wc-tabs-wrapper">
            <ul class="tabs wc-tabs" role="tablist">
                <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                    <li class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>">
                        <a href="#tab-<?php echo esc_attr( $key ); ?>">
                            <?php 
                            /**
                             * Hook "woocommerce_product_' . $key . '_tab_title"
                             *
                             * @since 1.0.0
                             */
                            echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php foreach ( $product_tabs as $key => $product_tab ) : ?>
                <div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>">
                    <?php
                    if ( isset( $product_tab['callback'] ) ) {
                        call_user_func( $product_tab['callback'], $key, $product_tab );
                    }
                    ?>
                </div>
            <?php endforeach; ?>

            <?php 
            /**
             * Hook 'woocommerce_product_after_tabs'
             *
             * @since 1.0.0
             */
            do_action( 'woocommerce_product_after_tabs' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?>
        </div>

    <?php endif;
}

/**
 * Tabs Accordion JS
 */
function emoza_single_product_tab_as_accordion_append_inline_js() {

    /**
     * Hook 'emoza_single_product_tabs_as_accordion_scroll_offset'
     * 
     * @since 1.1.0
     */
    $offset = apply_filters( 'emoza_single_product_tabs_as_accordion_scroll_offset', 100 );

	$js = "
        (function($){
            $( '[data-emoza-collapse]' ).each(function(){
                $(this)[0].addEventListener( 'emoza.collapse.expanded', function(){
                    window.scrollTo({ top: $(this).offset().top - $offset, behavior: 'smooth' });
                });
            });
        })(jQuery);
    ";
    wp_add_inline_script( 'emoza-custom', $js );
}

/**
 * Tabs Accordion Style
 */
function emoza_single_product_tabs_as_accordion_output() {
    $accordion_one_at_time = get_theme_mod( 'single_product_tabs_accordion_one_at_time', 1 );
    
	emoza_single_product_tab_as_accordion_append_inline_js(); 

    /**
     * Hook 'woocommerce_product_tabs'
     *
     * @since 1.0.0
     */
    $product_tabs = apply_filters( 'woocommerce_product_tabs', array() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound

    if ( ! empty( $product_tabs ) ) : ?>

        <div class="emoza-accordion">
            <?php 
            $counter = 0;
            foreach ( $product_tabs as $key => $product_tab ) : ?>
            <div class="emoza-accordion__item">
                <a href="#" class="emoza-accordion__toggle emoza-collapse-toggle<?php echo ( $counter == 0 ? ' active' : '' ); ?>" data-emoza-collapse="{'enable': true, 'id': 'emoza-accordion-<?php echo esc_attr( $key ); ?>', 'options': { 'oneAtTime': <?php echo ( $accordion_one_at_time ? 'true' : 'false' ); ?>, 'oneAtTimeParentSelector': '.emoza-accordion' }}">
                    <?php 
                    /**
                     * Hook "woocommerce_product_' . $key . '_tab_title"
                     *
                     * @since 1.0.0
                     */
                    echo wp_kses_post( apply_filters( 'woocommerce_product_' . $key . '_tab_title', $product_tab['title'], $key ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?>
                </a>
                <div id="emoza-accordion-<?php echo esc_attr( $key ); ?>" class="emoza-accordion__body emoza-collapse<?php echo ( $counter == 0 ? ' active' : '' ); ?>">
                    <div class="emoza-accordion__body-content emoza-collapse__content">
                        <?php
                        if ( isset( $product_tab['callback'] ) ) {
                            call_user_func( $product_tab['callback'], $key, $product_tab );
                        } ?>
                    </div>
                </div>
            </div>
            <?php 
            ++$counter;
            endforeach; ?>

            <?php 
            /**
             * Hook 'woocommerce_product_after_tabs'
             *
             * @since 1.0.0
             */
            do_action( 'woocommerce_product_after_tabs' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?>
        </div>

    <?php endif; ?>

    <?php
}