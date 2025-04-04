<?php
/**
 * Demos Page
 *
 * @package Emoza Starter Sites
 * @subpackage Core
 * @version    1.0.0
 * @since      1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Demos Page class.
 */
class EMWC_Demos_Page {

	/**
	 * The settings of page.
	 *
	 * @var array $settings The settings.
	 */
	public $settings = array(
		'has_pro'    => false,
		'pro_label'  => '',
		'pro_link'   => '#',
		'categories' => array(),
		'builders'   => array(),
	);

	/**
	 * The demos of page.
	 *
	 * @var array $demos The demos.
	 */
	public $demos = array();

	/**
	 * Constructor.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'set_demos' ) );
		add_action( 'init', array( $this, 'set_settings' ) );

		add_action( 'admin_notices', array( $this, 'html_notice' ) );
		add_action( 'admin_footer', array( $this, 'preview_template' ) );
		add_action( 'admin_footer', array( $this, 'import_template' ) );

		add_action( 'emwc_starter_sites', array( $this, 'html_demos' ) );

		add_action( 'wp_ajax_emwc_import_data', array( $this, 'import_data' ) );
		add_action( 'wp_ajax_emwc_html_import_data', array( $this, 'html_import_data' ) );
		add_action( 'wp_ajax_emwc_dismissed_handler', array( $this, 'ajax_dismissed_handler' ) );
		
		add_action('wp_ajax_save_emwc_custom_data', array( $this, 'custom_import_data' ) );

		add_action( 'emwc_plugin_activation', array( $this, 'reset_notices' ) );
		add_action( 'emwc_plugin_deactivation', array( $this, 'reset_notices' ) );

	}

	/**
	 * Settings
	 *
	 * @param array $settings The settings.
	 */
	public function set_settings() {
		$this->settings = apply_filters( 'emwc_register_demos_settings', $this->settings );
	}

	/**
	 * Demos
	 *
	 * @param array $demos The demos.
	 */
	public function set_demos( $demos ) {
		$this->demos = apply_filters( 'emwc_register_demos_list', $this->demos );
	}

