<?php
class Mcp_Post_Client
{
    function __construct()
    {
        add_action( 'init', array($this,'create_client') );
		add_filter('manage_edit-mcp_client_columns', array($this,'edit_columns'));
		add_action('manage_mcp_client_posts_custom_column',  array($this,'custom_columns'), 10, 2 );

    }
    

    function create_client()
    {
		
		/*  register post type */
        $labels = array(
            'name' =>  __( 'Clients', 'mcp-custom-post' ),   
            'singular_name' =>  __( 'Clients', 'mcp-custom-post' ),     
            'add_new' =>  __( 'Add Client', 'mcp-custom-post' ),   
            'add_new_item' => __( 'Add a Client', 'mcp-custom-post' ),   
            'edit_item' => __( 'Edit Client', 'mcp-custom-post' ),   
            'new_item' => __( 'New Client', 'mcp-custom-post' ),    
            'not_found' =>  __( 'Client not found.', 'mcp-custom-post' ),   
            'parent_item_colon' => '',  
            'menu_name' => __( 'Clients', 'mcp-custom-post' ),   
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
			'menu_icon'=> 'dashicons-businessman',
            'supports' => array('title'),
        );

        register_post_type( 'mcp_client', $args);
		
		/*  register taxonomy */
		$category_labels = array(
		  'name'              => __( 'Client Groups', 'mcp-custom-post' ),
		  'singular_name'     => __( 'Client Groups', 'mcp-custom-post' ),
		  'search_items'      => __( 'Search Client Group', 'mcp-custom-post' ),
		  'all_items'         => __( 'All Clients', 'mcp-custom-post' ),
		  'edit_item'         => __( 'Edit Client Group', 'mcp-custom-post' ),
		  'update_item'       => __( 'Update Client Group', 'mcp-custom-post' ),
		  'add_new_item'      => __( 'Add New Client Group', 'mcp-custom-post' ),
		  'new_item_name'     => __( 'New Client Group', 'mcp-custom-post' ),
		  'menu_name'         => __( 'Groups', 'mcp-custom-post' ),
		);
		
	    $args = array(
            'labels' => $category_labels,
            'hierarchical' => true,
       );
		
       register_taxonomy( 'mcp_client_group', 'mcp_client', $args );

    }
	
	
	function edit_columns($columns){
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title",'mcp-custom-post'),
		"mcp_client_group" => __("Group",'mcp-custom-post'),
		"date" => __("Date",'mcp-custom-post'),
	  );
	 
	  return $columns;
	}
	
	function custom_columns($column, $post_id ){
		global $post;
		
		switch ($column) {
			case 'mcp_client_group' :
			$terms = get_the_term_list( $post_id , 'mcp_client_group' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo strip_tags($terms);
            else
                _e( 'Unable to get client group(s)', 'mcp-custom-post' );
            break;
		}
	}
    
    
}


new Mcp_Post_Client;
