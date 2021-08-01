<?php
add_action( 'after_setup_theme', 'cww_portfolio_setup_custom' );
function cww_portfolio_setup_custom(){
	cww_portfolio_theme_page();
	cww_portfolio_suggest_plugins();
}
// THEME PAGE
function cww_portfolio_theme_page() {
	add_action( 'admin_menu', 'cww_portfolio_register_theme_page' );
}


function cww_portfolio_suggest_plugins() {

	require_once get_template_directory() . '/inc/welcome/companion.php';

	/* tgm-plugin-activation */
	require_once get_template_directory() . '/inc/welcome/class-tgm-plugin-activation.php';



	$plugins = array(
		'cww-companion' => array(
			'title'       => esc_html__( 'CWW Companion', 'cww-portfolio' ),
			'description' => esc_html__(' This plugin adds extra features on your theme','cww-portfolio'),
			'activate'    => array(
				'label' => esc_html__( 'Activate', 'cww-portfolio' ),
			),
			'install'     => array(
				'label' => esc_html__( 'Install', 'cww-portfolio' ),
			),
		),
		'contact-form-7'        => array(
			'title'       => esc_html__( 'Contact Form 7', 'cww-portfolio' ),
			'description' => esc_html__( 'The Contact Form for easily adding forms.',
				'cww-portfolio' ),
			'activate'    => array(
				'label' => esc_html__( 'Activate', 'cww-portfolio' ),
			),
			'install'     => array(
				'label' => esc_html__( 'Install', 'cww-portfolio' ),
			),
		),
		
	);
	$plugins = apply_filters( 'cww_portfolio_theme_info_plugins', $plugins );
	CWW_Portfolio_Companion_Plugin::init( array(
		'slug'           => 'cww-companion', //section for customizer notice plugin
		'activate_label' => esc_html__( 'Activate CWW Companion', 'cww-portfolio' ),
		'activate_msg'   => esc_html__( 'This feature requires the CWW Companion plugin to be activated.',
			'cww-portfolio' ),
		'install_label'  => esc_html__( 'Install CWW Companion', 'cww-portfolio' ),
		'install_msg'    => esc_html__( 'This feature requires the CWW Companion plugin to be installed.',
			'cww-portfolio' ),
		'plugins'        => $plugins,
	) );
}

function cww_portfolio_tgma_suggest_plugins() {
	$plugins = array(
		array(
			'name'             => 'CWW Companion',
			'slug'             => 'cww-companion',
			'required'         => false,
			'force_activation' => false,
			'is_automatic'     => false
		),

		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'One Click Demo Import',
			'slug'     => 'one-click-demo-import',
			'required' => false,
		),
	);

	$plugins = apply_filters( 'cww_portfolio_tgmpa_plugins', $plugins );

	$config = array(
		'id'           => 'cww-portfolio',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => false,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	$config = apply_filters( 'cww_portfolio_tgmpa_config', $config );

	tgmpa( $plugins, $config );
}

add_action( 'tgmpa_register', 'cww_portfolio_tgma_suggest_plugins' );



function cww_portfolio_load_theme_partial( $currentTab = null ) {

	$requestTab = ( isset( $_REQUEST['tab'] ) ) ? $_REQUEST['tab'] : 'getting-started';

	if ( ! $currentTab ) {
		$currentTab = $requestTab;
	}

	require_once get_template_directory() . '/inc/welcome/companion.php';
	require_once get_template_directory() . "/inc/welcome/theme-info.php";
	wp_enqueue_style( 'cww-portfolio-theme-info', get_theme_file_uri('/inc/welcome/assets/css/welcome.css') );
	
}

function cww_portfolio_register_theme_page() {
	$page_name = apply_filters( 'cww_portfolio_theme_page_name', __( 'CWW Portfolio Info', 'cww-portfolio' ) );
	add_theme_page( $page_name, $page_name, 'activate_plugins', 'cww-welcome', 'cww_portfolio_load_theme_partial' );
}