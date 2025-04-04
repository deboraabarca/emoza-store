<?php
/**
 *
 * Dashboard
 * @package Dashboard
 *
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Dashboard class.
 */
class Emoza_Dashboard
{

    /**
     * The settings of page.
     *
     * @var array $settings The settings.
     */
    public $settings = array();

    /**
     * Constructor.
     */
    public function __construct() {
        if ( defined('EMOZA_WL_ACTIVE') ) {
            return;
        }

        // Display conditions ajax callback needs to be loaded before. 
        if( defined( 'EMOZA_PRO_VERSION' ) ) {
            add_action( 'wp_ajax_templates_builder_display_conditions_select_ajax', array( $this, 'templates_builder_display_conditions_select_ajax' ) );
        }

        if( ! is_admin() ) {
            return;
        }

        if( $this->is_themes_page() || $this->is_emoza_dashboard_page() ) {
            add_action('init', array( $this, 'set_settings' ));
            add_action('admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ));
        }

        if( $this->is_emoza_dashboard_page() ) {
            add_filter( 'admin_footer_text', array( $this, 'admin_footer_text' ) );

            if( defined( 'EMOZA_PRO_VERSION' ) ) {
                add_action( 'admin_footer', array( $this, 'templates_builder_display_conditions_script_template' ) );
            }
        }

        add_filter('woocommerce_enable_setup_wizard', '__return_false');

        add_action('admin_menu', array( $this, 'add_menu_page' ));
        add_action('admin_footer', array( $this, 'add_admin_footer_internal_scripts' ));
        add_action('admin_notices', array( $this, 'html_notice' ));
        
        add_action('wp_ajax_emoza_notifications_read', array( $this, 'ajax_notifications_read' ));

        add_action('wp_ajax_emoza_plugin', array( $this, 'ajax_plugin' ));
        add_action('wp_ajax_emoza_dismissed_handler', array( $this, 'ajax_dismissed_handler' ));

        add_action( 'wp_ajax_emoza_option_switcher_handler', array( $this, 'ajax_option_switcher_handler' ) );
        
        add_action( 'wp_ajax_emoza_module_activation_handler', array( $this, 'ajax_module_activation_handler' ) );
        add_action( 'wp_ajax_emoza_module_activation_all_handler', array( $this, 'ajax_module_activation_all_handler' ) );

        add_action('switch_theme', array( $this, 'reset_notices' ));
        add_action('after_switch_theme', array( $this, 'reset_notices' ));
    }
    
    /**
     * Check if is the themes.php page
     * 
     */
    public function is_themes_page() {
        global $pagenow;
        return $pagenow === 'themes.php';
    }

    /**
     * Check if is the theme dashboard page
     * 
     */
    public function is_emoza_dashboard_page() {
        global $pagenow;

        // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        return $pagenow === 'admin.php' && ( isset( $_GET[ 'page' ] ) && $_GET[ 'page' ] === 'emoza-dashboard' );
    }

    /**
     * Settings
     *
     * @param array $settings The settings.
     */
    public function set_settings() {

        /**
         * Hook 'emoza_dashboard_settings'
         *
         * @since 1.0.0
         */
        $this->settings = apply_filters('emoza_dashboard_settings', array());
    }

    /**
     * Add menu page
     */
    public function add_menu_page() {

        // Add main 'Emoza' page
        add_menu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_menu_page
            esc_html__('Emoza', 'emoza-woocommerce'), 
            esc_html__('Emoza', 'emoza-woocommerce'), 
            'manage_options', 
            isset( $this->settings['menu_slug'] ) ? $this->settings['menu_slug'] : 'emoza-dashboard', 
            array( $this, 'html_dashboard' ),
            get_template_directory_uri() . '/assets/img/admin/emoza-icon.svg',
            58.9
        );

        if( defined( 'EMOZA_PRO_VERSION' ) ) {

            // Add 'Theme Dashboard' page
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'emoza-dashboard',
                esc_html__('Theme Dashboard', 'emoza-woocommerce'),
                esc_html__('Theme Dashboard', 'emoza-woocommerce'),
                'manage_options',
                get_admin_url() . 'admin.php?page=emoza-dashboard',
                '',
                0
            );

            // Add 'Customize' link
            $customize_url = add_query_arg( 'return', rawurlencode( remove_query_arg( wp_removable_query_args(), isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ) ), 'customize.php' );
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'emoza-dashboard',
                esc_html__('Customize', 'emoza-woocommerce'),
                esc_html__('Customize', 'emoza-woocommerce'),
                'manage_options',
                esc_url( $customize_url ),
                '',
                1
            );

