<?php
/**
* Settings for theme footer
*
*
*/

$wp_customize->add_section( 'cww_footer_section', array(
	      'title'   	=> esc_html__( 'Footer Settings', 'cww-portfolio' ),
	      'priority' 	=> 50
	    )
	  );


$wp_customize->add_setting('cww_footer_text', 
		array(
	        'sanitize_callback' => 'sanitize_text_field',
		)
	);

$wp_customize->add_control( 'cww_footer_text', array(
	        'label'         	=> esc_html__( 'Footer Copyright', 'cww-portfolio' ),
	        'section'       	=> 'cww_footer_section',
	        'type'      		=> 'text',
	        'priority'			=> 30,
	        
	      ) );