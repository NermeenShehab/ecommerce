<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Fired during plugin activation
 * @package    CWW Companion
 */


class CWW_Companion_Plugin_Activator {

	public static function activate() {

		$site_status = get_option( 'cww_fresh_website_activate' );
		if ( (bool) $site_status === false ) {
			//Default pages when set as static posts
			$pages = array( esc_html__( 'Home', 'cww-companion' ), esc_html__( 'Blog', 'cww-companion' ) );
			foreach ($pages as $page){
				$post_data = array( 'post_author' => 1, 'post_name' => $page,  'post_status' => 'publish' , 'post_title' => $page, 'post_type' => 'page', );
				if($page == 'Home'): 
					$page_option = 'page_on_front';
					$template = 'home-tmpl.php';	
				else:
					$page_option = 'page_for_posts';
					$template = 'page.php';
				endif;
				$post_data = wp_insert_post( $post_data, false );
				if ( $post_data ){
					update_post_meta( $post_data, '_wp_page_template', $template );
					$page = get_page_by_title($page);
					update_option( 'show_on_front', 'page' );
					update_option( $page_option, $page->ID );
				}
			}
			update_option( 'cww_fresh_website_activate', true );
		}
	} // end of activate function


	

	
}// end of class