<?php
/**
 * Emoza review notice
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the theme review notice after certain period.
 *
 */
class Emoza_Theme_Review_Notice {

	/**
	 * Constructor
	 */
	public function __construct() {

		if( defined( 'EMOZA_WL_ACTIVE' ) ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'review_notice' ) );
		add_action( 'admin_notices', array( $this, 'review_notice_markup' ), 0 );
		add_action( 'admin_init', array( $this, 'ignore_theme_review_notice' ), 0 );
		add_action( 'admin_init', array( $this, 'ignore_theme_review_notice_partially' ), 0 );
		add_action( 'switch_theme', array( $this, 'review_notice_data_remove' ) );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'emoza-notices', get_template_directory_uri() . '/assets/css/admin/emoza-notices.min.css', array(), EMOZA_VERSION, 'all' );
	}

	/**
	 * Set the required option value as needed for theme review notice.
	 */
	public function review_notice() {
		if ( !get_option( 'emoza_theme_installed_time' ) ) {
			update_option( 'emoza_theme_installed_time', time() );
		}
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function review_notice_markup() {
		$user_id                  = get_current_user_id();
		$current_user             = wp_get_current_user();
		$ignored_notice           = get_user_meta( $user_id, 'emoza_disable_review_notice', true );
		$ignored_notice_partially = get_user_meta( $user_id, 'delay_emoza_disable_review_notice_partially', true );

		if ( ( get_option( 'emoza_theme_installed_time' ) > strtotime( '-14 day' ) ) || ( $ignored_notice_partially > strtotime( '-14 day' ) ) || ( $ignored_notice ) ) {
			return;
		}
		
		?>
		<div class="emoza-notice notice" style="position:relative;">
			<p>
				<?php
				printf(
				    /* Translators: %1$s current user display name. */
					esc_html__(
						'Hi %1$s, it\'s so exciting to see that you\'ve made significant progress in building your website. We have a small request that would mean the world to us. Could you please take a moment to write a review for Emoza on WordPress.org? Your support will not only fuel our motivation but also help other users feel confident in choosing our theme. Thank you!', 
						'emoza-woocommerce'
					),
					'<strong>' . esc_html( $current_user->display_name ) . '</strong>'
				);
				?>
			</p>

			<a href="https://wordpress.org/support/theme/emoza-woocommerce/reviews/?filter=5#new-post" class="emoza-btn emoza-btn-secondary" target="_blank"><?php esc_html_e( 'Ok, you deserve it', 'emoza-woocommerce' ); ?></a>
			<a href="?delay_emoza_disable_review_notice_partially=0" class="emoza-btn emoza-btn-link"><?php esc_html_e( 'Nope, maybe later', 'emoza-woocommerce' ); ?></a>
			<a href="?nag_emoza_disable_review_notice=0" class="emoza-btn emoza-btn-link"><?php esc_html_e( 'I already rated it', 'emoza-woocommerce' ); ?></a>

			<a class="notice-dismiss" href="?nag_emoza_disable_review_notice=0" style="text-decoration:none;"></a>
		</div>
		<?php
	}

	/**
	 * Disable review notice permanently
	 */
	public function ignore_theme_review_notice() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended, Universal.Operators.StrictComparisons.LooseEqual
		if ( isset( $_GET['nag_emoza_disable_review_notice'] ) && '0' == $_GET['nag_emoza_disable_review_notice'] ) {
			add_user_meta( get_current_user_id(), 'emoza_disable_review_notice', 'true', true );
		}
	}

	/**
	 * Delay review notice
	 */
	public function ignore_theme_review_notice_partially() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended, Universal.Operators.StrictComparisons.LooseEqual
		if ( isset( $_GET['delay_emoza_disable_review_notice_partially'] ) && '0' == $_GET['delay_emoza_disable_review_notice_partially'] ) {
			update_user_meta( get_current_user_id(), 'delay_emoza_disable_review_notice_partially', time() );
		}
	}

	/**
	 * Delete data on theme switch
	 */
	public function review_notice_data_remove() {
		$get_all_users        = get_users();
		$theme_installed_time = get_option( 'emoza_theme_installed_time' );

		// Delete options data.
		if ( $theme_installed_time ) {
			delete_option( 'emoza_theme_installed_time' );
		}

		foreach ( $get_all_users as $user ) {
			$ignored_notice           = get_user_meta( $user->ID, 'emoza_disable_review_notice', true );
			$ignored_notice_partially = get_user_meta( $user->ID, 'delay_emoza_disable_review_notice_partially', true );

			if ( $ignored_notice ) {
				delete_user_meta( $user->ID, 'emoza_disable_review_notice' );
			}

			if ( $ignored_notice_partially ) {
				delete_user_meta( $user->ID, 'delay_emoza_disable_review_notice_partially' );
			}
		}
	}
}

new Emoza_Theme_Review_Notice();
