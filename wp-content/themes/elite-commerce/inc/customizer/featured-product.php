<?php
/**
 * Hero Content Options
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Featured_Product_Options {
	public function __construct() {
		// Register Hero Content Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_commerce_featured_product_visibility'      => 'disabled',
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Commerce_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'ff_multiputpose_breadcrumb_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'elite-commerce' ),
					'description'       =>  sprintf( esc_html__( 'Install %1$sWooCommerce%2$s Plugin for this section.', 'elite-commerce' ), '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a>' ),
					'section'           => 'elite_commerce_ss_featured_product',
				)
			);

			return;
		}

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_featured_product_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_featured_product',
				'choices'           => Elite_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		// Add Edit Shortcut Icon.
		$wp_customize->selective_refresh->add_partial( 'elite_commerce_featured_product_visibility', array(
			'selector' => '#featured-product-section',
		) );

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_featured_product_custom_subtitle',
				'label'             => esc_html__( 'Top Subtitle', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_featured_product',
				'active_callback'   => array( $this, 'is_featured_product_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Dropdown_Posts_Custom_Control',
				'sanitize_callback' => 'absint',
				'settings'          => 'elite_commerce_featured_product_product',
				'label'             => esc_html__( 'Select Product', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_featured_product',
				'active_callback'   => array( $this, 'is_featured_product_visible' ),
				'input_attrs' => array(
					'post_type'      => 'product',
					'posts_per_page' => -1,
				),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_featured_product_visible( $control ) {
		return ( elite_commerce_display_section( $control->manager->get_setting( 'elite_commerce_featured_product_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_commerce_ss_featured_product = new Elite_Commerce_Featured_Product_Options();