	/**
	 * Import Data
	 */
	public function import_data() {

		check_ajax_referer( 'nonce', 'nonce' );

    try{

			$demo_id        = ( isset( $_POST['demo_id'] ) ) ? sanitize_text_field( wp_unslash( $_POST['demo_id'] ) ) : '';
			$builder        = ( isset( $_POST['builder'] ) ) ? sanitize_text_field( wp_unslash( $_POST['builder'] ) ) : '';
			$content_type   = ( isset( $_POST['content_type'] ) ) ? sanitize_text_field( wp_unslash( $_POST['content_type'] ) ) : '';
			$import_content = ( isset( $_POST['import_content'] ) ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['import_content'] ) ) : '';

			if ( ! $demo_id || ! isset( $this->demos[ $demo_id ] ) ) {
        throw new Exception( esc_html__( 'Invalid demo id.', 'emoza-starter-sites' ) );
      }

			// Reset import data.
			// delete_transient( 'emwc_importer_data' );

			wp_send_json_success( $this->demos[ $demo_id ] );

    } catch( Exception $e ) {

			wp_send_json_error( $e->getMessage() );

    }

	}
	
	public function custom_import_data() {
		check_ajax_referer( 'nonce', 'nonce' );
		
		try {
			$color_scheme = ( isset( $_POST['color_scheme'] ) ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['color_scheme'] ) ) : array();
    		$logo 			= ( isset( $_POST['logo'] ) ) ? esc_url_raw( $_POST['logo'] ) : '';
    		$favicon 		= ( isset( $_POST['favicon'] ) ) ? esc_url_raw( $_POST['favicon'] ) : '';

			$custom_import_settings = array(
				'color_scheme' 		=> $color_scheme,
				'custom_logo' 		=> $logo,
				'custom_favicon' 	=> $favicon,
			);
		
			set_transient( 'emwc_custom_import_settings', $custom_import_settings, HOUR_IN_SECONDS );			
		
			 wp_send_json_success(array('message' => 'Saved successfully', 'logo' => $favicon));
		} catch( Exception $e ) {
			wp_send_json_error(array('message' => 'Error: Invalid nonce'));	
		}

	}

	/**
	 * HTML Demos
	 */
	public function html_demos() {

		if ( empty( $this->demos ) ) {
			return;
		}

		$current_demo = get_option( 'emwc_current_starter', '' );

		?>
			<div class="emwc">

				<div class="emwc-demos">

					<?php foreach ( $this->demos as $demo_id => $demo ) : ?>

						<?php

							// Variables.
							$name    = ( ! empty( $demo['name'] ) ) ? $demo['name'] : '';
							$type    = ( ! empty( $demo['type'] ) ) ? $demo['type'] : '';
							$preview = ( ! empty( $demo['preview'] ) ) ? $demo['preview'] : '';
							$color_scheme = ( ! empty( $demo['color_scheme'] ) ) ? $demo['color_scheme'] : '';
							
							if ( is_array( $color_scheme ) ) {
								$color_scheme = implode( ',', $color_scheme );
							}

							// Categories.
							$categories = '[]';

							if ( ! empty( $demo['categories'] ) ) {
								foreach ( $demo['categories'] as $category ) {
									$categories .= sprintf( '[%s]', $category );
								}
							}

							// Builders.
							$builders = '[]';

							if ( ! empty( $demo['builders'] ) ) {
								foreach ( $demo['builders'] as $builder ) {
									$builders .= sprintf( '[%s]', $builder );
								}
							}

							$imported_class = ( $current_demo === $demo_id ) ? ' emwc-demo-item-imported' : '';

						?>

						<div class="emwc-demo-item<?php echo esc_attr( $imported_class ); ?>" data-type="<?php echo esc_attr( $type ); ?>" data-categories="<?php echo esc_attr( $categories ); ?>" data-builders="<?php echo esc_attr( $builders ); ?>">

							<div class="emwc-demo-image">
								<?php if ( ! empty( $demo['thumbnail'] ) ) : ?>
									<figure>
										<img src="<?php echo esc_url( $demo['thumbnail'] ); ?>">
									</figure>
								<?php endif; ?>
								<?php if ( ! empty( $demo['builders'] ) && count( $demo['builders'] ) > 1 ) : ?>
									<div class="emwc-demo-quick-import">
										<?php foreach ( $demo['builders'] as $builder ) : ?>
											<a href="#" class="emwc-import-open-button" data-color-scheme="<?php echo esc_attr( $color_scheme ); ?>" data-demo-id="<?php echo esc_attr( $demo_id ); ?>" data-builder="<?php echo esc_attr( $builder ); ?>" data-quick="yes"><?php echo esc_html( ucfirst( $builder ) ); ?></a>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>

							<div class="emwc-demo-data">

								<div class="emwc-demo-info">
									<?php if ( ! empty( $demo['name'] ) ) : ?>
										<div class="emwc-demo-name">
											<?php echo esc_html( $demo['name'] ); ?>
											<?php if ( ! $this->settings['has_pro'] ) : ?>
												<?php if ( $demo['type'] === 'free' ) : ?>
													<div class="emwc-demo-badge emwc-demo-badge-free">free</div>
												<?php else : ?>
													<div class="emwc-demo-badge emwc-demo-badge-pro">pro</div>
												<?php endif; ?>
											<?php endif; ?>
										</div>
									<?php endif; ?>
								</div>

								<div class="emwc-demo-buttons">
									<button class="emwc-demo-remove-button button button-secondary"><?php esc_html_e( 'Remove', 'emoza-starter-sites' ); ?></button>
									<div class="emwc-demo-preview">
										<?php if ( ! empty( $demo['preview'] ) ) : ?>
											<a href="<?php echo esc_url( $preview ); ?>" class="emwc-demo-preview-button button button-secondary"><?php esc_html_e( 'Preview', 'emoza-starter-sites' ); ?></a>
										<?php endif; ?>
									</div>
									<div class="emwc-demo-actions">
										<?php if ( $this->settings['has_pro'] || $demo['type'] === 'free' ) : ?>
											<a href="#" class="emwc-import-open-button button button-primary" data-color-scheme="<?php echo esc_attr( $color_scheme ); ?>"  data-demo-id="<?php echo esc_attr( $demo_id ); ?>"><?php esc_html_e( 'Import', 'emoza-starter-sites' ); ?></a>
										<?php endif; ?>
										<?php if ( ! $this->settings['has_pro'] && $demo['type'] === 'pro' ) : ?>
											<a href="<?php echo esc_url( $this->settings['pro_link'] ); ?>" target="_blank" class="emwc-demo-pro-link-button button button-primary"><?php echo esc_html( $this->settings['pro_label'] ); ?></a>
										<?php endif; ?>
									</div>
								</div>

							</div>

						</div>

					<?php endforeach; ?>

				</div>

				<div class="emwc-import"></div>
				<div class="emwc-preview"></div>

			</div>
		<?php
	}

	/**
	 * Preview Template
	 */
	public function preview_template() {
		?>
			<script type="text/html" id="tmpl-emwc-preview">
					<div class="emwc-preview-header">
						<div class="emwc-preview-header-left">
							<div class="emwc-preview-header-column emwc-preview-header-logo">
								<a href="<?php echo esc_url( 'https://emoza.org/' ); ?>" target="_blank">
									<figure>
										<img width="96px" height="24px" src="{{ window.emwc_localize.plugin_url }}core/assets/img/logo.svg" alt="<?php esc_html_e( 'Emoza', 'emoza-starter-sites' ); ?>">
									</figure>
								</a>
							</div>
							<div class="emwc-preview-header-column emwc-preview-header-arrow">
								<a href="#" class="emwc-preview-header-arrow-prev"><i class="dashicons dashicons-arrow-left-alt2"></i></a>
							</div>
							<div class="emwc-preview-header-column emwc-preview-header-arrow">
								<a href="#" class="emwc-preview-header-arrow-next"><i class="dashicons dashicons-arrow-right-alt2"></i></a>
							</div>
							<div class="emwc-preview-header-column emwc-preview-header-info">{{{ data.info }}}</div>
						</div>
						<div class="emwc-preview-header-right">
							<a href="#" class="emwc-preview-cancel-button button button-secondary button-medium">
								<?php esc_html_e( 'Cancel', 'emoza-starter-sites' ); ?>
							</a>
							<div class="emwc-preview-header-actions">{{{ data.actions }}}</div>
						</div>
					</div>
					<iframe src="{{ data.preview }}" class="emwc-preview-iframe"></iframe>
			</script>
		<?php
	}
	/**
	 * Import Template
	 */
	public function import_template() {
		?>
			<script type="text/html" id="tmpl-emwc-import">
			
				<div class="emwc-import-overlay emwc-import-close-button"></div>

				<form class="emwc-import-form">

					<input type="hidden" name="demo_id" value="{{ data.args.demoId }}" />

					<input type="hidden" name="start" data-action="emwc_import_start" data-priority="20" data-log="<?php esc_html_e( 'Starting setup...', 'emoza-starter-sites' ); ?>" />

					<# var isStartFromFirstStep = ( ! data.args.quick ) ? ' emwc-active' : ''; #>

					<div class="emwc-import-step{{ isStartFromFirstStep }}">
						<div class="emwc-import-title">
							<?php esc_html_e( 'Use one of these', 'emoza-starter-sites' ); ?>
							<div class="emwc-import-close-button"><i class="dashicons dashicons-no-alt"></i></div>
						</div>
						<div class="emwc-import-content">
							<div class="emwc-import-content-block">
								<div class="emwc-import-toggle emwc-active">
									<div class="emwc-import-toggle-title emwc-import-toggle-button">
										<?php esc_html_e( 'Page Builder', 'emoza-starter-sites' ); ?>
										<i class="emwc-import-toggle-icon dashicons dashicons-arrow-up-alt2"></i>
									</div>
									<div class="emwc-import-toggle-content">
										<div class="emwc-import-image-select emwc-import-builder-select">
											<# _.each( data.builders, function( builder ) { #>
												<label class="emwc-import-image-select-item">
													<# var builderChecked    = ( data.args.builder === builder ) ? ' checked="checked"' : ''; #>
													<# var builderPluginSlug = ( builder === 'gutenberg' ) ? 'emoza-blocks' : builder; #>
													<input type="radio" name="builder_type" value="{{ builder }}" data-builder-plugin="{{ builderPluginSlug }}" {{{ builderChecked }}} />
													<figure>
														<img src="{{ window.emwc_localize.plugin_url }}core/assets/img/builder-{{ builder }}.svg" />
													</figure>
													<div class="emwc-import-image-select-name">{{ builder }}</div>
												</label>
											<# } ); #>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="emwc-import-actions">
							<a href="#" class="emwc-import-close-button button button-secondary"><?php esc_html_e( 'Close', 'emoza-starter-sites' ); ?></a>
							<a href="#" class="emwc-import-next-button button button-primary"><?php esc_html_e( 'Next', 'emoza-starter-sites' ); ?></a>
						</div>
					</div>

					<# var isStartFromSecondStep = ( data.args.quick ) ? ' emwc-active' : ''; #>

					<div class="emwc-import-step{{ isStartFromSecondStep }}">
						<div class="emwc-import-title">
							<?php esc_html_e( 'Choose your preferred type', 'emoza-starter-sites' ); ?>
							<div class="emwc-import-close-button"><i class="dashicons dashicons-no-alt"></i></div>
						</div>
						<div class="emwc-import-content">
							<# var isShowContentType = ( data.args.imported ) ? ' emwc-hidden' : ''; #>
							<div class="emwc-import-content-block emwc-import-content-select{{ isShowContentType }}">
								<div class="emwc-import-toggle emwc-active">
									<div class="emwc-import-toggle-title emwc-import-toggle-button">
										<?php esc_html_e( 'Content Type', 'emoza-starter-sites' ); ?>
										<i class="emwc-import-toggle-icon dashicons dashicons-arrow-up-alt2"></i>
									</div>
									<div class="emwc-import-toggle-content">
										<div class="emwc-import-image-select">
											<label class="emwc-import-image-select-item">
												<input type="radio" name="content_type" value="entire-site" checked="checked" />
												<figure>
													<img src="{{ data.thumbnail }}" class="emwc-content-type-entire-site" />
												</figure>
												<div class="emwc-import-image-select-name"><?php esc_html_e( 'Entire Site', 'emoza-starter-sites' ); ?></div>
											</label>
											<label class="emwc-import-image-select-item">
												<input type="radio" name="content_type" value="placeholder" />
												<figure>
													<img width="100" src="{{ window.emwc_localize.plugin_url }}core/assets/img/content-type-placeholder.jpg" />
												</figure>
												<div class="emwc-import-image-select-name"><?php esc_html_e( 'Placeholder', 'emoza-starter-sites' ); ?></div>
											</label>
										</div>
									</div>
								</div>
							</div>
							<div class="emwc-import-content-block">
								<div class="emwc-import-toggle emwc-active">
									<div class="emwc-import-toggle-title emwc-import-toggle-button">
										<?php esc_html_e( 'Import Content', 'emoza-starter-sites' ); ?>
										<i class="emwc-import-toggle-icon dashicons dashicons-arrow-up-alt2"></i>
									</div>
									<div class="emwc-import-toggle-content">
										<div class="emwc-import-checkboxes">
											<label>
												<input type="checkbox" data-action="emwc_import_contents" class="emwc-import-with-content-type" data-priority="40" data-log="<?php esc_html_e( 'Importing contents...', 'emoza-starter-sites' ); ?>" checked="checked" />
												<span><i></i></span>
												<?php esc_html_e( 'Content', 'emoza-starter-sites' ); ?>
											</label>
											<label>
												<input type="checkbox" data-action="emwc_import_widgets" data-priority="41" data-log="<?php esc_html_e( 'Importing widgets...', 'emoza-starter-sites' ); ?>" checked="checked" />
												<span><i></i></span>
												<?php esc_html_e( 'Widgets', 'emoza-starter-sites' ); ?>
											</label>
											<label>
												<input type="checkbox" data-action="emwc_import_customizer" data-priority="42" data-log="<?php esc_html_e( 'Importing customizer options...', 'emoza-starter-sites' ); ?>" checked="checked" />
												<span><i></i></span>
												<?php esc_html_e( 'Customizer', 'emoza-starter-sites' ); ?>
											</label>
										</div>
										<# if ( data.args.imported ) { #>
											<div class="emwc-import-checkboxes emwc-import-clean-checkboxes">
												<label>
													<input type="checkbox" data-action="emwc_import_clean" class="emwc-import-with-content-type" data-priority="10" data-log="<?php esc_html_e( 'Cleaning previous import data...', 'emoza-starter-sites' ); ?>" />
													<span><i></i></span>
													<?php esc_html_e( 'Clean Install', 'emoza-starter-sites' ); ?>
												</label>
												<div class="emwc-import-clean-description"><?php esc_html_e( 'This option will remove the previous imported content and will perform a fresh and clean install.', 'emoza-starter-sites' ); ?></div>
											</div>
										<# } #>
									</div>
								</div>
							</div>
						</div>
						<div class="emwc-import-actions">
							<# if ( data.args.quick ) { #>
								<a href="#" class="emwc-import-close-button button button-secondary"><?php esc_html_e( 'Close', 'emoza-starter-sites' ); ?></a>
							<# } else { #>
								<a href="#" class="emwc-import-prev-button button button-secondary"><?php esc_html_e( 'Prev', 'emoza-starter-sites' ); ?></a>
							<# } #>
							<# if ( window.emwc_localize.settings.has_pro || data.type === 'free' ) { #>
								<a href="#" class="emwc-import-next-button button button-primary"><?php esc_html_e( 'Next', 'emoza-starter-sites' ); ?></a>
							<# } #>
							<# if ( ! window.emwc_localize.settings.has_pro && data.type === 'pro' ) { #>
								<a href="{{ window.emwc_localize.settings.pro_link }}" target="_blank" class="emwc-demo-pro-link-button button button-primary">{{ window.emwc_localize.settings.pro_label }}</a>
							<# } #>
						</div>
					</div>

					<# if ( data.args.colorScheme ) { #>

						<# var colorScheme = data.args.colorScheme.split(','); #>
						<div class="emwc-import-step">
							<div class="emwc-import-title">
								<?php esc_html_e( 'Customize your import', 'emoza-starter-sites' ); ?>
								<div class="emwc-import-close-button"><i class="dashicons dashicons-no-alt"></i></div>
							</div>
							<div class="emwc-import-content">
								<div class="emwc-import-content-block">
									<div class="emwc-import-content-block-title">
										<?php esc_html_e( 'Would you like to customize the colors of this starter site or upload a logo before importing?', 'emoza-starter-sites' ); ?>
									</div>
									<div class="emwc-import-clean-description"><?php esc_html_e( 'You can always change these settings later.', 'emoza-starter-sites' ); ?></div>
								</div>
							</div>
							<div class="emwc-import-actions">
								<# if ( window.emwc_localize.settings.has_pro || data.type === 'free' ) { #>
									<a href="#" class="emwc-import-next-button emwc-import-customize-button button button-secondary"><?php esc_html_e( 'Customize', 'emoza-starter-sites' ); ?></a>
								<# } #>
								<a href="#" class="emwc-import-skip-button button button-primary"><?php esc_html_e( 'Continue without customizing', 'emoza-starter-sites' ); ?></a>
								<# if ( ! window.emwc_localize.settings.has_pro && data.type === 'pro' ) { #>
									<a href="{{ window.emwc_localize.settings.pro_link }}" target="_blank" class="emwc-demo-pro-link-button button button-primary">{{ window.emwc_localize.settings.pro_label }}</a>
								<# } #>
							</div>							
						</div>
						<div class="emwc-import-step">
							<input type="hidden" name="emwc_color_scheme" value="" />
							<div class="emwc-import-title">
								<?php esc_html_e( 'Customize your import', 'emoza-starter-sites' ); ?>
								<div class="emwc-import-close-button"><i class="dashicons dashicons-no-alt"></i></div>
							</div>
							<div class="emwc-import-actions emwc-import-customize-actions">
								
								<div class="emwc-import-customize-fields">
									<div class="emwc-logo-upload">
										<input type="hidden" class="emwc-logo-upload-input" name="emwc_logo_url" value="" />
										<div class="emwc-logo-upload-button emwc-media-button"><?php esc_html_e( 'Upload Logo', 'emoza-starter-sites' ); ?></div>
									</div>

									<div class="emwc-icon-upload">
										<input type="hidden" class="emwc-icon-upload-input" name="emwc_icon_url" value="" />
										<div class="emwc-icon-upload-button emwc-media-button"><?php esc_html_e( 'Upload Site Icon', 'emoza-starter-sites' ); ?></div>
									</div>

									<div class="emwc-color-pickers">
										<#
										var colorOptions = [];

										for (var i = 1; i <= 9; i++) {
											colorOptions.push({
												label: window.emwc_localize.tooltips['global_color_' + i],
												class: 'demo2-global-color-' + i,
												value: colorScheme[i - 1]
											});
										}

										#>
										<# _.each(colorOptions, function(colorOption) { #>
											<div class="emwc-color-picker">
												<span class="pickr-holder"></span>
												<input class="emwc-color-picker-input {{ colorOption.class }}" type="hidden" data-default="{{ colorOption.value }}" value="{{ colorOption.value }}">
												<div class="emwc-color-picker-tooltip">{{ colorOption.label }}</div>
											</div>
										<# }); #>
									</div>
								</div>

								<div style="display:flex;gap:10px;">
									<a href="#" class="emwc-import-reset-button button button-secondary"><?php esc_html_e( 'Reset', 'emoza-starter-sites' ); ?></a>
									<a href="#" class="emwc-import-next-button emwc-import-save-custom-data-button button button-primary"><?php esc_html_e( 'Next', 'emoza-starter-sites' ); ?></a>
								</div>

								<div class="emwc-iframe-wrapper">
									<iframe id="emwc-demo-frame" src="{{ data.preview }}" height="100%"></iframe>
								</div>								
							</div>							
						</div>
					<# } #>		

					<div class="emwc-import-step">
						<div class="emwc-import-title">
							<?php esc_html_e( 'Okay, just one last step...', 'emoza-starter-sites' ); ?>
							<div class="emwc-import-close-button"><i class="dashicons dashicons-no-alt"></i></div>
						</div>
						<div class="emwc-import-content">
							<div class="emwc-import-content-block">
								<div class="emwc-import-toggle emwc-active">
									<div class="emwc-import-toggle-title emwc-import-toggle-button">
										<?php esc_html_e( 'Install Plugins', 'emoza-starter-sites' ); ?>
										<i class="emwc-import-toggle-icon dashicons dashicons-arrow-up-alt2"></i>
									</div>
									<div class="emwc-import-toggle-content">
										<div class="emwc-import-checkboxes">
											<# _.each( data.builders, function( builder ) { #>
												<#
													var builderPluginSlug     = ( builder === 'gutenberg' ) ? '' : 'elementor';
													var builderPluginName     = ( builder === 'gutenberg' ) ? '' : 'Elementor';
													var builderPluginChecked  = ( data.args.builder === builder ) ? ' checked="checked"' : '';
													var builderPluginActive   = ( data.args.builder !== builder ) ? ' emwc-hidden' : '';
													if ( builderPluginSlug && builderPluginName ) {
														#>
														<label class="emwc-import-plugin-builder emwc-import-plugin-{{ builderPluginSlug }} emwc-import-plugin-required{{ builderPluginActive }}">
															<input type="checkbox" name="plugin" data-action="emwc_import_plugin" data-priority="30" data-slug="{{ builderPluginSlug }}" data-path="{{ builderPluginSlug }}/{{ builderPluginSlug }}.php" data-log="<?php esc_html_e( 'Installing and activating', 'emoza-starter-sites' ); ?>: {{ builderPluginName }}" {{{ builderPluginChecked }}} />
															<span><i></i></span>
															{{ builderPluginName }}
														</label>
														<# 
													}
											} ); #>
											<# _.each( data.plugins, function( plugin ) { #>
												<# 
												var isPluginRequired = ( plugin.required ) ? ' emwc-import-plugin-required' : '';
												if ( data.args.builder === 'elementor' && plugin.slug === 'stackable-ultimate-gutenberg-blocks' ) {
													return;
												}

												#>

												<label class="emwc-import-plugin-{{ plugin.slug }}{{ isPluginRequired }}">
													<input type="checkbox" name="plugin" data-action="emwc_import_plugin" data-priority="30" data-slug="{{ plugin.slug }}" data-path="{{ plugin.path }}" data-log="<?php esc_html_e( 'Installing and activating', 'emoza-starter-sites' ); ?>: {{ plugin.name }}" checked="checked" />
													<span><i></i></span>
													{{{ plugin.name }}}
												</label>
											<# } ); #>
										</div>
									</div>
								</div>
							</div>
							<!-- <div class="emwc-import-content-block">
								<div class="emwc-import-content-block-title">
									<?php esc_html_e( 'Subscribe and Import', 'emoza-starter-sites' ); ?>
								</div>
								<div class="emwc-import-subscribe">
									<div class="emwc-import-subscribe-text"><?php esc_html_e( 'Subscribe to learn about new starter sites and features', 'emoza-starter-sites' ); ?></div>
									<label>
										<strong><?php esc_html_e( 'Email', 'emoza-starter-sites' ); ?></strong>
										<input type="email" value="<?php echo esc_attr( get_option( 'admin_email' ) ); ?>" class="emwc-import-subscribe-field-email" />
									</label>
									<label>
										<input type="checkbox" value="yes" class="emwc-import-subscribe-field-count-me" checked="checked" />
										<?php esc_html_e( 'Yes, count me in!', 'emoza-starter-sites' ); ?>
									</label>
									<small><?php esc_html_e( 'We do not spam, unsubscribe anytime.', 'emoza-starter-sites' ); ?></small>
								</div>
							</div> -->
						</div>
						<div class="emwc-import-actions emwc-import-actions-column">
							<a href="#" class="emwc-import-start-button button button-primary"><?php esc_html_e( 'Start Now', 'emoza-starter-sites' ); ?></a>
							<!-- <a href="#" class="emwc-import-start-button button button-primary" data-subscribe="yes"><?php esc_html_e( 'Subscribe and Start Importing', 'emoza-starter-sites' ); ?></a> -->
							<!-- <a href="#" class="emwc-import-start-button button button-secondary"><?php esc_html_e( 'Skip, Start Importing', 'emoza-starter-sites' ); ?></a> -->
						</div>
					</div>

					<div class="emwc-import-step">
						<div class="emwc-import-title">
							<?php esc_html_e( 'We are building your website', 'emoza-starter-sites' ); ?>
						</div>
						<div class="emwc-import-content">
							<div class="emwc-import-content-block">
								<?php esc_html_e( 'Please be patient and don’t refresh this page, the import process may take a while, this also depends on your server.', 'emoza-starter-sites' ); ?>
								<div class="emwc-import-progress">
									<div class="emwc-import-progress-info">
										<div class="emwc-import-progress-label"></div>
										<div class="emwc-import-progress-sublabel">0%</div>
									</div>
									<div class="emwc-import-progress-bar">
										<div class="emwc-import-progress-indicator" style="--emwc-indicator: 0%;"></div>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="emwc-import-step emwc-import-step-error">
						<div class="emwc-import-error-content">
							<div class="emwc-import-error-image">
								<figure>
									<img src="<?php echo esc_url( EMWC_URL . 'core/assets/img/error.svg' ); ?>" />
								</figure>
							</div>
							<div class="emwc-import-error-title">
								<?php esc_html_e( 'Sorry, something went wrong', 'emoza-starter-sites' ); ?>
							</div>
							<div class="emwc-import-error-box">
								<div class="emwc-import-error-message">
									<strong><?php esc_html_e( 'What went wrong', 'emoza-starter-sites' ); ?></strong>
									<?php esc_html_e( 'Please be patient and don’t refresh this page.', 'emoza-starter-sites' ); ?>
								</div>
								<div class="emwc-import-error-message">
									<strong><small><?php esc_html_e( 'More technical information from console', 'emoza-starter-sites' ); ?></small></strong>
									<div class="emwc-import-error-log"></div>
								</div>
							</div>
							<a href="#" class="emwc-import-open-button button button-primary" data-color-scheme="{{ data.args.colorScheme }}" data-demo-id="{{ data.args.demoId }}"><?php esc_html_e( 'Click here and try again', 'emoza-starter-sites' ); ?></a>
						</div>
					</div>

					<div class="emwc-import-step emwc-import-step-finish">
						<div class="emwc-import-finish-content">
							<div class="emwc-import-finish-title">
								<?php esc_html_e( 'Congratulations!', 'emoza-starter-sites' ); ?>
							</div>
							<?php esc_html_e( 'Your website is all set! Now, update the text, images, and design elements to truly make it your own.', 'emoza-starter-sites' ); ?>
							<div class="emwc-import-finish-actions">
								<a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Customize', 'emoza-starter-sites' ); ?></a>
								<a href="<?php echo esc_url( site_url( '/' ) ); ?>" target="_blank" class="button button-primary"><?php esc_html_e( 'View Site', 'emoza-starter-sites' ); ?></a>
							</div>
							<!-- <div class="emwc-import-finish-tweet">
								<p class="emwc-import-finish-tweet-text"></p>
								<a href="#" target="_blank" class="emwc-import-finish-tweet-button">
									<?php esc_html_e( 'Click to Tweet', 'emoza-starter-sites' ); ?>
									<i class="dashicons dashicons-twitter"></i>
								</a>
							</div> -->
						</div>
					</div>

					<input type="hidden" name="finish" data-action="emwc_import_finish" data-priority="50" data-log="<?php esc_html_e( 'Finishing setup...', 'emoza-starter-sites' ); ?>"/>

				</form>

			</script>

		<?php
	}

	/**
	 * Is template of Emoza
	 */
	public function is_emoza_template() {

		$theme = wp_get_theme();

		if ( $theme->parent() ) {
			$theme = $theme->parent();
		}

		$themes = array(
			'Emoza WooCommerce',
			'Emoza WooCommerce Pro',
		);

		return in_array( $theme->name, $themes );

	}

	/**
	 * Display a notification.
	 */
	public function html_notice() {

		if ( ! $this->is_emoza_template() && ! get_transient( 'emwc_no_active_theme' ) ) {
			?>
			<div class="emwc-notice notice notice-warning is-dismissible">
				<p>
				<?php
					// Translators: Link.
					echo wp_kses( sprintf( __( 'Emoza Starter Sites (plugin) requires an %1$s theme to be installed and activated.', 'emoza-starter-sites' ), '<a href="https://emoza.org/" target="_blank">' . __( 'Emoza WooCommerce', 'emoza-starter-sites' ) . '</a>' ), 'post' );
				?>
				</p>
			</div>
			<?php
		}
	}

	/**
	 * Purified from the database information about notification.
	 */
	public function reset_notices() {
		delete_transient( 'emwc_no_active_theme' );
	}

  /**
   * Dismissed handler
   */
  public function ajax_dismissed_handler() {

    check_ajax_referer( 'nonce', 'nonce' );
    set_transient( 'emwc_no_active_theme', true, 90 * DAY_IN_SECONDS );
    wp_send_json_success();

  }

}

new EMWC_Demos_Page();