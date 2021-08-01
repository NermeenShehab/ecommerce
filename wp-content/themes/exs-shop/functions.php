<?php
/**
 * Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage ExS
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

//load parent CSS
if ( ! function_exists( 'exs_shop_enqueue_static' ) ) :
	/**
	 * exs_shop_enqueue_static
	 *
	 * @return void
	 * @since 0.0.1
	 */
	function exs_shop_enqueue_static() {

		$min = exs_option( 'assets_min' ) && ! EXS_DEV_MODE ? 'min/' : '';
		//main theme css file
		wp_enqueue_style( 'exs-shop-child-style', get_stylesheet_directory_uri() . '/assets/css/' . $min . 'main.css', array( 'exs-style' ), wp_get_theme()->get( 'Version' ) );

		if ( function_exists( 'exs_extra_enqueue_static' ) ) {
			return;
		}

		//custom Google fonts css file and inline styles if option is enabled
		$exs_font_body     = json_decode( exs_option( 'font_body', '{"font":"","variant": [],"subset":[]}' ) );
		$exs_font_headings = json_decode( exs_option( 'font_headings', '{"font":"","variant": [],"subset":[]}' ) );

		if ( ! empty( $exs_font_body->font ) || ! empty( $exs_font_headings->font ) ) {
			/*
			Translators: If there are characters in your language that are not supported
			by chosen font(s), translate this to 'off'. Do not translate into your own language.
			*/

			if ( 'off' !== esc_html_x( 'on', 'Google font: on or off', 'exs' ) ) {
				$exs_body_variants = array();
				$exs_body_subsets  = array();
				if ( ! empty( $exs_font_body->font ) ) {
					$exs_body_variants = $exs_font_body->variant;
					$exs_body_subsets  = $exs_font_body->subset;
				}

				$exs_headings_variants = array();
				$exs_headings_subsets  = array();
				if ( ! empty( $exs_font_headings->font ) ) {
					$exs_headings_variants = $exs_font_headings->variant;
					$exs_headings_subsets  = $exs_font_headings->subset;
				}

				$exs_fonts    = array(
					'body'     => $exs_font_body->font,
					'headings' => $exs_font_headings->font,
				);
				$exs_variants = array(
					'body'     => implode( ',', $exs_body_variants ),
					'headings' => implode( ',', $exs_headings_variants ),
				);
				$exs_subsets  = array(
					'body'     => implode( ',', $exs_body_subsets ),
					'headings' => implode( ',', $exs_headings_subsets ),
				);
				//'Montserrat|Bowlby One|Quattrocento Sans';
				$exs_fonts_string    = implode( '|', array_filter( $exs_fonts ) );
				$exs_variants_string = implode( ',', array_filter( $exs_variants ) );
				$exs_variants_string = ! empty( $exs_variants_string ) ? ':' . $exs_variants_string : '';
				$exs_subsets_string  = implode( ',', array_filter( $exs_subsets ) );

				$exs_query_args = array(
					'family' => urlencode( $exs_fonts_string . $exs_variants_string ),
				);
				if ( ! empty( $exs_subsets_string ) ) {
					$exs_query_args['subset'] = urlencode( $exs_subsets_string );
				}
				$exs_font_url = add_query_arg(
					$exs_query_args,
					'//fonts.googleapis.com/css'
				);

				//no need to provide anew version for Google fonts link - exs-style added to load it before google fonts style
				wp_enqueue_style( 'exs-google-fonts-style', $exs_font_url, array( 'exs-style' ), '1.0.0' );

				//printing header styles
				$exs_body_style = ( ! empty( $exs_font_body->font ) ) ? 'body,button,input,select,textarea{font-family:"' . $exs_font_body->font . '",sans-serif}' : '';

				$exs_headings_style = ( ! empty( $exs_font_headings->font ) ) ? 'h1,h2,h3,h4,h5,h6{font-family: "' . $exs_font_headings->font . '",sans-serif}' : '';

				wp_add_inline_style(
					'exs-google-fonts-style',
					wp_kses(
						$exs_body_style . $exs_headings_style,
						false
					)
				);
			}
		}
	}
