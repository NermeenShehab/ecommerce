<?php
/**
 * Adds the theme options sections, settings, and controls to the theme customizer
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Menu_Options {
	public function __construct() {
		// Register Menu Options.
		add_action( 'customize_register', array( $this, 'register_menu_options' ), 30 );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_commerce_primary_menu_on'       => 1,
			'elite_commerce_primary_menu_cat_list' => 1,		
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add Menu options to nav menu
	 */
	public function register_menu_options( $wp_customize ) {
		// Set active callback options for menus.
		$wp_customize->get_control( 'nav_menu_locations[menu-1]' )->active_callback = array( $this, 'is_primary_menu_on' );

		// Set Priority for menus.
		$wp_customize->get_control( 'nav_menu_locations[menu-1]' )->priority = 2;
		
		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_primary_menu_on',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Display Primary', 'elite-commerce' ),
				'section'           => 'menu_locations',
				'priority'          => 1,
			) 
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_primary_menu_dark',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Dark Primary Nav', 'elite-commerce' ),
				'section'           => 'menu_locations',
				'active_callback'   => array( $this, 'is_primary_menu_on' ),
				'priority'          => 1,
			) 
		);	

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_primary_menu_cat_list',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Display Category List on Primary Menu', 'elite-commerce' ),
				'active_callback'   => array( $this, 'is_woo_active' ),
				'section'           => 'menu_locations',
				'priority'          => 1,
			) 
		);
	}

	/**
	 * Active callback to determine if primary menu is on/pff
	 */
	public function is_primary_menu_on( $control ) {
		return $control->manager->get_setting( 'elite_commerce_primary_menu_on' )->value() ? true : false;
	}

	/**
	 * Active callback to determine if primary menu is on/pff
	 */
	public function is_woo_active( $control ) {
		return class_exists( 'WooCommerce' );
	}
}

/**
 * Initialize class
 */
$elite_commerce_menu_options = new Elite_Commerce_Menu_Options();
