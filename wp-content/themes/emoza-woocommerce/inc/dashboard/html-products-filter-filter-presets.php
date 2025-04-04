<div class="emoza-dashboard-card emoza-dashboard-card-no-box-shadow">
    <div class="emoza-dashboard-card-inner-header em-mb-10px">
        <h2 class="em-font-size-20px em-mb-10px em-mt-0"><?php echo esc_html__( 'Filter Presets', 'emoza-woocommerce' ); ?></h2>
        <p class="em-text-color-grey em-m-0">The list of filter presets which you can use in your shop.</p>
    </div>
    <div class="em-presets-list">
        <div class="em-presets-list__header">
            <strong>Preset Name</strong>
            <strong>Shortcode</strong>
            <strong>Actions</strong>
        </div>
        <div class="em-presets-list__body">
            <div class="em-presets-list__item">
                <p class="em-presets-list__item-name">My preset</p>
                <p class="em-presets-list__item-shortcode">[emoza_shop_filters-preset-0ugb9]</p>
                <div class="em-presets-list__item-actions">
                    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-primary emoza-dashboard-pro-tooltip has-icon" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Emoza Pro', 'emoza-woocommerce' ); ?>" target="_blank">
                        Edit
                        <?php emoza_get_svg_icon( 'icon-lock-outline', true ); ?>
                    </a>
                    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-secondary emoza-dashboard-pro-tooltip has-icon has-icon-blue" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Emoza Pro', 'emoza-woocommerce' ); ?>" target="_blank">
                        Remove
                        <?php emoza_get_svg_icon( 'icon-lock-outline', true ); ?>
                    </a>
                </div>
            </div>
        </div>
        <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-secondary em-presets-list__add-button emoza-dashboard-pro-tooltip has-icon has-icon-blue" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Emoza Pro', 'emoza-woocommerce' ); ?>" target="_blank">
            + Add new preset
            <?php emoza_get_svg_icon( 'icon-lock-outline', true ); ?>
        </a>
    </div>
    <hr class="emoza-dashboard-divider">
    <a href="<?php echo esc_url( $this->settings['pf_upgrade_pro'] ); ?>" class="button button-primary emsf-save-settings emoza-dashboard-pro-tooltip has-icon" data-tooltip-message="<?php echo esc_attr__( 'This is only available on Emoza Pro', 'emoza-woocommerce' ); ?>" target="_blank" style="max-width: 150px;">
        Save settings
        <?php emoza_get_svg_icon( 'icon-lock-outline', true ); ?>
    </a>
</div>