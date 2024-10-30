<?php
class Mcp_Post_Testimonial
{
    function __construct()
    {
        add_action( 'init', array($this,'create_testimonial') );
		add_filter('manage_edit-mcp_testimonial_columns', array($this,'edit_columns'));
		add_action('manage_mcp_testimonial_posts_custom_column',  array($this,'custom_columns'), 10, 2 );

    }
    

    function create_testimonial()
    {
		
		/*  register post type */
        $labels = array(
            'name' =>  __( 'Testimonials', 'mcp-custom-post' ),   
            'singular_name' =>  __( 'Testimonials', 'mcp-custom-post' ),     
            'add_new' =>  __( 'Add Testimonial', 'mcp-custom-post' ),   
            'add_new_item' => __( 'Add a Testimonial', 'mcp-custom-post' ),   
            'edit_item' => __( 'Edit Testimonial', 'mcp-custom-post' ),   
            'new_item' => __( 'New Testimonial', 'mcp-custom-post' ),    
            'not_found' =>  __( 'Testimonial not found.', 'mcp-custom-post' ),   
            'parent_item_colon' => '',  
            'menu_name' => __( 'Testimonials', 'mcp-custom-post' ),   
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
			'menu_icon'=> 'dashicons-format-chat',
            'supports' => array('title','editor'),
        );

        register_post_type( 'mcp_testimonial', $args);
		
		/*  register taxonomy */
		$category_labels = array(
		  'name'              => __( 'Testimonial Groups', 'mcp-custom-post' ),
		  'singular_name'     => __( 'Testimonial Groups', 'mcp-custom-post' ),
		  'search_items'      => __( 'Search Testimonial Group', 'mcp-custom-post' ),
		  'all_items'         => __( 'All Testimonials', 'mcp-custom-post' ),
		  'edit_item'         => __( 'Edit Testimonial Group', 'mcp-custom-post' ),
		  'update_item'       => __( 'Update Testimonial Group', 'mcp-custom-post' ),
		  'add_new_item'      => __( 'Add New Testimonial Group', 'mcp-custom-post' ),
		  'new_item_name'     => __( 'New Testimonial Group', 'mcp-custom-post' ),
		  'menu_name'         => __( 'Groups', 'mcp-custom-post' ),
		);
		
	    $args = array(
            'labels' => $category_labels,
            'hierarchical' => true,
       );
		
       register_taxonomy( 'mcp_testimonial_group', 'mcp_testimonial', $args );

    }
	
	
	function edit_columns($columns){
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title",'mcp-custom-post'),
		"mcp_testimonial_group" => __("Group",'mcp-custom-post'),
		"date" => __("Date",'mcp-custom-post'),
	  );
	 
	  return $columns;
	}
	
	function custom_columns($column, $post_id ){
		global $post;
		
		switch ($column) {
			case 'mcp_testimonial_group' :
			$terms = get_the_term_list( $post_id , 'mcp_testimonial_group' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo strip_tags($terms);
            else
                _e( 'Unable to get testimonial group(s)', 'mcp-custom-post' );
            break;
		}
	}
    
    
}


new Mcp_Post_Testimonial;
