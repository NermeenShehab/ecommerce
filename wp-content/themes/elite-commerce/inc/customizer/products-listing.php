<?php
/**
 * Products Listing Options
 *
 * @package Elite Commerce
 */

class Elite_Commerce_Products_Listing_Options {
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
			'elite_commerce_products_listing_visibility'              => 'disabled',
			'elite_commerce_products_listing_number'                  => 5,
			'elite_commerce_products_listing_columns'                 => 5,
			'elite_commerce_products_listing_orderby'                 => 'title',
			'elite_commerce_products_listing_products_filter'         => 'none',
			'elite_commerce_products_listing_order'                   => 'ASC',
			'elite_commerce_products_listing_button_text'             => esc_html__( 'View All', 'elite-commerce' ),
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
					'settings'          => 'ff_multiputpose_products_listing_plugin_notice',
					'label'             =>  esc_html__( 'Info', 'elite-commerce' ),
					'description'       =>  sprintf( esc_html__( 'Install %1$sWooCommerce%2$s Plugin for this section.', 'elite-commerce' ), '<a href="https://wordpress.org/plugins/woocommerce/" target="_blank">', '</a>' ),
					'section'           => 'elite_commerce_ss_products_listing',
				)
			);

			return;
		}

		Elite_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'elite_commerce_products_listing_visibility',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Visible On', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'choices'           => Elite_Commerce_Customizer_Utilities::section_visibility(),
	        )
	    );

	    Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_products_listing_section_top_subtitle',
				'label'             => esc_html__( 'Section Top Sub-title', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_products_listing_section_title',
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'Section Title', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_products_listing_number',
				'type'              => 'number',
				'label'             => esc_html__( 'Number', 'elite-commerce' ),
				'description'       => esc_html__( 'Please refresh the customizer page once the number is changed.', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'sanitize_callback' => 'absint',
				'input_attrs'       => array(
					'min'   => 1,
					'max'   => 80,
					'step'  => 1,
					'style' => 'width:100px;',
				),
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
				array(
				'settings'          => 'elite_commerce_products_listing_columns',
				'sanitize_callback' => 'absint',
				'description'       => esc_html__( 'Theme supports up to 6 columns', 'elite-commerce' ),
				'label'             => esc_html__( 'No of Columns', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'type'              => 'number',
				'input_attrs'       => array(
	                'style' => 'width: 50px;',
	                'min'   => 2,
	                'max'   => 6,
	            ),
	            'active_callback'  => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_products_listing_paginate',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Paginate', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'elite_commerce_products_listing_orderby',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Order By', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'choices'           => array(
	                'date'       => esc_html__( 'Date - The date the product was published', 'elite-commerce' ),
	                'id'         => esc_html__( 'ID - The post ID of the product', 'elite-commerce' ),
	                'menu_order' => esc_html__( 'Menu Order - The Menu Order, if set (lower numbers display first)', 'elite-commerce' ),
	                'popularity' => esc_html__( 'Popularity - The number of purchases', 'elite-commerce' ),
	                'rand'       => esc_html__( 'Random', 'elite-commerce' ),
	                'rating'     => esc_html__( 'Rating - The average product rating', 'elite-commerce' ),
	                'title'      => esc_html__( 'Title - The product title', 'elite-commerce' ),
	            ),
	            'active_callback'   => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Elite_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'elite_commerce_products_listing_products_filter',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Products Filter', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'choices'           => array(
	                'none'         => esc_html__( 'None', 'elite-commerce' ),
	                'on_sale'      => esc_html__( 'Retrieve on sale products', 'elite-commerce' ),
	                'best_selling' => esc_html__( 'Retrieve best selling products', 'elite-commerce' ),
	                'top_rated'    => esc_html__( 'Retrieve top rated products', 'elite-commerce' ),
	            ),
	            'active_callback'   => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_products_listing_featured',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Show only Products that are marked as Featured Products', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
				array(
	            'settings'          => 'elite_commerce_products_listing_order',
				'sanitize_callback' => 'elite_commerce_sanitize_select',
	            'type'              => 'select',
				'label'             => esc_html__( 'Order', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'choices'           => array(
	                'ASC'  => esc_html__( 'Ascending', 'elite-commerce' ),
	                'DESC' => esc_html__( 'Descending', 'elite-commerce' ),
	            ),
	            'active_callback'   => array( $this, 'is_products_listing_visible' ),
	        )
	    );

	    Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'settings'          => 'elite_commerce_products_listing_skus',
				'type'              => 'text',
				'description'       => esc_html__( 'Comma separated list of product SKUs', 'elite-commerce' ),
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'label'             => esc_html__( 'SKUs', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Dropdown_Select2_Custom_Control',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_products_listing_category',
				'label'             => esc_html__( 'Pick Product categories', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_products_listing',
				'input_attrs'       => array(
					'multiselect' => true,
				),
				'choices'           => array( esc_html__( '--Select--', 'elite-commerce' ) => Elite_Commerce_Customizer_Utilities::get_terms( 'product_cat' ) ),
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'text',
				'sanitize_callback' => 'elite_commerce_text_sanitization',
				'settings'          => 'elite_commerce_products_listing_button_text',
				'label'             => esc_html__( 'Button Text', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'type'              => 'url',
				'sanitize_callback' => 'esc_url_raw',
				'settings'          => 'elite_commerce_products_listing_button_link',
				'label'             => esc_html__( 'Button Link', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);

		Elite_Commerce_Customizer_Utilities::register_option(
			array(
				'custom_control'    => 'Elite_Commerce_Toggle_Switch_Custom_control',
				'settings'          => 'elite_commerce_products_listing_button_target',
				'sanitize_callback' => 'elite_commerce_switch_sanitization',
				'label'             => esc_html__( 'Open link in new tab?', 'elite-commerce' ),
				'section'           => 'elite_commerce_ss_key_features',
				'active_callback'   => array( $this, 'is_products_listing_visible' ),
			)
		);
	}

	/**
	 * Hero Content visibility active callback.
	 */
	public function is_products_listing_visible( $control ) {
		return ( elite_commerce_display_section( $control->manager->get_setting( 'elite_commerce_products_listing_visibility' )->value() ) );
	}
}

/**
 * Initialize class
 */
$elite_commerce_ss_products_listing = new Elite_Commerce_Products_Listing_Options();