            // Add 'Starter Sites' link
            add_submenu_page( // phpcs:ignore WPThemeReview.PluginTerritory.NoAddAdminPages.add_menu_pages_add_submenu_page
                'emoza-dashboard',
                esc_html__('Starter Sites', 'emoza-woocommerce'),
                esc_html__('Starter Sites', 'emoza-woocommerce'),
                'manage_options',
                get_admin_url() . 'admin.php?page=emoza-dashboard&tab=starter-sites',
                '',
                2
            );
        }

    }

    /**
     * Admin footer style.
     * 
     * @return void
     */
    public function add_admin_footer_internal_scripts() {
        ?>
        <style>
            #adminmenu .toplevel_page_emoza-dashboard .wp-submenu a[href="admin.php?page=emoza-dashboard"] {
                display: none;
            }
            #adminmenu .toplevel_page_emoza-dashboard .wp-submenu a[href="https://emoza.org?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Emoza"] {
                background-color: green;
                color: #FFF;
            }
        </style>
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function() {
                const emozaUpsellMenuItem = document.querySelector( '#adminmenu .toplevel_page_emoza-dashboard .wp-submenu a[href="https://emoza.org?utm_source=theme_submenu_page&utm_medium=button&utm_campaign=Emoza"]' );

                if ( ! emozaUpsellMenuItem ) {
                    return;
                }

                emozaUpsellMenuItem.addEventListener( 'click', function( e ){
                    e.preventDefault();

                    const href = this.getAttribute( 'href' );
                    window.open( href, '_blank' );
                } );
            });
        </script>
        <?php
    }

    /**
     * This function will register scripts and styles for admin dashboard.
     *
     * @param string $page Current page.
     */
    public function admin_enqueue_scripts( $hook ) {
        wp_enqueue_style('emoza-dashboard', get_template_directory_uri() . '/assets/css/admin/emoza-dashboard.min.css', array(), EMOZA_VERSION);

        if (is_rtl()) {
            wp_enqueue_style('emoza-dashboard-rtl', get_template_directory_uri() . '/assets/css/admin/emoza-dashboard-rtl.min.css', array(), EMOZA_VERSION);
        }

        wp_enqueue_script('emoza-dashboard', get_template_directory_uri() . '/assets/js/admin/emoza-dashboard.min.js', array( 'jquery', 'wp-util', 'jquery-ui-sortable' ), EMOZA_VERSION, true);

        wp_enqueue_script( 'emoza-select2-js', get_template_directory_uri() . '/assets/vendor/select2/select2.full.min.js', array( 'jquery' ), '4.0.6', true );
		wp_enqueue_style( 'emoza-select2-css', get_template_directory_uri() . '/assets/vendor/select2/select2.min.css', array(), '4.0.6', 'all' );

        wp_enqueue_style('wp-components');

        wp_localize_script('emoza-dashboard', 'emoza_dashboard', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce( 'nonce-em-dashboard' ),
            'i18n' => array(
                'activate' => esc_html__('Activate', 'emoza-woocommerce'),
                'deactivate' => esc_html__('Deactivate', 'emoza-woocommerce'),
                'installing' => esc_html__('Installing...', 'emoza-woocommerce'),
                'activating' => esc_html__('Activating...', 'emoza-woocommerce'),
                'deactivating' => esc_html__('Deactivating...', 'emoza-woocommerce'),
                'loading' => esc_html__('Loading...', 'emoza-woocommerce'),
                'saving' => esc_html__('Saving...', 'emoza-woocommerce'),
                'saved' => esc_html__('Saved!', 'emoza-woocommerce'),
                'unsaved_changes' => esc_html__('You have unsaved changes.', 'emoza-woocommerce'),
                'save' => esc_html__('Save', 'emoza-woocommerce'),
                'redirecting' => esc_html__('Redirecting...', 'emoza-woocommerce'),
                'activated' => esc_html__('Activated', 'emoza-woocommerce'),
                'deactivated' => esc_html__('Deactivated', 'emoza-woocommerce'),
                'failed_message' => esc_html__('Something went wrong, contact support.', 'emoza-woocommerce'),
            ),
        ));
    }

    /**
     * Get plugin status.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_status($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('is_plugin_active_for_network')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        if (!file_exists(WP_PLUGIN_DIR . '/' . $plugin_path)) {
            return 'not_installed';
        } elseif (in_array($plugin_path, (array) get_option('active_plugins', array())) || is_plugin_active_for_network($plugin_path)) {
            return 'active';
        } else {
            return 'inactive';
        }
    }

    /**
     * Get plugin data.
     *
     * @param string $plugin_path Plugin path.
     */
    public function get_plugin_data($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('get_plugin_data')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        return get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin_path);
    }

    /**
     * Install a plugin.
     *
     * @param string $plugin_slug Plugin slug.
     */
    public function install_plugin($plugin_slug)
    {

        if (!current_user_can('install_plugins')) {
            return;
        }

        if (!function_exists('plugins_api')) {
            require_once ABSPATH . 'wp-admin/includes/plugin-install.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }
        if (!class_exists('WP_Upgrader')) {
            require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        if (false === filter_var($plugin_slug, FILTER_VALIDATE_URL)) {
            $api = plugins_api(
                'plugin_information',
                array(
                    'slug' => $plugin_slug,
                    'fields' => array(
                        'short_description' => false,
                        'sections' => false,
                        'requires' => false,
                        'rating' => false,
                        'ratings' => false,
                        'downloaded' => false,
                        'last_updated' => false,
                        'added' => false,
                        'tags' => false,
                        'compatibility' => false,
                        'homepage' => false,
                        'donate_link' => false,
                    ),
                )
            );

            $download_link = $api->download_link;
        } else {
            $download_link = $plugin_slug;
        }

        // Use AJAX upgrader skin instead of plugin installer skin.
        // ref: function wp_ajax_install_plugin().
        $upgrader = new Plugin_Upgrader(new WP_Ajax_Upgrader_Skin());

        $install = $upgrader->install($download_link);

        if (false === $install) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Activate a plugin.
     *
     * @param string $plugin_path Plugin path.
     */
    public function activate_plugin($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return false;
        }

        if (!function_exists('activate_plugin')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        $activate = activate_plugin($plugin_path, '', false, true);

        if (is_wp_error($activate)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Deactivate a plugin.
     *
     * @param string $plugin_path Plugin path.
     */
    public function deactivate_plugin($plugin_path)
    {

        if (!current_user_can('install_plugins')) {
            return false;
        }

        if (!function_exists('deactivate_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
        }

        $deactivate = deactivate_plugins($plugin_path);

        if (is_wp_error($deactivate)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Ajax notifications.
     */
    public function ajax_notifications_read() {
        check_ajax_referer( 'nonce-em-dashboard', 'nonce' );

        $latest_notification_date = ( isset( $_POST[ 'latest_notification_date' ] ) ) ? sanitize_text_field( wp_unslash( $_POST[ 'latest_notification_date' ] ) ) : false;
        update_user_meta( get_current_user_id(), 'emoza_dashboard_notifications_latest_read', $latest_notification_date );

        wp_send_json_success();
    }

    /**
     * Ajax plugin.
     */
    public function ajax_plugin() {
        check_ajax_referer( 'nonce-em-dashboard', 'nonce' );

        $plugin_type = (isset($_POST['type'])) ? sanitize_text_field(wp_unslash($_POST['type'])) : '';
        $plugin_slug = (isset($_POST['slug'])) ? sanitize_text_field(wp_unslash($_POST['slug'])) : '';
        $plugin_path = (isset($_POST['path'])) ? sanitize_text_field(wp_unslash($_POST['path'])) : '';

        if ( ! current_user_can('install_plugins') || empty($plugin_slug) || empty($plugin_type) ) {
            wp_send_json_error( esc_html__( 'Insufficient permissions to install the plugin.', 'emoza-woocommerce' ) );
        }

        if ($plugin_type === 'install' || $plugin_type === 'activate') {

            if ('not_installed' === $this->get_plugin_status($plugin_path)) {

                $this->install_plugin($plugin_slug);
                $this->activate_plugin($plugin_path);

            } elseif ('inactive' == $this->get_plugin_status($plugin_path)) {

                $this->activate_plugin($plugin_path);

            }

            if ('active' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        } elseif ($plugin_type == 'deactivate') {

            $this->deactivate_plugin($plugin_path);

            if ('inactive' === $this->get_plugin_status($plugin_path)) {
                wp_send_json_success();
            }

        }

        wp_send_json_error(esc_html__('Failed to initialize or activate importer plugin.', 'emoza-woocommerce'));
    }

    /**
     * Dismissed handler
     */
    public function ajax_dismissed_handler() {
        check_ajax_referer( 'nonce-em-dashboard', 'nonce' );

        if (isset($_POST['notice'])) {
            set_transient(sanitize_text_field(wp_unslash($_POST['notice'])), true, 0);
            wp_send_json_success();
        }

        wp_send_json_error();
    }

    /**
     * Purified from the database information about notification.
     */
    public function reset_notices() {
        delete_transient(sprintf('%s_hero_notice', get_template()));
    }

    /**
     * Option switcher handler.
     */
    public function ajax_option_switcher_handler() {
        check_ajax_referer( 'nonce-em-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $option_id = ( isset( $_POST[ 'optionId' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['optionId'] ) ) : '';
        $activate  = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? 'yes' : 'no';

        if ( empty( $option_id ) ) {
            wp_send_json_error();
        }

        update_option( $option_id, $activate );

        wp_send_json_success();
    }

    /**
     * Activate/Deactivate Module Ajax
     */
    public function ajax_module_activation_handler() {
        check_ajax_referer( 'nonce-em-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $module   = ( isset( $_POST[ 'module' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['module'] ) ) : '';
        $activate = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? true : false;

        if ( empty( $module ) ) {
            wp_send_json_error();
        }

        $modules = get_option( 'emoza-modules', array() );
        $modules[ $module ] = $activate;

        update_option( 'emoza-modules', $modules );

        if ( $activate ) {

            /**
             * Hook 'emoza_admin_module_activated'.
             * Fires after a module is activated.
             * 
             * @param string $module Module ID.
             * 
             * @since 1.1.0
             */
            do_action( 'emoza_admin_module_activated', $module );
        } else {

            /**
             * Hook 'emoza_admin_module_deactivated'.
             * Fires after a module is deactivated.
             * 
             * @param string $module Module ID.
             * 
             * @since 1.1.0
             */
            do_action( 'emoza_admin_module_deactivated', $module );
        }

        wp_send_json_success();
    }

    /**
     * Activate/Deactivate All Modules Ajax
     */
    public function ajax_module_activation_all_handler() {
        check_ajax_referer( 'nonce-em-dashboard', 'nonce' );

        if( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error();
        }

        $activate = ( isset( $_POST[ 'activate' ] ) ) ? sanitize_text_field( wp_unslash( $_POST['activate'] ) ) : '';

        // Convert string to boolean
        $activate = ( $activate === 'true' ) ? true : false;

        // Get a list with all modules id's
        $all_modules_ids = emoza_get_modules_ids();

        // Get current modules active/disabled list
        $current_modules = get_option( 'emoza-modules', array() );

        $modules = array();
        foreach( $all_modules_ids as $module_id ) {

            // Skip some modules
            if( in_array( $module_id, array( 'hf-builder', 'schema-markup', 'adobe-typekit' ) ) ) {
                $modules[ $module_id ] = $current_modules[ $module_id ];
            } else {
                $modules[ $module_id ] = $activate;
            }

        }

        // Update modules option
        update_option( 'emoza-modules', $modules );

        if ( $activate ) {

            /**
             * Hook 'emoza_admin_all_modules_activated'.
             * Fires after all modules are activated.
             * 
             * @param array $modules Modules list.
             * 
             * @since 1.1.0
             */
            do_action( 'emoza_admin_all_modules_activated', $modules );
        } else {

            /**
             * Hook 'emoza_admin_all_modules_deactivated'.
             * Fires after all modules are deactivated.
             * 
             * @param array $modules Modules list.
             * 
             * @since 1.1.0
             */
            do_action( 'emoza_admin_all_modules_deactivated', $modules );
        }
        

        wp_send_json_success();
    }

    /**
     * Admin Footer Text
     */
    public function admin_footer_text() {
        $text = sprintf(
			/* translators: %s: https://wordpress.org/ */
			__( 'Thank you for creating your website with <a href="%s" class="emoza-dashboard-footer-link" target="_blank">Emoza</a>.', 'emoza-woocommerce' ),
			'https://emoza.org'
		);

        return $text;
    }

    /**
     * Check if the latest notification is read
     */
    public function latest_notification_is_read() {
        if( ! isset( $this->settings[ 'notifications' ] ) || empty( $this->settings[ 'notifications' ] ) ) {
            return false;
        }
        
        $user_id                     = get_current_user_id();
        $user_read_meta              = get_user_meta( $user_id, 'emoza_dashboard_notifications_latest_read', true );

        $last_notification_date      = strtotime( is_string( $this->settings[ 'notifications' ][0]->post_date ) ? $this->settings[ 'notifications' ][0]->post_date : '' );
        $last_notification_date_ondb = $user_read_meta ? strtotime( $user_read_meta ) : false;

        if( ! $last_notification_date_ondb ) {
            return false;
        }

        if( $last_notification_date > $last_notification_date_ondb ) {
            return false;
        }

        return true;
    }

    /**
     * Sanitize array deep.
     */
    private function sanitize_array_deep( $array_data ) {
        return array_map( array( $this, 'sanitize_recursive' ), $array_data );
    }
    
    /**
     * Sanitize recursive.
     */
    private function sanitize_recursive( $value ) {
        if ( is_array( $value ) ) {
            return $this->sanitize_array_deep( $value );
        } else {
            return sanitize_text_field( wp_unslash( $value ) );
        }
    } 

    /**
     * Get emoza templates CPT
     */
    public function get_template_parts() {
        $args = array(
            'numberposts'   => -1, // phpcs:ignore WPThemeReview.CoreFunctionality.PostsPerPage.posts_per_page_numberposts
            'post_type'     => 'emoza_hf',
        );  

        $posts = get_posts( $args );

        $parts = array();

        if ( ! empty( $posts ) ) {
            foreach ( $posts as $post ) {
                $parts[ $post->ID ] = $post->post_title;
            }
        }

        return $parts;
    }

    /**
     * Templates builder display conditions script template.
     * 
     */
    public function templates_builder_display_conditions_script_template() {
        emoza_display_conditions_script_template();
    }

    /**
     * Templates Buidler Display conditions ajax callback
     * 
     */
    public function templates_builder_display_conditions_select_ajax() {
        $term   = ( isset( $_GET['term'] ) ) ? sanitize_text_field( wp_unslash( $_GET['term'] ) ) : '';
        $nonce  = ( isset( $_GET['nonce'] ) ) ? sanitize_text_field( wp_unslash( $_GET['nonce'] ) ) : '';
        $source = ( isset( $_GET['source'] ) ) ? sanitize_text_field( wp_unslash( $_GET['source'] ) ) : '';

        if ( ! empty( $term ) && ! empty( $source ) && ! empty( $nonce ) && wp_verify_nonce( $nonce, 'nonce-em-dashboard' ) ) {
            $options = emoza_get_display_conditions_select_options( $term, $source );

            wp_send_json_success( $options );
        } else {
            wp_send_json_error();
        }
    }

    /**
     * HTML Dashboard
     */
    public function html_dashboard() {
        require get_template_directory() . '/inc/dashboard/html-dashboard.php';
	}

    /**
     * HTML Notice
     */
    public function html_notice()
    {

        global $pagenow;

        $screen = get_current_screen();

        if ('themes.php' === $pagenow && 'themes' === $screen->base) {

            $transient = sprintf('%s_hero_notice', get_template());

            if (!get_transient($transient)) {
                ?>
            <div class="emoza-dashboard emoza-dashboard-notice">
            <div class="emoza-dashboard-dismissable dashicons dashicons-dismiss" data-notice="<?php echo esc_attr($transient); ?>"></div>
            <?php require get_template_directory() . '/inc/dashboard/html-hero.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound ?>
            </div>
        <?php
}

        }
    }
}

new Emoza_Dashboard();
