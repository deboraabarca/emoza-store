<?php
/**
 * Footer class
 *
 * @package Emoza
 */

if ( !class_exists( 'Emoza_Footer' ) ) :
	Class Emoza_Footer {

		/**
		 * Instance
		 */     
		private static $instance;

		/**
		 * Initiator
		 */
		public static function get_instance() {
			if ( ! isset( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor
		 */
		public function __construct() {
			add_action( 'emoza_footer', array( $this, 'footer_widgets' ), 9 );
			add_action( 'emoza_footer', array( $this, 'footer_markup' ) );
			add_action( 'emoza_footer_after', array( $this, 'scroll_to_top' ) );
		}

		/**
		 * Widgets
		 */
		public function footer_widgets() {
			$container  = get_theme_mod( 'footer_container', 'container' );
			$layout     = get_theme_mod( 'footer_widgets', 'col3' );
			$alignment  = get_theme_mod( 'footer_widgets_alignment', 'top' );
			$visibility = get_theme_mod( 'footer_widgets_visibility', 'all' );

			if ( !is_active_sidebar( 'footer-1' ) || 'disabled' === $layout ) {
				return;
			}

			switch ($layout) {

				case 'col4':
				case 'col4-bigleft':
				case 'col4-bigright':   
					$columns    = 'col-3';
					$column_no  = 4;
					break;

				case 'col3':
				case 'col3-bigleft':
				case 'col3-bigright':
					$columns = 'col-4';
					$column_no  = 3;
					break;

				case 'col2':
				case 'col2-bigleft':
				case 'col2-bigright':
					$columns = 'col-6';
					$column_no  = 2;
					break;

				default:
					$columns = 'col-12';
					$column_no  = 1;
					break;
			}

			?>

			<?php 
			/**
			 * Hook 'emoza_before_footer_widgets'
			 * 
			 * @since 1.0.0
			 */
			do_action( 'emoza_before_footer_widgets' ); ?>

			<div class="footer-widgets visibility-<?php echo esc_attr( $visibility ); ?>">

				<?php 
				/**
				 * Hook 'emoza_footer_widgets_content_start'
				 * 
				 * @since 1.0.0
				 */
				do_action( 'emoza_footer_widgets_content_start' ); ?>

				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="footer-widgets-grid <?php echo esc_attr( $layout ); ?> align-<?php echo esc_attr( $alignment ); ?>">
					<?php for ( $i = 1; $i <= $column_no; $i++ ) { ?>
						<?php if ( is_active_sidebar( 'footer-' . $i ) ) : ?>
						<div class="widget-column">
							<?php dynamic_sidebar( 'footer-' . $i); ?>
						</div>
						<?php endif; ?>	
					<?php } ?>
					</div>
				</div>

				<?php 
				/**
				 * Hook 'emoza_footer_widgets_content_end'
				 * 
				 * @since 1.0.0
				 */
				do_action( 'emoza_footer_widgets_content_end' ); ?>

			</div>
			
			<?php 
			/**
			 * Hook 'emoza_after_footer_widgets'
			 * 
			 * @since 1.0.0
			 */
			do_action( 'emoza_after_footer_widgets' ); ?>

			<?php
		}

		/**
		 * Markup for the footer
		 */
		public function footer_markup() {
			$layout     = get_theme_mod( 'footer_copyright_layout', 'col2' );
			$container  = get_theme_mod( 'footer_credits_container', 'container' );
			$elements   = get_theme_mod( 'footer_copyright_elements', array( 'footer_credits', 'footer_social_profiles' ) );
			?>

			<?php 
			/**
			 * Hook 'emoza_before_footer_copyright'
			 * 
			 * @since 1.0.0
			 */
			do_action( 'emoza_before_footer_copyright' ); ?>

			<footer id="colophon" class="site-footer" <?php emoza_schema( 'footer' ); ?>>

				<?php 
				/**
				 * Hook 'emoza_footer_copyright_content_start'
				 * 
				 * @since 1.0.0
				 */
				do_action( 'emoza_footer_copyright_content_start' ); ?>

				<div class="<?php echo esc_attr( $container ); ?>">
					<div class="site-info">
						<div class="row">

							<?php if( $layout === 'col2' ) : ?>
								<div class="col-md-6 footer-copyright-elements">

									<?php 
									foreach( $elements as $element ) {
										$content = call_user_func( array( $this, $element ), 'left' );

										if( $content ) {
											echo wp_kses_post( $content );
										}
									} ?>	
								
								</div>
								<div class="col-md-6 footer-copyright-elements">

									<?php 
									foreach( $elements as $element ) {
										$content = call_user_func( array( $this, $element ), 'right' );

										if( $content ) {
											echo wp_kses_post( $content );
										}
									} ?>

								</div>
							<?php else : 
								$footer_content_alignment = get_theme_mod( 'footer_content_alignment', 'left' ); ?>
								
								<div class="col-12 footer-copyright-elements footer-copyright-alignment-<?php echo esc_attr( $footer_content_alignment ); ?>">

									<?php 
									foreach( $elements as $element ) {
										$content = call_user_func( array( $this, $element ), 'all' );

										if( $content ) {
											echo wp_kses_post( $content );
										}
									} ?>

								</div>
							<?php endif; ?>
							
						</div>
					</div>
				</div><!-- .site-info -->

				<?php 
				/**
				 * Hook 'emoza_footer_copyright_content_end'
				 * 
				 * @since 1.0.0
				 */
				do_action( 'emoza_footer_copyright_content_end' ); ?>

			</footer><!-- #colophon -->

			<?php 
			/**
			 * Hook 'emoza_after_footer_copyright'
			 * 
			 * @since 1.0.0
			 */
			do_action( 'emoza_after_footer_copyright' ); ?>

			<?php
		}

		/**
		 * Credits
		 */
		public function footer_credits( $position = 'all' ) {
			$footer_credits_position = get_theme_mod( 'footer_credits_position', 'right' );
			
			if( $footer_credits_position !== $position && 'all' !== $position ) {
				return '';
			}

			/* translators: %1$1s, %2$2s theme copyright tags*/
			$credits    = get_theme_mod( 'footer_credits', sprintf( esc_html__( '%1$1s. Proudly powered by %2$2s', 'emoza-woocommerce' ), '{copyright} {year} {site_title}', '{theme_author}' ) );

			$tags       = array( '{theme_author}', '{site_title}', '{copyright}', '{year}' );
			$replace    = array( '<a rel="nofollow" href="https://emoza.org">' . esc_html__( 'Emoza', 'emoza-woocommerce' ) . '</a>', get_bloginfo( 'name' ), '&copy;', gmdate('Y') );

			// White Label
			if( defined( 'EMOZA_WL_ACTIVE' ) ) {
				$wl_data = emoza_wl_get_data();
				$replace[0] = '<a rel="nofollow" href="'. esc_url( $wl_data[ 'wl_agency_url' ] ) .'">' . esc_html( $wl_data[ 'wl_agency_name' ] ) . '</a>';
			}

			$credits    = str_replace( $tags, $replace, $credits );

			return '<div class="emoza-credits">' . $credits . '</div>';
		}

		/**
		 * Social profiles
		 */
		public function footer_social_profiles( $position = 'all' ) {
			$social_profiles_footer_position = get_theme_mod( 'social_profiles_footer_position', 'left' );
			
			if( $social_profiles_footer_position !== $position && 'all' !== $position ) {
				return '';
			}

			emoza_social_profile( 'social_profiles_footer' );
		}

		/**
		 * Payment icons
		 */
		public function footer_payment_icons( $position = 'all' ) {
			$footer_payment_image    = get_theme_mod( 'footer_payment_image' );
			$footer_payment_position = get_theme_mod( 'footer_payment_position', 'right' );

			if( ! $footer_payment_image ) {
				return '';
			}

			if( $footer_payment_position !== $position && 'all' !== $position ) {
				return '';
			} 
			
			// Get image
			$image = wp_get_attachment_image( attachment_url_to_postid( $footer_payment_image ), 'full' ); 

			return '<div class="emoza-payment-methods">' . $image . '</div>';
		}

		/**
		 * Navigation menu
		 */
		public function footer_navigation_menu( $position = 'all' ) {
			$footer_navigation_menu_position = get_theme_mod( 'footer_navigation_menu_position', 'left' );

			if( $footer_navigation_menu_position !== $position && 'all' !== $position ) {
				return '';
			} ?> 

			<div class="emoza-footer-copyright-navigation not-footer-builder">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'footer-copyright-menu',
						'menu_id'        => 'footer-copyright-menu',
						'depth'          => 1,
					)
				); ?>
			</div>

			<?php
		}

		/**
		 * HTML
		 */
		public function footer_html( $position = 'all' ) {
			$footer_html_content  = get_theme_mod( 'footer_html_content' );
			$footer_html_position = get_theme_mod( 'footer_html_position', 'right' );

			if( ! $footer_html_content ) {
				return '';
			}

			if( $footer_html_position !== $position && 'all' !== $position ) {
				return '';
			}

			return '<div class="emoza-html">'. $footer_html_content .'</div>'; 
		}

		/**
		 * Shortcode
		 */
		public function footer_shortcode( $position = 'all' ) {
			$footer_shortcode_content  = get_theme_mod( 'footer_shortcode_content' );
			$footer_shortcode_position = get_theme_mod( 'footer_shortcode_position', 'right' );

			if( ! $footer_shortcode_content ) {
				return '';
			}

			if( $footer_shortcode_position !== $position && 'all' !== $position ) {
				return '';
			}

			return '<div class="emoza-shortcode">'. do_shortcode( $footer_shortcode_content ) .'</div>'; 
		}

		/**
		 * Back to top icon
		 */
		public function scroll_to_top() {
			$enable = get_theme_mod( 'enable_scrolltop', 1 );

			if ( !$enable ) {
				return;
			}

			$type       = get_theme_mod( 'scrolltop_type', 'icon' );            
			$text       = get_theme_mod( 'scrolltop_text', esc_html__( 'Back to top', 'emoza-woocommerce' ) ); 
			$icon       = get_theme_mod( 'scrolltop_icon', 'icon1' );
			$visibility = get_theme_mod( 'scrolltop_visibility', 'all' );
			$position   = get_theme_mod( 'scrolltop_position', 'right' );

			echo '<div class="back-to-top visibility-' . esc_attr( $visibility ) . ' position-' . esc_attr( $position ) . '">';
			if ( 'text' === $type ) {
				echo '<span>' . esc_html( $text ) . '</span>';
			}
			echo    '<i class="ws-svg-icon">' . emoza_get_svg_icon( 'icon-btt-' . $icon, false ) . '</i>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo '</div>';
		}
	}

	/**
	 * Initialize class
	 */
	Emoza_Footer::get_instance();

endif;