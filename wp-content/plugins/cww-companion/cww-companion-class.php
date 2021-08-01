<?php
/**
 * Main plugin class 
 * 
 */

if ( !class_exists( 'CWW_Companion' ) ) {

    /**
     * Sets up and initializes the plugin.
     */
    class CWW_Companion {

        /**
         * A reference to an instance of this class.
         *
         * @since  1.0.0
         * @access private
         * @var    object
         */
        private static $instance = null;

        /**
         * Plugin version
         *
         * @var string
         */
        private $version = CWW_COMP_VER;

        /**
         * Returns the instance.
         *
         * @since  1.0.0
         * @access public
         * @return object
         */
        public static function get_instance() {
            // If the single instance hasn't been set, set it now.
            if ( null == self::$instance ) {
                self::$instance = new self;
            }
            return self::$instance;
        }

        /**
         * Sets up needed actions/filters for the plugin to initialize.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function __construct() {

            // Load translation files
            add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

            add_action( 'wp_enqueue_scripts', [ $this, 'cww_companion_view_scripts' ] );
            add_action('admin_enqueue_scripts', [ $this, 'cww_companion_customizer_scripts'] );
        }

        /**
         * Loads the translation files.
         *
         * @since 1.0.0
         * @access public
         * @return void
         */
        public function load_plugin_textdomain() {
        	
            load_plugin_textdomain( 'cww-companion', false, basename( dirname( __FILE__ ) ) . '/languages' );
        }

        /**
         * Returns plugin version
         *
         * @return string
         */
        public function get_version() {
            return $this->version;
        }

       
        /**
         * Frontend styles & scripts
         * 
         * 
         */ 
        function cww_companion_view_scripts(){

            wp_register_style( 'magnific-popup', CWW_COMP_ASS_URL. '/magnific-popup/magnific-popup.css', array(), CWW_COMP_VER );

            wp_register_script( 'jarallax', CWW_COMP_ASS_URL. '/jarallax/jarallax.min.js', array('jquery'), CWW_COMP_VER, true );
            wp_register_script( 'jquery-magnific-popup', CWW_COMP_ASS_URL. '/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), CWW_COMP_VER, true );
            wp_register_script( 'jquery-waypoints', CWW_COMP_ASS_URL.'/waypoints/jquery.waypoints.min.js', array('jquery'), CWW_COMP_VER, true );
            wp_register_script( 'jquery-counterup', CWW_COMP_ASS_URL.'/counter-up/jquery.counterup.min.js', array(), CWW_COMP_VER, true );
        }
    

        /**
        * Admin scripts
        */
        function cww_companion_customizer_scripts(){
        	
        	$current_screen = get_current_screen();
			
			if( $current_screen->base == 'customize' ){
            wp_enqueue_style( 'font-awesome', CWW_COMP_ASS_URL . '/font-awesome/css/font-awesome.min.css', array(), CWW_COMP_VER );
        	}

        }
        

    }

}

if ( !function_exists( 'cww_companion' ) ) {

    /**
     * Returns instanse of the plugin class.
     *
     * @since  1.0.0
     * @return object
     */
    function cww_companion() {
        return CWW_Companion::get_instance();
    }

}

cww_companion();