endif;
add_action( 'wp_enqueue_scripts', 'exs_shop_enqueue_static', 20 );

//theme options
if ( ! function_exists( 'exs_shop_default_options' ) ) :
	function exs_shop_default_options() {
		return array(
			'demo_number'                              => '',
			'colorLight'                               => '#ffffff',
			'colorFont'                                => '#111111',
			'colorFontMuted'                           => '#666666',
			'colorBackground'                          => '#f7f7f7',
			'colorBorder'                              => '#efefef',
			'colorDark'                                => '#444444',
			'colorDarkMuted'                           => '#222222',
			'colorMain'                                => '#e57b7b',
			'colorMain2'                               => '#8a8dff',
			'color_meta_icons'                         => 'meta-icons-main',
			'intro_block_heading'                      => '',
			'intro_position'                           => '',
			'intro_layout'                             => '',
			'intro_fullscreen'                         => '',
			'intro_background'                         => '',
			'intro_background_image'                   => '',
			'intro_image_animation'                    => 'zoomIn',
			'intro_background_image_cover'             => '1',
			'intro_background_image_fixed'             => '1',
			'intro_background_image_overlay'           => '',
			'intro_heading'                            => '',
			'intro_heading_mt'                         => '',
			'intro_heading_mb'                         => '',
			'intro_heading_animation'                  => 'fadeInUp',
			'intro_description'                        => '',
			'intro_description_mt'                     => '',
			'intro_description_mb'                     => '',
			'intro_description_animation'              => 'fadeInUp',
			'intro_button_text_first'                  => '',
			'intro_button_url_first'                   => '',
			'intro_button_first_animation'             => 'fadeInUp',
			'intro_button_text_second'                 => '',
			'intro_button_url_second'                  => '',
			'intro_button_second_animation'            => 'fadeInUp',
			'intro_buttons_mt'                         => '',
			'intro_buttons_mb'                         => '',
			'intro_shortcode'                          => '',
			'intro_shortcode_mt'                       => '',
			'intro_shortcode_mb'                       => '',
			'intro_shortcode_animation'                => '',
			'intro_alignment'                          => 'text-center',
			'intro_extra_padding_top'                  => 'pt-5',
			'intro_extra_padding_bottom'               => 'pb-5',
			'intro_show_search'                        => '',
			'intro_font_size'                          => '',
			'intro_teasers_block_heading'              => '',
			'intro_teaser_section_layout'              => '',
			'intro_teaser_section_background'          => '',
			'intro_teaser_section_padding_top'         => 'pt-5',
			'intro_teaser_section_padding_bottom'      => 'pb-5',
			'intro_teaser_font_size'                   => '',
			'intro_teaser_layout'                      => 'text-center',
			'intro_teaser_heading'                     => '',
			'intro_teaser_description'                 => '',
			'logo'                                     => '1',
			'logo_text_primary'                        => '',
			'logo_text_primary_hidden'                 => '',
			'logo_text_secondary'                      => '',
			'logo_text_secondary_hidden'               => '',
			'header_top_tall'                          => '',
			'logo_background'                          => '',
			'logo_padding_horizontal'                  => '',
			'skins_extra'                              => '',
			'main_container_width'                     => '1400',
			'blog_container_width'                     => '',
			'blog_single_container_width'              => '960',
			'search_container_width'                   => '',
			'preloader'                                => '',
			'box_fade_in'                              => '',
			'totop'                                    => '1',
			'assets_min'                               => '1',
			'assets_lightbox'                          => '1',
			'post_thumbnails_fullwidth'                => '',
			'buttons_uppercase'                        => '',
			'buttons_bold'                             => '1',
			'buttons_colormain'                        => '',
			'buttons_outline'                          => '',
			'buttons_big'                              => '',
			'buttons_radius'                           => 'btns-rounded',
			'buttons_fs'                               => '',
			'meta_email'                               => '',
			'meta_email_label'                         => '',
			'meta_phone'                               => '',
			'meta_phone_label'                         => '',
			'meta_address'                             => '',
			'meta_address_label'                       => '',
			'meta_opening_hours'                       => '',
			'meta_opening_hours_label'                 => '',
			'meta_facebook'                            => '#',
			'meta_twitter'                             => '#',
			'meta_youtube'                             => '#',
			'meta_instagram'                           => '#',
			'meta_pinterest'                           => '',
			'meta_linkedin'                            => '',
			'meta_github'                              => '',
			'side_extra'                               => '',
			'header_image_background_image_cover'      => '1',
			'header_image_background_image_fixed'      => '1',
			'header_image_background_image_overlay'    => '',
			'header'                                   => '1',
			'header_logo_hidden'                       => '',
			'header_fluid'                             => '',
			'header_background'                        => 'l',
			'header_align_main_menu'                   => 'menu-right',
			'header_toggler_menu_main'                 => '1',
			'header_absolute'                          => '',
			'header_transparent'                       => '',
			'header_menu_uppercase'                    => '',
			'header_menu_bold'                         => '',
			'header_border_top'                        => '',
			'header_border_bottom'                     => '',
			'header_font_size'                         => '',
			'header_sticky'                            => 'scrolltop-sticky',
			'header_login_links'                       => '',
			'header_login_links_hidden'                => '',
			'header_search'                            => '',
			'header_search_hidden'                     => '',
			'header_button_text'                       => '',
			'header_button_url'                        => '',
			'header_button_hidden'                     => '',
			'header_toplogo_options_heading'           => '',
			'header_toplogo_background'                => 'l',
			'header_toplogo_social_hidden'             => '',
			'header_toplogo_meta_hidden'               => '',
			'header_topline_options_heading'           => '',
			'topline'                                  => '',
			'topline_fluid'                            => '1',
			'topline_background'                       => 'i c',
			'meta_topline_text'                        => '',
			'topline_font_size'                        => 'fs-14',
			'topline_login_links'                      => '',
			'title'                                    => '1',
			'title_fluid'                              => '',
			'title_show_title'                         => '1',
			'title_show_breadcrumbs'                   => '1',
			'title_show_search'                        => '',
			'title_background'                         => '',
			'title_border_top'                         => '',
			'title_border_bottom'                      => '',
			'title_extra_padding_top'                  => 'pt-4',
			'title_extra_padding_bottom'               => 'pb-2',
			'title_font_size'                          => '',
			'title_hide_taxonomy_name'                 => '',
			'title_background_image'                   => '',
			'title_background_image_cover'             => '1',
			'title_background_image_fixed'             => '1',
			'title_background_image_overlay'           => '',
			'title_blog_single_hide_meta_icons'        => '1',
			'title_blog_single_show_author'            => '',
			'title_blog_single_show_author_avatar'     => '',
			'title_blog_single_before_author_word'     => '',
			'title_blog_single_show_date'              => '',
			'title_blog_single_before_date_word'       => '',
			'title_blog_single_show_human_date'        => '',
			'title_blog_single_show_categories'        => '',
			'title_blog_single_before_categories_word' => '',
			'title_blog_single_show_tags'              => '',
			'title_blog_single_before_tags_word'       => '',
			'title_blog_single_show_comments_link'     => '',
			'main_sidebar_width'                       => '25',
			'main_gap_width'                           => '',
			'main_sidebar_sticky'                      => '1',
			'main_extra_padding_top'                   => 'pt-2',
			'main_extra_padding_bottom'                => 'pb-6',
			'main_font_size'                           => '',
			'sidebar_font_size'                        => '',
			'main_sidebar_widgets_heading'             => '',
			'main_sidebar_widgets_title_uppercase'     => '',
			'main_sidebar_widgets_title_bold'          => '',
			'main_sidebar_widgets_title_decor'         => '1',
			'footer_top'                               => '',
			'footer_top_content_heading_text'          => '',
			'footer_top_image'                         => '',
			'footer_top_pre_heading'                   => '',
			'footer_top_pre_heading_mt'                => '',
			'footer_top_pre_heading_mb'                => '',
			'footer_top_pre_heading_animation'         => '',
			'footer_top_heading'                       => '',
			'footer_top_heading_mt'                    => '',
			'footer_top_heading_mb'                    => '',
			'footer_top_heading_animation'             => '',
			'footer_top_description'                   => '',
			'footer_top_description_mt'                => '',
			'footer_top_description_mb'                => '',
			'footer_top_description_animation'         => '',
			'footer_top_shortcode'                     => '',
			'footer_top_shortcode_mt'                  => '',
			'footer_top_shortcode_mb'                  => '',
			'footer_top_shortcode_animation'           => '',
			'footer_top_options_heading_text'          => '',
			'footer_top_fluid'                         => '',
			'footer_top_background'                    => '',
			'footer_top_border_top'                    => '',
			'footer_top_border_bottom'                 => '',
			'footer_top_extra_padding_top'             => '',
			'footer_top_extra_padding_bottom'          => '',
			'footer_top_font_size'                     => '',
			'footer_top_background_image'              => '',
			'footer_top_background_image_cover'        => '',
			'footer_top_background_image_fixed'        => '',
			'footer_top_background_image_overlay'      => '',
			'footer'                                   => '1',
			'footer_layout_gap'                        => '30',
			'footer_fluid'                             => '',
			'footer_background'                        => 'i m',
			'footer_border_top'                        => '',
			'footer_border_bottom'                     => 'container',
			'footer_extra_padding_top'                 => 'pt-6',
			'footer_extra_padding_bottom'              => 'pb-2',
			'footer_font_size'                         => '',
			'footer_background_image'                  => '',
			'footer_background_image_cover'            => '1',
			'footer_background_image_fixed'            => '1',
			'footer_background_image_overlay'          => '',
			'footer_widgets_heading'                   => '',
			'footer_sidebar_widgets_title_uppercase'   => '',
			'footer_sidebar_widgets_title_bold'        => '',
			'footer_sidebar_widgets_title_decor'       => '1',
			'copyright'                                => '4',
			'copyright_text'                           => '&copy; [year]',
			'copyright_fluid'                          => '',
			'copyright_background'                     => 'i m',
			'copyright_extra_padding_top'              => 'pt-2',
			'copyright_extra_padding_bottom'           => 'pb-2',
			'copyright_font_size'                      => 'fs-14',
			'copyright_background_image'               => '',
			'copyright_background_image_cover'         => '',
			'copyright_background_image_fixed'         => '',
			'copyright_background_image_overlay'       => '',
			'typo_body_heading'                        => '',
			'typo_body_size'                           => '',
			'typo_body_weight'                         => '',
			'typo_body_line_height'                    => '',
			'typo_body_letter_spacing'                 => '',
			'typo_p_margin_bottom'                     => '',
			'font_body_extra'                          => '',
			'blog_layout'                              => 'default-wide-image',
			'blog_layout_gap'                          => '30',
			'blog_sidebar_position'                    => 'right',
			'blog_page_name'                           => '',
			'blog_show_full_text'                      => '',
			'blog_excerpt_length'                      => '20',
			'blog_read_more_text'                      => '',
			'blog_hide_taxonomy_type_name'             => '',
			'blog_meta_options_heading'                => '',
			'blog_hide_meta_icons'                     => '',
			'blog_show_author'                         => '1',
			'blog_show_author_avatar'                  => '',
			'blog_before_author_word'                  => '',
			'blog_show_date'                           => '1',
			'blog_before_date_word'                    => '',
			'blog_show_human_date'                     => '',
			'blog_show_categories'                     => '1',
			'blog_before_categories_word'              => '',
			'blog_show_tags'                           => '1',
			'blog_before_tags_word'                    => '',
			'blog_show_comments_link'                  => 'number',
			'blog_single_layout'                       => 'wide-image',
			'blog_single_sidebar_position'             => 'no',
			'blog_single_first_embed_featured'         => '',
			'blog_single_fullwidth_featured'           => '',
			'blog_single_show_author_bio'              => '1',
			'blog_single_author_bio_about_word'        => '',
			'blog_single_post_nav_heading'             => '',
			'blog_single_post_nav'                     => 'thumbnail',
			'blog_single_post_nav_word_prev'           => esc_html__( 'Prev', 'exs-shop' ),
			'blog_single_post_nav_word_next'           => esc_html__( 'Next', 'exs-shop' ),
			'blog_single_related_posts_heading'        => '',
			'blog_single_related_posts'                => 'list-thumbnails',
			'blog_single_related_posts_title'          => esc_html__( 'Related Posts', 'exs-shop' ),
			'blog_single_related_posts_number'         => '4',
			'blog_single_meta_options_heading'         => '',
			'blog_single_hide_meta_icons'              => '',
			'blog_single_show_author'                  => '1',
			'blog_single_show_author_avatar'           => '',
			'blog_single_before_author_word'           => '',
			'blog_single_show_date'                    => '1',
			'blog_single_before_date_word'             => '',
			'blog_single_show_human_date'              => '',
			'blog_single_show_categories'              => '1',
			'blog_single_before_categories_word'       => '',
			'blog_single_show_tags'                    => '1',
			'blog_single_before_tags_word'             => '',
			'blog_single_show_comments_link'           => 'number',
			'blog_single_toc_heading'                  => '',
			'blog_single_toc_enabled'                  => '',
			'blog_single_toc_title'                    => '',
			'blog_single_toc_background'               => '',
			'blog_single_toc_bordered'                 => '',
			'blog_single_toc_shadow'                   => '',
			'blog_single_toc_rounded'                  => '',
			'blog_single_toc_mt'                       => '',
			'blog_single_toc_mb'                       => '',
			'search_layout'                            => 'side',
			'search_sidebar_position'                  => 'right',
			'search_show_full_text'                    => '',
			'search_excerpt_length'                    => '20',
			'search_read_more_text'                    => '',
			'search_meta_options_heading'              => '',
			'search_hide_meta_icons'                   => '',
			'search_show_author'                       => '',
			'search_show_author_avatar'                => '',
			'search_before_author_word'                => '',
			'search_show_date'                         => '',
			'search_before_date_word'                  => '',
			'search_show_human_date'                   => '',
			'search_show_categories'                   => '',
			'search_before_categories_word'            => '',
			'search_show_tags'                         => '',
			'search_before_tags_word'                  => '',
			'search_show_comments_link'                => '',
			'special_categories_extra'                 => '',
			'animation_extra'                          => '',
			'popup_extra'                              => '',
			'shop_products_list_extra'                 => '',
			'header_cart_dropdown'                     => '1',
			'shop_sidebar_position'                    => 'no',
			'shop_container_width'                     => '',
			'shop_animation'                           => '1',
			'product_sidebar_position'                 => 'no',
			'product_container_width'                  => '',
			'product_related_products_heading'         => '',
			'product_related_products_title'           => '',
			'product_related_products_count'           => '',
			'product_related_products_cols'            => '',
			'product_related_separate'                 => '',
			'product_related_separate_background'      => '',
			'product_related_separate_container_width' => '',
			'preset'                                   => '',
			'skin'                                     => '     ',
			'jquery_to_footer'                         => '',
			'side_nav_position'                        => '',
			'side_nav_background'                      => 'l',
			'side_nav_sticked'                         => '',
			'side_nav_sticked_shadow'                  => '',
			'side_nav_sticked_border'                  => '',
			'side_nav_header_overlap'                  => '',
			'side_nav_font_size'                       => '',
			'header_toggler_menu_side'                 => '1',
			'side_nav_logo_position'                   => '',
			'side_nav_meta_position'                   => 'bottom',
			'side_nav_social_position'                 => 'bottom',
			'font_body_heading'                        => '',
			'font_body'                                => '{"font":"Nunito","variant":[],"subset":[]}',
			'font_headings_heading'                    => '',
			'font_headings'                            => '{"font":"","variant":[],"subset":[]}',
			'category_portfolio_heading'               => '',
			'category_portfolio'                       => '',
			'category_portfolio_layout'                => 'cols-absolute-no-meta 3',
			'category_portfolio_layout_gap'            => '5',
			'category_portfolio_sidebar_position'      => 'no',
			'category_services_heading'                => '',
			'category_services'                        => '',
			'category_services_layout'                 => 'cols-excerpt 3',
			'category_services_layout_gap'             => '60',
			'category_services_sidebar_position'       => 'no',
			'category_team_heading'                    => '',
			'category_team'                            => '',
			'category_team_layout'                     => 'cols-excerpt 3',
			'category_team_layout_gap'                 => '50',
			'category_team_sidebar_position'           => 'no',
			'animation_enabled'                        => '',
			'animation_sidebar_widgets'                => '',
			'animation_footer_widgets'                 => '',
			'animation_feed_posts'                     => '',
			'animation_feed_posts_thumbnail'           => '',
			'message_top_heading'                      => '',
			'message_top_id'                           => '',
			'message_top_text'                         => '',
			'message_top_close_button_text'            => '',
			'message_top_background'                   => 'l m',
			'message_top_font_size'                    => '',
			'message_bottom_heading'                   => '',
			'message_bottom_id'                        => '',
			'message_bottom_text'                      => '',
			'message_bottom_close_button_text'         => '',
			'message_bottom_background'                => 'l m',
			'message_bottom_font_size'                 => '',
			'message_bottom_layout'                    => '',
			'message_bottom_bordered'                  => '',
			'message_bottom_shadow'                    => '',
			'message_bottom_rounded'                   => '',
			'product_simple_add_to_cart_hide_button'   => '1',
			'product_simple_add_to_cart_hide_icon'     => '',
			'product_simple_add_to_cart_block_button'  => '',
			'product_simple_add_to_cart_text'          => '',
			'product_center_content'                   => '1',
			'product_show_reviews'                     => '1',
			'product_show_category'                    => '1',
			'product_show_short_description'           => '',
			'product_show_thumbnail_add_to_cart'       => '',
			'product_show_thumbnail_link'              => '1',
			'intro_teaser_image_1'                     => '',
			'intro_teaser_title_1'                     => '',
			'intro_teaser_text_1'                      => '',
			'intro_teaser_link_1'                      => '',
			'intro_teaser_button_text_1'               => '',
			'intro_teaser_image_2'                     => '',
			'intro_teaser_title_2'                     => '',
			'intro_teaser_text_2'                      => '',
			'intro_teaser_link_2'                      => '',
			'intro_teaser_button_text_2'               => '',
			'intro_teaser_image_3'                     => '',
			'intro_teaser_title_3'                     => '',
			'intro_teaser_text_3'                      => '',
			'intro_teaser_link_3'                      => '',
			'intro_teaser_button_text_3'               => '',
			'intro_teaser_image_4'                     => '',
			'intro_teaser_title_4'                     => '',
			'intro_teaser_text_4'                      => '',
			'intro_teaser_link_4'                      => '',
			'intro_teaser_button_text_4'               => '',
			'typo_heading_h1'                          => '',
			'typo_size_h1'                             => '',
			'typo_line_height_h1'                      => '',
			'typo_letter_spacing_h1'                   => '',
			'typo_weight_h1'                           => '',
			'typo_mt_h1'                               => '',
			'typo_mb_h1'                               => '',
			'typo_heading_h2'                          => '',
			'typo_size_h2'                             => '',
			'typo_line_height_h2'                      => '',
			'typo_letter_spacing_h2'                   => '',
			'typo_weight_h2'                           => '',
			'typo_mt_h2'                               => '',
			'typo_mb_h2'                               => '',
			'typo_heading_h3'                          => '',
			'typo_size_h3'                             => '',
			'typo_line_height_h3'                      => '',
			'typo_letter_spacing_h3'                   => '',
			'typo_weight_h3'                           => '',
			'typo_mt_h3'                               => '',
			'typo_mb_h3'                               => '',
			'typo_heading_h4'                          => '',
			'typo_size_h4'                             => '',
			'typo_line_height_h4'                      => '',
			'typo_letter_spacing_h4'                   => '',
			'typo_weight_h4'                           => '',
			'typo_mt_h4'                               => '',
			'typo_mb_h4'                               => '',
			'typo_heading_h5'                          => '',
			'typo_size_h5'                             => '',
			'typo_line_height_h5'                      => '',
			'typo_letter_spacing_h5'                   => '',
			'typo_weight_h5'                           => '',
			'typo_mt_h5'                               => '',
			'typo_mb_h5'                               => '',
			'typo_heading_h6'                          => '',
			'typo_size_h6'                             => '',
			'typo_line_height_h6'                      => '',
			'typo_letter_spacing_h6'                   => '',
			'typo_weight_h6'                           => '',
			'typo_mt_h6'                               => '',
			'typo_mb_h6'                               => '',
			'contact_message_success'                  => esc_html__( 'Message was sent!', 'exs-shop' ),
			'contact_message_fail'                     => esc_html__( 'There was an error during message sending!', 'exs-shop' ),

		);
	}
