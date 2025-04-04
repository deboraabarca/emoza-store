<?php
/**
 * Divider control
 *
 * @package Emoza
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Emoza_Divider_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'emoza-divider-control';

	public $check_white_label = false;

	/**
	 * Constructor
	 */
	public function __construct( $manager, $id, $args = array(), $options = array() ) {
		parent::__construct( $manager, $id, $args );
	}

	/**
	 * Render the control in the customizer
	 */
	public function render_content() {
		if( $this->check_white_label && defined( 'EMOZA_WL_ACTIVE' ) ) {
			return '';
		} ?>
		<hr class="emoza-cust-divider">
	<?php
	}
}
