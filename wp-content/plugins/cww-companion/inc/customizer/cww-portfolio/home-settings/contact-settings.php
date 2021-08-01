<?php
/**
* Settings related to contact section
*
*
*
*/
add_action( 'customize_register', 'cww_companion_contact_register' );
function cww_companion_contact_register( $wp_customize ) {

	$default = cww_portfolio_customizer_defaults();
	
$wp_customize->add_section( 'cww_homepage_contact_section', array(
	      'title'   		=> esc_html__( 'Contact Section', 'cww-companion' ),
	      'panel'    		=> 'cww_homepage_panel',
	      'priority'   	=> 70
	    )
	  );

//enable or disable section
$wp_customize->add_setting('cww_contact_enable', 
		array(
	        'default'           	=> $default['cww_contact_enable'],
	        'sanitize_callback' 	=> 'cww_portfolio_sanitize_checkbox',
		)
	);

$wp_customize->add_control( new CWW_Portfolio_Checkbox($wp_customize, 'cww_contact_enable', 
	array(
	    'label' 			=> esc_html__( 'Enable or Disable Section', 'cww-portfolio' ),
	    'section'     		=> 'cww_homepage_contact_section',
	    'priority'			=> 1,
	    
       )
    )
);


$wp_customize->add_setting('cww_contact_title', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
	)
);

$wp_customize->add_control( 'cww_contact_title', array(
	        'label'         	=> esc_html__( 'Section Title', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      			=> 'text',
	        'priority'				=> 50,
	        
	      ) );

$wp_customize->add_setting('cww_contact_sub_title', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
	)
);

$wp_customize->add_control( 'cww_contact_sub_title', array(
	        'label'         	=> esc_html__( 'Section Subtitle', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      			=> 'text',
	        'priority'				=> 60,
	        
	      ) );

//form shortcode
$wp_customize->add_setting('cww_contact_shortcode', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'cww_contact_shortcode', array(
	        'label'         	=> esc_html__( 'Enter Form Shortcode', 'cww-companion' ),
	        'description' 		=> esc_html__('Enter contact form shortcode','cww-companion'),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      			=> 'text',
	        'priority'				=> 70,
	        
	      ) );

//setting seperator
$wp_customize->add_setting( 'cww_contact_section_info',array(
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

$wp_customize->add_control( new CWW_Portfolio_Customize_Seperator_Control($wp_customize, 'cww_contact_section_info',
      array(
          'label'       => esc_html__( 'Additional Contact Info', 'cww-companion' ),
          'description' => esc_html__('Configure additional contact info below','cww-companion'),
           'section'    => 'cww_homepage_contact_section',
           'priority' => 80,
        )
    )
);

$wp_customize->add_setting('cww_contact_info_title', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'cww_contact_info_title', array(
	        'label'         	=> esc_html__( 'Info Title', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      		=> 'text',
	        'priority'			=> 90,
	        
	      ) );


$wp_customize->add_setting('cww_contact_info_sub_title', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'cww_contact_info_sub_title', array(
	        'label'         	=> esc_html__( 'Info Subtitle', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      		=> 'text',
	        'priority'			=> 100,
	        
	      ) );

//address
$wp_customize->add_setting('cww_contact_address', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'cww_contact_address', array(
	        'label'         	=> esc_html__( 'Address', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      		=> 'text',
	        'priority'			=> 110,
	        
	      ) );

//email
$wp_customize->add_setting('cww_contact_email', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'cww_contact_email', array(
	        'label'         	=> esc_html__( 'Email', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      		=> 'text',
	        'priority'			=> 120,
	        
	      ) );

//mobile
$wp_customize->add_setting('cww_contact_mobile', 
	array(
        'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'cww_contact_mobile', array(
	        'label'         	=> esc_html__( 'Mobile', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_contact_section',
	        'type'      		=> 'text',
	        'priority'			=> 130,
	        
	      ) );

}