<?php
class Mcp_Post_Team
{
    function __construct()
    {
        add_action( 'init', array($this,'create_team') );
		add_filter('manage_edit-mcp_team_columns', array($this,'edit_columns'));
		add_action('manage_mcp_team_posts_custom_column',  array($this,'custom_columns'), 10, 2 );

    }
    

    function create_team()
    {
		
		/*  register post type */
        $labels = array(
            'name' =>  __( 'Team', 'mcp-custom-post' ),   
            'singular_name' =>  __( 'Team', 'mcp-custom-post' ),     
            'add_new' =>  __( 'Add Member', 'mcp-custom-post' ),   
            'add_new_item' => __( 'Add a Member', 'mcp-custom-post' ),   
            'edit_item' => __( 'Edit Member', 'mcp-custom-post' ),   
            'new_item' => __( 'New Member', 'mcp-custom-post' ),    
            'not_found' =>  __( 'Member not found.', 'mcp-custom-post' ),   
            'parent_item_colon' => '',  
            'menu_name' => __( 'Team', 'mcp-custom-post' ),   
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
			'menu_icon'=> 'dashicons-groups',
            'supports' => array('title','editor'),
        );

        register_post_type( 'mcp_team', $args);
		
		/*  register taxonomy */
		$category_labels = array(
		  'name'              => __( 'Categories', 'mcp-custom-post' ),
		  'singular_name'     => __( 'Categories', 'mcp-custom-post' ),
		  'search_items'      => __( 'Search Category', 'mcp-custom-post' ),
		  'all_items'         => __( 'All Categories', 'mcp-custom-post' ),
		  'edit_item'         => __( 'Edit Category', 'mcp-custom-post' ),
		  'update_item'       => __( 'Update Category', 'mcp-custom-post' ),
		  'add_new_item'      => __( 'Add New Category', 'mcp-custom-post' ),
		  'new_item_name'     => __( 'New Category', 'mcp-custom-post' ),
		  'menu_name'         => __( 'Categories', 'mcp-custom-post' ),
		);
		
	    $args = array(
            'labels' => $category_labels,
            'hierarchical' => true,
       );
		
       register_taxonomy( 'mcp_team_group', 'mcp_team', $args );

    }
	
	
	function edit_columns($columns){
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title",'mcp-custom-post'),
		"mcp_team_group" => __("Categories",'mcp-custom-post'),
		"date" => __("Date",'mcp-custom-post'),
	  );
	 
	  return $columns;
	}
	
	function custom_columns($column, $post_id ){
		global $post;
		
		switch ($column) {
			case 'mcp_team_group' :
			$terms = get_the_term_list( $post_id , 'mcp_team_group' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo strip_tags($terms);
            else
                _e( 'Unable to get team group(s)', 'mcp-custom-post' );
            break;
		}
	}
    
    
}


new Mcp_Post_Team;
