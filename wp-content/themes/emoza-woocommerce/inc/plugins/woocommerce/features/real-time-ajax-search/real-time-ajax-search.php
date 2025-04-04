<?php
/**
 * Real Time Ajax Search
 *
 * @package Emoza
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Include the helper class.
require get_template_directory() . '/inc/plugins/woocommerce/features/real-time-ajax-search/real-time-ajax-search-helper.php';

/**
 * Real Time Ajax Search
 * 
 */
class Emoza_Real_Time_Ajax_Search {

	/**
	 * Constructor.
	 * 
	 */
	public function __construct() {
		$ajax_search = get_theme_mod( 'shop_search_enable_ajax', 0 );
		if ( $ajax_search ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ), 11 );

			add_action( 'emoza_shop_ajax_search_products_loop_start', array( $this, 'products_loop_wrapper_open' ), 10, 2 );
			add_action( 'emoza_shop_ajax_search_products_loop_end', array( $this, 'products_loop_wrapper_close' ), 10, 2 );
			add_action( 'emoza_shop_ajax_search_products_loop_end', array( $this, 'see_all_button' ), 15, 2 );
			add_action( 'emoza_shop_ajax_search_after_products_loop', array( $this, 'categories' ), 10, 2 );

			add_action('wp_ajax_emoza_ajax_search_callback', array( $this, 'ajax_callback' ) );
			add_action('wp_ajax_nopriv_emoza_ajax_search_callback', array( $this, 'ajax_callback' ) );

			add_filter( 'emoza_custom_css_output', array( $this, 'custom_css' ) );
		}

		$enable_search_by_sku = get_theme_mod( 'shop_search_ajax_enable_search_by_sku', 0 );
		if( $enable_search_by_sku ) {
			add_filter( 'posts_clauses', array( 'Emoza_Real_Time_Ajax_Search_Helper', 'set_query_post_clauses' ), 10, 2 );
		}
	}

	/**
	 * Enqueue scripts and styles.
	 * 
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_register_script( 'emoza-ajax-search', get_template_directory_uri() . '/assets/js/emoza-ajax-search.min.js', array( 'jquery' ), EMOZA_VERSION, true );
		wp_enqueue_script( 'emoza-ajax-search' );
		wp_localize_script( 'emoza-ajax-search', 'emoza_ajax_search', array( 'nonce' => wp_create_nonce( 'emoza-ajax-search-random-nonce' ) ) );
	}

	/**
	 * Products loop wrapper open.
	 * 
	 * @return void
	 */
	public function products_loop_wrapper_open( $query, $data ) {
		emoza_get_template_part( 'template-parts/search/content', 'ajax-search-loop-start' );
	}

	/**
	 * Products loop wrapper close.
	 * 
	 * @return void
	 */
	public function products_loop_wrapper_close( $query, $data ) {
		emoza_get_template_part( 'template-parts/search/content', 'ajax-search-loop-end' );
	}

	/**
	 * See All Button.
	 * 
	 * @return void
	 */
	public function see_all_button( $query, $data ) {
		$see_all_button = get_theme_mod( 'shop_search_ajax_display_see_all', 0 );
		if( ! $see_all_button ) {
			return;
		}

		$search_link_mounted = add_query_arg( 'post_type', 'product', get_search_link( $data['search-term'] ) );

		emoza_get_template_part( 'template-parts/search/content', 'ajax-search-see-all-button', array( 'search_link_mounted' => $search_link_mounted, 'query' => $query ) );
	}

	/**
	 * Categories.
	 * 
	 * @return void
	 */
	public function categories( $query, $data ) {
		if ( ! $data['show-categories'] ) {
			return;
		}

		if ( ! $data['search-term'] ) {
			return;
		}

		$term_args = array(
			'taxonomy' => 'product_cat',
			'name__like' => $data['search-term'],
		);

		$terms = get_terms( $term_args );
		if ( empty( $terms ) ) {
			return;
		}

		emoza_get_template_part( 'template-parts/search/content', 'ajax-search-categories', array( 'terms' => $terms ) );
	}

	/**
	 * Ajax Search Callback.
	 * 
	 * @return void
	 */
	public function ajax_callback() {
		check_ajax_referer( 'emoza-ajax-search-random-nonce', 'nonce' );

		$data = array();

		/**
		 * Hook 'emoza_ajax_search_search_term'
		 *
		 * @since 1.0.0
		 */
		$data['search-term'] = isset( $_POST['search_term'] ) ? apply_filters( 'emoza_ajax_search_search_term', sanitize_text_field( wp_unslash( $_POST['search_term'] ) ) ) : '';

		/**
		 * Hook 'emoza_shop_ajax_search_posts_per_page'
		 *
		 * @since 1.0.0
		 */
		$data['posts-per-page'] = apply_filters( 'emoza_shop_ajax_search_posts_per_page', get_theme_mod( 'shop_search_ajax_posts_per_page', 15 ) );

		/**
		 * Hook 'emoza_shop_ajax_search_order'
		 *
		 * @since 1.0.0
		 */
		$data['order'] = apply_filters( 'emoza_shop_ajax_search_order', get_theme_mod( 'shop_search_ajax_order', 'asc' ) );

		/**
		 * Hook 'emoza_shop_ajax_search_orderby'
		 *
		 * @since 1.0.0
		 */
		$data['orderby'] = apply_filters( 'emoza_shop_ajax_search_orderby', get_theme_mod( 'shop_search_ajax_orderby', 'title' ) ); 

		/**
		 * Hook 'emoza_shop_ajax_search_enable_search_by_sku'
		 *
		 * @since 1.0.0
		 */
		$data['enable-search-by-sku'] = apply_filters( 'emoza_shop_ajax_search_enable_search_by_sku', get_theme_mod( 'shop_search_ajax_enable_search_by_sku', 0 ) );

		/**
		 * Hook 'emoza_shop_ajax_search_show_categories'
		 *
		 * @since 1.0.0
		 */
		$data['show-categories'] = apply_filters( 'emoza_shop_ajax_search_show_categories', get_theme_mod( 'shop_search_ajax_show_categories', 1 ) );

		$query  = Emoza_Real_Time_Ajax_Search_Helper::get_products( $data );
		
		$output = '';
		ob_start();
		emoza_get_template_part( 'template-parts/search/content', 'ajax-search', array( 'query' => $query, 'data' => $data ) );
		$output = ob_get_clean();

		if( $output ) {
			wp_send_json( array(
				'status'  => 'success',
				'output'  => wp_kses_post( $output ),
			) );
		} else {
			$output = '<p class="emoza-ajax-search__no-results">'. esc_html__( 'No products found.', 'emoza-woocommerce' ) .'</p>';

			wp_send_json( array(
				'status'  => 'success',
				'type'    => 'no-results',
				'output'  => wp_kses_post( $output ),
			) );
		}
	}

	/**
	 * Custom CSS
	 * 
	 * @param string $css Custom CSS.
	 * 
	 * @return string
	 */
	public function custom_css( $css ) {
		$shop_ajax_search = get_theme_mod( 'shop_search_enable_ajax', 0 );

		if( ! $shop_ajax_search ) {
			return $css;
		}

		$css .= Emoza_Custom_CSS::get_border_color_rgba_css( 'color_body_text', '#212121', '.emoza-ajax-search__wrapper ,.emoza-ajax-search__item+.emoza-ajax-search__item:before', '0.1', true );
		$css .= Emoza_Custom_CSS::get_background_color_rgba_css( 'color_body_text', '#212121', '.emoza-ajax-search__divider', '0.1', true );

		return $css;
	}
}

new Emoza_Real_Time_Ajax_Search();
