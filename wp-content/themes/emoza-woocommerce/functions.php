<?php
/**
 * Emoza functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Emoza
 */

if ( ! defined( 'EMOZA_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'EMOZA_VERSION', '1.1.3' );
}

/**
 * Loads the Emoza SDK if it's available.
 */
if ( file_exists( get_stylesheet_directory() . '/emoza-pro/emoza-sdk/start.php' ) ) {
    if ( ! function_exists( 'ew_fs' ) ) {
        // Create a helper function for easy SDK access.
        function ew_fs() {
            global $ew_fs;

            if ( ! isset( $ew_fs ) ) {
                // Include Freemius SDK.
                require_once get_stylesheet_directory() . '/emoza-pro/emoza-sdk/start.php';

                $ew_fs = fs_dynamic_init( array(
                    'id'                  => '16914',
                    'slug'                => 'emoza-woocommerce-premium',
                    'type'                => 'theme',
                    'public_key'          => 'pk_903b7e5abd79767b7313e0665f941',
                    'is_premium'          => true,
                    // If your theme is a serviceware, set this option to false.
                    'has_premium_version' => true,
                    'has_addons'          => false,
                    'has_paid_plans'      => true,
                    'menu'                => array(
                        'slug'           => 'emoza-dashboard',
                        'support'        => false,
                    ),
                ) );
            }

            return $ew_fs;
        }

        // Init Freemius.
        ew_fs();
        // Signal that SDK was initiated.
        do_action( 'ew_fs_loaded' );
    }
}

/**
 * Loads the Emoza Pro if it's available.
 */
if ( file_exists( get_stylesheet_directory() . '/emoza-pro/emoza-pro.php' ) ) {
    require_once get_stylesheet_directory() . '/emoza-pro/emoza-pro.php';
}

/**
 * Declare incompatibility with WooCommerce 8.3+ new default cart and checkout blocks.
 * 
 */
add_action( 'plugins_loaded', function(){
	add_action( 'before_woocommerce_init', function() {
		if ( class_exists( '\Automattic\WooCommerce\Utilities\FeaturesUtil' ) ) {
			\Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility( 'cart_checkout_blocks', __FILE__, false );
		}
	} );
} );

if ( ! function_exists( 'emoza_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function emoza_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Emoza, use a find and replace
		 * to change 'emoza-woocommerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'emoza-woocommerce', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'emoza-extra-large', 1140, 9999 );
		add_image_size( 'emoza-large', 920, 9999 );
		add_image_size( 'emoza-big', 575, 9999 );
		add_image_size( 'emoza-medium', 380, 9999 );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary'   => esc_html__( 'Primary', 'emoza-woocommerce' ),
				'secondary' => esc_html__( 'Secondary Menu', 'emoza-woocommerce' ),
			)
		);

		/*
		 * Add post formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'status',
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',

			/**
			 * Hook 'emoza_custom_background_args'
			 * 
			 * @since 1.0.0
			 */
			apply_filters(
				'emoza_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		/**
		 * Wide alignments
		 *
		 */     
		add_theme_support( 'align-wide' );

		/**
		 * Color palettes
		 */
		$selected_palette   = get_theme_mod( 'color_palettes', 'palette1' );
		$palettes           = emoza_global_color_palettes();

		$colors = array();
		
		$custom_palette_toggle = get_theme_mod( 'custom_palette_toggle', 0 );
		if( $custom_palette_toggle ) {
			for ( $i = 0; $i < 8; $i++ ) {
				$colors[] = array(
					/* translators: %s: color palette */
					'name'  => sprintf( esc_html__( 'Color %s', 'emoza-woocommerce' ), ($i+1) ),
					'slug'  => 'color-' . $i,
					'color' => get_theme_mod( 'custom_color' . ($i+1), '#212121' ),
				);
			}
		} else {
			for ( $i = 0; $i < 8; $i++ ) { 
				$colors[] = array(
					/* translators: %s: color palette */
					'name'  => sprintf( esc_html__( 'Color %s', 'emoza-woocommerce' ), ($i+1) ),
					'slug'  => 'color-' . $i,
					'color' => $palettes[$selected_palette][$i],
				);
			}
		}

		add_theme_support(
			'editor-color-palette',
			$colors
		);  
		
		/**
		 * Editor font sizes
		 */
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => esc_html__( 'Small', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'S', 'Font size', 'emoza-woocommerce' ),
					'size'      => 14,
					'slug'      => 'small',
				),              
				array(
					'name'      => esc_html__( 'Normal', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'N', 'Font size', 'emoza-woocommerce' ),
					'size'      => 16,
					'slug'      => 'normal',
				),
				array(
					'name'      => esc_html__( 'Large', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'emoza-woocommerce' ),
					'size'      => 18,
					'slug'      => 'large',
				),
				array(
					'name'      => esc_html__( 'Larger', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'L', 'Font size', 'emoza-woocommerce' ),
					'size'      => 24,
					'slug'      => 'larger',
				),
				array(
					'name'      => esc_html__( 'Extra large', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'XL', 'Font size', 'emoza-woocommerce' ),
					'size'      => 32,
					'slug'      => 'extra-large',
				),
				array(
					'name'      => esc_html__( 'Huge', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'XXL', 'Font size', 'emoza-woocommerce' ),
					'size'      => 48,
					'slug'      => 'huge',
				),
				array(
					'name'      => esc_html__( 'Gigantic', 'emoza-woocommerce' ),
					'shortName' => esc_html_x( 'XXXL', 'Font size', 'emoza-woocommerce' ),
					'size'      => 64,
					'slug'      => 'gigantic',
				),
			)
		);      

		/**
		 * Responsive embeds
		 */
		add_theme_support( 'responsive-embeds' );

		/**
		 * Page templates with blocks
		 */
		add_theme_support( 'block-templates' );

		/**
		 * Appearance tools.
		 */
		add_theme_support( 'appearance-tools' );
	}
