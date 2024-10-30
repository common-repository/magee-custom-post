<?php
class Mcp_Post_Slider
{
    function __construct()
    {
        add_action( 'init', array($this,'create_slider') );
		add_filter('manage_edit-mcp_slide_columns', array($this,'edit_columns'));
		add_action('manage_mcp_slide_posts_custom_column',  array($this,'custom_columns'), 10, 2 );

    }
    

    function create_slider()
    {
		
		/*  register post type */
        $labels = array(
            'name' =>  __( 'Slides', 'mcp-custom-post' ),   
            'singular_name' =>  __( 'Slides', 'mcp-custom-post' ),     
            'add_new' =>  __( 'Add Slide', 'mcp-custom-post' ),   
            'add_new_item' => __( 'Add a Slide', 'mcp-custom-post' ),   
            'edit_item' => __( 'Edit Slide', 'mcp-custom-post' ),   
            'new_item' => __( 'New Slide', 'mcp-custom-post' ),    
            'not_found' =>  __( 'Slide not found.', 'mcp-custom-post' ),   
            'parent_item_colon' => '',  
            'menu_name' => __( 'Slides', 'mcp-custom-post' ),   
            'menu_position' => 6
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
			'menu_icon'=> 'dashicons-format-gallery',
            'supports' => array('title','editor'),
        );

        register_post_type( 'mcp_slide', $args);
		
		/*  register taxonomy */
		$category_labels = array(
		  'name'              => __( 'Slider', 'mcp-custom-post' ),
		  'singular_name'     => __( 'Slider', 'mcp-custom-post' ),
		  'search_items'      => __( 'Search Slider', 'mcp-custom-post' ),
		  'all_items'         => __( 'All Slider', 'mcp-custom-post' ),
		  'edit_item'         => __( 'Edit Slider', 'mcp-custom-post' ),
		  'update_item'       => __( 'Update Slider', 'mcp-custom-post' ),
		  'add_new_item'      => __( 'Add New Slider', 'mcp-custom-post' ),
		  'new_item_name'     => __( 'New Slider', 'mcp-custom-post' ),
		  'menu_name'         => __( 'Slider', 'mcp-custom-post' ),
		);
		
	    $args = array(
            'labels' => $category_labels,
            'hierarchical' => true,
       );
		
       register_taxonomy( 'mcp_slider', 'mcp_slide', $args );

    }
	
	
	function edit_columns($columns){
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title",'mcp-custom-post'),
		"mcp_slider" => __("Slider",'mcp-custom-post'),
		"date" => __("Date",'mcp-custom-post'),
	  );
	 
	  return $columns;
	}
	
	function custom_columns($column, $post_id ){
		global $post;
		
		switch ($column) {
			case 'mcp_slider' :
			$terms = get_the_term_list( $post_id , 'mcp_slider' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo strip_tags($terms);
            else
                _e( 'Unable to get slider', 'mcp-custom-post' );
            break;
		}
	}
    
    
}


new Mcp_Post_Slider;