endif;
add_filter( 'exs_default_theme_options', 'exs_shop_default_options' );

//filter page menu
if ( ! function_exists( 'exs_shop_filter_wp_page_menu_args' ) ) :
	function exs_shop_filter_wp_page_menu_args( $args ) {

		$args['menu_class'] = 'top-menu ';
		$args['container'] = 'ul';

		return $args;
	}
endif;
add_filter( 'wp_page_menu_args', 'exs_shop_filter_wp_page_menu_args' );

//filter starter content
if ( ! function_exists( 'exs_shop_filter_starter_content' ) ) :
	function exs_shop_filter_starter_content( $content ) {

		//blog is a front page
		unset( $content['options'] );

		//top image
		$content['attachments']['image-top'] = array(
			'image-dots' => array(
				'post_title' => _x( 'Example image 1', 'Theme starter content', 'exs' ),
				'file'       => '../exs-shop/assets/img/bg-dots-small.png', // URL relative to the template directory.
			),
		);
		$content['posts']['front']['thumbnail'] = '{{image-dots}}';
		$content['posts']['front']['post_title'] = esc_html__( 'Home Static', 'exs-shop' );
		$content['posts']['home2']['thumbnail'] = '{{image-dots}}';
		$content['posts']['about']['thumbnail'] = '{{image-dots}}';
		$content['posts']['pricing']['thumbnail'] = '{{image-dots}}';
		$content['posts']['typography']['thumbnail'] = '{{image-dots}}';
		$content['posts']['contact']['thumbnail'] = '{{image-dots}}';

		//fix menu
		$first_menu_item = array(
			'page_front' => array(
				'type'      => 'post_type',
				'object'    => 'page',
				'object_id' => '{{front}}',
			),
		);
		unset( $content['nav_menus']['primary']['items']['page_blog'] );
		$content['nav_menus']['primary']['items'] = $first_menu_item + $content['nav_menus']['primary']['items'];

		return $content;
	}
endif;
add_filter( 'exs_starter_content', 'exs_shop_filter_starter_content' );
