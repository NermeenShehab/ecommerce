<?php
/**
 * Theme static files
 *
 * @package ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Enqueue scripts and styles.
 */
//front end styles and scripts
if ( ! function_exists( 'exs_enqueue_static' ) ) :
	function exs_enqueue_static() {

		$min = exs_option( 'assets_min' ) && ! EXS_DEV_MODE ? 'min/' : '';

		$main_nob = exs_option( 'assets_main_nob' );
		$nob = exs_option( 'assets_nob' );
		//main theme css file
		if ( ! empty( $main_nob ) ) {
			wp_enqueue_style( 'exs-style', EXS_THEME_URI . '/assets/css/' . $min . 'main-nob.css', array(), EXS_THEME_VERSION );
		} else {
			wp_enqueue_style( 'exs-style', EXS_THEME_URI . '/assets/css/' . $min . 'main.css', array(), EXS_THEME_VERSION );
		}

		if ( ! empty( $nob ) ) {
			//deregister block library CSS
			wp_dequeue_style( 'wp-block-library' );
		}

		//Woo styles
		if ( class_exists( 'WooCommerce' ) ) {
			wp_enqueue_style( 'exs-shop-style', EXS_THEME_URI . '/assets/css/' . $min . 'shop.css', array(), EXS_THEME_VERSION );
			$shop_animation = exs_option( 'shop_animation', '');
			if ( ! empty( $shop_animation ) ) {
				wp_enqueue_style( 'exs-shop-animation-style', EXS_THEME_URI . '/assets/css/' . $min . 'shop-animation' . (int) $shop_animation . '.css', array(), EXS_THEME_VERSION );
			}
		}
		//EDD styles
		if ( class_exists( 'Easy_Digital_Downloads' ) ) {
			wp_enqueue_style( 'exs-edd-style', EXS_THEME_URI . '/assets/css/' . $min . 'edd.css', array(), EXS_THEME_VERSION );
		}
		//bbPress styles
		if ( class_exists( 'bbPress' ) ) {
			wp_enqueue_style( 'exs-bbpress-style', EXS_THEME_URI . '/assets/css/' . $min . 'bbpress.css', array(), EXS_THEME_VERSION );
		}
		//BuddyPress styles
		if ( class_exists( 'BuddyPress' ) ) {
			wp_enqueue_style( 'exs-buddypress-style', EXS_THEME_URI . '/assets/css/' . $min . 'buddypress.css', array(), EXS_THEME_VERSION );
		}
		//WP Job Manager styles
		if ( class_exists( 'WP_Job_Manager' ) ) {
			wp_enqueue_style( 'exs-wpjm-style', EXS_THEME_URI . '/assets/css/' . $min . 'wpjm.css', array(), EXS_THEME_VERSION );
		}
		//Simple Job Board styles
		if ( class_exists( 'Simple_Job_Board' ) ) {
			wp_enqueue_style( 'exs-sjb-style', EXS_THEME_URI . '/assets/css/' . $min . 'sjb.css', array(), EXS_THEME_VERSION );
		}
		//Ultimate Member styles
		if ( class_exists( 'UM_Functions' ) ) {
			wp_enqueue_style( 'exs-um-style', EXS_THEME_URI . '/assets/css/' . $min . 'um.css', array(), EXS_THEME_VERSION );
		}
		//Events Calendar
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			wp_enqueue_style( 'exs-events-calendar-style', EXS_THEME_URI . '/assets/css/' . $min . 'events-calendar.css', array(), EXS_THEME_VERSION );
		}
		//LearnPress
		if ( class_exists( 'LearnPress' ) ) {
			if ( version_compare(LEARNPRESS_VERSION, '4.0.0', '>') ) {
				wp_enqueue_style( 'exs-learnpress-style', EXS_THEME_URI . '/assets/css/' . $min . 'learnpress4.css', array(), EXS_THEME_VERSION );
			} else {
				wp_enqueue_style( 'exs-learnpress-style', EXS_THEME_URI . '/assets/css/' . $min . 'learnpress.css', array(), EXS_THEME_VERSION );
			}
		}

		//views, post and comments likes
		if (
			class_exists( 'Post_Views_Counter' )
			||
			class_exists( 'PLD_Comments_like_dislike' )
			||
			class_exists( 'CLD_Comments_like_dislike' )
		) {
			wp_enqueue_style( 'exs-views-likes-style', EXS_THEME_URI . '/assets/css/' . $min . 'views-likes.css', array(), EXS_THEME_VERSION );
		}

		//elementor
		if (
			defined( 'ELEMENTOR_VERSION' )
			||
			defined( 'ELEMENTOR_PRO_VERSION' )
		) {
			wp_enqueue_style( 'exs-elementor-style', EXS_THEME_URI . '/assets/css/' . $min . 'elementor.css', array(), EXS_THEME_VERSION );
		}

		//admin-bar styles for front end
		if ( is_admin_bar_showing() ) {
			//Add Frontend admin styles
			wp_enqueue_style(
				'exs-admin-bar-style',
				EXS_THEME_URI . '/assets/css/admin-frontend.css',
				array(),
				EXS_THEME_VERSION
			);
		}

		$min_js = ! EXS_DEV_MODE ? 'min/' : '';
		//main theme script
		wp_enqueue_script( 'exs-init-script', EXS_THEME_URI . '/assets/js/' . $min_js . 'init.js', array(), EXS_THEME_VERSION, true );

		//glightbox gallery
		if ( exs_option( 'assets_lightbox', '' ) ) :
			wp_enqueue_script( 'exs-glightbox-script', EXS_THEME_URI . '/assets/vendors/glightbox/glightbox.min.js', array(), EXS_THEME_VERSION, true );
			wp_enqueue_script( 'exs-glightbox-init-script', EXS_THEME_URI . '/assets/vendors/glightbox/glightbox.init.js', array(), EXS_THEME_VERSION, true );
			wp_enqueue_style( 'exs-glightbox-style', EXS_THEME_URI . '/assets/vendors/glightbox/glightbox.min.css', array(), EXS_THEME_VERSION );
		endif;

		//comments script
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		if ( is_customize_preview() ) {
			wp_enqueue_script( 'exs-customize-preview-script', EXS_THEME_URI . '/assets/js/' . $min_js . 'customize-preview.js', array( 'jquery', 'customize-selective-refresh' ), EXS_THEME_VERSION, true );
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'exs_enqueue_static' );

