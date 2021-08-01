<?php

add_action( 'customize_register', 'cww_companion_controllers_customize_register' );
function cww_companion_controllers_customize_register( $wp_customize ) {
    
    $file_loc = CWW_COMP_PATH.'/inc/customizer/controllers/';

	$file_paths = array(

		$file_loc.'page-editor/customizer-page-editor',
		

	);

	foreach ( $file_paths as $file_path ){

		require $file_path.'.php'; 
	}

    
    
}