<?php
/**
 * Pro upsell options
 *
 * @package Emoza
 */

/**
 * Main Header
 */
$emoza_controls_general     = json_decode( $wp_customize->get_control( 'emoza_main_header_tabs' )->controls_general );
$emoza_new_controls_general = array( '#customize-control-emoza_upsell_main_header' );
$wp_customize->get_control( 'emoza_main_header_tabs' )->controls_general = wp_json_encode( array_merge( $emoza_controls_general, $emoza_new_controls_general ) );

$wp_customize->add_setting( 
    'emoza_upsell_main_header',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Emoza_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_main_header',
        array(
            'title'         => esc_html__( 'More header options available with Emoza Pro.', 'emoza-woocommerce' ),
            'features_list' => array(
                esc_html__( 'Render HTML content', 'emoza-woocommerce' ),
                esc_html__( 'Render shortcode content', 'emoza-woocommerce' ),
                esc_html__( 'Polylang/WPML language switcher', 'emoza-woocommerce' ),
            ),
            'section'     => 'emoza_section_main_header',
            'priority'    => 999,
        )
    ) 
);

/**
 * Header Image
 */
$wp_customize->add_setting( 
    'emoza_upsell_header_image',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Emoza_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_header_image',
        array(
            'title'         => esc_html__( 'More header image options available with Emoza Pro.', 'emoza-woocommerce' ),
            'features_list' => array(
                esc_html__( 'Display shop category image', 'emoza-woocommerce' ),
                esc_html__( 'Page level options to control the image', 'emoza-woocommerce' ),
            ),
            'section'       => 'header_image',
            'priority'      => 999,
        )
    ) 
);

/**
 * Typography General Section
 */
$wp_customize->add_setting( 
    'emoza_upsell_typography_general',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Emoza_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_typography_general',
        array(
            'title'         => esc_html__( 'Create your own custom Fonts Library with Emoza Pro!', 'emoza-woocommerce' ),
            'sub_title'     => esc_html__( 'You can upload your favorite fonts in the following formats:', 'emoza-woocommerce' ),
            'features_list' => array(
                '.woff2',
                '.woff',
                '.ttf',
                '.eot',
                '.otf',
                '.svg',
            ),
            'features_list_last_item_text' => array(
                'text_before_link' => esc_html__( 'Plus, Unlock all features', 'emoza-woocommerce' ),
                'link_text'        => esc_html__( 'many other premium features!', 'emoza-woocommerce' ),
            ),
            'section'       => 'emoza_section_typography_general',
            'priority'      => 999,
        )
    ) 
);

/**
 * Site Layout
 */
$wp_customize->add_setting( 
    'emoza_upsell_site_layout',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Emoza_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_site_layout',
        array(
            'title'         => esc_html__( 'Switch to a different site layout with Emoza Pro!', 'emoza-woocommerce' ),
            'sub_title'     => esc_html__( 'Unlock all the following layouts:', 'emoza-woocommerce' ),
            'features_list' => array(
                esc_html__( 'Boxed', 'emoza-woocommerce' ),
                esc_html__( 'Padded', 'emoza-woocommerce' ),
                esc_html__( 'Fluid', 'emoza-woocommerce' ),
            ),
            'features_list_last_item_text' => array(
                'text_before_link' => esc_html__( 'Plus, you\'ll get access to', 'emoza-woocommerce' ),
                'link_text'        => esc_html__( 'many other premium features!', 'emoza-woocommerce' ),
            ),
            'section'       => 'emoza_section_layout',
            'priority'      => 999,
        )
    ) 
);

/**
 * Blog Single
 */
$emoza_controls_general     = json_decode( $wp_customize->get_control( 'emoza_blog_single_tabs' )->controls_general );
$emoza_new_controls_general = array( '#customize-control-emoza_upsell_blog_single' );
$wp_customize->get_control( 'emoza_blog_single_tabs' )->controls_general = wp_json_encode( array_merge( $emoza_controls_general, $emoza_new_controls_general ) );

$wp_customize->add_setting( 
    'emoza_upsell_blog_single',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Emoza_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_blog_single',
        array(
            'title'         => esc_html__( 'Improve the user experience of your blog posts with Emoza Pro!', 'emoza-woocommerce' ),
            'features_list' => array(
                esc_html__( 'A reading time estimator', 'emoza-woocommerce' ),
                esc_html__( 'A reading progress bar', 'emoza-woocommerce' ),
                esc_html__( 'Table of contents', 'emoza-woocommerce' ),
                esc_html__( 'Social share buttons', 'emoza-woocommerce' ),
            ),
            'section'       => 'emoza_section_blog_singles',
            'priority'      => 999,
        )
    ) 
);

