<?php
class Mcp_Post_Portfolio
{
    function __construct()
    {
        add_action( 'init', array($this,'create_portfolio') );
		add_filter('manage_edit-mcp_portfolio_columns', array($this,'edit_columns'));
		add_action('manage_mcp_portfolio_posts_custom_column',  array($this,'custom_columns'), 10, 2 );

    }
    

    function create_portfolio()
    {
		
		/*  register post type */
        $labels = array(
            'name' =>  __( 'Portfolios', 'mcp-custom-post' ),   
            'singular_name' =>  __( 'Portfolios', 'mcp-custom-post' ),     
            'add_new' =>  __( 'Add Portfolio', 'mcp-custom-post' ),   
            'add_new_item' => __( 'Add a Portfolio', 'mcp-custom-post' ),   
            'edit_item' => __( 'Edit Portfolio', 'mcp-custom-post' ),   
            'new_item' => __( 'New Portfolio', 'mcp-custom-post' ),    
            'not_found' =>  __( 'Portfolio not found.', 'mcp-custom-post' ),   
            'parent_item_colon' => '',  
            'menu_name' => __( 'Portfolios', 'mcp-custom-post' ),   
            'menu_position' => 6
        );   
        $args = array(   
            'labels' => $labels,
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'has_archive' => false,
            'hierarchical' => false,
			'menu_icon'=> 'dashicons-portfolio',
            'supports' => array('title','editor','excerpt','page-attributes')
        );

        register_post_type( 'mcp_portfolio', $args);
		
		/*  register taxonomy */
		$category_labels = array(
		  'name'              => __( 'Portfolio Categories', 'mcp-custom-post' ),
		  'singular_name'     => __( 'Portfolio Categories', 'mcp-custom-post' ),
		  'search_items'      => __( 'Search Portfolio Category', 'mcp-custom-post' ),
		  'all_items'         => __( 'All Portfolios', 'mcp-custom-post' ),
		  'edit_item'         => __( 'Edit Portfolio Category', 'mcp-custom-post' ),
		  'update_item'       => __( 'Update Portfolio Category', 'mcp-custom-post' ),
		  'add_new_item'      => __( 'Add New Portfolio Category', 'mcp-custom-post' ),
		  'new_item_name'     => __( 'New Portfolio Category', 'mcp-custom-post' ),
		  'menu_name'         => __( 'Categories', 'mcp-custom-post' ),
		);
		
	    $args = array(
            'labels' => $category_labels,
            'hierarchical' => true,
       );
		
       register_taxonomy( 'mcp_portfolio_category', 'mcp_portfolio', $args );

    }
	
	
	function edit_columns($columns){
	  $columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __("Title",'mcp-custom-post'),
		"mcp_portfolio_category" => __("Category",'mcp-custom-post'),
		"date" => __("Date",'mcp-custom-post'),
	  );
	 
	  return $columns;
	}
	
	function custom_columns($column, $post_id ){
		global $post;
		
		switch ($column) {
			case 'mcp_portfolio_category' :
			$terms = get_the_term_list( $post_id , 'mcp_portfolio_category' , '' , ',' , '' );
            if ( is_string( $terms ) )
                echo strip_tags($terms);
            else
                _e( 'Unable to get portfolio category.', 'mcp-custom-post' );
            break;
		}
	}
    
    
}


new Mcp_Post_Portfolio;
