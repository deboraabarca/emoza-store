<?php
/**
 * Theme update functions
 * 
 * to do: use version compare
 *
 */

/**
 * Migrate woocommerce options
 */
function emoza_migrate_woo_catalog_columns_and_rows() {
    $flag = get_theme_mod( 'emoza_migrate_woo_catalog_columns_and_rows_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }

    $woocommerce_catalog_columns = get_option( 'woocommerce_catalog_columns', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_columns_desktop', $woocommerce_catalog_columns );

    $woocommerce_catalog_rows = get_option( 'woocommerce_catalog_rows', 4 );
    set_theme_mod( 'shop_woocommerce_catalog_rows', $woocommerce_catalog_rows );

    //Set flag
    set_theme_mod( 'emoza_migrate_woo_catalog_columns_and_rows_flag', true );
}
add_action( 'init', 'emoza_migrate_woo_catalog_columns_and_rows' );

/**
 * Migrate header options
 */
function emoza_migrate_header_mobile_icons() {
    $flag = get_theme_mod( 'emoza_migrate_header_mobile_icons_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }
    
    $default_components = emoza_get_default_header_components();

    $header_components = get_theme_mod( 'header_components', $default_components['l1'] );

    $header_components_mobile = array_map(function ( $value ) {
        return $value === 'woocommerce_icons' ? 'mobile_woocommerce_icons' : $value;
    }, $header_components );
    set_theme_mod( 'header_components_mobile', $header_components_mobile );

    $header_components_offcanvas = array_map(function ( $value ) {
        return $value === 'woocommerce_icons' ? 'mobile_offcanvas_woocommerce_icons' : $value;
    }, $header_components );
    set_theme_mod( 'header_components_offcanvas', $header_components_offcanvas );

    //Set flag
    set_theme_mod( 'emoza_migrate_header_mobile_icons_flag', true );
}
add_action( 'init', 'emoza_migrate_header_mobile_icons' );

/**
 * Header/Footer Builder
 * Enable HF module for new users. 
 * Existing users (from update) will be asked if they want to use new header builder 
 * or continue with old header system.
 * 
 * @since 1.1.0
 */
function emoza_hf_enable_to_new_users( $old_theme_name ) {
	$old_theme_name = strtolower( $old_theme_name );
	if( !get_option( 'emoza-update-hf' ) && strpos( $old_theme_name, 'emoza-woocommerce' ) === FALSE ) {
		update_option( 'emoza-update-hf', true );

        $all_modules = get_option( 'emoza-modules' );
		$all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

		update_option( 'emoza-modules', array_merge( $all_modules, array( 'hf-builder' => true ) ) );
	}
}
add_action('after_switch_theme', 'emoza_hf_enable_to_new_users');

/**
 * Header/Footer Update Notice
 * 
 * @since 1.1.0
 * 
 */
function emoza_hf_update_notice_1_1_9() {
    $theme = wp_get_theme();
    $theme_version = $theme->get( 'Version' );

    if ( version_compare( $theme_version, '1.0.9', '>' ) ) {
        return;
    }

    if ( get_option( 'emoza-update-hf-dismiss' ) ) {
        return;
    }
    
    if ( !get_option( 'emoza-update-hf' ) ) { ?>

    <div class="notice notice-success thd-theme-dashboard-notice-success is-dismissible">
        <h3><?php esc_html_e( 'Emoza Header/Footer Update', 'emoza-woocommerce'); ?></h3>
        <p>
            <?php esc_html_e( 'This version of Emoza comes with a new Header and Footer Builder. Activate it by clicking on the button below and you can access new options.', 'emoza-woocommerce' ); ?>
        </p>
        <p>
            <?php esc_html_e( 'Note 1: This upgrade is optional, there is no need to do it if you are happy with your current header and footer.', 'emoza-woocommerce' ); ?>
        </p>         
        <p>
            <?php esc_html_e( 'Note 2: Your current header and footer customizations will be lost and you will have to use the new options to customize your header and footer.', 'emoza-woocommerce' ); ?>
        </p>   
        <p>
            <?php esc_html_e( 'Note 3: Please take a full backup of your website before upgrading.', 'emoza-woocommerce' ); ?>
        </p>            
        <p>
            <?php 
            /* translators: 1: documentation link. */
            printf( esc_html__( 'Want to see the new header and footer builder before upgrading? Check out our %s.', 'emoza-woocommerce' ), '<a target="_blank" href="https://docs.emoza.org/">documentation</a>' ); ?>
        </p>
        <a href="#" class="button emoza-update-hf" data-nonce="<?php echo esc_attr( wp_create_nonce( 'emoza-update-hf-nonce' ) ); ?>" style="margin-top: 15px;"><?php esc_html_e( 'Update theme header and footer', 'emoza-woocommerce' ); ?></a>
        <a href="#" class="button emoza-update-hf-dismiss" data-nonce="<?php echo esc_attr( wp_create_nonce( 'emoza-update-hf-dismiss-nonce' ) ); ?>" style="margin-top: 15px;"><?php esc_html_e( 'Continue to use the old header and footer system', 'emoza-woocommerce' ); ?></a> 
    </div>
    <?php }
}
add_action( 'admin_notices', 'emoza_hf_update_notice_1_1_9' );

/**
 * Header update ajax callback
 * 
 * @since 1.1.0
 */
function emoza_hf_update_notice_1_1_9_callback() {
	check_ajax_referer( 'emoza-update-hf-nonce', 'nonce' );

	update_option( 'emoza-update-hf', true );

    $all_modules = get_option( 'emoza-modules' );
    $all_modules = ( is_array( $all_modules ) ) ? $all_modules : (array) $all_modules;

    update_option( 'emoza-modules', array_merge( $all_modules, array( 'hf-builder' => true ) ) );

	wp_send_json( array(
		'success' => true,
	) );
}
add_action( 'wp_ajax_emoza_hf_update_notice_1_1_9_callback', 'emoza_hf_update_notice_1_1_9_callback' );

/**
 * Header update ajax callback
 * 
 * @since 1.1.0
 */
function emoza_hf_update_dismiss_notice_1_1_9_callback() {
	check_ajax_referer( 'emoza-update-hf-dismiss-nonce', 'nonce' );

	update_option( 'emoza-update-hf-dismiss', true );

	wp_send_json( array(
		'success' => true,
	) );
}
add_action( 'wp_ajax_emoza_hf_update_dismiss_notice_1_1_9_callback', 'emoza_hf_update_dismiss_notice_1_1_9_callback' );

/**
 * Migrate 'header transparent' and 'header image' old display conditions to the new.
 * Migrate scroll to top offsets.
 * 
 * @since 1.1.0
 */
function emoza_migrate_1_2_1_options() {
    $flag = get_theme_mod( 'emoza_migrate_1_2_1_options_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }

    // Scroll To Top Offsets
    set_theme_mod( 'scrolltop_side_offset_desktop', get_theme_mod( 'scrolltop_side_offset', 30 ) );
    set_theme_mod( 'scrolltop_bottom_offset_desktop', get_theme_mod( 'scrolltop_bottom_offset', 30 ) );

    // Header Transparent
    $header_transparent_display_on = get_theme_mod( 'header_transparent_display_on', 'front-page' );
    $values = explode( ',', $header_transparent_display_on );
    $new_value = array();

    foreach( $values as $val ) {

        if( $val === 'pages' ) {
            $val = 'single-page';
        }

        if( $val === 'blog-archive' ) {
            $val = 'post-archives';
        }

        if( $val === 'blog-posts' ) {
            $val = 'single-post';
        }

        if( $val === 'post-search' ) {
            $val = 'search';
        }

        $new_value[] = array(
            'type'      => 'include',
            'condition' => $val,
            'id'        => null,
        );
    }

    set_theme_mod( 'header_transparent_display_on', wp_json_encode( $new_value ) );

    // Header Image
    $show_header_image_only_home = get_theme_mod( 'show_header_image_only_home', 0 );
    if( $show_header_image_only_home ) {
        set_theme_mod( 'header_image_display_conditions', wp_json_encode( array(
            array(
                'type'      => 'include',
                'condition' => 'front-page',
                'id'        => null,
            ),
        ) ) );
    } else {
        set_theme_mod( 'header_image_display_conditions', wp_json_encode( array(
            array(
                'type'      => 'include',
                'condition' => 'all',
                'id'        => null,
            ),
        ) ) );
    }

    //Set flag
    set_theme_mod( 'emoza_migrate_1_2_1_options_flag', true );
}
add_action( 'init', 'emoza_migrate_1_2_1_options' );

/**
 * Migrate 'size-chart, linked variations, product swatches and video gallery' modules.
 * 
 * @since 1.1.0
 */
function emoza_migrate_2_0_0_modules( $old_theme_name ) {
    $flag = get_theme_mod( 'emoza_migrate_2_0_0_modules_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }

    $modules = get_option( 'emoza-modules', array() );

    // Size charts module.
    $size_chart = get_theme_mod( 'single_size_chart', 0 );
    if ( ! empty( $size_chart ) ) {
        $modules = array_merge( $modules, array( 'size-chart' => true ) );
    }

    // Linked variations module.
    $linked_variations = get_theme_mod( 'single_product_linked_variations', 0 );
    if ( ! empty( $linked_variations ) ) {
        $modules = array_merge( $modules, array( 'linked-variations' => true ) );
    }

    // Product swatches module.
    $product_swatches = get_theme_mod( 'product_swatch', 1 );
    if ( ! empty( $product_swatches ) ) {
        $modules = array_merge( $modules, array( 'product-swatches' => true ) );
    }

    // Modal popup module.
    $modal_popup = get_theme_mod( 'modal_popup_enable', 0 );
    if ( ! empty( $modal_popup ) ) {
        $modules = array_merge( $modules, array( 'modal-popup' => true ) );
    }

    // Local google fonts module.
    $local_google_fonts = get_theme_mod( 'perf_google_fonts_local', 1 );
    if ( ! empty( $local_google_fonts ) && ! isset( $modules['local-google-fonts'] ) ) {
        $modules = array_merge( $modules, array( 'local-google-fonts' => true ) );
    }

    // Sticky add to cart module.
    $sticky_add_to_cart = get_theme_mod( 'single_sticky_add_to_cart', 0 );
    if ( ! empty( $sticky_add_to_cart ) ) {
        $modules = array_merge( $modules, array( 'sticky-add-to-cart' => true ) );
    }

    // Advanced reviews module.
    $advanced_reviews = get_theme_mod( 'single_product_reviews_advanced_enable', 0 );
    if ( ! empty( $advanced_reviews ) ) {
        $modules = array_merge( $modules, array( 'advanced-reviews' => true ) );
    }

    // Login Popup
    $login_popup = get_theme_mod( 'login_register_popup', 0 );
    if ( ! empty( $login_popup ) ) {
        $modules = array_merge( $modules, array( 'login-popup' => true ) );
    }

    // Video gallery module
    if( ! isset( $modules[ 'video-gallery' ] ) ) {
        $modules = array_merge( $modules, array( 'video-gallery' => true ) );
    }

    // Wishlist module
    $wishlist_enabled = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) !== 'layout1' ? true : false;
    if( $wishlist_enabled ) {
        $modules = array_merge( $modules, array( 'wishlist' => true ) );
    }

    // Table of contents module
    if( ! isset( $modules[ 'table-of-contents' ] ) ) {
        $modules = array_merge( $modules, array( 'table-of-contents' => true ) );
    }

    // Custom sidebars module
    $custom_sidebars_enabled = get_theme_mod( 'custom_sidebars', '[]' ) !== '[]' ? true : false;
    if( $custom_sidebars_enabled ) {
        $modules = array_merge( $modules, array( 'custom-sidebars' => true ) );
    }

    // Variations gallery module
    if( ! isset( $modules[ 'variations-gallery' ] ) ) {
        $modules = array_merge( $modules, array( 'variations-gallery' => true ) );
    }

    update_option( 'emoza-modules', $modules );

    //Set flag
    set_theme_mod( 'emoza_migrate_2_0_0_modules_flag', true );
}
add_action( 'admin_init', 'emoza_migrate_2_0_0_modules' );

/**
 * Migrate 'size-chart, linked variations, product swatches and video gallery' modules.
 * 
 * @since 1.1.0
 */
function emoza_migrate_2_1_0_options() {
    $flag = get_theme_mod( 'emoza_migrate_2_1_0_options_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }

    // Migrate the mobile offcanvas old padding to new responsive padding.
    $ehfb_mobile_offcanvas_padding = get_theme_mod( 'ehfb_mobile_offcanvas_padding', 20 );
    if( $ehfb_mobile_offcanvas_padding !== 20 && $ehfb_mobile_offcanvas_padding !== '{ "unit": "px", "linked": false, "top": "20", "right": "20", "bottom": "20", "left": "20" }' ) {
        $padding = $ehfb_mobile_offcanvas_padding;
        $new_value = '{ "unit": "px", "linked": false, "top": "'. $padding .'", "right": "'. $padding .'", "bottom": "'. $padding .'", "left": "'. $padding .'" }';

        set_theme_mod( 'ehfb_mobile_offcanvas_padding_desktop', $new_value );
    }

    //Set flag
    set_theme_mod( 'emoza_migrate_2_1_0_options_flag', true );
}
add_action( 'admin_init', 'emoza_migrate_2_1_0_options' );

/**
 * Migrate size chart options
 * @since 1.1.0
 */
function emoza_migrate_2_0_5_options() {
    $flag = get_theme_mod( 'emoza_migrate_2_0_5_options_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }
    
    // Size Chart
    if( class_exists( 'Emoza_Modules' ) && Emoza_Modules::is_module_active( 'size-chart' ) ) {
        
        // Size Chart Default Colors
        set_theme_mod( 'single_size_chart_title_text_color', get_theme_mod( 'color_link_default', '#212121' ) );
        set_theme_mod( 'single_size_chart_title_text_hover', get_theme_mod( 'color_link_hover', '#757575' ) );
        set_theme_mod( 'single_size_chart_icon_link_color', get_theme_mod( 'color_link_default', '#212121' ) );
        set_theme_mod( 'single_size_chart_icon_link_color_hover', get_theme_mod( 'color_link_hover', '#757575' ) );

        // Size Chart Popup Colors
        set_theme_mod( 'single_size_chart_popup_background_color', get_theme_mod( 'content_cards_background', '#F2F2F2' ) );
        set_theme_mod( 'single_size_chart_popup_close_icon_color', get_theme_mod( 'color_link_default', '#212121' ) );
        set_theme_mod( 'single_size_chart_popup_close_icon_color_hover', get_theme_mod( 'color_link_hover', '#757575' ) );
        set_theme_mod( 'single_size_chart_popup_title_color', get_theme_mod( 'color_heading_4', '#212121' ) );
        set_theme_mod( 'single_size_chart_popup_tabs_color', get_theme_mod( 'color_link_default', '#212121' ) );
        set_theme_mod( 'single_size_chart_popup_tabs_color_hover', get_theme_mod( 'color_link_hover', '#757575' ) );
        set_theme_mod( 'single_size_chart_popup_table_headings_background_color', get_theme_mod( 'color_link_default', '#212121' ) );
        set_theme_mod( 'single_size_chart_popup_table_headings_text_color', get_theme_mod( 'button_color', '#FFF' ) );

    }

    // Slide Sidebar
    if( get_theme_mod( 'shop_archive_sidebar' ) === 'sidebar-slide' ) {

        // Background Color
        set_theme_mod( 'shop_archive_slide_sidebar_background_color', get_theme_mod( 'content_cards_background', '#f5f5f5' ) );

        // Widgets Divider Border Color
        set_theme_mod( 'shop_archive_slide_sidebar_widgets_divider_color', '#d1d1d1' );
        
    }


    //Set flag
    set_theme_mod( 'emoza_migrate_2_0_5_options_flag', true );
}
add_action( 'init', 'emoza_migrate_2_0_5_options' );

/**
 * Migrate quick links options
 * 
 * @since 1.1.0
 */
function emoza_migrate_2_0_7_options() {
    $flag = get_theme_mod( 'emoza_migrate_2_0_7_options_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }
    
    // Quick Links
    if( class_exists( 'Emoza_Modules' ) && Emoza_Modules::is_module_active( 'quick-links' ) ) {
        
        // Set Item Text Color
        set_theme_mod( 'ql_item_text_color', get_theme_mod( 'ql_item_color', '' ) );
        set_theme_mod( 'ql_item_text_color_hover', get_theme_mod( 'ql_item_color_hover', '' ) );

    }

    //Set flag
    set_theme_mod( 'emoza_migrate_2_0_7_options_flag', true );
}
add_action( 'init', 'emoza_migrate_2_0_7_options' );

/**
 * Do not enable new templates builder UI to existing users.
 * 
 * @since 1.1.0
 */
function emoza_templates_builder_new_ui() {
    //$flag = get_theme_mod( 'emoza_templates_builder_new_ui_flag', false );

    //if ( ! empty( $flag ) ) { return; }

    if ( class_exists( 'Emoza_Modules' ) && Emoza_Modules::is_module_active( 'templates' ) ) {
        update_option( 'emoza-legacy-templates-builder', true );
    } else {
        update_option( 'emoza-legacy-templates-builder', false );
    }

    //Set flag
    //set_theme_mod( 'emoza_templates_builder_new_ui_flag', true );
}
add_action( 'init', 'emoza_templates_builder_new_ui' );

/**
 * Accordion style to widgets.
 * The option ID changed from 'shop_accordion_to_widgets' to 'accordion_to_lists' in favor of more general usage throughout the theme.
 * 
 * @since 1.1.0
 */
function emoza_migrate_accordion_style_to_wdigets() {
    $flag = get_theme_mod( 'emoza_migrate_accordion_style_to_wdigets_flag', false );

    if ( ! empty( $flag ) ) {
        return;
    }

    set_theme_mod( 'accordion_to_lists', get_theme_mod( 'shop_accordion_to_widgets', 0 ) );
    set_theme_mod( 'accordion_to_lists_initial_state', get_theme_mod( 'shop_accordion_to_widgets_initial_state', 'expanded' ) );

    //Set flag
    set_theme_mod( 'emoza_migrate_accordion_style_to_wdigets_flag', true );
}
add_action( 'init', 'emoza_migrate_accordion_style_to_wdigets' );