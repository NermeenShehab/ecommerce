<?php
/**
 * Testimonial Options
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Testimonial_Options {
	public function __construct() {
		// Register Testimonial Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add color options to universal options
	 */
	public function add_colors( $color_options ) {

		$section_color_options =  $this->get_colors();

		$updated_defaults = wp_parse_args( $section_color_options, $color_options );

		return $updated_defaults;
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_commerce_testimonial_visibility' => 'disabled',
			'elite_commerce_testimonial_number'     => 3,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add layouts section and its controls
	 */
	public function register_options( $wp_customize ) {
		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_testimonial_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_testimonial',
				'choices'           => Elite_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'elite_commerce_testimonial_visibility', array(
			'selector' => '#testimonial-section',
		) );

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_testimonial_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_testimonial_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_testimonial',
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_testimonial_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'elite-commerce' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_testimonial',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_testimonial_visible' ),
			)
		);

		$numbers = elite_commerce_gtm( 'elite_commerce_testimonial_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Commerce_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'elite_commerce_testimonial_page_' . $i,
					'label'             => esc_html__( 'Select Page #', 'elite-commerce' )  . $j,
					'section'           => 'elite_commerce_ss_testimonial',
					'active_callback'   => array( $this, 'is_testimonial_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);
		}
	}

	/**
	 * Testimonial visibility active callback.
	 */
	public function is_testimonial_visible( $control ) {
		return ( elite_commerce_display_section( $control->manager->get_setting( 'elite_commerce_testimonial_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_commerce_ss_testimonial = new Elite_Commerce_Testimonial_Options();
