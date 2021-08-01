<?php
/**
* Settings related to theme service section
*
*/
add_action( 'customize_register', 'cww_companion_service_register' );
function cww_companion_service_register( $wp_customize ) {

    $default = cww_portfolio_customizer_defaults();
    
$wp_customize->add_section( 'cww_homepage_service_section', array(
	      'title'      => esc_html__( 'Service Section', 'cww-companion' ),
	      'panel'      => 'cww_homepage_panel',
          'priority'   => 40
	    )
	  );

//Service section
$wp_customize->add_setting('cww_service_enable', 
        array(
            'default'               => $default['cww_service_enable'],
            'sanitize_callback'     => 'cww_portfolio_sanitize_checkbox',
        )
    );

$wp_customize->add_control( new CWW_Portfolio_Checkbox($wp_customize, 'cww_service_enable', 
    array(
        'label'             => esc_html__( 'Enable or Disable Section', 'cww-portfolio' ),
        'section'           => 'cww_homepage_service_section',
        'priority'          => 1,
        
       )
    )
);


$wp_customize->add_setting('cww_service_title', 
	array(
        'default'           => $default['cww_service_title'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
	)
);

$wp_customize->add_control( 'cww_service_title', array(
	        'label'         	=> esc_html__( 'Section Title', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_service_section',
	        'type'      		=> 'text',
	        'priority'			=> 50,
	        
	      ) );

$wp_customize->add_setting('cww_service_sub_title', 
	array(
        'default'           => $default['cww_service_sub_title'],
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'postMessage'
	)
);

$wp_customize->add_control( 'cww_service_sub_title', array(
	        'label'         	=> esc_html__( 'Section Subtitle', 'cww-companion' ),
	        'section'       	=> 'cww_homepage_service_section',
	        'type'      		=> 'text',
	        'priority'			=> 60,
	        
	      ) );

//service section repeater
$wp_customize->add_setting( 'cww_service_features', array(
    'sanitize_callback' => 'cww_companion_sanitize_repeater',
    'default' => json_encode(
        array(
            array(
                'service_icon' => '',
                'service_text'   => '',
                'service_desc'  => '',
            )
        )
    )
));

$wp_customize->add_control(  new CWW_Companion_Repeater_Controler( $wp_customize, 'cww_service_features', 
    array(
        'label'                     => esc_html__('Service Options','cww-companion'),
        'description'               => esc_html__('Manage services','cww-companion'),
        'section'                   => 'cww_homepage_service_section',
        'priority'					=> 70,
        'cww_companion_box_label'           => esc_html__('Services','cww-companion'),
        'cww_companion_box_add_control'     => esc_html__('Add Services','cww-companion'),
    ),
        array(
            'service_icon' => array(
            'type'        => 'icon',
            'label'       => esc_html__( 'Choose Icon', 'cww-companion' ),
            'default'     => '',
            'class'       => 'un-bottom-block-cat1'
            ), 

            'service_text' => array(
            'type'        => 'text',
            'label'       => esc_html__( 'Service Text', 'cww-companion' ),
            'default'     => '',
            'class'       => 'un-bottom-block-cat1'
            ),

            'service_desc' => array(
            'type'        => 'textarea',
            'label'       => esc_html__( 'Service Description', 'cww-companion' ),
            'default'     => '',
            'class'       => 'un-bottom-block-cat1'
            )   
        )
));



$wp_customize->add_setting('cww_service_pro_notice', 
            array(
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

$wp_customize->add_control( new CWW_Portfolio_Customize_Pro_Info( $wp_customize, 'cww_service_pro_notice', 
    array(
        'label'             => esc_html__( 'You need premium version of theme to unlock all features', 'cww-companion' ),
        'section'           => 'cww_homepage_service_section',
        'priority'          => 80,
    ) ) );


}