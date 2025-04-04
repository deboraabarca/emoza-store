<?php

/**
 * Tabs Nav Items
 * 
 * @package Dashboard
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

// @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>

<div class="emoza-dashboard-row">
    <div class="emoza-dashboard-column emoza-dashboard-column-9">
        
        <!-- Customize Your Size -->
        <div class="emoza-dashboard-card emoza-dashboard-card-top-spacing emoza-dashboard-card-tabs-divider">
            <div class="emoza-dashboard-card-header em-d-flex em-justify-content-between em-align-items-center">
                <h2><?php echo esc_html__( 'Customize your site', 'emoza-woocommerce' ); ?></h2>
                <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="emoza-dashboard-external-link" target="_blank">
                    <?php echo esc_html__( 'Go To Customizer', 'emoza-woocommerce' ); ?>
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#2271b1"/>
                    </svg>
                </a>
            </div>
            <div class="emoza-dashboard-card-body">
                <div class="emoza-dashboard-row">
                    <?php foreach ($this->settings[ 'features' ] as $feature) : // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound 
                        $link_target = isset( $feature[ 'link_target' ] ) ? $feature[ 'link_target' ] : '_blank';

                        if( $feature[ 'type' ] !== 'free' ) {
                            continue;
                        }
                        
                        ?>

                        <div class="emoza-dashboard-column emoza-dashboard-column-4">
                            <div class="emoza-dashboard-feature-card">
                                <div class="emoza-dashboard-feature-card-title">
                                    <h3><?php echo esc_html( $feature[ 'title' ] ); ?></h3>
                                </div>
                                <div class="emoza-dashboard-feature-card-actions">
                                    <?php if( ! isset( $feature[ 'module' ] ) ) : ?>
                                        <?php if( isset( $feature[ 'link_url' ] ) ) : ?>
                                            <a href="<?php echo esc_url( $feature['link_url'] ); ?>" class="emoza-dashboard-link emoza-dashboard-link-default emoza-dashboard-customize-link" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $feature['link_label'] ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php elseif ( Emoza_Modules::is_module_active( $feature['module'] ) ) : ?>
                                        <a href="#" class="emoza-dashboard-link emoza-dashboard-link-danger emoza-dashboard-module-activation" data-module-id="<?php echo esc_attr( $feature['module'] ); ?>" data-module-activate="false">
                                            <?php echo esc_html__( 'Deactivate', 'emoza-woocommerce' ); ?>
                                        </a>
                                        <?php if( isset( $feature[ 'link_url' ] ) ) : ?>
                                            <a href="<?php echo esc_url( $feature['link_url'] ); ?>" class="emoza-dashboard-link emoza-dashboard-link-default emoza-dashboard-customize-link" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $feature['link_label'] ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php else : ?>
                                        <a href="#" class="emoza-dashboard-link emoza-dashboard-link-success emoza-dashboard-module-activation" data-module-id="<?php echo esc_attr( $feature['module'] ); ?>" data-module-activate="true">
                                            <?php echo esc_html__( 'Activate', 'emoza-woocommerce' ); ?>
                                        </a>
                                        <?php if( isset( $feature[ 'link_url' ] ) ) : ?>
                                            <a href="<?php echo esc_url( $feature['link_url'] ); ?>" class="emoza-dashboard-link emoza-dashboard-link-default emoza-dashboard-customize-link em-d-none" target="<?php echo esc_attr( $link_target ); ?>">
                                                <?php echo esc_html( $feature['link_label'] ); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    
                                    <?php if( isset( $feature[ 'docs_link' ] ) ) : ?>
                                        <a href="<?php echo esc_url( $feature[ 'docs_link' ] ); ?>" class="emoza-dashboard-feature-card-link-icon" title="<?php echo esc_attr__( 'Documentation', 'emoza-woocommerce' ); ?>" target="_blank">
                                            <svg width="17" height="17" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="10" cy="10" r="9.5" stroke="#757575"/>
                                                <path d="M8.79004 12.1689V11.769C8.79004 11.4559 8.82601 11.1829 8.89795 10.9502C8.96989 10.7174 9.09049 10.4995 9.25977 10.2964C9.42904 10.089 9.65755 9.87321 9.94531 9.64893C10.2415 9.41618 10.4764 9.21517 10.6499 9.0459C10.8276 8.87663 10.9546 8.70736 11.0308 8.53809C11.1112 8.36458 11.1514 8.16357 11.1514 7.93506C11.1514 7.57536 11.0286 7.30241 10.7832 7.11621C10.542 6.92578 10.2013 6.83057 9.76123 6.83057C9.37191 6.83057 9.00586 6.88558 8.66309 6.99561C8.32031 7.10563 7.98177 7.24316 7.64746 7.4082L7.12061 6.29102C7.5057 6.07943 7.92253 5.91016 8.37109 5.7832C8.82389 5.65202 9.32113 5.58643 9.86279 5.58643C10.7261 5.58643 11.3926 5.7959 11.8623 6.21484C12.3363 6.63379 12.5732 7.18604 12.5732 7.87158C12.5732 8.24821 12.514 8.57194 12.3955 8.84277C12.277 9.10938 12.1014 9.35693 11.8687 9.58545C11.6401 9.80973 11.363 10.0467 11.0371 10.2964C10.7705 10.508 10.5653 10.6921 10.4214 10.8486C10.2817 11.001 10.1844 11.1554 10.1294 11.312C10.0786 11.4686 10.0532 11.6569 10.0532 11.877V12.1689H8.79004ZM8.54883 14.2129C8.54883 13.8659 8.6377 13.6226 8.81543 13.4829C8.9974 13.339 9.21956 13.2671 9.48193 13.2671C9.73584 13.2671 9.95378 13.339 10.1357 13.4829C10.3177 13.6226 10.4087 13.8659 10.4087 14.2129C10.4087 14.5514 10.3177 14.7969 10.1357 14.9492C9.95378 15.0973 9.73584 15.1714 9.48193 15.1714C9.21956 15.1714 8.9974 15.0973 8.81543 14.9492C8.6377 14.7969 8.54883 14.5514 8.54883 14.2129Z" fill="#757575"/>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Do more with Emoza Pro -->
        <div class="emoza-dashboard-card">
            <div class="emoza-dashboard-card-header em-d-flex em-justify-content-between em-align-items-center">
                <h2><?php echo esc_html__( 'Do more with Emoza Pro', 'emoza-woocommerce' ); ?></h2>

                <?php if( ! $this->settings[ 'has_pro' ] ) : ?>
                    <a href="<?php echo esc_url( $this->settings['upgrade_pro'] ); ?>" class="emoza-dashboard-external-link" target="_blank">
                        <?php echo esc_html__( 'Upgrade To Pro', 'emoza-woocommerce' ); ?>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#2271b1"/>
                        </svg>
                    </a>
                <?php else : ?>
                    <div class="emoza-dahsboard-modules-global-actions">
                        <a href="#" class="emoza-dashboard-module-activation-all emoza-dahsboard-modules-activate-all" data-module-activate="true">
                            <?php echo esc_html__( 'Activate All', 'emoza-woocommerce' ); ?>
                        </a>
                        <a href="#" class="emoza-dashboard-module-activation-all emoza-dahsboard-modules-deactivate-all" data-module-activate="false">
                            <?php echo esc_html__( 'Deactivate All', 'emoza-woocommerce' ); ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="emoza-dashboard-card-body">
                <div class="emoza-dashboard-row">
                    <?php foreach ($this->settings[ 'features' ] as $feature) : // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound 
                        $link_target = isset( $feature[ 'link_target' ] ) ? $feature[ 'link_target' ] : '_blank';

                        if( $feature[ 'type' ] !== 'pro' ) {
                            continue;
                        }
                        
                        ?>

                        <div class="emoza-dashboard-column emoza-dashboard-column-4">
                            <div class="emoza-dashboard-feature-card">
                                <div class="emoza-dashboard-feature-card-title">
                                    <h3><?php echo esc_html( $feature[ 'title' ] ); ?></h3>
                                </div>
                                <div class="emoza-dashboard-feature-card-actions">
                                    <?php if( ! $this->settings[ 'has_pro' ] ) : ?>

                                        <?php if( isset( $feature[ 'docs_link' ] ) ) : ?>
                                            <a href="<?php echo esc_url( $feature[ 'docs_link' ] ); ?>" class="emoza-dashboard-link" target="_blank">
                                                <?php echo esc_html__( 'Learn More', 'emoza-woocommerce' ); ?>
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?php echo esc_url( $this->settings['upgrade_pro'] ); ?>" class="emoza-dashboard-feature-card-link-icon emoza-dashboard-feature-card-link-icon-always-visible emoza-dashboard-pro-tooltip" target="_blank" data-tooltip-message="<?php echo esc_attr__( 'This option is only available on Emoza Pro', 'emoza-woocommerce' ); ?>">
                                            <span class="dashicons dashicons-lock"></span>
                                        </a>

                                    <?php else : ?>

                                        <?php if( ! isset( $feature[ 'module' ] ) ) : ?>
                                            <?php if( isset( $feature[ 'link_url' ] ) || isset( $feature['pro_use_docs_link'] ) ) : 
                                                $link_url = isset( $feature['pro_use_docs_link'] ) ? $feature['docs_link'] : $feature['link_url'];
                                                
                                                ?>
                                                <a href="<?php echo esc_url( $link_url ); ?>" class="emoza-dashboard-link emoza-dashboard-link-default emoza-dashboard-customize-link" target="<?php echo esc_attr( $link_target ); ?>">
                                                    <?php echo esc_html( $feature['link_label'] ); ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php elseif ( Emoza_Modules::is_module_active( $feature['module'] ) ) : ?>
                                            <a href="#" class="emoza-dashboard-link emoza-dashboard-link-danger emoza-dashboard-module-activation" data-module-id="<?php echo esc_attr( $feature['module'] ); ?>" data-module-activate="false">
                                                <?php echo esc_html__( 'Deactivate', 'emoza-woocommerce' ); ?>
                                            </a>
                                            <?php if( isset( $feature[ 'link_url' ] ) ) : ?>
                                                <a href="<?php echo esc_url( $feature['link_url'] ); ?>" class="emoza-dashboard-link emoza-dashboard-link-default emoza-dashboard-customize-link" target="<?php echo esc_attr( $link_target ); ?>">
                                                    <?php echo esc_html( $feature['link_label'] ); ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <a href="#" class="emoza-dashboard-link emoza-dashboard-link-success emoza-dashboard-module-activation" data-module-id="<?php echo esc_attr( $feature['module'] ); ?>" data-module-activate="true">
                                                <?php echo esc_html__( 'Activate', 'emoza-woocommerce' ); ?>
                                            </a>
                                            <?php if( isset( $feature[ 'link_url' ] ) ) : ?>
                                                <a href="<?php echo esc_url( $feature['link_url'] ); ?>" class="emoza-dashboard-link emoza-dashboard-link-default emoza-dashboard-customize-link em-d-none" target="<?php echo esc_attr( $link_target ); ?>">
                                                    <?php echo esc_html( $feature['link_label'] ); ?>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if( isset( $feature[ 'docs_link' ] ) ) : ?>
                                            <a href="<?php echo esc_url( $feature[ 'docs_link' ] ); ?>" class="emoza-dashboard-feature-card-link-icon" title="<?php echo esc_attr__( 'Documentation', 'emoza-woocommerce' ); ?>" target="_blank">
                                                <svg width="17" height="17" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="10" cy="10" r="9.5" stroke="#757575"/>
                                                    <path d="M8.79004 12.1689V11.769C8.79004 11.4559 8.82601 11.1829 8.89795 10.9502C8.96989 10.7174 9.09049 10.4995 9.25977 10.2964C9.42904 10.089 9.65755 9.87321 9.94531 9.64893C10.2415 9.41618 10.4764 9.21517 10.6499 9.0459C10.8276 8.87663 10.9546 8.70736 11.0308 8.53809C11.1112 8.36458 11.1514 8.16357 11.1514 7.93506C11.1514 7.57536 11.0286 7.30241 10.7832 7.11621C10.542 6.92578 10.2013 6.83057 9.76123 6.83057C9.37191 6.83057 9.00586 6.88558 8.66309 6.99561C8.32031 7.10563 7.98177 7.24316 7.64746 7.4082L7.12061 6.29102C7.5057 6.07943 7.92253 5.91016 8.37109 5.7832C8.82389 5.65202 9.32113 5.58643 9.86279 5.58643C10.7261 5.58643 11.3926 5.7959 11.8623 6.21484C12.3363 6.63379 12.5732 7.18604 12.5732 7.87158C12.5732 8.24821 12.514 8.57194 12.3955 8.84277C12.277 9.10938 12.1014 9.35693 11.8687 9.58545C11.6401 9.80973 11.363 10.0467 11.0371 10.2964C10.7705 10.508 10.5653 10.6921 10.4214 10.8486C10.2817 11.001 10.1844 11.1554 10.1294 11.312C10.0786 11.4686 10.0532 11.6569 10.0532 11.877V12.1689H8.79004ZM8.54883 14.2129C8.54883 13.8659 8.6377 13.6226 8.81543 13.4829C8.9974 13.339 9.21956 13.2671 9.48193 13.2671C9.73584 13.2671 9.95378 13.339 10.1357 13.4829C10.3177 13.6226 10.4087 13.8659 10.4087 14.2129C10.4087 14.5514 10.3177 14.7969 10.1357 14.9492C9.95378 15.0973 9.73584 15.1714 9.48193 15.1714C9.21956 15.1714 8.9974 15.0973 8.81543 14.9492C8.6377 14.7969 8.54883 14.5514 8.54883 14.2129Z" fill="#757575"/>
                                                </svg>
                                            </a>
                                        <?php endif; ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
    <div class="emoza-dashboard-column emoza-dashboard-column-3">
        
        <div class="emoza-dashboard-sticky-wrapper">
            
            <?php if( ! $this->settings[ 'has_pro' ] ) : ?>
                <!-- Priority Support -->
                <div class="emoza-dashboard-card em-border-color-primary">
                    <div class="emoza-dashboard-card-header">
                        <h2><?php echo esc_html__( 'Premium support', 'emoza-woocommerce' ); ?></h2>
                    </div>
                    <div class="emoza-dashboard-card-body">
                        <p><?php echo esc_html__( 'Get support from our team of WordPress experts via email. We aim to respond within one business day, but we often manage to reply much sooner.', 'emoza-woocommerce' ); ?></p>
                        <a href="<?php echo esc_url( $this->settings['upgrade_pro'] ); ?>" class="emoza-dashboard-external-link" target="_blank">
                            <?php echo esc_html__( 'Get Premium Support With Emoza Pro', 'emoza-woocommerce' ); ?>
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#2271b1"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Leave a Review -->
            <div class="emoza-dashboard-card">
                <div class="emoza-dashboard-card-header em-d-flex em-justify-content-between em-align-items-center">
                    <h2><?php echo esc_html__( 'Leave a review', 'emoza-woocommerce' ); ?></h2>
                    <svg width="83" height="24" viewBox="0 0 83 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1_1797)">
                        <path d="M74.6355 2.87524H4.76826C2.13482 2.87524 0 5.0091 0 7.64133V18.5084C0 21.1407 2.13482 23.2745 4.76826 23.2745H74.6355C77.2689 23.2745 79.4037 21.1407 79.4037 18.5084V7.64133C79.4037 5.0091 77.2689 2.87524 74.6355 2.87524Z" fill="#F5F5F5"/>
                        <path d="M76.2002 0.728333H6.33295C3.69952 0.728333 1.5647 2.86218 1.5647 5.49442V16.3615C1.5647 18.9938 3.69952 21.1276 6.33295 21.1276H76.2002C78.8336 21.1276 80.9684 18.9938 80.9684 16.3615V5.49442C80.9684 2.86218 78.8336 0.728333 76.2002 0.728333Z" fill="white"/>
                        <path d="M13.8982 5.11517L15.6982 8.75802L19.7219 9.34525L16.8117 12.1824L17.4983 16.1871L13.8982 14.2957L10.2981 16.1871L10.9846 12.1824L8.07446 9.34525L12.0981 8.75802L13.8982 5.11517Z" fill="#FFB840"/>
                        <path d="M27.5817 5.11517L29.3818 8.75802L33.4089 9.34525L30.4953 12.1824L31.1819 16.1871L27.5817 14.2957L23.9851 16.1871L24.6716 12.1824L21.7581 9.34525L25.7851 8.75802L27.5817 5.11517Z" fill="#FFB840"/>
                        <path d="M41.268 5.11517L43.0681 8.75802L47.0917 9.34525L44.1782 12.1824L44.8681 16.1871L41.268 14.2957L37.6679 16.1871L38.3545 12.1824L35.4443 9.34525L39.468 8.75802L41.268 5.11517Z" fill="#FFB840"/>
                        <path d="M54.9509 5.11517L56.7509 8.75802L60.7746 9.34525L57.8644 12.1824L58.551 16.1871L54.9509 14.2957L51.3508 16.1871L52.0408 12.1824L49.1272 9.34525L53.1508 8.75802L54.9509 5.11517Z" fill="#FFB840"/>
                        <path d="M68.6378 5.11517L70.4378 8.75802L74.4615 9.34525L71.5479 12.1824L72.2379 16.1871L68.6378 14.2957L65.0377 16.1871L65.7242 12.1824L62.8107 9.34525L66.8377 8.75802L68.6378 5.11517Z" fill="#FFB840"/>
                        </g>
                        <path d="M82.85 4.15852C80.8962 4.56585 80.347 5.11249 79.9415 7.06475C79.8992 7.26526 79.612 7.26526 79.5697 7.06475C79.1621 5.11249 78.615 4.56374 76.6612 4.15852C76.4606 4.1163 76.4606 3.82927 76.6612 3.78706C78.615 3.37972 79.1621 2.83309 79.5697 0.87871C79.612 0.678207 79.8992 0.678207 79.9415 0.87871C80.3491 2.83098 80.8962 3.37972 82.85 3.78495C83.0507 3.82716 83.0507 4.11419 82.85 4.15641V4.15852Z" fill="#F5F5F5"/>
                        <defs>
                        <clipPath id="clip0_1_1797">
                        <rect width="80.9681" height="22.5433" fill="white" transform="translate(0 0.728333)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="emoza-dashboard-card-body">
                    <p><?php echo esc_html__( 'It makes us happy to hear from our users. We would appreciate a review.', 'emoza-woocommerce' ); ?></p>
                    <a href="<?php echo esc_url( $this->settings['review_link'] ); ?>" class="button button-primary button-outline button-medium em-font-weight-500" target="_blank">
                        <?php echo esc_html__( 'Submit a Review', 'emoza-woocommerce' ); ?>
                    </a>
                </div>
            </div>

            <!-- Knowledge Base -->
            <div class="emoza-dashboard-card">
                <div class="emoza-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Documentation', 'emoza-woocommerce' ); ?></h2>
                </div>
                <div class="emoza-dashboard-card-body">
                    <?php if ( ! defined( 'EMOZA_PRO_VERSION' ) ) : ?>
                        <p><?php echo esc_html__( 'Our documentation is here to guide you through Emoza\'s features.', 'emoza-woocommerce' ); ?></p>
                    <?php else : ?>
                        <p><?php echo esc_html__( 'Our documentation is here to guide you through Emoza Pro\'s features.', 'emoza-woocommerce' ); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $this->settings['knowledge_base_link'] ); ?>" class="button button-primary button-outline button-medium em-font-weight-500" target="_blank">
                        <?php echo esc_html__( 'Browse Docs', 'emoza-woocommerce' ); ?>
                    </a>
                </div>
            </div>

            <!-- Need Help? -->
            <div class="emoza-dashboard-card">
                <div class="emoza-dashboard-card-header">
                    <h2><?php echo ! defined( 'EMOZA_PRO_VERSION' ) ? esc_html__( 'Support', 'emoza-woocommerce' ) : esc_html__( 'Support', 'emoza-woocommerce' ); ?></h2>
                </div>
                <div class="emoza-dashboard-card-body">
                    <?php if( ! defined( 'EMOZA_PRO_VERSION' ) ) : ?>
                        <p><?php echo esc_html__( 'Have a question? Hit a bug? Find solutions or ask a member of our expert team for help.', 'emoza-woocommerce' ); ?></p>
                    <?php else : ?>
                        <p><?php echo esc_html__( 'Need help? Submit a ticket and a member of our support team will aim to respond within one business day.', 'emoza-woocommerce' ); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo esc_url( $this->settings['support_link'] ); ?>" class="button button-primary button-outline button-medium em-font-weight-500" target="_blank">
                        <?php echo ! defined( 'EMOZA_PRO_VERSION' ) ? esc_html__( 'Get Support', 'emoza-woocommerce' ) : esc_html__( 'Submit a Ticket', 'emoza-woocommerce' ); ?>
                    </a>
                </div>
            </div>

            <!-- Have and idea of feedback -->
            <div class="emoza-dashboard-card">
                <div class="emoza-dashboard-card-header">
                    <h2><?php echo esc_html__( 'Have an idea or feedback?', 'emoza-woocommerce' ); ?></h2>
                </div>
                <div class="emoza-dashboard-card-body">
                    <p><?php echo esc_html__( 'Got an idea for how to improve Emoza and Emoza Pro? Let us know.', 'emoza-woocommerce' ); ?></p>
                    <a href="<?php echo esc_url( $this->settings['suggest_idea_link'] ); ?>" class="emoza-dashboard-external-link" target="_blank">
                        <?php echo esc_html__( 'Suggest An Idea', 'emoza-woocommerce' ); ?>
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.4375 0H8.25C7.94531 0 7.66406 0.1875 7.54688 0.492188C7.42969 0.773438 7.5 1.10156 7.71094 1.3125L8.67188 2.27344L4.14844 6.79688C3.84375 7.07812 3.84375 7.57031 4.14844 7.85156C4.28906 7.99219 4.47656 8.0625 4.6875 8.0625C4.875 8.0625 5.0625 7.99219 5.20312 7.85156L9.72656 3.32812L10.6875 4.28906C10.8281 4.42969 11.0156 4.5 11.2266 4.5C11.3203 4.5 11.4141 4.5 11.5078 4.45312C11.8125 4.33594 12 4.05469 12 3.75V0.5625C12 0.257812 11.7422 0 11.4375 0ZM9.1875 7.5C8.85938 7.5 8.625 7.75781 8.625 8.0625V10.6875C8.625 10.8047 8.53125 10.875 8.4375 10.875H1.3125C1.19531 10.875 1.125 10.8047 1.125 10.6875V3.5625C1.125 3.46875 1.19531 3.375 1.3125 3.375H3.9375C4.24219 3.375 4.5 3.14062 4.5 2.8125C4.5 2.50781 4.24219 2.25 3.9375 2.25H1.3125C0.585938 2.25 0 2.85938 0 3.5625V10.6875C0 11.4141 0.585938 12 1.3125 12H8.4375C9.14062 12 9.75 11.4141 9.75 10.6875V8.0625C9.75 7.75781 9.49219 7.5 9.1875 7.5Z" fill="#2271b1"/>
                        </svg>
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>

<?php
// @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
