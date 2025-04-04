<?php
/**
 * Emoza WP-CLI commands.
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! defined( 'WP_CLI' ) ) {
	return;
}

if ( ! WP_CLI ) {
	return;
}

class Emoza_WP_CLI {

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		add_action( 'cli_init', array( $this, 'regenerate_custom_css' ) );
	}

	/**
	 * Regenerate custom CSS.
	 * Regenerates the dynamic custom css file from the theme.
	 * 
	 * @return void
	 */
	public function regenerate_custom_css() {
		WP_CLI::add_command( 'em-custom-css', function(){
			$custom_css = new Emoza_Custom_CSS();
			$custom_css->update_custom_css_file();

			WP_CLI::success( 'Custom CSS regenerated.' );
		} );
	}
}

new Emoza_WP_CLI();
