<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Emoza
 */

$emoza_sidebar_id = '';

if (is_home() && !is_front_page()) {
	$emoza_sidebar_id = get_theme_mod('blog_archive_sidebar', 'sidebar-1');
} elseif (is_singular()) {
	$emoza_sidebar_mod  = get_theme_mod('blog_single_sidebar', 'sidebar-1');
	$emoza_sidebar_meta = get_post_meta(get_the_ID(), '_emoza_sidebar', true);
	$emoza_sidebar_id   = (!empty($emoza_sidebar_meta)) ? $emoza_sidebar_meta : $emoza_sidebar_mod;
}

if (empty($emoza_sidebar_id)) {
	$emoza_sidebar_id = 'sidebar-1';
}

$emoza_custom_sidebars = json_decode(get_theme_mod('custom_sidebars', '[]'), true);

if (!empty($emoza_custom_sidebars)) {
	foreach ($emoza_custom_sidebars as $emoza_custom_sidebar) {
		if (!empty($emoza_custom_sidebar['conditions']) && emoza_get_display_conditions($emoza_custom_sidebar['conditions'], false)) {
			$emoza_sidebar_id = sanitize_key($emoza_custom_sidebar['name']);
		}
	}
}

if (!is_active_sidebar($emoza_sidebar_id)) {
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
	<?php dynamic_sidebar($emoza_sidebar_id); ?>
	<?php 
	/**
	 * Hook 'emoza_after_sidebar'
	 *
	 * @since 1.0.0
	 */
	do_action('emoza_after_sidebar'); ?>
</aside><!-- #secondary -->
