<?php

/**
 *
 * Hero
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

global $pagenow;

$screen = get_current_screen(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$user   = wp_get_current_user(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="emoza-dashboard-hero">
	<div class="emoza-dashboard-hero-content">

		<div class="emoza-dashboard-hero-title">
			<?php echo wp_kses_post($this->settings['hero_title']); ?>
			<?php if ($this->settings['has_pro']) { ?>
				<sup class="emoza-dashboard-hero-badge emoza-dashboard-hero-badge-pro">pro</sup>
			<?php } else { ?>
				<sup class="emoza-dashboard-hero-badge emoza-dashboard-hero-badge-free">free</sup>
			<?php } ?>
		</div>

		<div class="emoza-dashboard-hero-desc">
			<?php echo wp_kses_post($this->settings['hero_desc']); ?>
		</div>

		<?php if ('themes.php' === $pagenow && 'themes' === $screen->base) : ?>

			<div class="emoza-dashboard-hero-actions">

				<a href="<?php echo esc_url(add_query_arg('page', $this->settings['menu_slug'], admin_url('admin.php'))); ?>" class="button button-secondary">
					<?php esc_html_e('Theme Dashboard', 'emoza-woocommerce'); ?>
				</a>

			</div>

        <?php else : ?>

            <div class="emoza-dashboard-hero-customize-button">
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary" target="_blank">
                    <?php echo esc_html__( 'Start Customizing', 'emoza-woocommerce' ); ?>
                </a>
            </div>

		<?php endif; ?>

	</div>

	<div class="emoza-dashboard-hero-image">
		<img src="<?php //echo esc_url($this->settings['hero_image']); ?>">
	</div>

</div>