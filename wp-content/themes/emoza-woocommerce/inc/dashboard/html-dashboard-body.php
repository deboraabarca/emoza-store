<?php
/**
 * Dashboard HTML Body
 * 
 * @package Emoza
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Hook 'emoza_before_dashboard_body_html'
 * 
 * @since 1.1.0
 */
do_action( 'emoza_before_dashboard_body_html' );

/**
 * Hook 'emoza_do_not_load_default_dashboard_body_html'
 * Filter to prevent rendering the dashboard body HTML.
 * 
 * @since 1.1.0
 */
if ( apply_filters( 'emoza_remove_default_dashboard_body_html', false ) ) {
	return;
}

?>

<div class="emoza-dashboard-container">
	<?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>

	<div class="emoza-dashboard-row em-p-relative em-zindex-2">
		<div class="emoza-dashboard-column">
			<?php require get_template_directory() . '/inc/dashboard/html-tabs-nav-items.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
		</div>
	</div>
	<div class="emoza-dashboard-row">
		<div class="emoza-dashboard-column">
			<?php 
			// phpcs:ignore WordPress.Security.NonceVerification.Recommended
			$section = ( isset( $_GET['tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['tab'] ) ) : '';

			foreach( $this->settings[ 'tabs' ] as $nav_tab_id => $nav_tab_title ) : 
				$nav_tab_active = (($nav_tab && $nav_tab === $nav_tab_id) || (!$section && $nav_tab_id === 'home')) ? ' active' : '';

				?>	
				<div class="emoza-dashboard-tab-content-wrapper" data-tab-wrapper-id="main">					
					<div class="emoza-dashboard-tab-content<?php echo esc_attr( $nav_tab_active ); ?>" data-tab-content-id="<?php echo esc_attr( $nav_tab_id ); ?>">
						<?php require get_template_directory() . '/inc/dashboard/html-'. $nav_tab_id .'.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>