endif;
add_action( 'after_setup_theme', 'emoza_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function emoza_content_width() {
	/**
	 * Hook 'emoza_content_width'
	 *
	 * @since 1.0.0
	 */
	$GLOBALS['content_width'] = apply_filters( 'emoza_content_width', 1140 ); // phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
}
add_action( 'after_setup_theme', 'emoza_content_width', 0 );

/**
 * Include the TGM Plugin Activation class for use third-party plugins.
 */
//require_once get_template_directory() . '/inc/classes/class-tgm-plugin-activation.php';

/**
 * Register the required plugins for the Emoza theme.
 *
 * This function is hooked into 'tgmpa_register', which is triggered within the
 * TGM_Plugin_Activation class, ensuring that the required plugins are installed
 * and activated when the theme is activated.
 */
function emoza_register_required_plugins() {
    // Array of plugins that our theme requires.
    $plugins = array(
        array(
            'name'               => 'Emoza Starter Sites', // The plugin name.
            'slug'               => 'emoza-starter-sites', // The plugin slug (typically the folder name).
            'required'           => true, // If false, the plugin is only 'recommended' instead of required.
            'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => 'https://emoza.org/downloads/emoza-starter-sites-1.0.zip', // Fallback URL if the plugin is not found in the WordPress Plugin Directory.
        ),
        // Add more plugins as needed.
    );

    // Configuration settings for TGM Plugin Activation.
    $config = array(
        'id'           => 'emoza-woocommerce',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                            // Default absolute path to pre-packaged plugins.
        'menu'         => 'tgmpa-install-plugins',       // Menu slug.
        'parent_slug'  => 'themes.php',                  // Parent menu slug.
        'capability'   => 'edit_theme_options',          // Capability needed to view plugin install page.
        'has_notices'  => true,                          // Show admin notices or not.
        'dismissable'  => false,                         // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                            // If 'dismissable' is false, this message will be output at the top of the nag.
        'is_automatic' => true,                          // Automatically activate plugins after installation or not.
        'message'      => '',                            // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}
//add_action('tgmpa_register', 'emoza_register_required_plugins');

/**
 * Check if Kirki is active. If not, display an admin notice and block access to the customizer.
 */
function emoza_show_kirki_required_message() {
    if (!is_plugin_active('kirki/kirki.php') && isset($_GET['page']) && $_GET['page'] === 'tgmpa-install-plugins') {
        echo '<div class="notice notice-warning" style="display:block !important"><p>' . __('The Kirki Customizer Framework plugin is required for the Emoza theme. Please install and activate it to access the Customizer settings.', 'emoza-woocommerce') . '</p></div>';
    }
}
//add_action('admin_notices', 'emoza_show_kirki_required_message');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function emoza_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'emoza-woocommerce' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'emoza-woocommerce' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
			'before_sidebar' => '<div class="sidebar-wrapper"><a href="#" role="button" class="close-sidebar" title="'. esc_attr__( 'Close sidebar', 'emoza-woocommerce' ) .'" onclick="emoza.toggleClass.init(event, this, \'sidebar-slide-close\');" data-emoza-selector=".sidebar-slide+.widget-area" data-emoza-toggle-class="show">'. emoza_get_svg_icon( 'icon-cancel' ) .'</a>',
			'after_sidebar'  => '</div>',
		)
	);

	for ( $i = 1; $i <= 4; $i++ ) { 
		register_sidebar(
			array(
				/* translators: %s = footer widget area number */
				'name'          => sprintf( esc_html__( 'Footer %s', 'emoza-woocommerce' ), $i ),
				'id'            => 'footer-' . $i,
				'description'   => esc_html__( 'Add widgets here.', 'emoza-woocommerce' ),
				'before_widget' => '<section id="%1$s" class="widget %2$s">',
				'after_widget'  => '</section>',
				'before_title'  => '<h2 class="widget-title">',
				'after_title'   => '</h2>',
			)
		);
	}
}
add_action( 'widgets_init', 'emoza_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function emoza_scripts() {
	$fonts_library = get_theme_mod( 'fonts_library', 'google' );
	
	if( $fonts_library === 'google' ) {
		wp_enqueue_style( 'emoza-google-fonts', emoza_google_fonts_url(), array(), emoza_google_fonts_version() );
	} elseif( $fonts_library === 'custom' ) {
		wp_enqueue_style( 'emoza-custom-google-fonts', emoza_custom_google_fonts_url(), array(), emoza_google_fonts_version() );
	} else {
		$kits = get_option( 'emoza_adobe_fonts_kits', array() );

		foreach ( $kits as $kit_id => $kit_data ) {

			if ( $kit_data['enable'] == false ) {
				continue;
			}

			wp_enqueue_style( 'emoza-typekit-' . $kit_id, 'https://use.typekit.net/' . $kit_id . '.css', array(), EMOZA_VERSION );
		}
	}

	wp_enqueue_script( 'emoza-custom', get_template_directory_uri() . '/assets/js/custom.min.js', array(), EMOZA_VERSION, true );
	wp_localize_script( 'emoza-custom', 'emoza', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'settings' => array(
			'misc' => array(
				'dropdowns_hover_delay' => get_option( 'emoza_dropdowns_hover_delay', 'yes' ),
			),
		),
		'i18n'    => array(
			'emoza_sharebox_copy_link' => __( 'Copy link', 'emoza-woocommerce' ),
			'emoza_sharebox_copy_link_copied' => __( 'Copied!', 'emoza-woocommerce' ),
		),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'emoza-carousel', get_template_directory_uri() . '/assets/js/emoza-carousel.min.js', NULL, EMOZA_VERSION, true );
	wp_register_script( 'emoza-popup', get_template_directory_uri() . '/assets/js/emoza-popup.min.js', NULL, EMOZA_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'emoza_scripts', 10 );

/**
 * Enqueue style css
 * Ensure compatibility with Emoza Pro, since pro scripts are enqueued with order "10"
 * We always need the custom.min.css as the last stylesheet enqueued
 * 
 * 'emoza-custom-style' is registered at 'inc/classes/class-emoza-custom-css.php'
 */
function emoza_style_css() {
	wp_enqueue_style( 'emoza-style-min', get_template_directory_uri() . '/assets/css/styles.min.css', array(), EMOZA_VERSION );
	wp_enqueue_style( 'emoza-custom-styles' );
	wp_enqueue_style( 'emoza-style', get_stylesheet_uri(), array(), EMOZA_VERSION );
}
add_action( 'wp_enqueue_scripts', 'emoza_style_css', 12 );

/**
 * Enqueue admin scripts and styles.
 */
function emoza_admin_scripts() {
	wp_register_script( 'emoza-select2', get_template_directory_uri() . '/assets/vendor/select2/select2.full.min.js', array( 'jquery' ), EMOZA_VERSION, false );
	wp_register_style( 'emoza-select2', get_template_directory_uri() . '/assets/vendor/select2/select2.min.css', array(), '4.0.6', 'all' );

	wp_register_script( 'emoza-admin-modal', get_template_directory_uri() . '/assets/js/admin/emoza-admin-modal.min.js', array( 'jquery' ), EMOZA_VERSION, false );
	wp_register_style( 'emoza-admin-modal', get_template_directory_uri() . '/assets/css/admin/emoza-admin-modal.min.css', array(), EMOZA_VERSION, 'all' );

	wp_enqueue_script( 'emoza-admin-functions', get_template_directory_uri() . '/assets/js/admin-functions.min.js', array( 'jquery' ), EMOZA_VERSION, true );
	wp_localize_script( 'emoza-admin-functions', 'emozaadm', array(
		'hfUpdate' => array(
			'confirmMessage' => __( 'Are you sure you want to upgrade your header?', 'emoza-woocommerce' ),
			'errorMessage' => __( 'It was not possible complete the request, please reload the page and try again.', 'emoza-woocommerce' ),
		),
		'hfUpdateDimiss' => array(
			'confirmMessage' => __( 'Are you sure you want to dismiss this notice?', 'emoza-woocommerce' ),
			'errorMessage' => __( 'It was not possible complete the request, please reload the page and try again.', 'emoza-woocommerce' ),
		),                      
	) );
}
add_action( 'admin_enqueue_scripts', 'emoza_admin_scripts' );

/**
 * Page Templates.
 */
function emoza_remove_page_templates( $page_templates ) {
	if( ! defined( 'EMOZA_PRO_VERSION' ) ) {
		unset( $page_templates['page-templates/template-wishlist.php'] );
	}
   
	return $page_templates;
}
add_filter( 'theme_page_templates', 'emoza_remove_page_templates' );

/**
 * Helper functions.
 */
require get_template_directory() . '/inc/helpers.php';

/**
 * Deactivate Elementor Wizard.
 */
function emoza_deactivate_ele_onboarding() {
	update_option( 'elementor_onboarded', true );
}
add_action( 'after_switch_theme', 'emoza_deactivate_ele_onboarding' );

/**
 * Modules Class.
 */
require get_template_directory() . '/inc/modules/class-emoza-modules.php';

/**
 * Gutenberg editor.
 */
require get_template_directory() . '/inc/editor.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/plugins/jetpack/jetpack.php';
}