if( class_exists( 'Woocommerce' ) ) {

    /**
     * Woocommerce Single Tabs Section
     */
    $wp_customize->add_setting( 
        'emoza_upsell_single_product_tabs',
        array(
            'default'           => '',
            'sanitize_callback' => 'emoza_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Emoza_Upsell_Message( 
            $wp_customize, 
            'emoza_upsell_single_product_tabs',
            array(
                'title'         => esc_html__( 'Single product tabs options available with Emoza Pro.', 'emoza-woocommerce' ),
                'features_list' => array(
                    esc_html__( 'More positions to display the tabs', 'emoza-woocommerce' ),
                    esc_html__( '5+ layout variations', 'emoza-woocommerce' ),
                ),
                'section'     => 'emoza_section_single_product_tabs',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Shop Archive Layout Section
     */
    $wp_customize->add_setting( 
        'emoza_upsell_shop_archive_layout',
        array(
            'default'           => '',
            'sanitize_callback' => 'emoza_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Emoza_Upsell_Message( 
            $wp_customize, 
            'emoza_upsell_shop_archive_layout',
            array(
                'title'         => esc_html__( 'Increase the conversion rate of your product catalog with Emoza Pro!', 'emoza-woocommerce' ),
                'features_list' => array(
                    esc_html__( 'Wishlist buttons', 'emoza-woocommerce' ),
                    esc_html__( 'Off-canvas sidebar filters', 'emoza-woocommerce' ),
                    esc_html__( 'Extra shop header styles', 'emoza-woocommerce' ),
                    esc_html__( '\'Load more\' pagination', 'emoza-woocommerce' ),
                    esc_html__( 'Product spacing control', 'emoza-woocommerce' ),
                ),
                'section'     => 'woocommerce_product_catalog',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Shop Archive Product Card Section
     */
    $wp_customize->add_setting( 
        'emoza_upsell_shop_archive_product_card',
        array(
            'default'           => '',
            'sanitize_callback' => 'emoza_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Emoza_Upsell_Message( 
            $wp_customize, 
            'emoza_upsell_shop_archive_product_card',
            array(
                'title'         => esc_html__( 'Make your product cards more engaging with Emoza Pro!', 'emoza-woocommerce' ),
                'features_list' => array(
                    esc_html__( 'A quantity picker', 'emoza-woocommerce' ),
                    esc_html__( 'An in-cart quantity counter', 'emoza-woocommerce' ),
                    esc_html__( 'A product stock status label', 'emoza-woocommerce' ),
                    esc_html__( 'Custom fields added with the ACF plugin', 'emoza-woocommerce' ),
                    esc_html__( 'A cool product image swap effect', 'emoza-woocommerce' ),
                ),
                'section'     => 'emoza_section_shop_archive_product_card',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Cart
     */
    $wp_customize->add_setting( 
        'emoza_upsell_cart',
        array(
            'default'           => '',
            'sanitize_callback' => 'emoza_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Emoza_Upsell_Message( 
            $wp_customize, 
            'emoza_upsell_cart',
            array(
                'title'         => esc_html__( 'Deliver a better cart experience with Emoza Pro!', 'emoza-woocommerce' ),
                'features_list' => array(
                    esc_html__( 'Additional cart table styles', 'emoza-woocommerce' ),
                    esc_html__( 'A stylish \'Continue shopping\' button', 'emoza-woocommerce' ),
                    esc_html__( 'Off-canvas side mini cart functionality', 'emoza-woocommerce' ),
                    esc_html__( 'A floating mini cart icon', 'emoza-woocommerce' ),
                    esc_html__( 'An option to show a quantity picker inside the mini cart', 'emoza-woocommerce' ),
                ),
                'section'     => 'emoza_section_shop_cart',
                'priority'    => 999,
            )
        ) 
    );

    /**
     * Woocommerce Checkout
     */
    $wp_customize->add_setting( 
        'emoza_upsell_checkout',
        array(
            'default'           => '',
            'sanitize_callback' => 'emoza_sanitize_text',
        )
    );

    $wp_customize->add_control( 
        new Emoza_Upsell_Message( 
            $wp_customize, 
            'emoza_upsell_checkout',
            array(
                'title'         => esc_html__( 'Make the checkout process easier than ever with Emoza Pro!', 'emoza-woocommerce' ),
                'features_list' => array(
                    esc_html__( 'A one-step checkout layout', 'emoza-woocommerce' ),
                    esc_html__( 'A Shopify-like checkout layout', 'emoza-woocommerce' ),
                    esc_html__( 'A multi-step checkout layout', 'emoza-woocommerce' ),
                    esc_html__( 'An option to show a quantity picker on the checkout page', 'emoza-woocommerce' ),
                    esc_html__( 'A distraction-free checkout page', 'emoza-woocommerce' ),
                ),
                'section'     => 'woocommerce_checkout',
                'priority'    => 999,
            )
        ) 
    );
    
}

/**
 * Menus
 */
$wp_customize->add_section( 
    new Emoza_Section_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_menus',
        array(
            'title'         => esc_html__( 'Create more complex menus with Emoza Pro!', 'emoza-woocommerce' ),
            'features_list' => array(
                esc_html__( 'A mega menu module', 'emoza-woocommerce' ),
                esc_html__( 'A \'Primary Mobile Menu\' location', 'emoza-woocommerce' ),
                esc_html__( 'A \'Secondary Mobile Menu\' location', 'emoza-woocommerce' ),
                esc_html__( 'A \'Footer Copyright Menu\' location', 'emoza-woocommerce' ),
            ),
            'panel'         => 'nav_menus',
            'priority'      => 999,
        )
    ) 
);

/**
 * Footer Copyright
 */
$emoza_controls_general     = json_decode( $wp_customize->get_control( 'emoza_footer_credits_tabs' )->controls_general );
$emoza_new_controls_general = array( '#customize-control-emoza_upsell_footer_copyright' );
$wp_customize->get_control( 'emoza_footer_credits_tabs' )->controls_general = wp_json_encode( array_merge( $emoza_controls_general, $emoza_new_controls_general ) );

$wp_customize->add_setting( 
    'emoza_upsell_footer_copyright',
	array(
		'default'           => '',
		'sanitize_callback' => 'emoza_sanitize_text',
	)
);

$wp_customize->add_control( 
    new Emoza_Upsell_Message( 
        $wp_customize, 
        'emoza_upsell_footer_copyright',
        array(
            'title'   => __( 'More footer copyright options available in PRO version.', 'emoza-woocommerce' ),
            'display_thumb' => false, 
            'section'       => 'emoza_section_footer_credits',
            'priority'      => 999,
        )
    ) 
);

/**
 * Upsell Sections
 * Sections that are not clickable
 */

// Main Panel

// Custom Sidebar
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_sidebar',
        array(
            'title'         => esc_html__( 'Custom Sidebar', 'emoza-woocommerce' ),
            'priority'      => 30,
        )
    ) 
);

// Product Swatches
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_product_swatches',
        array(
            'title'         => esc_html__( 'Variation Swatch', 'emoza-woocommerce' ),
            'priority'      => 150,
        )
    ) 
);

// Add To Cart Notifications
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_adtcnotif',
        array(
            'title'         => esc_html__( 'Add To Cart Notifications', 'emoza-woocommerce' ),
            'priority'      => 152,
        )
    ) 
);

// Free Shipping Progress Bar
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_free_shipping_progress_bar',
        array(
            'title'         => esc_html__( 'Free Shipping Progress Bar', 'emoza-woocommerce' ),
            'priority'      => 152,
        )
    ) 
);

