<?php
/**
 * ACF Custom functions for this theme.
 *
 * @package WordPress
 * @subpackage Base_Theme
 * @since Base Theme 1.0
*/
if ( ! class_exists( 'acf' ) ) {
    
    /**
	 * ACF Custom Theme Functions to check ACF present of missing
	 */
	class Base_Theme_ACF_Fields_Sync {

        
        public function __construct() {

           add_filter( 'acf/settings/save_json',array( $this, 'base_theme_save_json_filter') );
           add_filter( 'acf/settings/load_json',array( $this, 'base_theme_load_json_filter') );
       
        }  
        
        
        /**
         * save a json when the group is validate in admin
        */
        public function base_theme_save_json_filter(){
            var_dump('ff'); exit;

            $path = get_stylesheet_directory() . '/acf-json';
            var_dump($path); exit;
            return $path;
        }

        /**
         * this function alerts about avalaibles sync
        */
        public function base_theme_load_json_filter(){
            // remove original path (optional)
            unset($paths[0]);
            
            
            // append path
            $paths[] = get_stylesheet_directory() . '/acf-json';
            
            
            // return
            return $paths;
        }


    }
    new Base_Theme_ACF_Fields_Sync();
}
