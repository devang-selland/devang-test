<?php
/**
 * Register a Custom Post type Module.
 *
 * @package Base_Theme
 * @subpackage Base_Theme
 * @since Base Theme 1.0
*/
// Enable module / Disable Module theme option field
if ( ! class_exists( 'Base_Theme_ACF_Custom_Post_Type_Module' ) ) {
    class Base_Theme_ACF_Custom_Post_Type_Module{

        private $text_doamin = 'base_theme';

        /* Class constructor */
        public function __construct()
        {
            add_action( 'init', array( $this, 'base_theme_register_post_type' ) );
            add_action( 'init',array( $this,'base_theme_add_taxonomy') );		
        }

        public function base_theme_custom_get_post_types() {
            $custom_post_types_arr = array();
        
            // $custom_post_types_arr[] = array(
            // 'singular'           => 'POSTTYPE_SINGULAR_NAME',
            // 'plural'             => 'POSTTYPE_PLURAL_NAME',
            // 'slug'               => 'POSTTYPE_SLUG', 
            // 'publicly_queryable' => false,  
            // 'supports'           => array( 'title', 'thumbnail' ),
            // 'has_archive'        => false    
            // );

            
            return $custom_post_types_arr;
        }
        
        public function base_theme_custom_get_category_types() {
            $category_types_arr = array();
        
            // $category_types_arr[] = array(
            // 'singular'  => 'Taxonomy Singlar',
            // 'plural'    => 'Taxonomy Plural',
            // 'slug'      => 'taxonomy-name',
            // 'post_type' => 'posttypename',      
            // );   
        
            return $category_types_arr;
        }  

        /* ACF Theme option custom post type register function */
        public function base_theme_register_post_type() {

            $posttypes = $this->base_theme_custom_get_post_types();
            
            if( $posttypes ):
            
                // loop through the rows of data
                foreach( $posttypes as $posttype ):
                    //Capitilize the words and make it plural
                    $post_type_name = $posttype['post_type_name'];
                    $allow_single_post_view = $posttype['publicly_queryable'];
                    $has_archive = $posttype['has_archive'];
                    $name       = $posttype['singular'];
                    $plural     = $posttype['plural'];	
                    $slug       = $posttype['slug'];	
                    $no_found = 'No '.strtolower( $plural ).' found';
                    $not_found_in_trash =  'No '.strtolower( $plural ). ' found in Trash';
                    
                    $labels = array_merge(
                        // Default
                        array(
                            'name'                  => _x( $plural , 'post type general name', $this->text_doamin ),
                            'singular_name'         => _x( $name, 'post type singular name', $this->text_doamin ),
                            'add_new'               => _x( 'Add New', strtolower( $name ), $this->text_doamin ),
                            'add_new_item'          => __( 'Add New ' . $name, $this->text_doamin ),
                            'edit_item'             => __( 'Edit ' . $name, $this->text_doamin ),
                            'new_item'              => __( 'New ' . $name, $this->text_doamin ),
                            'all_items'             => __( 'All ' . $plural, $this->text_doamin ),
                            'view_item'             => __( 'View ' . $name, $this->text_doamin ),
                            'search_items'          => __( 'Search ' . $plural, $this->text_doamin ),
                            'not_found'             => __( $no_found, $this->text_doamin),
                            'not_found_in_trash'    => __( $not_found_in_trash, $this->text_doamin), 
                            'parent_item_colon'     => '',
                            'menu_name'             => $plural
                        ),
                    );
                    
                    // Same principle as the labels. We set some defaults and overwrite them with the given arguments.
                    $args = array_merge(		 
                        // Default
                        array(
                            'label'                 => $plural,
                            'labels'                => $labels,
                            'public'                => true,
                            'show_ui'               => true,
                            'show_in_nav_menus'     => true,
                            'menu_icon'				=> $menu_icon
                        ),						 
                    );
                    $args['supports'] = $posttype['supports'];
                    $args['publicly_queryable'] = $allow_single_post_view;
                    $args['has_archive'] = $has_archive;
                    
                    register_post_type( $slug, $args );

                endforeach;

            endif;
        }
        /* ACF Theme option custom taxonomy array function */
        public function base_theme_add_taxonomy() {
            
            $custom_taxonomies = $this->base_theme_custom_get_category_types();
            // check if the repeater field has rows of data           
                        
            if( $custom_taxonomies ):

                foreach( $custom_taxonomies as $custom_taxonomy ):

                    // Taxonomy properties
                    $taxonomy_slug = $custom_taxonomy['slug'];
                    
                    //Capitilize the words and make it plural
                    $taxonomy_name = $custom_taxonomy['singular'];
                    $taxonomy_plural = $custom_taxonomy['plural'];
                    $taxonomy_post_type = $custom_taxonomy['post_type'];

                    // Default labels, overwrite them with the given labels.
                    $taxonomy_labels = array(
                        'name'                  => _x( $taxonomy_plural, 'taxonomy general name', $this->text_doamin ),
                        'singular_name'         => _x( $taxonomy_name, 'taxonomy singular name', $this->text_doamin ),
                        'search_items'          => __( 'Search ' . $taxonomy_plural, $this->text_doamin ),
                        'all_items'             => __( 'All ' . $taxonomy_plural, $this->text_doamin ),
                        'parent_item'           => __( 'Parent ' . $taxonomy_name, $this->text_doamin ),
                        'parent_item_colon'     => __( 'Parent ' . $taxonomy_name, $this->text_doamin ),
                        'edit_item'             => __( 'Edit ' . $taxonomy_name, $this->text_doamin ),
                        'update_item'           => __( 'Update ' . $taxonomy_name, $this->text_doamin ),
                        'add_new_item'          => __( 'Add New ' . $taxonomy_name, $this->text_doamin ),
                        'new_item_name'         => __( 'New ' . $taxonomy_name, $this->text_doamin ),
                        'menu_name'             => __( $taxonomy_name, $this->text_doamin ),
                    );
                    
                    // Default arguments, overwritten with the given arguments
                    $taxonomy_args = array_merge(							
                        // Default
                        array(
                            'labels'                 => $taxonomy_labels,
                            'hierarchical'          => true,																		
                            'show_ui'               => true,
                            'show_in_nav_menus'     => true,
                            'show_admin_column' 	=> true,
                            'query_var'             => true,
                            'rewrite'               => array( 'slug' => $taxonomy_slug ),
                        ),
                    
                    );
                    
                    register_taxonomy( $taxonomy_slug, $taxonomy_post_type, $taxonomy_args );

                endforeach;

            endif;                   

        }  
    
    }
}
new Base_Theme_ACF_Custom_Post_Type_Module();