//front end styles and scripts
if ( ! function_exists( 'exs_enqueue_static_later' ) ) :
	function exs_enqueue_static_later() {

		wp_register_style( 'exs-style-inline', false );
		wp_enqueue_style( 'exs-style-inline' );

		//inline styles for customizer options - colors and typography
		$exs_colors_string = exs_get_root_colors_inline_styles_string();
		$exs_typography_string = exs_get_typography_inline_styles_string();
		if ( ! empty( $exs_colors_string ) || ! empty( $exs_typography_string ) ) :
			$exs_styles_string = '';
			if ( ! empty( $exs_colors_string ) ) {
				$exs_styles_string .= ':root{' . $exs_colors_string . '}';
			}
			wp_add_inline_style(
				'exs-style-inline',
				wp_kses(
					$exs_styles_string . $exs_typography_string,
					false
				)
			);
		endif;

	}
endif;
add_action( 'wp_enqueue_scripts', 'exs_enqueue_static_later', 9999 );

//enqueue masonry for grid layout
if ( ! function_exists( 'exs_enqueue_masonry' ) ) :
	function exs_enqueue_masonry() {
		wp_enqueue_script( 'masonry', '', array( 'imagesloaded' ), '', true );
	}
endif;
//enqueue masonry for grid layout action
if ( ! function_exists( 'exs_enqueue_masonry_action' ) ) :
	function exs_enqueue_masonry_action() {
		add_action( 'wp_enqueue_scripts', 'exs_enqueue_masonry' );
	}
endif;

