<?php
/**
 * Dashboard HTML
 *
 * @package Emoza
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$user_id             = get_current_user_id();
$current_user        = wp_get_current_user(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
$notification_read   = $this->latest_notification_is_read();
$notifications_count = 1;

?>
<div class="emoza-dashboard emoza-dashboard-wrap">
    <div class="emoza-dashboard-top-bar">
        <a href="<?php echo esc_url($this->settings['upgrade_pro']); ?>" class="emoza-dashboard-top-bar-logo" target="_blank" style=" display: flex; color: #333; font-weight: bold; font-size: 24px; ">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/admin/logo.svg'); ?>">
        </a>
        <div class="emoza-dashboard-top-bar-infos">
            <div class="emoza-dashboard-top-bar-info-item">
                <div class="emoza-dashboard-theme-version">
                    <strong><?php echo esc_html( ( ! $this->settings[ 'has_pro' ] ) ? EMOZA_VERSION : EMOZA_PRO_VERSION ); ?></strong>
                    <span class="emoza-dashboard-badge<?php echo ( $this->settings[ 'has_pro' ] ) ? ' emoza-dashboard-badge-pro' : ''; ?>">
                        <?php echo esc_html( ( ! $this->settings[ 'has_pro' ] ) ? __( 'FREE', 'emoza-woocommerce' ) : __( 'PRO', 'emoza-woocommerce' ) ); ?>
                    </span>
                </div>
            </div>
            <div class="emoza-dashboard-top-bar-info-item">
                <a href="<?php echo esc_url( $this->settings['website_link'] ); ?>" class="emoza-dashboard-theme-website" target="_blank">
                    <?php echo esc_html__( 'Website', 'emoza-woocommerce' ); ?>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13.6 2.40002H7.20002L8.00002 4.00002H11.264L6.39202 8.88002L7.52002 10.008L12 5.53602V8.00002L13.6 8.80002V2.40002ZM9.60002 9.60002V12H4.00002V6.40002H7.20002L8.80002 4.80002H2.40002V13.6H11.2V8.00002L9.60002 9.60002Z" fill="#2271b1"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <?php require get_template_directory() . '/inc/dashboard/html-notifications-sidebar.php'; ?>
    <?php require get_template_directory() . '/inc/dashboard/html-dashboard-body.php'; ?>
</div>