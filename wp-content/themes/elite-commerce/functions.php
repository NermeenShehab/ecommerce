<?php
/**
 * Elite Commerce functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elite Commerce
 */

/**
 * Returns theme mod value saved for option merging with default option if available.
 * @since 1.0
 */
function elite_commerce_gtm( $option ) {
	// Get our Customizer defaults
	$defaults = apply_filters( 'elite_commerce_customizer_defaults', true );

	return isset( $defaults[ $option ] ) ? get_theme_mod( $option, $defaults[ $option ] ) : get_theme_mod( $option );
}

if ( ! function_exists( 'elite_commerce_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function elite_commerce_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Elite Commerce, use a find and replace
		 * to change 'elite-commerce' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'elite-commerce', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Used in archive content, featured content.
		set_post_thumbnail_size( 825, 620, false );

		// Used in slider.
		add_image_size( 'elite-commerce-slider', 1920, 1000, false );

		// Used in hero content.
		add_image_size( 'elite-commerce-hero', 600, 650, false );

		// Used in portfolio, team.
		add_image_size( 'elite-commerce-portfolio', 400, 450, false );

		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary Menu', 'elite-commerce' ),
			'social' => esc_html__( 'Social Menu', 'elite-commerce' ),
		) );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'elite_commerce_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Add theme editor style
		add_editor_style( array( 'css/editor-style.css' ) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	}
endif;
add_action( 'after_setup_theme', 'elite_commerce_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
function elite_commerce_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'elite_commerce_content_width', 1230 );
}
add_action( 'after_setup_theme', 'elite_commerce_content_width', 0 );

if ( ! function_exists( 'elite_commerce_custom_content_width' ) ) :
	/**
	 * Custom content width.
	 *
	 * @since 1.0
	 */
	function elite_commerce_custom_content_width() {
		$layout  = elite_commerce_get_theme_layout();

		if ( 'no-sidebar-full-width' !== $layout ) {
			$GLOBALS['content_width'] = apply_filters( 'elite_commerce_content_width', 890 );
		}
	}
endif;
add_filter( 'template_redirect', 'elite_commerce_custom_content_width' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function elite_commerce_widgets_init() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Sidebar', 'elite-commerce' ),
		'id'          => 'sidebar-1',
		'description' => esc_html__( 'Add widgets here.', 'elite-commerce' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Slider Sidebar Left', 'elite-commerce' ),
		'id'          => 'sidebar-slider-left',
		'description' => esc_html__( 'Recommended: Product Category Widget, Menu Widget', 'elite-commerce' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 1', 'elite-commerce' ),
		'id'          => 'sidebar-2',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'elite-commerce' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 2', 'elite-commerce' ),
		'id'          => 'sidebar-3',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'elite-commerce' ),
		) + $args
	);

	register_sidebar( array(
		'name'        => esc_html__( 'Footer 3', 'elite-commerce' ),
		'id'          => 'sidebar-4',
		'description' => esc_html__( 'Add widgets here to appear in your footer.', 'elite-commerce' ),
		) + $args
	);

	if ( class_exists( 'WooCommerce' ) ) {
		//Optional Primary Sidebar for Shop
		register_sidebar( array(
			'name'        => esc_html__( 'WooCommerce Sidebar', 'elite-commerce' ),
			'id'          => 'sidebar-woo',
			'description' => esc_html__( 'This is Optional Sidebar for WooCommerce Pages', 'elite-commerce' ),
			) + $args
		);
	}
}
add_action( 'widgets_init', 'elite_commerce_widgets_init' );

/**
 * Count the number of footer sidebars to enable dynamic classes for the footer
 *
 * @since 1.0
 */
function elite_commerce_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-3' ) ) {
		$count++;
	}

	if ( is_active_sidebar( 'sidebar-4' ) ) {
		$count++;
	}

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
	}

	if ( $class ) {
		echo 'class="widget-area footer-widget-area ' . $class . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'elite_commerce_fonts_url' ) ) :
	/**
	 * Register Google fonts for Elite Commerce
	 *
	 * Create your own elite_commerce_fonts_url() function to override in a child theme.
	 *
	 * @since 1.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function elite_commerce_fonts_url() {
		$fonts_url = '';

		/* Translators: If there are characters in your language that are not
		* supported by Roboto, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$roboto = _x( 'on', 'Roboto font: on or off', 'elite-commerce' );

		if ( 'off' !== $roboto ) {
			$font_families = array();

			$font_families[] = 'Roboto:300,400,500,600,700,800,900';


			$query_args = array(
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;

/**
 * Enqueue scripts and styles.
 */