/**
 * Load Max Mega Menu compatibility file.
 */
if ( class_exists( 'Mega_Menu' ) ) {
	require get_template_directory() . '/inc/plugins/max-mega-menu/max-mega-menu.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/plugins/woocommerce/woocommerce.php';
}

/**
 * Load WooCommerce Brands compatibility file.
 */
if ( class_exists( 'WooCommerce' ) && class_exists( 'WC_Brands' ) ) {
	require get_template_directory() . '/inc/plugins/woocommerce-brands/woocommerce-brands.php';
}

/**
 * Load Elementor compatibility file.
 */
if( defined( 'ELEMENTOR_VERSION' ) ) {
	require get_template_directory() . '/inc/plugins/elementor/elementor.php';
}

/**
 * Load Elementor Pro compatibility file.
 */
if( defined( 'ELEMENTOR_PRO_VERSION' ) ) {
	require get_template_directory() . '/inc/plugins/elementor-pro/elementor-pro.php';
}

/**
 * Load Dokan compatibility file.
 */
if( defined( 'DOKAN_PLUGIN_VERSION' ) && class_exists( 'Woocommerce' ) ) {
	require get_template_directory() . '/inc/plugins/dokan/dokan.php';
}

/**
 * Load WC Vendors compatibility file.
 */
