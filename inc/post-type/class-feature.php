<?php
class Mcp_Post_Feature
{
    function __construct()
    {
        add_action( 'init', array($this,'create_feature') );
        add_filter('manage_edit-mcp_feature_columns', array($this,'edit_columns'));
		add_action('manage_mcp_feature_posts_custom_column',  array($this,'custom_columns'), 10, 2 );
    }
    

    function create_feature()
    {
		
		/*  register post type */
        $labels = array(
            'name' =>  __( 'Features', 'mcp-custom-post' ),   
            'singular_name' =>  __( 'Features', 'mcp-custom-post' ),     
            'add_new' =>  __( 'Add Feature', 'mcp-custom-post' ),   
            'add_new_item' => __( 'Add a Feature', 'mcp-custom-post' ),   
            'edit_item' => __( 'Edit Feature', 'mcp-custom-post' ),   
            'new_item' => __( 'New Feature', 'mcp-custom-post' ),    
            'not_found' =>  __( 'Feature not found.', 'mcp-custom-post' ),   
            'parent_item_colon' => '',  
            'menu_name' => __( 'Features', 'mcp-custom-post' ),   
            'menu_position' => 5
        );   
        $args = array(   
            'labels' => $labels,
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
			'menu_icon'=> 'dashicons-star-filled',
            'supports' => array('title','editor'),
        );

        register_post_type( 'mcp_feature', $args);
		
		/*  register taxonomy */
		$category_labels = array(
		  'name'              => __( 'Feature Groups', 'mcp-custom-post' ),
		  'singular_name'     => __( 'Feature Groups', 'mcp-custom-post' ),
		  'search_items'      => __( 'Search Feature Group', 'mcp-custom-post' ),
		  'all_items'         => __( 'All Features', 'mcp-custom-post' ),
		  'edit_item'         => __( 'Edit Feature Group', 'mcp-custom-post' ),
		  'update_item'       => __( 'Update Feature Group', 'mcp-custom-post' ),
		  'add_new_item'      => __( 'Add New Feature Group', 'mcp-custom-post' ),
		  'new_item_name'     => __( 'New Feature Group', 'mcp-custom-post' ),
		  'menu_name'         => __( 'Groups', 'mcp-custom-post' ),
		);
		
	    $args = array(
            'labels' => $category_labels,
            'hierarchical' => true,
       );
		
       register_taxonomy( 'mcp_feature_group', 'mcp_feature', $args );

    }
	
	function edit_columns($columns){
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title",'mcp-custom-post'),
		"mcp_feature_group" => __("Group",'mcp-custom-post'),
		"date" => __("Date",'mcp-custom-post'),
	  );
	 
	  return $columns;
	}
	
	function custom_columns($column, $post_id ){
		global $post;
		
		switch ($column) {
			case 'mcp_feature_group' :
			$terms = get_the_term_list( $post_id , 'mcp_feature_group' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo strip_tags($terms);
            else
                _e( 'Unable to get feature group(s)', 'mcp-custom-post' );
            break;
		}
	}
	
    
    
}
	
	

new Mcp_Post_Feature;
