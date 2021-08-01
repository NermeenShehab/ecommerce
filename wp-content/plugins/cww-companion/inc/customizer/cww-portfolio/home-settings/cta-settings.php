<?php 
/**
* Settings related to CTA section
*
*
*/
add_action( 'customize_register', 'cww_companion_cta_register' );
function cww_companion_cta_register( $wp_customize ) {

$default = cww_portfolio_customizer_defaults();

$wp_customize->add_section( 'cww_homepage_cta_section', array(
	      'title'   	=> esc_html__( 'CTA Section', 'cww-companion' ),
	      'panel'   	=> 'cww_homepage_panel',
	      'priority' 	=> 30
	    )
	  );


//Enable or disable section
$wp_customize->add_setting('cww_cta_enable', 
		array(
	        'default'           	=> $default['cww_cta_enable'],
	        'sanitize_callback' 	=> 'cww_portfolio_sanitize_checkbox',
		)
	);

$wp_customize->add_control( new CWW_Portfolio_Checkbox($wp_customize, 'cww_cta_enable', 
	array(
	    'label' 			=> esc_html__( 'Enable or Disable Section', 'cww-portfolio' ),
	    'section'     		=> 'cww_homepage_cta_section',
	    'priority'			=> 1,
	    
       )
    )
);


$wp_customize->add_setting( 'cww_cta_bg',array(
    	'sanitize_callback' => 'esc_url_raw'
	)
);
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cww_cta_bg',
      array(
          'label'       => esc_html__( 'Background Image', 'cww-companion' ),
           'section'   	=> 'cww_homepage_cta_section',
           'priority'	=> 20,
        )
    )
);


$wp_customize->add_setting('cww_cta_title', 
	array(
        'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control( 'cww_cta_title', array(
	        'label'         	=> esc_html__( 'Section Title', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_cta_section',
	        'type'      		=> 'text',
	        'priority'			=> 30,
	        
	      ) );

$wp_customize->add_setting('cww_cta_sub_title', 
	array(
        'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control( 'cww_cta_sub_title', array(
	        'label'         	=> esc_html__( 'Section Subtitle', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_cta_section',
	        'type'      		=> 'text',
	        'priority'			=> 40,
	        
	      ) );

//cta button text
$wp_customize->add_setting('cww_cta_btn_text', 
	array(
        'sanitize_callback' => 'sanitize_text_field'
	)
);

$wp_customize->add_control( 'cww_cta_btn_text', array(
	        'label'         	=> esc_html__( 'Button Text', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_cta_section',
	        'type'      		=> 'text',
	        'priority'			=> 50,
	        
	      ) );

//button URL
$wp_customize->add_setting('cww_cta_btn_url', 
	array(
        'sanitize_callback' => 'esc_url_raw'
	)
);

$wp_customize->add_control( 'cww_cta_btn_url', array(
	        'label'         	=> esc_html__( 'Button URL', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_cta_section',
	        'type'      		=> 'text',
	        'priority'			=> 60,
	        
	      ) );

}