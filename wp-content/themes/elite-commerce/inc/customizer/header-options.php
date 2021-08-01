<?php
/**
 * Adds the header options sections, settings, and controls to the theme customizer
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Header_Options {
	public function __construct() {
		// Register Header Options.
		add_action( 'customize_register', array( $this, 'register_header_options' ) );

		// Register Header Top Options
		add_action( 'customize_register', array( $this, 'register_header_top_options' ) );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_commerce_header_phone_text'  => esc_html__( 'Customer Support', 'elite-commerce' ),
			'elite_commerce_header_login_on'   => 1,
			'elite_commerce_header_login_icon' => 'far fa-user',
			'elite_commerce_header_login_link' => get_permalink( get_option('woocommerce_myaccount_page_id') ),
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add header options section and its controls
	 */
	public function register_header_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'elite_commerce_header_options',
			array(
				'title' => esc_html__( 'Header Options', 'elite-commerce' ),
				'panel' => 'elite_commerce_theme_options'
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'elite_commerce_header_style', array(
			'selector' => '#masthead',
		) );

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_header_login_on',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Login Icon/Link', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_options',
			) 
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'elite_commerce_header_login_link_note',
				'label'             =>  esc_html__( 'Info', 'elite-commerce' ),
				'description'       =>  sprintf( esc_html__( 'If you want user icon, save "far fa-user". For more classes, check %1$sthis%2$s', 'elite-commerce' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'elite_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_login_icon',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Icon', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'elite_commerce_header_login_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Link', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_header_login_target',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_options',
				'active_callback'   => array( $this, 'is_login_link_on' ),
			)
		);
	}

	/**
	 * Active callback to determine if login link is on/pff
	 */
	public function is_login_link_on( $control ) {
		return $control->manager->get_setting( 'elite_commerce_header_login_on' )->value() ? true : false;
	} 

	public function register_header_top_options( $wp_customize ) {
		// Add header options section.
		$wp_customize->add_section( 'elite_commerce_header_top_options',
			array(
				'title' => esc_html__( 'Header Top Options', 'elite-commerce' ),
				'panel' => 'elite_commerce_theme_options'
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_top_text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Text', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_email',
				'sanitize_callback' => 'sanitize_email',
				'label'             => esc_html__( 'Email', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_phone',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Phone', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_phone_text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Text Below Phone', 'elite-commerce' ),
				'description'       => esc_html__( 'Not Applicable for Header Style Two and Six', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_address',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Address', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_open_hours',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Open Hours', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'settings'          => 'elite_commerce_header_button_text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Button Text', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'settings'          => 'elite_commerce_header_button_link',
				'sanitize_callback' => 'esc_url_raw',
				'label'             => esc_html__( 'Button Link', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_header_button_target',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'elite-commerce' ),
				'section'           => 'elite_commerce_header_top_options',
			)
		);
	}
}

/**
 * Initialize class
 */
$elite_commerce_theme_options = new Elite_Commerce_Header_Options();
