<?php
/**
 * Custom fonts control
 *
 * @package Emoza
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Emoza_Custom_Fonts_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'emoza-custom-fonts-control';

	public $title = '';

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

			$values = ( ! empty( $this->value() ) ) ? json_decode( $this->value(), true ) : array();
			$values = ( ! empty( $values ) ) ? $values : array( array() );

		?>
		<div class="emoza-custom-fonts-control">

			<?php if( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			<?php } ?>

			<?php if( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>

			<div class="emoza-custom-font-items">
				<div class="emoza-custom-font-item hidden">
					<a href="#" class="emoza-custom-font-remove"><i class="dashicons dashicons-trash"></i></a>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font Name', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="name" class="emoza-custom-font-item-input" />
						</div>
					</div>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .woff2', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="woff2" class="emoza-custom-font-item-input" />
							<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/woff2"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
						</div>
					</div>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .woff', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="woff" class="emoza-custom-font-item-input" />
							<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/woff"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
						</div>
					</div>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .ttf', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="ttf" class="emoza-custom-font-item-input" />
							<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/ttf"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
						</div>
					</div>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .eot', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="eot" class="emoza-custom-font-item-input" />
							<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/eot"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
						</div>
					</div>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .otf', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="otf" class="emoza-custom-font-item-input" />
							<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/otf"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
						</div>
					</div>
					<div class="emoza-custom-font-item-wrapper">
						<label><?php esc_html_e( 'Font .svg', 'emoza-woocommerce' ); ?></label>
						<div class="emoza-custom-font-item-inner">
							<input type="text" name="svg" class="emoza-custom-font-item-input" />
							<a href="#" class="button button-primary emoza-custom-font-upload" data-type="image/svg+xml"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
						</div>
					</div>
				</div>
				<?php if ( ! empty( $values ) ) : ?>
					<?php foreach ( $values as $value ) : ?>
						<div class="emoza-custom-font-item">
							<a href="#" class="emoza-custom-font-remove"><i class="dashicons dashicons-trash"></i></a>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font Name', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $name = ( ! empty( $value['name'] ) ) ? $value['name'] : ''; ?>
									<input type="text" name="name" class="emoza-custom-font-item-input" value="<?php echo esc_attr( $name ); ?>" />
								</div>
							</div>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .woff2', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $woff2 = ( ! empty( $value['woff2'] ) ) ? $value['woff2'] : ''; ?>
									<input type="text" name="woff2" class="emoza-custom-font-item-input" value="<?php echo esc_url( $woff2 ); ?>" />
									<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/woff2"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
								</div>
							</div>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .woff', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $woff = ( ! empty( $value['woff'] ) ) ? $value['woff'] : ''; ?>
									<input type="text" name="woff" class="emoza-custom-font-item-input" value="<?php echo esc_url( $woff ); ?>" />
									<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/woff"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
								</div>
							</div>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .ttf', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $ttf = ( ! empty( $value['ttf'] ) ) ? $value['ttf'] : ''; ?>
									<input type="text" name="ttf" class="emoza-custom-font-item-input" value="<?php echo esc_url( $ttf ); ?>" />
									<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/ttf"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
								</div>
							</div>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .eot', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $eot = ( ! empty( $value['eot'] ) ) ? $value['eot'] : ''; ?>
									<input type="text" name="eot" class="emoza-custom-font-item-input" value="<?php echo esc_url( $eot ); ?>" />
									<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/eot"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
								</div>
							</div>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .otf', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $otf = ( ! empty( $value['otf'] ) ) ? $value['otf'] : ''; ?>
									<input type="text" name="otf" class="emoza-custom-font-item-input" value="<?php echo esc_url( $otf ); ?>" />
									<a href="#" class="button button-primary emoza-custom-font-upload" data-type="font/otf"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
								</div>
							</div>
							<div class="emoza-custom-font-item-wrapper">
								<label><?php esc_html_e( 'Font .svg', 'emoza-woocommerce' ); ?></label>
								<div class="emoza-custom-font-item-inner">
									<?php $svg = ( ! empty( $value['svg'] ) ) ? $value['svg'] : ''; ?>
									<input type="text" name="svg" class="emoza-custom-font-item-input" value="<?php echo esc_url( $svg ); ?>" />
									<a href="#" class="button button-primary emoza-custom-font-upload" data-type="image/svg+xml"><?php esc_html_e( 'Upload', 'emoza-woocommerce' ); ?></a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>

			<div class="emoza-custom-font-footer">
				<a href="#" class="button emoza-custom-font-add"><?php esc_html_e( 'Add New Font', 'emoza-woocommerce' ); ?></a>
			</div>

			<textarea id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="emoza-custom-font-textarea hidden" <?php $this->link(); ?>><?php echo wp_kses( $this->value(), array() ); ?></textarea>

		</div>
		<?php
	}
}
