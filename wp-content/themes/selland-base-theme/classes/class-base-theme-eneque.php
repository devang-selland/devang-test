<?php
/**
 * ACF Custom functions for this theme.
 *
 * @package WordPress
 * @subpackage Base_Theme
 * @since Base Theme 1.0
*/

if ( ! class_exists( 'Base_Theme_Eneque' ) ) {

    /**
	 * ACF Custom Theme Functions
	 */
	class Base_Theme_Eneque {

        public function __construct() {

            // Register theme style CSS
            add_action( 'wp_enqueue_scripts', array( $this, 'base_theme_register_styles' ) );   
            
            //Register gutenber admin css
            add_action( 'enqueue_block_editor_assets', array( $this, 'base_theme_register_admin_styles' ) );   
    
        }  
        
        /**
         * Register Theme style CSS
         *
         */
        public function base_theme_register_styles() {
           
            // Enqueue CSS Files
            $cssfiles = array(
                'base-theme-style'        => '/style.css',
                'base-theme-main'       => '/assets/css/base-theme-main.css',

            );

            foreach($cssfiles as $cssfilekey=>$cssfilevalue){
                wp_enqueue_style( $cssfilekey, get_template_directory_uri() . $cssfilevalue );
            }
            wp_style_add_data( 'base-theme-style', 'rtl', 'replace' );
            // Enqueue JS Files
            $jsfiles = array(
                'base-theme-navigation'        => '/assets/js/navigation.js',
            );

            foreach($jsfiles as $jsfilekey=>$jsfilevalue){
                wp_enqueue_script( $jsfilekey, get_template_directory_uri() . $jsfilevalue , array( 'jquery' ), '', true );
            }

            // Localize the script with new data
            // $translation_array = array(
            //         'ajax_url' => admin_url( 'admin-ajax.php' ),
            // );
            // wp_localize_script( 'general-js', 'ajax_variable', $translation_array );

            if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

        }

        /**
         * Register Options Page
         *
         */
        public function base_theme_register_admin_styles() {

            // Make path a variable so we don't write it twice ;)
            $blockPath = '/assets/css/base-theme-editor-styles.css';

            // Enqueue block editor styles
            wp_enqueue_style(
                'base-theme-editor-css',
                get_theme_file_uri( $blockPath ),
            );

        }

    }
    
}
new Base_Theme_Eneque();