if( class_exists( 'WC_Vendors' ) && class_exists( 'Woocommerce' ) ) {
	require get_template_directory() . '/inc/plugins/wc-vendors/wc-vendors.php';
}

/**
 * Load WC Germanized compatibility file.
 */
if( class_exists( 'WooCommerce_Germanized' ) && class_exists( 'Woocommerce' ) ) {
	require get_template_directory() . '/inc/plugins/wc-germanized/class-wc-germanized.php';
}

/**
 * Load WC Germanized EU VAT Compilance compatibility file.
 */
if( class_exists( 'WC_EU_VAT_Compliance' ) && class_exists( 'Woocommerce' ) ) {
	require get_template_directory() . '/inc/plugins/woocommerce-eu-vat-compliance-premium/class-woocommerce-eu-vat-compliance-premium.php';
}

/**
 * Upsell.
 */
if( ! defined( 'EMOZA_PRO_VERSION' ) ) {
	require get_template_directory() . '/inc/customizer/upsell/class-customize.php';
}

/**
 * Theme classes.
 */
require get_template_directory() . '/inc/classes/class-emoza-topbar.php';
require get_template_directory() . '/inc/classes/class-emoza-header.php';
require get_template_directory() . '/inc/classes/class-emoza-footer.php';
require get_template_directory() . '/inc/classes/class-emoza-posts-archive.php';
require get_template_directory() . '/inc/classes/class-emoza-svg-icons.php';
require get_template_directory() . '/inc/classes/class-emoza-metabox.php';
require get_template_directory() . '/inc/classes/class-emoza-custom-css.php';

