<?php
/**
 * Emoza Customizer Panel Upsell
 *
 * @package Emoza
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Emoza_Panel_Upsell extends WP_Customize_Panel {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'emoza-panel-upsell';

    /**
	 * An Underscore (JS) template for rendering this section.
	 *
	 * Class variables for this section class are available in the `data` JS object;
	 * export custom variables by overriding WP_Customize_Section::json().
	 *
	 * @since 4.3.0
	 *
	 * @see WP_Customize_Section::print_template()
	 */
	protected function render_template() {
		?>
        <li id="accordion-panel-{{ data.id }}" class="accordion-section control-section control-panel control-panel-{{ data.type }}">
			<h3 class="accordion-section-title" tabindex="0">
				{{ data.title }}
				<span class="screen-reader-text"><?php echo esc_html__( 'Press return or enter to open this panel', 'emoza-woocommerce' ); ?></span>
                <span class="emoza-pro-badge"><?php echo esc_html__( 'PRO', 'emoza-woocommerce' ); ?></span>
				<span class="emoza-pro-lock-icon">
					<span class="dashicons dashicons-lock"></span>
				</span>
			</h3>
			<ul class="accordion-sub-container control-panel-content"></ul>
		</li>
		<?php
	}
}
