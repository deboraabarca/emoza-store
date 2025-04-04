<?php
/**
 * Emoza Pro Upsell Notice
 *
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Class to display the emoza pro upsell notice.
 *
 */
class Emoza_Pro_Upsell_Notice {

	/**
	 * Constructor
	 */
	public function __construct() {

		if( defined( 'EMOZA_WL_ACTIVE' ) ) {
			return;
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
		add_action( 'admin_notices', array( $this, 'notice_markup' ), 20 );
        add_action( 'admin_init', array( $this, 'dimiss_notice' ), 0 );
		add_action( 'switch_theme', array( $this, 'notice_data_remove' ) );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_enqueue_scripts() {
		wp_enqueue_style( 'emoza-notices', get_template_directory_uri() . '/assets/css/admin/emoza-notices.min.css', array(), EMOZA_VERSION, 'all' );
	}

	/**
	 * Show HTML markup if conditions meet.
	 */
	public function notice_markup() {
		$user_id                  = get_current_user_id();
		$dismissed_notice         = get_user_meta( $user_id, 'emoza_pro_upsell_notice_dismiss', true ) ? true : false;

		if( defined( 'EMOZA_PRO_VERSION' ) ) {
			return;
		}

		if ( $dismissed_notice ) {
			return;
		}

		// Display Conditions
		global $hook_suffix;
		
		if( ! in_array( $hook_suffix, array( 'woocommerce_page_wc-settings', 'index.php', 'plugins.php', 'edit.php', 'plugin-install.php' ) ) ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if( $hook_suffix === 'edit.php' && ! isset( $_GET[ 'post_type' ] ) ) {
			return;
		}

		// phpcs:ignore WordPress.Security.NonceVerification.Recommended
		if( $hook_suffix === 'edit.php' && ( isset( $_GET[ 'post_type' ] ) && $_GET[ 'post_type' ] !== 'product' ) ) {
			return;
		}

		?>

		<div class="emoza-notice emoza-notice-with-thumbnail notice" style="position:relative;">
			<h3><?php echo esc_html__( 'Grow Your Store and Expand Your Success!', 'emoza-woocommerce' ); ?></h3>

			<p>
				<?php
					echo esc_html__(
						'Emoza Pro comes with more than 45+ powerful features tailored for the Emoza theme, helping you turn visitors into customers. Enjoy handy tools like wishlists, size charts, advanced reviews, variation swatches, and stylish galleries. Join the thousands of happy entrepreneurs who have upgraded their Emoza stores and boosted their success!', 'emoza-woocommerce'
					);
				?>
			</p>

			<a href="https://emoza.org?utm_source=theme_notice&utm_medium=button&utm_campaign=Emoza" class="emoza-btn emoza-btn-secondary" target="_blank"><?php esc_html_e( 'Upgrade To Emoza Pro', 'emoza-woocommerce' ); ?></a>
			
			<a class="notice-dismiss" href="?emoza_pro_upsell_notice_dismiss=1" style="text-decoration:none;"></a>
		</div>
		<?php
	}

    /**
	 * Dismiss notice permanently
	 */
	public function dimiss_notice() {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended, Universal.Operators.StrictComparisons.LooseEqual
		$notice_dismiss = isset( $_GET['emoza_pro_upsell_notice_dismiss'] ) && '1' == $_GET['emoza_pro_upsell_notice_dismiss'];
		if ( $notice_dismiss ) { 
			add_user_meta( get_current_user_id(), 'emoza_pro_upsell_notice_dismiss', 'true', true );
		}
	}

	/**
	 * Delete data on theme switch
	 */
	public function notice_data_remove() {
		$get_all_users = get_users();

		foreach ( $get_all_users as $user ) {
			$dismissed_notice = get_user_meta( $user->ID, 'emoza_pro_upsell_notice_dismiss', true );

			if ( $dismissed_notice ) {
				delete_user_meta( $user->ID, 'emoza_pro_upsell_notice_dismiss' );
			}
		}
	}
}

new Emoza_Pro_Upsell_Notice();
