<?php 
/**
* Demo Importer Config
*
*
*
*/

$url = 'https://codeworkweb.com/demo-importer/cww-portfolio-demos/';

$data = array(

    'main' => array(
        //'categories'        => array( 'Main Demo','cww-portfolio' ),
        'preview_url'       => 'https://demo.codeworkweb.com/cww-portfolio/main/',
        'xml_file'          => $url.'content.xml',
        'theme_settings'    => $url.'customizer.dat',
        'widgets_file'      => $url.'widgets.wie',
        'home_title'        => 'Home',
        'blog_title'        => 'Blogs',
        'posts_to_show'     => '5',
        'is_shop'           => false,
        'menus'             => array(
            'menu-1'   => 'Main Menu'
        ),
        'required_plugins'  => array(
            'free'          => array(
               
                array(
                    'slug'    => 'contact-form-7',
                    'init'    => 'contact-form-7/wp-contact-form-7.php',
                    'name'    => 'Contact Form 7',
                ),
            ),
        ),
    ),
  );
