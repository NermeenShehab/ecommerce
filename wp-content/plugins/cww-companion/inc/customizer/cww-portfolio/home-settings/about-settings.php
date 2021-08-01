<?php
/**
* Settings for about section
*
*/
add_action( 'customize_register', 'cww_companion_about_register' );
function cww_companion_about_register( $wp_customize ) {

  $default = cww_portfolio_customizer_defaults();
  
$wp_customize->add_section( 'cww_homepage_about_section', array(
	      'title'    => esc_html__( 'About Section', 'cww-companion' ),
	      'panel'    => 'cww_homepage_panel',
        'priority' => 20
	    )
	  );


//enable or disable section
$wp_customize->add_setting('cww_about_enable', 
    array(
          'default'             => $default['cww_about_enable'],
          'sanitize_callback'   => 'cww_portfolio_sanitize_checkbox',
    )
  );

$wp_customize->add_control( new CWW_Portfolio_Checkbox($wp_customize, 'cww_about_enable', 
  array(
      'label'       => esc_html__( 'Enable or Disable Section', 'cww-portfolio' ),
      'section'         => 'cww_homepage_about_section',
      'priority'      => 1,
      
       )
    )
);


$wp_customize->add_setting('cww_about_title', 
	array(
        'default'           => $default['cww_about_title'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
	)
);

$wp_customize->add_control( 'cww_about_title', array(
	        'label'         	=> esc_html__( 'Section Title', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_about_section',
	        'type'      		=> 'text',
	        'priority'			=> 50,
	        
	      ) );

$wp_customize->add_setting('cww_about_sub_title', 
	array(
        'default'           => $default['cww_about_sub_title'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
	)
);

$wp_customize->add_control( 'cww_about_sub_title', array(
	        'label'         	=> esc_html__( 'Section Subtitle', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_about_section',
	        'type'      		=> 'text',
	        'priority'			=> 60,
	        
	      ) );

//image
$wp_customize->add_setting( 'cww_about_image',array(
			'default' 			=> $default['cww_about_image'],
        	'sanitize_callback' => 'esc_url_raw',
          'transport'         => 'postMessage'
    	)
	);

$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'cww_about_image',
      array(
          'label'       => esc_html__( 'Upload Image', 'cww-companion' ),
          'description' => esc_html__('Recommend image size: 425 x 500 px','cww-companion'),
           'section'   	=> 'cww_homepage_about_section',
           'priority'	=> 70,
        )
    )
);

//about contents

$wp_customize->add_setting(
                'customizer_page_editor', array(
                    'sanitize_callback' => 'wp_kses_post',
                )
            );
          
$wp_customize->add_control(
    new Customizer_Page_Editor(
        $wp_customize, 'customizer_page_editor', array(
            'label'                      => esc_html__( 'Contents', 'cww-companion' ),
            'section'                    => 'cww_homepage_about_section',
            'priority'                   => 80,
        )
    )
);

//Counter seperator
$wp_customize->add_setting( 'cww_about_counter_section_info',array(
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

$wp_customize->add_control( new CWW_Portfolio_Customize_Seperator_Control($wp_customize, 'cww_about_counter_section_info',
      array(
          'label'       => esc_html__( 'Counters', 'cww-companion' ),
          'description' => esc_html__('Configure counters value and texts below','cww-companion'),
           'section'    => 'cww_homepage_about_section',
           'priority' => 90,
        )
    )
);

//first counter
$wp_customize->add_setting('cww_about_counter_value_first', 
  array(
        'default'           => $default['cww_about_counter_value_first'],
        'sanitize_callback' => 'sanitize_text_field',
        
  )
);

$wp_customize->add_control( 'cww_about_counter_value_first', array(
          'label'           => esc_html__( 'Counter Value', 'cww-companion' ),
          'section'         => 'cww_homepage_about_section',
          'type'          => 'text',
          'priority'      => 100,
          
        ) );


$wp_customize->add_setting('cww_about_counter_text_first', 
  array(
        'default'           => $default['cww_about_counter_text_first'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
  )
);

$wp_customize->add_control( 'cww_about_counter_text_first', array(
          'label'           => esc_html__( 'Counter Text', 'cww-companion' ),
          'section'         => 'cww_homepage_about_section',
          'type'          => 'text',
          'priority'      => 110,
          
        ) );


//second counter seperator
$wp_customize->add_setting( 'cww_about_counter_section_sec_info',array(
          'sanitize_callback' => 'sanitize_text_field'
      )
  );

$wp_customize->add_control( new CWW_Portfolio_Customize_Seperator_Control($wp_customize, 'cww_about_counter_section_sec_info',
      array(
          'description' => esc_html__('Second counter value and text settings','cww-companion'),
           'section'    => 'cww_homepage_about_section',
           'priority' => 120,
        )
    )
);

//second counter
$wp_customize->add_setting('cww_about_counter_value_sec', 
  array(
        'default'           => $default['cww_about_counter_value_sec'],
        'sanitize_callback' => 'sanitize_text_field',
        
  )
);

$wp_customize->add_control( 'cww_about_counter_value_sec', array(
          'label'           => esc_html__( 'Counter Value', 'cww-companion' ),
          'section'         => 'cww_homepage_about_section',
          'type'          => 'text',
          'priority'      => 130,
          
        ) );


$wp_customize->add_setting('cww_about_counter_text_sec', 
  array(
        'default'           => $default['cww_about_counter_text_sec'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
  )
);

$wp_customize->add_control( 'cww_about_counter_text_sec', array(
          'label'           => esc_html__( 'Counter Text', 'cww-companion' ),
          'section'         => 'cww_homepage_about_section',
          'type'          => 'text',
          'priority'      => 140,
          
        ) );

}