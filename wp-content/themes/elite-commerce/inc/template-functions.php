<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Elite Commerce
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function elite_commerce_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class with respect to layout selected.
	$layout  = elite_commerce_get_theme_layout();
	$sidebar = elite_commerce_get_sidebar_id();

	$layout_class = "layout-no-sidebar-content-width";

	if ( 'no-sidebar-full-width' === $layout ) {
		$layout_class = 'layout-no-sidebar-full-width';
	} elseif ( 'left-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-left-sidebar';
		}
	} elseif ( 'right-sidebar' === $layout ) {
		if ( '' !== $sidebar ) {
			$layout_class = 'layout-right-sidebar';
		}
	}

	$classes[] = $layout_class;

	// Add Site Layout Class.
	$classes[] = 'fluid-layout grid';

	// Add header Style Class.
	$classes[] = esc_attr( elite_commerce_gtm( 'elite_commerce_header_style' ) );

	// Add Color Scheme Class.
	$classes[] = esc_attr( elite_commerce_gtm( 'elite_commerce_color_scheme' ) . '-color-scheme' );

	$elite_commerce_enable = elite_commerce_gtm( 'elite_commerce_header_image_visibility' );

	if ( ! elite_commerce_display_section( $elite_commerce_enable ) || ( ! has_header_image() && ! ( is_header_video_active() && has_header_video() ) ) ) {
    	$classes[] = 'no-header-media';
    }

	return $classes;
}
add_filter( 'body_class', 'elite_commerce_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function elite_commerce_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'elite_commerce_pingback_header' );

if ( ! function_exists( 'elite_commerce_excerpt_length' ) ) :
	/**
	 * Sets the post excerpt length to n words.
	 *
	 * function tied to the excerpt_length filter hook.
	 * @uses filter excerpt_length
	 */
	function elite_commerce_excerpt_length( $length ) {
		if ( is_admin() ) {
			return $length;
		}

		// Getting data from Theme Options
		$length	= elite_commerce_gtm( 'elite_commerce_excerpt_length' );

		return absint( $length );
	} // elite_commerce_excerpt_length.
endif;
add_filter( 'excerpt_length', 'elite_commerce_excerpt_length', 999 );

if ( ! function_exists( 'elite_commerce_excerpt_more' ) ) :
	/**
	 * Replaces "[...]" (appended to automatically generated excerpts) with ... and a option from customizer
	 *
	 * @return string option from customizer prepended with an ellipsis.
	 */
	function elite_commerce_excerpt_more( $more ) {
		if ( is_admin() ) {
			return $more;
		}

		$more_tag_text = elite_commerce_gtm( 'elite_commerce_excerpt_more_text' );

		$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
			esc_url( get_permalink() ),
			/* translators: %s: Name of current post */
			wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
		);

		return '&hellip;' . $link;
	}
endif;
add_filter( 'excerpt_more', 'elite_commerce_excerpt_more' );

if ( ! function_exists( 'elite_commerce_custom_excerpt' ) ) :
	/**
	 * Adds Continue reading link to more tag excerpts.
	 *
	 * function tied to the get_the_excerpt filter hook.
	 */
	function elite_commerce_custom_excerpt( $output ) {
		if ( is_admin() ) {
			return $output;
		}

		if ( has_excerpt() && ! is_attachment() ) {
			$more_tag_text = elite_commerce_gtm( 'elite_commerce_excerpt_more_text' );

			$link = sprintf( '<a href="%1$s" class="more-link"><span class="more-button">%2$s</span></a>',
				esc_url( get_permalink() ),
				/* translators: %s: Name of current post */
				wp_kses_data( $more_tag_text ). '<span class="screen-reader-text">' . esc_html( get_the_title( get_the_ID() ) ) . '</span>'
			);

			$output .= '&hellip;' . $link;
		}

		return $output;
	} // elite_commerce_custom_excerpt.
endif;
add_filter( 'get_the_excerpt', 'elite_commerce_custom_excerpt' );

if ( ! function_exists( 'elite_commerce_more_link' ) ) :
	/**
	 * Replacing Continue reading link to the_content more.
	 *
	 * function tied to the the_content_more_link filter hook.
	 */
	function elite_commerce_more_link( $more_link, $more_link_text ) {
		$more_tag_text = elite_commerce_gtm( 'elite_commerce_excerpt_more_text' );

		return str_replace( $more_link_text, wp_kses_data( $more_tag_text ), $more_link );
	} // elite_commerce_more_link.
endif;
add_filter( 'the_content_more_link', 'elite_commerce_more_link', 10, 2 );

/**
 * Filter Homepage Options as selected in theme options.
 */
function elite_commerce_alter_home( $query ) {
	if ( $query->is_home() && $query->is_main_query() ) {
		$cats = elite_commerce_gtm( 'elite_commerce_front_page_category' );

		if ( $cats ) {
			$query->query_vars['category__in'] = explode( ',', $cats );
		}
	}
}
add_action( 'pre_get_posts', 'elite_commerce_alter_home' );

/**
 * Display section as selected in theme options.
 */
function elite_commerce_display_section( $option ) {
	if ( 'entire-site' === $option || 'custom-pages' === $option || ( is_front_page() && 'homepage' === $option ) || ( ! is_front_page() && 'excluding-home' === $option ) ) {
		return true;
	}

	// Section is disabled.
	return false;
}

/**
 * Return theme layout
 * @return layout
 */
