<?php

/**
 * Settings.
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if  ( empty( $this->settings['settings'] ) ) {
	return;
}

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="emoza-dashboard-row">
    <div class="emoza-dashboard-column">
        <div class="emoza-dashboard-card emoza-dashboard-card-top-spacing emoza-dashboard-card-tabs-divider">
            <div class="emoza-dashboard-card-body">

                <div class="emoza-dashboard-row">
                    <div class="emoza-dashboard-column emoza-dashboard-column-2">

                        <nav class="emoza-dashboard-tabs-nav emoza-dashboard-tabs-nav-vertical emoza-dashboard-tabs-nav-with-icons emoza-dashboard-tabs-nav-no-negative-margin" data-tab-wrapper-id="settings-tab">
                            <ul>
                                <?php foreach ( $this->settings['settings'] as $tab_id => $tab_title ) : 
                                    $current_tab = (isset($_GET['current_tab'])) ? sanitize_text_field(wp_unslash($_GET['current_tab'])) : key(array_slice($this->settings['settings'], 0, 1)); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
                                    $tab_active  = ( ($current_tab && $current_tab === $tab_id) || (!$current_tab && $tab_id === 'general' ) ) ? ' active' : '';

                                    ?>

                                    <li class="emoza-dashboard-tabs-nav-item<?php echo esc_attr( $tab_active ); ?>">
                                        <a href="#" class="emoza-dashboard-tabs-nav-link" data-tab-to="settings-tab-<?php echo esc_attr( $tab_id ); ?>">
                                            <?php echo emoza_dashboard_get_setting_icon( $tab_id ); ?>
                                            <?php echo esc_html( $tab_title ); ?>
                                        </a>
                                    </li>

                                <?php endforeach; ?>
                            </ul>
                        </nav>

                    </div>
                    <div class="emoza-dashboard-column emoza-dashboard-column-10">

                        <?php 
						$current_tab = ( isset( $_GET['current_tab'] ) ) ? sanitize_text_field( wp_unslash( $_GET['current_tab'] ) ) : '';

						foreach( $this->settings[ 'settings' ] as $tab_id => $tab_title ) : 
							$tab_active = ( ($current_tab && $current_tab === $tab_id) || (!$current_tab && $tab_id === 'general') ) ? ' active' : '';

							?>	
                            <div class="emoza-dashboard-tab-content-wrapper" data-tab-wrapper-id="settings-tab">					
                                <div class="emoza-dashboard-tab-content<?php echo esc_attr( $tab_active ); ?>" data-tab-content-id="settings-tab-<?php echo esc_attr( $tab_id ); ?>">
                                    <?php require get_template_directory() . '/inc/dashboard/html-settings-'. $tab_id .'.php'; ?>
                                </div>
                            </div>
						<?php endforeach; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
