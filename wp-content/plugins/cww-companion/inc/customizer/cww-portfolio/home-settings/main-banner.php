<?php 
add_action( 'customize_register', 'cww_companion_repeaters_banner_register' );
function cww_companion_repeaters_banner_register( $wp_customize ) {

	$default = cww_portfolio_customizer_defaults();

	/**
	* Setting accordion
	*
	*/
	$wp_customize->add_setting( 'cww_home_banner_content_accordion', 
			array(
			    'capability'        => 'edit_theme_options',
			    'sanitize_callback' => 'sanitize_text_field'
	        )
		);

	$wp_customize->add_control( new CWW_Portfolio_Heading($wp_customize, 'cww_home_banner_content_accordion', 
		array(
		    'label' 			=> esc_html__( 'Banner Contents', 'cww-companion' ),
		    'section'     		=> 'cww_homepage_section',
		    'class'				=> 'advanced-home-bnr-content-accordion',
		    'accordion'			=> true,
		    'expanded'         	=> false,
		    'priority'			=> 10,
		    'controls_to_wrap'  => 8,
		    
	       )
	    )
	);

	//image
	$wp_customize->add_setting( 'cww_banner_image',array(
			'default' 			=> $default['cww_banner_image'],
        	'sanitize_callback' => 'esc_url_raw',
        	'transport' 		=> 'postMessage'
    	)
	);
	$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cww_banner_image',
	      array(
	          'label'       => esc_html__( 'Upload Image', 'cww-companion' ),
	           'section'   	=> 'cww_homepage_section',
	           'priority'	=> 20,
	        )
	    )
	);


	

	$wp_customize->add_setting('cww_banner_text_sm', 
		array(
	        'default'           => $default['cww_banner_text_sm'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_text_sm', array(
		        'label'         	=> esc_html__( 'Banner Text Top', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 30,
		        
		      ) );


	$wp_customize->add_setting('cww_banner_text_lg', 
		array(
	        'default'           => $default['cww_banner_text_lg'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_text_lg', array(
		        'label'         	=> esc_html__( 'Banner Text Middle', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 40,
		        
		      ) );


	$wp_customize->add_setting('cww_banner_text_sm2', 
		array(
	        'default'           => $default['cww_banner_text_sm2'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_text_sm2', array(
		        'label'         	=> esc_html__( 'Banner Text Bottom', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 50,
		        
		      ) );


	//Button Text
	$wp_customize->add_setting('cww_banner_btn_text', 
		array(
	        'default'           => $default['cww_banner_btn_text'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_btn_text', array(
		        'label'         	=> esc_html__( 'Primary Button Text', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 60,
		        
		      ) );



	//Button URL
	$wp_customize->add_setting('cww_banner_btn_url', 
		array(
	        'default'           => $default['cww_banner_btn_url'],
	        'sanitize_callback' => 'esc_url_raw',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_btn_url', array(
		        'label'         	=> esc_html__( 'Primary Button URL', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 70,
		        
		      ) );


	/**
	* Secondary Button
	*/
	//Button Text
	$wp_customize->add_setting('cww_banner_btn_text_sec', 
		array(
	        'default'           => $default['cww_banner_btn_text_sec'],
	        'sanitize_callback' => 'sanitize_text_field',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_btn_text_sec', array(
		        'label'         	=> esc_html__( 'Secondary Button Text', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 80,
		        
		      ) );



	//Button URL
	$wp_customize->add_setting('cww_banner_btn_url_sec', 
		array(
	        'default'           => $default['cww_banner_btn_url_sec'],
	        'sanitize_callback' => 'esc_url_raw',
	        'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( 'cww_banner_btn_url_sec', array(
		        'label'         	=> esc_html__( 'Secondary Button URL', 'cww-companion' ),
		        'section'       	=> 'cww_homepage_section',
		        
		        'type'      		=> 'text',
		        'priority'			=> 90,
		        
		      ) );


	/**
	*  accordion for color options
	*
	*/
	$wp_customize->add_setting( 'cww_home_banner_design_accordion', 
			array(
			    'capability'        => 'edit_theme_options',
			    'sanitize_callback' => 'sanitize_text_field'
	        )
		);

	$wp_customize->add_control( new CWW_Portfolio_Heading($wp_customize, 'cww_home_banner_design_accordion', 
		array(
		    'label' 			=> esc_html__( 'Design Options', 'cww-companion' ),
		    'section'     		=> 'cww_homepage_section',
		    'class'				=> 'advanced-home-bnr-design-accordion',
		    'accordion'			=> true,
		    'expanded'         	=> true,
		    'priority'			=> 100,
		    'controls_to_wrap'  => 3,
		    
	       )
	    )
	);


	//bg color
	$wp_customize->add_setting( 'cww_banner_bg',
            array(
                'default'     		=> $default['cww_banner_bg'],
                'type'        		=> 'theme_mod',
                'capability'  		=> 'edit_theme_options',
                'sanitize_callback' => 'cww_portfolio_sanitize_color',
                'transport'   		=> 'postMessage'
            )
        );
    

    $wp_customize->add_control( new Customizer_Alpha_Color_Control( $wp_customize, 'cww_banner_bg',
                array(
                    'label'         => esc_html__( 'Banner Background Color', 'cww-companion' ),
                    'description' 	=> esc_html__('Change background color for main banner','cww-companion'),
                    'section'       => 'cww_homepage_section',
                    'priority'      => 200,
                    'show_opacity'  => true, // Optional.
                    'palette' => array(
                        'rgb(150, 50, 220)', // RGB, RGBa, and hex values supported
                        'rgba(50,50,50,0.8)',
                        'rgba( 255, 255, 255, 0.2 )', // Different spacing = no problem
                        '#00CC99' // Mix of color types = no problem
                    )
                )
            )
        );


    $wp_customize->add_setting('cww_banner_animated_color', 
			array(
		        'default'           => $default['cww_banner_animated_color'],
		        'sanitize_callback' => 'cww_portfolio_sanitize_color',
		        'transport'         => 'postMessage'
		    )
		);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'cww_banner_animated_color', 
		array(
	        'label'           	=> esc_html__( 'Animated Shape Color', 'cww-companion' ),
	        'section'         	=> 'cww_homepage_section',
	        'priority'			=> 220,
	    ) ) );


}