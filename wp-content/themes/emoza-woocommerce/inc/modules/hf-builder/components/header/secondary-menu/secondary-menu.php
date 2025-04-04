<?php
/**
 * Header/Footer Builder
 * Secondary Menu Component
 * 
 * Args passed to this component:
 * $params - array of component parameters like device type, etc.
 * 
 * @package Emoza_Pro
 */

// Check display conditions.
if ( ! emoza_get_display_conditions( 'secondary_menu_display_conditions', false, '[{"type":"include","condition":"all","id":null}]' ) ) {
    return;
}

// Device type.
$device = isset( $params['device'] ) ? $params['device'] : 'desktop';

?>

<div class="ehfb-builder-item ehfb-component-secondary_menu" data-component-id="secondary_menu">
    <?php $this->customizer_edit_button();

    if ( function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled( 'secondary' ) ) : ?>
        <nav class="secondary-navigation" aria-label="<?php echo esc_attr__( 'Secondary Navigation Menu', 'emoza-woocommerce' ); ?>">
            <?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
        </nav>
    <?php else: 
        $has_hover_delay = get_option( 'emoza_dropdowns_hover_delay', 'yes' );
        ?>
    <nav class="top-bar-secondary-navigation secondary-navigation emoza-dropdown ehfb-navigation<?php echo 'yes' === $has_hover_delay ? ' with-hover-delay' : ''; ?>" aria-label="<?php echo esc_attr__( 'Secondary Navigation Menu', 'emoza-woocommerce' ); ?>">
        <?php
        wp_nav_menu( array(
            'theme_location'=> 'mobile' === $device && has_nav_menu( 'top-bar-mobile' ) ? 'top-bar-mobile' : 'secondary',
            'menu_id'       => 'secondary',
            'menu_class'    => 'menu emoza-dropdown-ul',
            'fallback_cb'   => false,
            'depth'         => 0,

            /**
             * Hook 'emoza_secondary_wp_nav_menu_walker'
             *
             * @since 1.0.0
             */
            'walker'        => apply_filters( 'emoza_secondary_wp_nav_menu_walker', '' ),
        ) );
        ?>
    </nav>
    <?php endif; ?>
</div>
