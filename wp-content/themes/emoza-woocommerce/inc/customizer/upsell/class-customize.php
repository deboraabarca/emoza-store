<?php
/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 */
final class Emoza_Customize_Upsell {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self();
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	private function setup_actions() {

		if( defined( 'EMOZA_WL_ACTIVE' ) ) {
			return;
		}

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/upsell/section-pro.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

		// Register custom section types.
		$manager->register_section_type( 'Emoza_Customize_Upsell_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Emoza_Customize_Upsell_Section_Pro(
				$manager,
				'emoza_upsell',
				array(
					'pro_text' => esc_html__( 'View Pro Features',  'emoza-woocommerce' ),
					'pro_url'  => 'https://emoza.org?utm_source=theme_customizer&utm_medium=emoza_customizer&utm_campaign=Emoza',
					'priority' => -999,
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'emoza-upsell-customize-controls', trailingslashit( get_template_directory_uri() ) . 'inc/customizer/upsell/customize-controls.js', array( 'customize-controls' ), EMOZA_VERSION, false );
	}
}

// Doing this customizer thang!
Emoza_Customize_Upsell::get_instance();