// Breadcrumbs Module
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_breadcrumbs',
        array(
            'title'         => esc_html__( 'Advanced Breadcrumbs', 'emoza-woocommerce' ),
            'priority'      => 80,
        )
    ) 
);

// Buy Now
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_buy_now',
        array(
            'title'         => esc_html__( 'Buy Now', 'emoza-woocommerce' ),
            'priority'      => 151,
        )
    ) 
);

// Modal Popup
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_modal_popup',
        array(
            'title'         => esc_html__( 'Modal Popup', 'emoza-woocommerce' ),
            'priority'      => 185,
        )
    ) 
);

// Quick Links
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_quicklinks',
        array(
            'title'         => esc_html__( 'Quick Links', 'emoza-woocommerce' ),
            'priority'      => 85,
        )
    ) 
);

// Wishlist
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_wishlist',
        array(
            'title'         => esc_html__( 'Wishlist', 'emoza-woocommerce' ),
            'priority'      => 149,
        )
    ) 
);

// Single Product Panel

// Size Chart
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_single_product_size_chart',
        array(
            'title'         => esc_html__( 'Size Chart', 'emoza-woocommerce' ),
            'panel'         => 'emoza_panel_single_product',
        )
    ) 
);

// Advanced Reviews
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_single_product_advanced_reviews',
        array(
            'title'         => esc_html__( 'Advanced Reviews', 'emoza-woocommerce' ),
            'panel'         => 'emoza_panel_single_product',
        )
    ) 
);

// Sticky Add To Cart
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_single_product_sticky_add_to_cart',
        array(
            'title'         => esc_html__( 'Sticky Add To Cart', 'emoza-woocommerce' ),
            'panel'         => 'emoza_panel_single_product',
        )
    ) 
);

// Linked Variations
$wp_customize->add_section( 
    new Emoza_Section_Upsell( 
        $wp_customize, 
        'emoza_section_single_product_linked_variations',
        array(
            'title'         => esc_html__( 'Linked Variations', 'emoza-woocommerce' ),
            'panel'         => 'emoza_panel_single_product',
        )
    ) 
);

// Extensions

// Hooks
$wp_customize->add_panel(
	new Emoza_Panel_Upsell(
		$wp_customize,
		'emoza_panel_hooks',
		array(
			'title'       => esc_html__( 'Hooks', 'emoza-woocommerce' ),
			'description' => esc_html__( 'Render custom content in multiples areas across the website.', 'emoza-woocommerce' ),
			'priority'    => 190,
		)
	)
);