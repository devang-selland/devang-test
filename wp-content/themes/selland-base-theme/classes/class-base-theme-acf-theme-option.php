<?php
/**
 * ACF Custom functions for this theme.
 *
 * @package WordPress
 * @subpackage Base_Theme
 * @since Base Theme 1.0
*/

if ( ! class_exists( 'Base_Theme_ACF_Theme_Option' ) ) {

    /**
	 * ACF Custom Theme Functions
	 */
	class Base_Theme_ACF_Theme_Option {

        public function __construct() {

            // Register options page
            add_action( 'init', array( $this, 'base_theme_register_options_page' ) );           
    
        }  
        
        /**
         * Register Options Page
         *
         */
        public function base_theme_register_options_page() {
            if( function_exists('acf_add_options_page') ) {
                acf_add_options_page(array(
                    'page_title' 	=> 'Theme Option',
                    'menu_title'	=> 'Theme Option',
                    'menu_slug' 	=> 'theme-option',
                    'capability'	=> 'edit_posts'
                ));
                acf_add_options_page(array(
                    'page_title'  => 'Theme Option',
                    'menu_title' => 'Theme Option',
                    'menu_slug'  => 'general-settings',
                    'parent_slug' => 'theme-option',
                    'redirect'  => false
                ));
            }
        }

    }
    
}
new Base_Theme_ACF_Theme_Option();