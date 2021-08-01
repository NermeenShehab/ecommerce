<?php


class CWW_Portfolio_Companion_Plugin {
	public static $plugin_state;
	public static $config = array();
	private static $instance = false;
	private static $slug;

	public function __construct( $config ) {
		self::$config = $config;
		self::$slug   = $config['slug'];
		add_action( 'tgmpa_register', array( __CLASS__, 'tgma_register' ) );
		add_action( 'wp_ajax_companion_disable_popup', array( __CLASS__, 'companion_disable_popup' ) );

		if ( get_template() === get_stylesheet() ) {

			if ( ! get_option( 'cww_welcome_disable_popup', false ) ) {
				if ( ! apply_filters( 'cww_portfolio_is_companion_installed', false ) ) {
					global $pagenow;
					if ( $pagenow !== "update.php" ) {
						add_action( 'admin_notices', array( __CLASS__, 'plugin_notice' ) );
						add_action( 'admin_head', function () {
							wp_enqueue_style( 'cww-portfolio-customizer-css', get_theme_file_uri('/inc/welcome/assets/css/companion.css') );
						} );
					}
				}
			}
		}

	}

	public static function plugin_notice() {
		?>
        <div class="notice notice-success is-dismissible cww-start-with-front-page-notice ">
            <div class="notice-content-wrapper">
				<?php require_once get_template_directory() . '/inc/welcome/active-notice.php'; ?>
            </div>
        </div>
		<?php
	}

	public static function companion_disable_popup() {
		$option = "cww_welcome_disable_popup";

		$nonce = isset( $_POST['companion_disable_popup_wpnonce'] ) ? $_POST['companion_disable_popup_wpnonce'] : '';

		if ( ! wp_verify_nonce( $nonce, "companion_disable_popup" ) ) {
			die( "wrong nonce" );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( __( 'Sorry, you are not allowed to manage options for this site.', 'cww-portfolio' ) );
		}

		$value = intval( isset( $_POST['value'] ) ? $_POST['value'] : 0 );

		update_option( $option, $value );
	}

	public static function tgma_register() {
		self::$plugin_state = self::get_plugin_state( self::$slug );
	}

	public static function get_plugin_state( $plugin_slug ) {
		$tgmpa     = TGM_Plugin_Activation::get_instance();
		$installed = $tgmpa->is_plugin_installed( $plugin_slug );

		return array(
			'installed' => $installed,
			'active'    => $installed && $tgmpa->is_plugin_active( $plugin_slug ),
		);
	}

	

	public static function get_activate_link( $slug = false ) {
		if ( ! $slug ) {
			$slug = self::$slug;
		}
		$tgmpa = TGM_Plugin_Activation::get_instance();
		$path  = $tgmpa->plugins[ $slug ]['file_path'];

		return add_query_arg( array(
			'action'        => 'activate',
			'plugin'        => rawurlencode( $path ),
			'plugin_status' => 'all',
			'paged'         => '1',
			'_wpnonce'      => wp_create_nonce( 'activate-plugin_' . $path ),
		), network_admin_url( 'plugins.php' ) );
	}

	public static function get_install_link( $slug = false ) {
		if ( ! $slug ) {
			$slug = self::$slug;
		}

		return add_query_arg(
			array(
				'action'   => 'install-plugin',
				'plugin'   => $slug,
				'_wpnonce' => wp_create_nonce( 'install-plugin_' . $slug ),
			),
			network_admin_url( 'update.php' )
		);
	}

	

	// static functions

	public static function init( $config ) {
		CWW_Portfolio_Companion_Plugin::getInstance( $config );
	}

	public static function getInstance( $config ) {
		if ( ! self::$instance ) {
			self::$instance = new CWW_Portfolio_Companion_Plugin( $config );
		}

		return self::$instance;
	}
}
