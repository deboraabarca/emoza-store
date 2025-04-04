<?php
/**
 * Adobe Typekit
 *
 * @package Emoza
 */

if ( ! Emoza_Modules::is_module_active( 'adobe-typekit' ) ) {
	return;
}

/**
 * Adobe typekit customize options.
 */
function emoza_adobe_typekit_options( $wp_customize ) {
    require get_template_directory() . '/inc/modules/adobe-typekit/customizer/options.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
}
add_action( 'customize_register', 'emoza_adobe_typekit_options', 999 );
