<?php
/**
 * Plugin Name:       Emoza Starter Sites
 * Description:       Starter Sites for Emoza WooCommerce
 * Version:           1.0.1
 * Author:            Emoza
 * Author URI:        https://emoza.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       emoza-starter-sites
 * Domain Path:       /languages
 *
 * @link              https://emoza.org
 * @package           Emoza Starter Sites
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Variables
 */
define( 'EMWC_VERSION', '1.0.1' );
define( 'EMWC_URL', plugin_dir_url( __FILE__ ) );
define( 'EMWC_PATH', plugin_dir_path( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
$theme = wp_get_theme();
$theme = ( get_template_directory() !== get_stylesheet_directory() && $theme->parent() ) ? $theme->parent() : $theme;

/**
 * Load Core
 */
require_once EMWC_PATH . '/core/classes/class-core.php';

/**
 * Plugin Activation.
 *
 * @param bool $networkwide The networkwide.
 */
function emwc_plugin_activation( $networkwide ) {
	do_action( 'emwc_plugin_activation', $networkwide );
}
register_activation_hook( __FILE__, 'emwc_plugin_activation' );

/**
 * Plugin Deactivation.
 *
 * @param bool $networkwide The networkwide.
 */
function emwc_plugin_deactivation( $networkwide ) {
	do_action( 'emwc_plugin_deactivation', $networkwide );
}
register_deactivation_hook( __FILE__, 'emwc_plugin_deactivation' );

/**
 * Language
 */
load_plugin_textdomain( 'emoza-starter-sites', false, plugin_basename( EMWC_PATH ) . '/languages' );