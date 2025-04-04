<?php
/**
 * Emoza Customizer Section
 *
 * @package Emoza
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Emoza_Section_Hidden extends WP_Customize_Section {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'emoza-section-hidden';
}
