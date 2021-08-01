<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Theme_Options {
	public function __construct() {
		// Register our Panel.
		add_action( 'customize_register', array( $this, 'add_panel' ) );

		// Register Breadcrumb Options.
		add_action( 'customize_register', array( $this, 'register_breadcrumb_options' ) );

		// Register Excerpt Options.
		add_action( 'customize_register', array( $this, 'register_excerpt_options' ) );

		// Register Homepage Options.
		add_action( 'customize_register', array( $this, 'register_homepage_options' ) );

		// Register Layout Options.
		add_action( 'customize_register', array( $this, 'register_layout_options' ) );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			// Header Media.
			'elite_commerce_header_image_visibility' => 'disabled',

			// Breadcrumb
			'elite_commerce_breadcrumb_show' => 1,

			// Layout Options.
			'elite_commerce_default_layout'          => 'right-sidebar',
			'elite_commerce_homepage_archive_layout' => 'no-sidebar-full-width',
			'elite_commerce_woocommerce_layout'      => 'no-sidebar-full-width',
			
			// Excerpt Options
			'elite_commerce_excerpt_length'    => 30,
			'elite_commerce_excerpt_more_text' => esc_html__( 'Continue reading', 'elite-commerce' ),

			// Homepage/Frontpage Options.
			'elite_commerce_front_page_category'   => '',
			'elite_commerce_show_homepage_content' => 1,
		);


		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Register the Customizer panels
	 */
	public function add_panel( $wp_customize ) {
		/**
		 * Add our Header & Navigation Panel
		 */
		 $wp_customize->add_panel( 'elite_commerce_theme_options',
			array(
				'title' => esc_html__( 'Theme Options', 'elite-commerce' ),
			)
		);
	}

	/**
	 * Add breadcrumb section and its controls
	 */
	public function register_breadcrumb_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'elite_commerce_breadcrumb_options',
			array(
				'title' => esc_html__( 'Breadcrumb', 'elite-commerce' ),
				'panel' => 'elite_commerce_theme_options',
			)
		);

		if ( function_exists( 'bcn_display' ) ) {
			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Commerce_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'elite-commerce' ),
					'description'       =>  sprintf( esc_html__( 'Since Breadcrumb NavXT Plugin is installed, edit plugin\'s settings %1$shere%2$s', 'elite-commerce' ), '<a href="' . esc_url( get_admin_url( null, 'options-general.php?page=breadcrumb-navxt' ) ) . '" target="_blank">', '</a>' ),
					'section'           => 'ff_multiputpose_breadcrumb_options',
				)
			);

			return;
		}

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_breadcrumb_show',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Display Breadcrumb?', 'elite-commerce' ),
				'section'           => 'elite_commerce_breadcrumb_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_breadcrumb_show_home',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Show on homepage?', 'elite-commerce' ),
				'section'           => 'elite_commerce_breadcrumb_options',
			)
		);
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_layout_options( $wp_customize ) {
		// Add layouts section.
		$wp_customize->add_section( 'elite_commerce_layouts',
			array(
				'title' => esc_html__( 'Layouts', 'elite-commerce' ),
				'panel' => 'elite_commerce_theme_options'
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'elite_commerce_default_layout',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'Default Layout', 'elite-commerce' ),
				'section'           => 'elite_commerce_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'elite-commerce' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'elite-commerce' ),
				),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'elite_commerce_homepage_archive_layout',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'Homepage/Archive Layout', 'elite-commerce' ),
				'section'           => 'elite_commerce_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'elite-commerce' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'elite-commerce' ),
				),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'select',
				'settings'          => 'elite_commerce_woocommerce_layout',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'WooCommerce Pages Layout', 'elite-commerce' ),
				'section'           => 'elite_commerce_layouts',
				'choices'           => array(
					'right-sidebar'         => esc_html__( 'Right Sidebar', 'elite-commerce' ),
					'no-sidebar-full-width' => esc_html__( 'No Sidebar: Full Width', 'elite-commerce' ),
				),
			)
		);
	}

	/**
	 * Add excerpt section and its controls
	 */
	public function register_excerpt_options( $wp_customize ) {
		// Add Excerpt Options section.
		$wp_customize->add_section( 'elite_commerce_excerpt_options',
			array(
				'title' => esc_html__( 'Excerpt Options', 'elite-commerce' ),
				'panel' => 'elite_commerce_theme_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'elite_commerce_excerpt_length',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Excerpt Length (Words)', 'elite-commerce' ),
				'section'           => 'elite_commerce_excerpt_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_excerpt_more_text',
				'sanitize_callback' => 'sanitize_text_field',
				'label'             => esc_html__( 'Excerpt More Text', 'elite-commerce' ),
				'section'           => 'elite_commerce_excerpt_options',
			)
		);
	}

	/**
	 * Add Homepage/Frontpage section and its controls
	 */
	public function register_homepage_options( $wp_customize ) {
		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_front_page_category',
				'description'       => esc_html__( 'Filter Homepage/Blog page posts by following categories', 'elite-commerce' ),
				'label'             => esc_html__( 'Categories', 'elite-commerce' ),
				'section'           => 'static_front_page',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'elite-commerce' ) => Elite_Commerce_Customizer_Utilities::get_terms( 'category' ) ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_show_homepage_content',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Show Home Content/Blog', 'elite-commerce' ),
				'section'           => 'static_front_page',
			)
		);
	}
}

/**
 * Initialize class
 */
$elite_commerce_theme_options = new Elite_Commerce_Theme_Options();
