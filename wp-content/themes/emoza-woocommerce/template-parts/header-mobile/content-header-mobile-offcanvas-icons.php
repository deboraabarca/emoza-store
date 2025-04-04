<?php
/**
 * Header Icons Template File
 * 
 */

$show_cart                   = get_theme_mod( 'enable_mobile_header_offcanvas_cart', 1 );
$show_account                = get_theme_mod( 'enable_mobile_header_offcanvas_account', 1 );
$show_wishlist               = get_theme_mod( 'shop_product_wishlist_layout', 'layout1' ) !== 'layout1' ? true : false;
$enable_header_wishlist_icon = get_theme_mod( 'enable_mobile_header_offcanvas_wishlist_icon', 1 );
$wishlist_enable             = Emoza_Modules::is_module_active( 'wishlist' );

if ( is_cart() ) {
    $class = 'current-menu-item';
} else {
    $class = '';
}
?>

<?php if ( $show_account ) : ?>
<?php echo '<a class="header-item wc-account-link" href="' . esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ) . '" title="' . esc_html__( 'Your account', 'emoza-woocommerce' ) . '"><i class="ws-svg-icon">' . emoza_get_header_icon( 'account' ) . '</i></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
<?php endif; ?>	

<?php if ( $show_cart ) : ?>
<div id="site-header-cart" class="em-d-inline-block site-header-cart header-item mini-cart-<?php echo ( count( WC()->cart->get_cart() ) > 2 ? 'has-scroll' : 'has-no-scroll' ); ?>">
    <div class="<?php echo esc_attr( $class ); ?>">
        <?php echo emoza_woocommerce_cart_link();  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
    <?php
    
    // Side Mini Cart
    $mini_cart_style = get_theme_mod( 'mini_cart_style', 'default' );
    if( $mini_cart_style === 'default' ) {
        $instance = array(
            'title' => esc_html__( 'Your Cart', 'emoza-woocommerce' ),
        );

        the_widget( 'WC_Widget_Cart', $instance, array(
            'before_title' => '<div class="widgettitle">',
            'after_title'  => '</div>',
        )  );
    }
    
    ?>
</div>
<?php endif; ?>
<?php if( $wishlist_enable && $show_wishlist && $enable_header_wishlist_icon ) : 
    $wishlist_count = isset( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ? count( explode( ',', sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ) ) ) : 0; ?>
    <a class="header-item header-wishlist-icon em-d-inline-block" href="<?php echo esc_url( get_permalink( get_option('emoza_wishlist_page_id') ) ); ?>" title="<?php echo esc_attr__( 'Your wishlist', 'emoza-woocommerce' ); ?>">
        <span class="count-number"><?php echo esc_html( $wishlist_count ); ?></span>
        <i class="ws-svg-icon"><?php emoza_get_header_icon( 'wishlist', true ); ?></i>
    </a>
<?php endif; ?>