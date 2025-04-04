<?php
/**
 * Emoza Accordion Control
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Emoza_Accordion_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 */
	public $type  = 'emoza-accordion';
    public $until = '';

    /**
     * Displays the control content.
     *
     */
    public function render_content() {
    ?>
        <a href="#" class="emoza-accordion-title" data-until="<?php echo esc_attr( $this->until ); ?>"><?php echo esc_html( $this->label ); ?></a>  
    <?php 
    }
}
