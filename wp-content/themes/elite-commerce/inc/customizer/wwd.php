<?php
/**
 * WWD Options
 *
 * @package Elite Commerce
 */

class Elite_Commerce_WWD_Options {
	public function __construct() {
		// Register WWD Options.
		add_action( 'customize_register', array( $this, 'register_options' ), 99 );

		// Add default options.
		add_filter( 'elite_commerce_customizer_defaults', array( $this, 'add_defaults' ) );
	}

	/**
	 * Add options to defaults
	 */
	public function add_defaults( $default_options ) {
		$defaults = array(
			'elite_commerce_wwd_visibility' => 'disabled',
			'elite_commerce_wwd_number'     => 4,
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
				'settings'          => 'elite_commerce_wwd_visibility',
				'type'              => 'select',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
				'label'             => esc_html__( 'Visible On', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_wwd',
				'choices'           => Elite_Commerce_Customizer_Utilities::section_visibility(),
			)
		);

		$wp_customize->selective_refresh->add_partial( 'elite_commerce_wwd_visibility', array(
			'selector' => '#wwd-section',
		) );

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_wwd_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_wwd_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_wwd_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'elite-commerce' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_wwd',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		$numbers = elite_commerce_gtm( 'elite_commerce_wwd_number' );

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Simple_Notice_Custom_Control',
				'sanitize_callback' => 'sanitize_text_field',
				'settings'          => 'elite_commerce_wwd_icon_note',
				'label'             =>  esc_html__( 'Info', 'elite-commerce' ),
				'description'       =>  sprintf( esc_html__( 'If you want camera icon, save "fas fa-camera". For more classes, check %1$sthis%2$s', 'elite-commerce' ), '<a href="' . esc_url( 'https://fontawesome.com/icons?d=gallery&m=free' ) . '" target="_blank">', '</a>' ),
				'section'           => 'elite_commerce_ss_wwd',
				'active_callback'   => array( $this, 'is_wwd_visible' ),
			)
		);

		for( $i = 0, $j = 1; $i < $numbers; $i++, $j++ ) {
			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Commerce_Simple_Notice_Custom_Control',
					'sanitize_callback' => 'elite_commerce_text_sanitization',
					'settings'          => 'elite_commerce_wwd_notice_' . $i,
					'label'             => esc_html__( 'Item #', 'elite-commerce' )  . $j,
					'section'           => 'elite_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'Elite_Commerce_Dropdown_Posts_Custom_Control',
					'sanitize_callback' => 'absint',
					'settings'          => 'elite_commerce_wwd_page_' . $i,
					'label'             => esc_html__( 'Select Page #', 'elite-commerce' )  . $j,
					'section'           => 'elite_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
					'input_attrs' => array(
						'post_type'      => 'page',
						'posts_per_page' => -1,
						'orderby'        => 'name',
						'order'          => 'ASC',
					),
				)
			);

			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'settings'          => 'elite_commerce_wwd_custom_icon_' . $i,
					'label'             => esc_html__( 'Icon Class', 'elite-commerce' ),
					'section'           => 'elite_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);

			Elite_Commerce_Customizer_Utilities::register_option(
				array(
					'custom_control'    => 'WP_Customize_Image_Control',
					'sanitize_callback' => 'esc_url_raw',
					'settings'          => 'elite_commerce_wwd_custom_image_' . $i,
					'label'             => esc_html__( 'Image', 'elite-commerce' ),
					'section'           => 'elite_commerce_ss_wwd',
					'active_callback'   => array( $this, 'is_wwd_visible' ),
				)
			);
		}
	}

	/**
	 * WWD visibility active callback.
	 */
	public function is_wwd_visible( $control ) {
		return ( elite_commerce_display_section( $control->manager->get_setting( 'elite_commerce_wwd_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_commerce_ss_wwd = new Elite_Commerce_WWD_Options();
