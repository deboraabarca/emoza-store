<?php
/**
 * Custom sidebars control
 *
 * @package Emoza
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Emoza_Custom_Sidebars_Control extends WP_Customize_Control {
		
	/**
	 * The type of control being rendered
	 */
	public $type = 'emoza-custom-sidebars-control';

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

			$settings = array(
				'label'  => esc_html__( 'Sidebar Display Conditions', 'emoza-woocommerce' ),
				'values' => array(),
				'labels' => array(),
			);

		?>
		<div class="emoza-custom-sidebars-control">

			<?php if( ! empty( $this->label ) ) { ?>
				<span class="customize-control-title"><?php echo wp_kses_post( $this->label ); ?></span>
			<?php } ?>

			<?php if( ! empty( $this->description ) ) { ?>
				<span class="customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php } ?>

			<div class="emoza-custom-sidebar-list">
				<div class="emoza-custom-sidebar-list-item hidden">
					<div class="emoza-custom-sidebar-list-item-inner">
						<input type="text" name="sidebar_name" class="emoza-custom-sidebar-name" value="" />
						<div class="emoza-custom-sidebar-icon emoza-custom-sidebar-condition emoza-display-conditions-control" title="<?php echo esc_attr_e( 'Display Conditions', 'emoza-woocommerce' ); ?>" data-condition-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
							<div class="emoza-custom-sidebar-condition-button emoza-display-conditions-modal-toggle dashicons dashicons-admin-generic"></div>
							<textarea name="sidebar_conditions" class="emoza-custom-sidebar-conditions emoza-display-conditions-textarea hidden"></textarea>
						</div>
						<div class="emoza-custom-sidebar-icon emoza-custom-sidebar-move dashicons dashicons-menu"></div>
						<div class="emoza-custom-sidebar-icon emoza-custom-sidebar-remove dashicons dashicons-no-alt"></div>
					</div>
				</div>
				<?php

					$values = ( empty( $values ) ) ? array( array( 'name' => '', 'conditions' => '' ) ) : $values;

					if ( is_array( $values ) && ! empty( $values ) ) {

						foreach ( $values as $value ) {

							$conditions = ( ! empty( $value['conditions'] ) ) ? $value['conditions'] : array();

							$labels = array();

							if ( is_array( $conditions ) && ! empty( $conditions ) ) {
								foreach ( $conditions as $condition ) {
									if ( ! empty( $condition['id'] ) ) {
										$labels[ $condition['id'] ] = emoza_get_display_condition_value_text( $condition );
									}
								}
							}

							$settings  = array(
								'label'  => esc_html__( 'Sidebar Display Conditions', 'emoza-woocommerce' ),
								'values' => $conditions,
								'labels' => $labels,
							);

							?>
								<div class="emoza-custom-sidebar-list-item">
									<div class="emoza-custom-sidebar-list-item-inner">
										<input type="text" name="sidebar_name" class="emoza-custom-sidebar-name" value="<?php echo esc_attr( $value['name'] ); ?>"/>
										<div class="emoza-custom-sidebar-icon emoza-custom-sidebar-condition emoza-display-conditions-control" title="<?php echo esc_attr_e( 'Display Conditions', 'emoza-woocommerce' ); ?>" data-condition-settings="<?php echo esc_attr( wp_json_encode( $settings ) ); ?>">
											<div class="emoza-custom-sidebar-condition-button emoza-display-conditions-modal-toggle dashicons dashicons-admin-generic"></div>
											<textarea name="sidebar_conditions" class="emoza-custom-sidebar-conditions emoza-display-conditions-textarea hidden"><?php echo wp_kses( wp_json_encode( $conditions ), array() ); ?></textarea>
										</div>
										<div class="emoza-custom-sidebar-icon emoza-custom-sidebar-move dashicons dashicons-menu"></div>
										<div class="emoza-custom-sidebar-icon emoza-custom-sidebar-remove dashicons dashicons-no-alt"></div>
									</div>
								</div>
							<?php

						}

					}

			 	?>
			</div>

			<div class="emoza-custom-sidebar-footer">
				<a href="#" class="button emoza-custom-sidebar-add"><?php esc_html_e( 'Add New Sidebar', 'emoza-woocommerce' ); ?></a>
			</div>

			<textarea id="<?php echo esc_attr( $this->id ); ?>" name="<?php echo esc_attr( $this->id ); ?>" class="emoza-custom-sidebar-textarea hidden" <?php $this->link(); ?>><?php echo wp_kses( $this->value(), array() ); ?></textarea>

		</div>
		<?php
	}
}