function elite_commerce_scripts() {
	$min  = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

	// FontAwesome.
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome/css/all' . $min . '.css', array(), '5.15.3', 'all' );

	// Theme stylesheet.
	wp_enqueue_style( 'elite-commerce-style', get_stylesheet_uri(), array(), elite_commerce_get_file_mod_date( 'style.css' ) );

	// Add google fonts.
	wp_enqueue_style( 'elite-commerce-fonts', elite_commerce_fonts_url(), array(), null );

	$color_style = elite_commerce_gtm( 'elite_commerce_color_style' );

	if ( 'dark' === $color_style ) {
		// Light color scheme.
		wp_enqueue_style( 'elite-commerce-dark-style', get_template_directory_uri() . '/css/dark' . $min . '.css', array( 'elite-commerce-style' ), elite_commerce_get_file_mod_date( '/css/dark' . $min . '.css' ) );
	}

	// Theme block stylesheet.
	wp_enqueue_style( 'elite-commerce-block-style', get_template_directory_uri() . '/css/blocks' . $min . '.css', array( 'elite-commerce-style' ), elite_commerce_get_file_mod_date( 'css/blocks' . $min . '.css' ) );

	$scripts = array(
		'elite-commerce-skip-link-focus-fix' => array(
			'src'      => '/js/skip-link-focus-fix' . $min . '.js',
			'deps'      => array(),
			'in_footer' => true,
		),
		'elite-commerce-keyboard-image-navigation' => array(
			'src'      => '/js/keyboard-image-navigation' . $min . '.js',
			'deps'      => array(),
			'in_footer' => true,
		),
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$deps = array( 'jquery', 'masonry' );


	$scripts['elite-commerce-script'] = array(
		'src'       => '/js/functions' . $min . '.js',
		'deps'      => $deps,
		'in_footer' => true,
	);

	$enable_slider = elite_commerce_gtm( 'elite_commerce_slider_visibility' );
	
	if ( elite_commerce_display_section( $enable_slider ) ) {
		wp_enqueue_style( 'swiper-css', get_template_directory_uri() . '/css/swiper' . $min . '.css', array(), elite_commerce_get_file_mod_date( '/css/swiper' . $min . '.css' ), false );

		$scripts['swiper'] = array(
			'src'      => '/js/swiper' . $min . '.js',
			'deps'      => null,
			'in_footer' => true,
		);

		$scripts['swiper-custom'] = array(
			'src'      => '/js/swiper-custom' . $min . '.js',
			'deps'      => array( 'swiper' ),
			'in_footer' => true,
		);
	}

	foreach ( $scripts as $handle => $script ) {
		wp_enqueue_script( $handle, get_theme_file_uri( $script['src'] ), $script['deps'], elite_commerce_get_file_mod_date( $script['src'] ), $script['in_footer'] );
	}

	wp_localize_script( 'elite-commerce-script', 'eliteCommerceScreenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'elite-commerce' ),
		'collapse' => esc_html__( 'collapse child menu', 'elite-commerce' ),
	) );

	if ( elite_commerce_display_section( $enable_slider ) ) {
		// Localize the script with new data.
		$slider_options = array(
			'slider'      => array(
				'speed'         => esc_js( elite_commerce_gtm( 'elite_commerce_slider_transition_speed' ) ),
				'effect'        => esc_js( elite_commerce_gtm( 'elite_commerce_slider_transition_effect' ) ),
				'loop'          => esc_js( elite_commerce_gtm( 'elite_commerce_slider_loop' ) ),
				'autoplay'      => esc_js( elite_commerce_gtm( 'elite_commerce_slider_autoplay' ) ),
				'autoplayDelay' => esc_js( elite_commerce_gtm( 'elite_commerce_slider_autoplay_delay' ) ),
				'pauseOnHover'  => esc_js( elite_commerce_gtm( 'elite_commerce_slider_pause_on_hover' ) ),
			),
		);

		wp_localize_script( 'swiper-custom', 'eliteCommerceSliderOptions', $slider_options );
	}
}
add_action( 'wp_enqueue_scripts', 'elite_commerce_scripts' );

/**
 * Get file modified date
 */
function elite_commerce_get_file_mod_date( $file ) {
	return date( 'Ymd-Gis', filemtime( get_theme_file_path( $file ) ) );
}

/**
 * Enqueue editor styles for Gutenberg
 */
function elite_commerce_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'elite-commerce-block-editor-style', trailingslashit( esc_url ( get_template_directory_uri() ) ) . 'css/editor-blocks.css' );

	// Add custom fonts.
	wp_enqueue_style( 'elite-commerce-fonts', elite_commerce_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'elite_commerce_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_theme_file_path( '/inc/custom-header.php' );

/**
 * Breadcrumb.
 */
require get_theme_file_path( '/inc/breadcrumb.php' );

/**
 * Custom template tags for this theme.
 */
require get_theme_file_path( '/inc/template-tags.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_theme_file_path( '/inc/template-functions.php' );

/**
 * Customizer additions.
 */
require get_theme_file_path( '/inc/customizer/customizer.php' );

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_theme_file_path( '/inc/jetpack.php' );
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_theme_file_path( '/inc/woocommerce.php' );
}

/**
 * Load Theme About Page
 */
require get_parent_theme_file_path( '/inc/theme-about.php' );