//customizer panel
if ( ! function_exists( 'exs_customizer_js' ) ) :
	function exs_customizer_js() {
		wp_enqueue_style(
			'exs-customizer-style',
			EXS_THEME_URI . '/assets/css/customizer.css',
			array(),
			EXS_THEME_VERSION
		);
		$min = ! EXS_DEV_MODE ? 'min/' : '';
		wp_register_script(
			'exs-customize-controls',
			EXS_THEME_URI . '/assets/js/' . $min . 'customize-controls.js',
			array( 'jquery' ),
			EXS_THEME_VERSION,
			true
		);
		$exs_blog_url = get_post_type_archive_link( 'post' );
		$exs_post     = wp_get_recent_posts(
			array(
				'numberposts' => 1,
				'post_status' => 'publish',
			)
		);
		wp_reset_postdata();
		$exs_post_url   = ( ! empty( $exs_post[0] ) ) ? get_permalink( $exs_post[0]['ID'] ) : $exs_blog_url;
		$exs_search_url = home_url( '/' ) . '?s=';
		$exs_shop_url = esc_html( home_url( '/' ) );
		$exs_checkout_url = $exs_shop_url;
		$exs_product_url = $exs_shop_url;
		if ( class_exists( 'WooCommerce' ) ) {
			$exs_shop_url = wc_get_page_permalink( 'shop' );
			$exs_checkout_url = wc_get_page_permalink( 'checkout' );
			$exs_products = wc_get_products( array( 'limit' => 1 ) );
			if ( ! empty( $exs_products[0] ) ) {
				$exs_product_url = get_permalink( $exs_products[0]->get_id());
			} else {
				$exs_product_url = $exs_shop_url;
			}
		}
		wp_localize_script(
			'exs-customize-controls',
			'exsCustomizerObject',
			array(
				'homeUrl'     => esc_url_raw( home_url() ),
				'blogUrl'     => esc_url_raw( $exs_blog_url ),
				'postUrl'     => esc_url_raw( $exs_post_url ),
				'searchUrl'   => esc_url_raw( $exs_search_url ),
				'shopUrl'     => esc_url_raw( $exs_shop_url ),
				'productUrl'  => esc_url_raw( $exs_product_url ),
				'checkoutUrl' => esc_url_raw( $exs_checkout_url ),
				'themeUrl'    => esc_url_raw( EXS_THEME_URI ),
			)
		);
		wp_enqueue_script( 'exs-customize-controls' );
	}
endif;
add_action( 'customize_controls_enqueue_scripts', 'exs_customizer_js' );

//admin styles
if ( ! function_exists( 'exs_action_load_custom_wp_admin_style' ) ) :
	function exs_action_load_custom_wp_admin_style( $exs_page ) {
		if (
			$exs_page !== 'edit.php'
			&&
			$exs_page !== 'post.php'
			&&
			$exs_page !== 'post-new.php'
			&&
			$exs_page !== 'appearance_page_pt-one-click-demo-import'
			&&
			$exs_page !== 'appearance_page_one-click-demo-import'
		) {
			return;
		}
		wp_register_style( 'exs-custom-wp-admin-css', EXS_THEME_URI . '/assets/css/admin-backend.css', false, EXS_THEME_VERSION );
		wp_enqueue_style( 'exs-custom-wp-admin-css' );
		$exs_colors_string = exs_get_root_colors_inline_styles_string();
		if ( ! empty( $exs_colors_string ) ) :
			wp_add_inline_style(
				'exs-custom-wp-admin-css',
				wp_kses(
					':root{' . $exs_colors_string . '}',
					false
				)
			);
		endif;
	} //exs_action_load_custom_wp_admin_style()
endif;
add_action( 'admin_enqueue_scripts', 'exs_action_load_custom_wp_admin_style' );

//Gutenberg script
//https://developer.wordpress.org/block-editor/tutorials/javascript/loading-javascript/
if ( ! function_exists( 'exs_action_enqueue_block_editor_assets' ) ) :
	function exs_action_enqueue_block_editor_assets( $exs_page ) {
		$min = ! EXS_DEV_MODE ? 'min/' : '';
		wp_enqueue_script(
			'exs-gutenberg-script',
			EXS_THEME_URI . '/assets/js/' . $min . 'gutenberg.js',
			array(
				'wp-i18n',
				'wp-blocks',
			),
			EXS_THEME_VERSION
		);

	}
endif;
add_action( 'enqueue_block_editor_assets', 'exs_action_enqueue_block_editor_assets' );

//Gutenberg styles
//https://developer.wordpress.org/block-editor/how-to-guides/javascript/extending-the-block-editor/
//does not work for the iframe editor - https://make.wordpress.org/core/2021/06/29/blocks-in-an-iframed-template-editor/
//because this styles are not for content - only for editor itself:
//https://github.com/WordPress/gutenberg/issues/33212#issuecomment-879290553
//if( ! function_exists( 'exs_action_enqueue_block_editor_styles' ) ) :
//	function exs_action_enqueue_block_editor_styles() {
//		$exs_colors_string = exs_get_root_colors_inline_styles_string();
//		if ( ! empty( $exs_colors_string ) ) :
//			wp_add_inline_style(
//				'wp-edit-blocks',
//				wp_kses(
//					':root{' . $exs_colors_string . '}',
//					false
//				)
//			);
//		endif;
//	}
//endif;
//add_action( 'enqueue_block_assets', 'exs_action_enqueue_block_editor_styles' );
