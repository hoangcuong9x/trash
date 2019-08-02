<?php

if( ! class_exists( 'GSPlugins_wps' ) ){
    
    class GSPlugins_wps{
        
        /**
         * Singleton Instance
         *
         * @access private static
         */
        private static $_instance;
        
        public function __construct() {
            add_action( 'admin_menu', array( $this, 'gs_main_menu' ) );
        }
        
        /**
         * Get class singleton instance
         *
         * @return Class Instance
         */
        public static function get_instance() {
            if ( ! self::$_instance instanceof GSPlugins_wps ) {
                self::$_instance = new GSPlugins_wps();
            }
            
            return self::$_instance;
        }
        
        
        public function gs_main_menu() {
            add_menu_page(
                __( 'GS Plugins', 'gswps' ),
                __( 'GS Plugins', 'gswps' ),
                'manage_options',
                'gsp-main',
                array( $this, 'gs_main_menu_cb' ),
                '',
                GSWPS_MENU_POSITION
            );
        }
        
        public function gs_main_menu_cb() {
            $protocol = is_ssl() ? 'https' : 'http';
            $promo_content = wp_remote_get( $protocol . '://www.gsamdani.com/gs_plugins_list/index.php' );
            echo $promo_content['body'];
        }
        
    }
    
    $tmev = GSPlugins_wps::get_instance();
    
}