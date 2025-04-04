<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @package    Emoza Starter Sites
 * @subpackage Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Emoza_Starter_Sites' ) ) {
	/**
	 * Main Core Class
	 */
	class Emoza_Starter_Sites {

		/**
		 * The theme name
		 *
		 * @var array $theme.
		 */
		public $theme = '';

		/**
		 * Initial
		 */
		public function init() {

			// Includes.
			require_once EMWC_PATH . 'core/classes/class-demos.php';
			require_once EMWC_PATH . 'core/classes/class-widget-importer.php';
			require_once EMWC_PATH . 'core/classes/class-customizer-importer.php';
			require_once EMWC_PATH . 'core/classes/class-importer.php';
			require_once EMWC_PATH . 'core/classes/class-core-helpers.php';

			// Actions.
			add_action( 'plugins_loaded', array( $this, 'theme_configs' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ), 15 );
		}

		/**
		 * Load theme config files
		 */
		public function theme_configs() {

			$theme  = wp_get_theme();
			$parent = ( get_template_directory() !== get_stylesheet_directory() && $theme->parent() ) ? $theme->parent() : $theme;

			if ( 'Emoza WooCommerce' === $theme->name || 'Emoza WooCommerce' === $parent->name 
				|| 'Emoza WooCommerce Pro' === $theme->name || 'Emoza WooCommerce Pro' === $parent->name ) {
				require_once EMWC_PATH . 'core/themes/emoza-woocommerce.php';
			}

		}

		/**
		 * This function will register scripts and styles for admin dashboard.
		 *
		 * @param string $page Current page.
		 */
		public function admin_enqueue_scripts( $page ) {
			if( ! empty( $page ) && $page !== 'appearance_page_emoza-dashboard' && $page !== 'toplevel_page_emoza-dashboard' ) {
				return;
			}

			// Demos.
			$demos = apply_filters( 'emwc_register_demos_list', array() );

			if ( ! empty( $demos ) ) {
				foreach ( $demos as $demo_id => $demo ) {
					unset( $demos[ $demo_id ]['import'] );
				}
			}

			// Settings.
			$settings = apply_filters( 'emwc_register_demos_settings', array() );

			// Tooltips.
			$tooltips = apply_filters( 'emwc_register_customize_tooltips', array() );

			// Theme.
			$theme = wp_get_theme();
			$theme = ( get_template_directory() !== get_stylesheet_directory() && $theme->parent() ) ? $theme->parent() : $theme;

			wp_enqueue_script( 'emoza-starter-sites-pickr', EMWC_URL . 'core/assets/js/pickr.min.js', array(), '1.0.0', true );

			wp_enqueue_media();

			wp_enqueue_script( 'emoza-starter-sites-core', EMWC_URL . 'core/assets/js/script.min.js', array( 'jquery', 'wp-util', 'underscore' ), EMWC_VERSION, true );			

			$seconds = '{0}'; // Placeholder for the dynamic value
			$theme_name = $theme->name; // Dynamic theme name

			// Translation string with placeholders
			$translated_text = sprintf(
				esc_html__('I just built my website in %s seconds with the %s theme by @emozadotorg. It was so easy!', 'emoza-starter-sites'),
				$seconds,
				$theme_name
			);

			wp_localize_script( 'emoza-starter-sites-core', 'emwc_localize', array(
				'ajax_url'          => admin_url( 'admin-ajax.php' ),
				'plugin_url'        => EMWC_URL,
				'nonce'             => wp_create_nonce( 'nonce' ),
				'demos'             => $demos,
				'theme_name'        => $theme->name,
				'imported'          => get_option( 'emwc_current_starter', '' ),
				'settings'          => $settings,
				'tooltips'			=> $tooltips,
				'i18n'              => array(
					'import_failed'   => esc_html__( 'Something went wrong, contact support.', 'emoza-starter-sites' ),
					'import_finished' => esc_html__( 'Finished!', 'emoza-starter-sites' ),
					'invalid_email'   => esc_html__( 'Enter a valid email address!', 'emoza-starter-sites' ),
					'tweet_text'      => $translated_text,
				),
			) );

			// Select2.
			wp_enqueue_style( 'emoza-starter-sites-core', EMWC_URL . 'core/assets/css/style.min.css', array(), EMWC_VERSION );

		}

		public function current_starter( $theme, $demo_id ) {

			$current = get_option( 'emwc_current_starter' );

			if ( $current === $demo_id ) {
				return false;
			}
			
			/*wp_remote_get( add_query_arg( array( 'theme' => $theme, 'demo_id' => $demo_id ), 'https://www.emoza.org/reports/starters.php' ),
				array(
					'timeout'    => 30,
					'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . ';'
				)
			);*/

			update_option( 'emwc_current_starter', $demo_id );

		}

	}

	/**
	 * The main function responsible for returning the one true emwc Instance to functions everywhere.
	 * Use this function like you would a global variable, except without needing to declare the global.
	 *
	 * Example: $emwc = emwc();
	 */
	function emwc() {

		// Globals.
		global $emwc_instance;

		// Init.
		if ( ! isset( $emwc_instance ) ) {
			$emwc_instance = new Emoza_Starter_Sites();
			$emwc_instance->init();
		}

		return $emwc_instance;
	}

	// Initialize.
	emwc();

}