<?php
/**
 * Template part for displaying wishlist content
 *
 * @package Emoza
 */

$products = isset( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ? sanitize_text_field( wp_unslash( $_COOKIE['woocommerce_items_in_cart_emoza_wishlist'] ) ) : false;

if( $products ) : 
    $products = explode( ',', $products ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
    
    <div class="emoza-wishlist-wrapper woocommerce-cart-form">
        <table class="shop_table shop_table_responsive emoza_wishlist_table" cellspacing="0">
            <thead>
                <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name"><?php esc_html_e( 'Product Name', 'emoza-woocommerce' ); ?></th>
                    <th class="product-price"><?php esc_html_e( 'Unit Price', 'emoza-woocommerce' ); ?></th>
                    <th class="product-quantity"><?php esc_html_e( 'Stock Status', 'emoza-woocommerce' ); ?></th>
                    <th class="product-subtotal">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ( $products as $product_id ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
                    $_product = wc_get_product( $product_id ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

                    if ( $_product && $_product->exists() ) {
                        $product_permalink = $_product->is_visible() ? $_product->get_permalink() : ''; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
                        ?>
                        <tr class="emoza-wishlist-row-item woocommerce-cart-form__cart-item">

                            <td class="product-remove">
                                <?php
                                    /**
                                     * Hook 'emoza_wishlist_remove_item_button'
                                     *
                                     * @since 1.0.0
                                     */
                                    echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                        'emoza_wishlist_remove_item_button',
                                        sprintf(
                                            '<a href="#" class="emoza-wishlist-remove-item remove" data-type="remove" aria-label="%s" data-product-id="%s" data-product_sku="%s" data-nonce="%s">&times;</a>',
                                            esc_html__( 'Remove this item', 'emoza-woocommerce' ),
                                            esc_attr( $product_id ),
                                            esc_attr( $_product->get_sku() ),
                                            esc_attr( wp_create_nonce( 'emoza-wishlist-nonce' ) )
                                        )
                                    );
                                ?>
                            </td>

                            <td class="product-thumbnail">
                                <?php
                                $thumbnail = $_product->get_image(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

                                if ( ! $product_permalink ) {
                                    echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } else {
                                    printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } ?>
                            </td>

                            <td class="product-name" data-title="<?php esc_attr_e( 'Product', 'emoza-woocommerce' ); ?>">
                                <?php
                                if ( ! $product_permalink ) {
                                    echo wp_kses_post( $_product->get_name() . '&nbsp;' );
                                } else {
                                    echo wp_kses_post( sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ) );
                                } 
                                
                                /**
                                 * Hook 'emoza_wishlist_after_item_name'
                                 *
                                 * @since 1.0.0
                                 */
                                do_action( 'emoza_wishlist_after_item_name', $_product, $product_id ); ?>
                            </td>

                            <td class="product-price" data-title="<?php esc_attr_e( 'Price', 'emoza-woocommerce' ); ?>">
                                <?php
                                    echo wp_kses_post( wc_price( $_product->get_price() ) );
                                ?>
                            </td>

                            <td class="product-stock" data-title="<?php esc_attr_e( 'Stock', 'emoza-woocommerce' ); ?>">
                                <?php
                                if ( ! $_product->is_in_stock() ) {
                                    /**
                                     * Hook 'emoza_wishlist_out_of_stock'
                                     *
                                     * @since 1.0.0
                                     */
                                    echo apply_filters( 'emoza_wishlist_out_of_stock', esc_html__( 'Out of Stock', 'emoza-woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } else {
                                    /**
                                     * Hook 'emoza_wishlist_in_stock'
                                     *
                                     * @since 1.0.0
                                     */
                                    echo apply_filters( 'emoza_wishlist_in_stock', esc_html__( 'In Stock', 'emoza-woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                } 
                                ?>
                            </td>

                            <td class="product-addtocart" data-title="<?php esc_attr_e( 'Add to Cart', 'emoza-woocommerce' ); ?>">
                                <?php
                                    switch ( $_product->get_type() ) { // @codingStandardsIgnoreStart WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
                                        case 'grouped':
                                            $button_class = '';
                                            $button_text  = __( 'View Products', 'emoza-woocommerce' );
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                        
                                        case 'variable':
                                            $button_class = '';
                                            $button_text  = __( 'Select Options', 'emoza-woocommerce' );
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                
                                        case 'external':
                                            $button_class = '';
                                            $button_text  = $_product->get_button_text();
                                            $button_url   = $_product->get_product_url();
                                            break;
                                        
                                        default:
                                            $button_class = 'emoza-custom-addtocart';
                                            $button_text  = __( 'Add to Cart', 'emoza-woocommerce' );
                                            $button_url   = $_product->add_to_cart_url();
                                            break;
                                    } // @codingStandardsIgnoreEnd WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
                                    echo '<strong><a href="'. esc_url( $button_url ) .'" class="'. esc_attr( $button_class ) .'" data-product-id="'. absint( $product_id ) .'" data-loading-text="'. esc_attr__( 'Loading...', 'emoza-woocommerce' ) .'" data-added-text="'. esc_attr__( 'Added!', 'emoza-woocommerce' ) .'" data-nonce="'. esc_attr( wp_create_nonce( 'emoza-custom-addtocart-nonce' ) ) .'">'. esc_html( $button_text ) .'</a></strong>';
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="footer-buttons">
            <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="button"><?php echo esc_html__( 'View Cart', 'emoza-woocommerce' ); ?></a>
        </div>
    </div>

<?php else : ?>
   
    <div class="emoza-wishlist-wrapper woocommerce-cart-form">
        <table class="shop_table shop_table_responsive emoza_wishlist_table empty" cellspacing="0">
            <thead>
                <tr>
                    <th class="product-remove">&nbsp;</th>
                    <th class="product-thumbnail">&nbsp;</th>
                    <th class="product-name"><?php esc_html_e( 'Product Name', 'emoza-woocommerce' ); ?></th>
                    <th class="product-price"><?php esc_html_e( 'Unit Price', 'emoza-woocommerce' ); ?></th>
                    <th class="product-quantity"><?php esc_html_e( 'Stock Status', 'emoza-woocommerce' ); ?></th>
                    <th class="product-subtotal">&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                <tr class="emoza-wishlist-row-item woocommerce-cart-form__cart-item">
                    <td colspan="6"><?php echo esc_html__( 'No products added to the wishlist', 'emoza-woocommerce' ); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

<?php endif; ?>