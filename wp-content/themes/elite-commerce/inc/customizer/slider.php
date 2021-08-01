<?php
/**
 * Slider Options
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Slider_Options {
	public function __construct() {
		// Register Slider Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 98 );

		// Register Slider Advance Options.
		add_action( 'customize_register', array( $this, 'register_advanced_options' ), 99 );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_commerce_slider_visibility' => 'disabled',
			'elite_commerce_slider_number'     => 2,
		);

		$updated_defaults = wp_parse_args( $defaults, $default_options );

		return $updated_defaults;
	}

	/**
	 * Add slider section and its controls
	 */
	public function register_options( $wp_customize ) {
		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_slider_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_slider',
				'choices'           => Elite_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'elite_commerce_slider_visibility', array(
			'selector' => '#slider-section',
		) );

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'elite_commerce_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'elite-commerce' ),
				'description'       =>  sprintf( esc_html__( 'For Slider left Section, add widgets to Slider Sidabar Left, form Widgets Section %1$shere%2$s', 'elite-commerce' ), '<a href="' . esc_url( admin_url( 'widgets.php' ) ) . '" target="_blank">', '</a>' ),
				'section'           => 'elite_commerce_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'number',
				'settings'          => 'elite_commerce_slider_number',
				'label'             => esc_html__( 'Number', 'elite-commerce' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_slider',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		$numbers = elite_commerce_gtm( 'elite_commerce_slider_number' );

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Commerce_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'elite_commerce_slider_page_' . $i,
					'label'             => esc_html__( 'Page #', 'elite-commerce' )  . $j,
					'section'           => 'elite_commerce_ss_slider',
					'active_callback'   => array( $this, 'is_slider_visible' ),
					'input_attrs'       => array(
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
	 * Add slider advance options
	 */
	public function register_advanced_options( $wp_customize ) {
		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Note_Control',
				'settings'          => 'elite_commerce_slider_advance_options_notice',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Slider Advance Options', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
				'transport'         => 'postMessage',
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_slider_autoplay',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Autoplay', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_slider',
				'active_callback'   => array( $this, 'is_slider_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_slider_autoplay_delay',
				'type'              => 'number',
				'sanitize_callback' => 'absint',
				'label'             => esc_html__( 'Autoplay Delay', 'elite-commerce' ),
				'description'       => esc_html__( '(in ms)', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_slider',
				'input_attrs'           => array(
					'width' => '10px',
				),
				'active_callback'   => array( $this, 'is_slider_autoplay_on' ),
			)
		);
	}

	/**
	 * Slider visibility active callback.
	 */
	public function is_slider_visible( $control ) {
		return ( elite_commerce_display_section( $control->manager->get_setting( 'elite_commerce_slider_visibility' )->value() ) );
	}

	/**
	 * Slider autoplay check.
	 */
	public function is_slider_autoplay_on( $control ) {
		return ( $this->is_slider_visible( $control ) && $control->manager->get_setting( 'elite_commerce_slider_autoplay' )->value() );
	}
}

/**
 * Initialize class
 */
$elite_commerce_ss_slider = new Elite_Commerce_Slider_Options();
