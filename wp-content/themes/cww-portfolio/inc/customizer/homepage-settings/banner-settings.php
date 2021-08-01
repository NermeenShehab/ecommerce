<?php
/**
* Settings related to theme banner section
*
*/

$wp_customize->add_panel( 'cww_homepage_panel', array(
      'priority'         =>      35,
      'capability'       =>      'edit_theme_options',
      'theme_supports'   => '',
      'title'            =>      esc_html__( 'Homepage Options', 'cww-portfolio' ),
      'description'      =>      esc_html__( 'This allows to edit general theme settings', 'cww-portfolio' ),
  ));


$wp_customize->add_section( 'cww_homepage_section', array(
	      'title'    => esc_html__( 'Main Banner', 'cww-portfolio' ),
	      'panel'    => 'cww_homepage_panel',
            'priority' => 1
	    )
	  );



$wp_customize->add_section( new CWW_Portfolio_FrontPageSection( $wp_customize, 'navigation_panel_install_companion_inside',
      array(
        'priority'   => 35,
        'title'      => esc_html__( 'Front Page content', 'cww-portfolio' ),
        'panel'      => 'cww_homepage_panel',
        'show_title' => false
      )
    )
  );

$wp_customize->add_section( new CWW_Portfolio_FrontPageSection( $wp_customize, 'navigation_panel_install_companion',
      array(
        'priority'   => 35,
        'title'      => esc_html__( 'Front Page content', 'cww-portfolio' ),
        'show_title' => false
      )
    )
  );
        