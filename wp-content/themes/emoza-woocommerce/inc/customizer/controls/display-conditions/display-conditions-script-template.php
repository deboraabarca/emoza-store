<?php
/**
 * Display conditions script template
 *
 * @package Emoza
 */

function emoza_customizer_display_conditions_script_template() {
	emoza_display_conditions_script_template();
}
add_action( 'customize_controls_print_footer_scripts', 'emoza_customizer_display_conditions_script_template' );
