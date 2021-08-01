<?php
/**
 * Elite Commerce Theme Customizer
 *
 * @package Elite Commerce
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function elite_commerce_sortable_sections( $wp_customize ) {
	$wp_customize->add_panel( 'elite_commerce_sp_sortable', array(
		'title'       => esc_html__( 'Sections', 'elite-commerce' ),
		'priority'    => 150,
	) );

	$default_sections = elite_commerce_get_default_sortable_sections();

	$sortable_options = array();

	$sortable_order = elite_commerce_gtm( 'elite_commerce_ss_order' );

	if ( $sortable_order ) {
		$sortable_options = explode( ',', $sortable_order );
	}

	$sortable_sections = array_unique( $sortable_options + array_keys( $default_sections ) );

	foreach ( $sortable_sections as $section ) {
		if ( isset( $default_sections[$section] ) ) {
			// Add sections.
			$wp_customize->add_section( 'elite_commerce_ss_' . $section,
				array(
					'title' => $default_sections[$section],
					'panel' => 'elite_commerce_sp_sortable'
				)
			);
		}

		unset($default_sections[$section]);
	}

	if ( count( $default_sections ) ) {
		foreach ($default_sections as $key => $value) {
			// Add new sections.
			$wp_customize->add_section( 'elite_commerce_ss_' . $key,
				array(
					'title' => $value,
					'panel' => 'elite_commerce_sp_sortable'
				)
			);
		}
	}

	// Add hidden section for saving sorted sections.
	Elite_Commerce_Customizer_Utilities::register_option(
		array(
			'settings'          => 'elite_commerce_ss_order',
			'sanitize_callback' => 'sanitize_text_field',
			'label'             => esc_html__( 'Section layout', 'elite-commerce' ),
			'section'           => 'elite_commerce_ss_main_content',
		)
	);
}
add_action( 'customize_register', 'elite_commerce_sortable_sections', 1 );

/**
 * Default sortable sections order
 * @return array
 */
function elite_commerce_get_default_sortable_sections() {
	return $default_sections = array (
		'slider'                => esc_html__( 'Slider', 'elite-commerce' ),
		'wwd'                   => esc_html__( 'What We Do', 'elite-commerce' ),
		'product_categories'    => esc_html__( 'Product Categories', 'elite-commerce' ),
		'products_listing'      => esc_html__( 'Products Listing', 'elite-commerce' ),
		'promotional_headline'  => esc_html__( 'Promotion Headline', 'elite-commerce' ),
		'featured_product'      => esc_html__( 'Featured Product', 'elite-commerce' ),
		'testimonial'           => esc_html__( 'Testimonials', 'elite-commerce' ),
	);
}
