<?php
/**
 * Alpha color control
 *
 * @package Emoza
 */

class Emoza_Alpha_Color extends WP_Customize_Control {

	public $type = 'emoza-alpha-color';

	public $remove_bordertop = false;

	public function enqueue() {
		wp_enqueue_script( 'emoza-pickr', get_template_directory_uri() . '/assets/vendor/pickr/pickr.min.js', array( 'jquery' ), '1.8.2', true );
	}

	public function render_content() {
		?>
			<div class="emoza-color-control<?php echo ( $this->remove_bordertop ) ? ' border-top-none' : ''; ?>">
				<?php if ( $this->label ) { ?>
					<div class="emoza-color-title"><?php echo esc_html( $this->label ); ?></div>
				<?php } ?>
				<div class="emoza-color-picker" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" style="background-color: <?php echo esc_attr( $this->value() ); ?>;"></div>
				<input type="text" value="<?php echo esc_attr( $this->value() ); ?>" class="emoza-color-input" <?php $this->link(); ?> />
			</div>
		<?php 
	}
}

class Emoza_Alpha_Color_Border_Bottom extends Emoza_Alpha_Color {
	public $type = 'emoza-alpha-color emoza-alpha-color-border-bottom';
}