function elite_commerce_get_theme_layout() {
	$layout = '';

	if ( is_page_template( 'templates/no-sidebar.php' ) ) {
		$layout = 'no-sidebar';
	} elseif ( is_page_template( 'templates/full-width-page.php' ) ) {
		$layout = 'no-sidebar-full-width';
	} elseif ( is_page_template( 'templates/left-sidebar.php' ) ) {
		$layout = 'left-sidebar';
	} elseif ( is_page_template( 'templates/right-sidebar.php' ) ) {
		$layout = 'right-sidebar';
	} else {
		$layout = elite_commerce_gtm( 'elite_commerce_default_layout' );

		if ( is_home() || is_archive() ) {
			$layout = elite_commerce_gtm( 'elite_commerce_homepage_archive_layout' );
		}

		if ( class_exists( 'WooCommerce' ) && ( is_shop() || is_woocommerce() || is_cart() || is_checkout() ) ) {
			$layout = elite_commerce_gtm( 'elite_commerce_woocommerce_layout' );
		}
	}

	return $layout;
}

/**
 * Return theme layout
 * @return layout
 */
function elite_commerce_get_sidebar_id() {
	$sidebar = '';

	$layout = elite_commerce_get_theme_layout();

	if ( 'no-sidebar-full-width' === $layout || 'no-sidebar' === $layout ) {
		return $sidebar;
	}

	$sidebaroptions = '';

	// WooCommerce Shop Page excluding Cart and checkout.
	if ( class_exists( 'WooCommerce' ) && is_woocommerce() ) {
		$shop_id        = get_option( 'woocommerce_shop_page_id' );
		$sidebaroptions = get_post_meta( $shop_id, 'elite-commerce-sidebar-option', true );
	} else {
		global $post, $wp_query;

		// Front page displays in Reading Settings.
		$page_on_front  = get_option( 'page_on_front' );
		$page_for_posts = get_option( 'page_for_posts' );

		// Get Page ID outside Loop.
		$page_id = $wp_query->get_queried_object_id();
		// Blog Page or Front Page setting in Reading Settings.
		if ( $page_id == $page_for_posts || $page_id == $page_on_front ) {
	        $sidebaroptions = get_post_meta( $page_id, 'elite-commerce-sidebar-option', true );
	    } elseif ( is_singular() ) {
	    	if ( is_attachment() ) {
				$parent 		= $post->post_parent;
				$sidebaroptions = get_post_meta( $parent, 'elite-commerce-sidebar-option', true );

			} else {
				$sidebaroptions = get_post_meta( $post->ID, 'elite-commerce-sidebar-option', true );
			}
		}
	}

	if ( class_exists( 'WooCommerce' ) && ( is_woocommerce() || is_cart() || is_checkout() ) ) {
		$sidebar = 'sidebar-woo'; // WooCommerce Sidebar.
	} 

	return 'sidebar-1'; // sidebar-1 is main sidebar.
}


/**
 * Function to add Scroll Up icon
 */
function elite_commerce_scrollup() {
	$disable_scrollup = elite_commerce_gtm( 'elite_commerce_band_disable_scrollup' );

	if ( $disable_scrollup ) {
		return;
	}

	echo '<a href="#masthead" id="scrollup" class="backtotop">' . '<span class="screen-reader-text">' . esc_html__( 'Scroll Up', 'elite-commerce' ) . '</span></a>' ;

}
add_action( 'wp_footer', 'elite_commerce_scrollup', 1 );

/**
 * Return args for specific section type
 */
function elite_commerce_get_section_args( $section_name ) {
	$numbers = elite_commerce_gtm( 'elite_commerce_' . $section_name . '_number' );

	$args = array(
		'ignore_sticky_posts' => 1,
		'posts_per_page'      => absint( $numbers ),
	);

	// If post or page or product, then set post__in argument.
	$post__in = array();

	for( $i = 0; $i < $numbers; $i++ ) {
		$post__in[] = elite_commerce_gtm( 'elite_commerce_' . $section_name . '_page_' . $i );
	}

	$args['post__in'] = $post__in;
	$args['orderby']  = 'post__in';
	$args['post_type'] = 'page';

	return $args;
}

/**
 * Add sections to appropriate hook.
 */
function elite_commerce_sections() {
	$default_sections = elite_commerce_get_default_sortable_sections();

	$sortable_options = array();

	$sortable_order = elite_commerce_gtm( 'elite_commerce_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sortable_sections = $sortable_options + array_keys( $default_sections );

	$hook = 'elite_commerce_before_content';

	foreach( $sortable_sections as $section ){
		if ( 'main_content' === $section ) {
			$hook = 'elite_commerce_after_content';

			continue;
		}

		$template_part = 'template-parts/' . str_replace( '_', '-', $section ) .'/' . str_replace( '_', '-', $section );

		add_action( $hook, function() use ( $template_part ) {
			get_template_part( $template_part );
		});
	}
}
add_action( 'wp', 'elite_commerce_sections', 10 );

/**
 * Display content.
 */
function elite_commerce_display_content() {
	?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div>
	<?php
}

/**
 * Section class format.
 */
function elite_commerce_display_section_classes( $classes ) {
	echo esc_attr( implode( ' ', $classes ) );
}

/**
 * Support Menu Description
 */
function elite_commerce_nav_description( $item_output, $item, $depth, $args ) {
    if ( !empty( $item->description ) ) {
        $item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
    }
 
    return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'elite_commerce_nav_description', 10, 4 );
