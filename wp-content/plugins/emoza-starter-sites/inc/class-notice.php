<?php
/**
 * Notice
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class EMWC_Custom_Notice {
    public function __construct() {
        $this->init();
    }

    public function init() {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'admin_notices', array( $this, 'display_notice' ) );
        add_action( 'wp_ajax_emwc_notice_dismissed_handler', array( $this, 'dismissed_handler' ) );
    }

    /**
	 *  Enqueue Scripts
	 *
	 */
	public function enqueue_scripts( $page ) {
		wp_enqueue_script( 'jquery' );

		ob_start();
		?>
		<script>
			jQuery(function($) {
				$( document ).on( 'click', '.emwc-temporary-notice .notice-dismiss', function () {
					jQuery.post( 'ajax_url', {
						action: 'emwc_notice_dismissed_handler',
						notice: $( this ).closest( '.emwc-temporary-notice' ).data( 'notice' ),
					});
				} );
			});
		</script>
		<?php
		$script = str_replace( 'ajax_url', admin_url( 'admin-ajax.php' ), ob_get_clean() );

		wp_add_inline_script( 'jquery', str_replace( array( '<script>', '</script>' ), '', $script ) );
	}

    /**
     * Display notice 
     * 
     */
    public function display_notice() {
        if ( ! get_transient( 'emwc-goldseason' ) ) {
            ?>
            <div class="emwc-temporary-notice notice notice-success is-dismissible" data-notice="emwc-goldseason" style="margin: 20px 19px 20px 2px;">
                <h3 style="margin-bottom: -2px; padding-left: 2px;"><?php echo esc_html__( 'Emoza Gold Season!', 'emoza-starter-sites' ); ?></h3>
                <p style="margin-bottom: 15px;"><?php echo esc_html__( 'Grab a massive ', 'emoza-starter-sites' ); ?><strong><?php echo esc_html__( '30% discount ', 'emoza-starter-sites' ); ?></strong><?php echo esc_html__( 'on Emoza WooCommerce Theme. This is "the" discount to get if you want all the awesome features of a Pro theme. If you miss this sale you won\'t see it again until next year!', 'emoza-starter-sites' ); ?></p>
                <a href="https://emoza.org/black-friday?utm_source=emwc_notice&utm_medium=button&utm_campaign=CyberWeek" class="button button-primary" target="_blank" style="color: #fff; border-color: #3fb28f; background-color: #3fb28f; margin-bottom: 15px;"><?php esc_html_e( 'Grab The Deal', 'emoza-starter-sites' ); ?></a>
            </div>
            <?php
        }
    }

    /**
	 * Dismissed handler
	 */
	public function dismissed_handler() {
		wp_verify_nonce( null );

		if ( isset( $_POST['notice'] ) ) { // Input var ok; sanitization ok.
			set_transient( sanitize_text_field( wp_unslash( $_POST['notice'] ) ), true, 90 * DAY_IN_SECONDS ); // Input var ok.
		}
	}
}

new EMWC_Custom_Notice();