/**
 * Theme ajax callbacks.
 */
require get_template_directory() . '/inc/ajax-callbacks.php';

/**
 * Legacy composer autoload.
 * Purpose is autoload only needed kirki-framework controls classes. 
 */
require_once get_parent_theme_file_path( 'vendor/kirki/autoload.php' );

/**
 * Theme dashboard.
 */
require get_template_directory() . '/inc/dashboard/class-dashboard.php';

/**
 * Theme dashboard settings.
 */
require get_template_directory() . '/inc/dashboard/class-dashboard-settings.php';

/**
 * Modules.
 */
require get_template_directory() . '/inc/modules/adobe-typekit/adobe-typekit.php';
require get_template_directory() . '/inc/modules/schema-markup/schema-markup.php';

if( defined( 'EMOZA_PRO_VERSION' ) ) {
	if( version_compare( EMOZA_PRO_VERSION, '1.0.0', '>=' ) ) {
		require get_template_directory() . '/inc/modules/hf-builder/class-header-footer-builder.php';
	} else {
		$emoza_all_modules = get_option( 'emoza-modules' );
		$emoza_all_modules = ( is_array( $emoza_all_modules ) ) ? $emoza_all_modules : (array) $emoza_all_modules;
		//update_option( 'emoza-modules', array_merge( $emoza_all_modules, array( 'hf-builder' => false ) ) );
	}
} else {
	require get_template_directory() . '/inc/modules/hf-builder/class-header-footer-builder.php';
}

/**
 * Review notice.
 */
require get_template_directory() . '/inc/notices/class-emoza-review.php';

/**
 * Emoza pro upsell notice.
 */
require get_template_directory() . '/inc/notices/class-emoza-pro-upsell.php';

/**
 * Theme update migration functions.
 */
require get_template_directory() . '/inc/theme-update.php';

/**
 * Register WP-CLI commands.
 */
require get_template_directory() . '/inc/classes/class-emoza-wp-cli.php';

/**
 * Emoza custom get template part
 */
function emoza_get_template_part( $slug, $name = null, $args = array() ) {
	if ( version_compare( get_bloginfo( 'version' ), '5.5', '>=' ) ) {
		return get_template_part( $slug, $name, $args );
	} else {
		extract($args);
	
		$templates = array();
		$name = (string) $name;
		if ( '' !== $name ) {
			$templates[] = "{$slug}-{$name}.php";
		}
		$templates[] = "{$slug}.php";
	 
		return include( locate_template($templates) );
	}
}

   
