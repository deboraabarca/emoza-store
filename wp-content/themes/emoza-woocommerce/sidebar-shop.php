<?php

/**
 * The sidebar for shop
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emoza
 */

$emoza_shop_sidebar_id = '';

if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()) {
	$emoza_shop_sidebar_id = get_theme_mod('shop_sidebar', 'shop-sidebar-1');
} elseif (is_singular('product')) {
	$emoza_shop_sidebar_mod  = get_theme_mod('shop_single_sidebar', 'shop-sidebar-1');
	$emoza_shop_sidebar_meta = get_post_meta(get_the_ID(), '_emoza_sidebar', true);
	$emoza_shop_sidebar_id   = (!empty($emoza_shop_sidebar_meta)) ? $emoza_shop_sidebar_meta : $emoza_shop_sidebar_mod;
}

if (empty($emoza_shop_sidebar_id)) {
	$emoza_shop_sidebar_id = 'shop-sidebar-1';
}

$emoza_custom_sidebars = json_decode(get_theme_mod('custom_sidebars', '[]'), true);

if (!empty($emoza_custom_sidebars)) {
	foreach ($emoza_custom_sidebars as $emoza_custom_sidebar) {
		if (!empty($emoza_custom_sidebar['conditions']) && emoza_get_display_conditions($emoza_custom_sidebar['conditions'], false)) {
			$emoza_shop_sidebar_id = sanitize_key($emoza_custom_sidebar['name']);
		}
	}
}

if (!is_active_sidebar($emoza_shop_sidebar_id) && !is_active_sidebar('sidebar-1')) {
	return;
}

?>

<aside id="secondary" class="widget-area" <?php emoza_schema( 'sidebar' ); ?>>
	<?php 
	/**
	 * Hook 'emoza_before_sidebar'
	 *
	 * @since 1.0.0
	 */
	do_action('emoza_before_sidebar'); ?>
	<?php if (is_active_sidebar($emoza_shop_sidebar_id)) {
		dynamic_sidebar($emoza_shop_sidebar_id);
	} else {
		dynamic_sidebar('sidebar-1');
	} ?>
	<?php 
	/**
	 * Hook 'emoza_after_sidebar'
	 *
	 * @since 1.0.0
	 */
	do_action('emoza_after_sidebar'); ?>
</aside><!-- #secondary -->
