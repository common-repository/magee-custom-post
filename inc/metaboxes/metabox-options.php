<?php

 
add_filter( 'mcp_meta_boxes', 'mcp_feature_metaboxes' );

function mcp_feature_metaboxes( array $meta_boxes ) {

	$prefix = '_mcp_';
	$meta_boxes['feature_metabox'] = array(
		'id'         => 'feature_metabox',
		'title'      => __( 'Feature Metabox', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_feature', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'mcp_styles' => true, // Enqueue the MCP stylesheet on the frontend
		'fields'     => array(

			array(
				'name' => __( 'Icon', 'mcp-custom-post' ),
				'desc' => __( 'field description (optional)', 'mcp-custom-post' ),
				'id'   => $prefix . 'feature_icon',
				'type' => 'icon_picker',
				'default' =>'fa-archive'
				// 'repeatable' => true,
			),
			array(
				'name' => __( 'Image Icon', 'mcp-custom-post' ),
				'desc' => __( 'Upload an image icon.', 'mcp-custom-post' ),
				'id'   => $prefix . 'feature_image_icon',
				'type' => 'file',
			),

			array(
				'name'    => __( 'Icon Color', 'mcp-custom-post' ),
				'desc'    => '',
				'id'      => $prefix . 'feature_icon_color',
				'type'    => 'colorpicker',
				'default' => '#26b9a3'
			),
			array(
				'name'    => __( 'Title Link', 'mcp-custom-post' ),
				'desc'    => '',
				'id'      => $prefix . 'feature_link',
				'type'    => 'text',
				'default' => ''
			),
			array(
						'name' => __( 'Target', 'mcp-custom-post' ),
						'id'   => $prefix . 'feature_target',
						'type'    => 'select',
						'options' => array(
							'_blank' => __( 'Blank', 'mcp-custom-post' ),
							'_self'   => __( 'Self', 'mcp-custom-post' ),
						),

		),
			),
	);
	
	$meta_boxes['testimonial_metabox'] = array(
		'id'         => 'testimonial_metabox',
		'title'      => __( 'Testimonial Metabox', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_testimonial', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'mcp_styles' => true, // Enqueue the MCP stylesheet on the frontend
		'fields'     => array(
							  
			array(
				'name' => __( 'Byline', 'mcp-custom-post' ),
				'desc' => '',
				'id'   => $prefix . 'testimonial_byline',
				'type' => 'text_small',
				'default' =>''
				// 'repeatable' => true,
			),

			array(
				'name' => __( 'Avatar', 'mcp-custom-post' ),
				'desc' => __( 'Upload avatar.', 'mcp-custom-post' ),
				'id'   => $prefix . 'testimonial_avatar',
				'type' => 'file',
			),
		),
	);
	
	
	$meta_boxes['team_metabox'] = array(
		'id'         => 'team_metabox',
		'title'      => __( 'Team Metabox', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_team', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'mcp_styles' => true, // Enqueue the MCP stylesheet on the frontend
		'fields'     => array(
			
			array(
				'name' => __( 'Avatar', 'mcp-custom-post' ),
				'desc' => __( 'Upload avatar.', 'mcp-custom-post' ),
				'id'   => $prefix . 'team_avatar',
				'type' => 'file',
			),
			
			array(
				'name' => __( 'Byline', 'mcp-custom-post' ),
				'desc' => '',
				'id'   => $prefix . 'team_byline',
				'type' => 'text_small',
				'default' =>''
				// 'repeatable' => true,
			),

		),
	);
	
	/**
	 * Repeatable Field Groups
	 */
	$meta_boxes['team_social_icon'] = array(
		'id'         => 'team_social_icon',
		'title'      => __( 'Social Icons', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_team', ),
		'fields'     => array(
			array(
				'id'          => $prefix . 'social_icons',
				'type'        => 'group',
				'description' => __( 'Generates reusable form icons', 'mcp-custom-post' ),
				'options'     => array(
					'group_title'   => __( 'Icon {#}', 'mcp-custom-post' ), // {#} gets replaced by row number
					'add_button'    => __( 'Add Another Icon', 'mcp-custom-post' ),
					'remove_button' => __( 'Remove Icon', 'mcp-custom-post' ),
					'sortable'      => true, // beta
				),
				// Fields array works the same, except id's only need to be unique for this group. Prefix is not needed.
				'fields'      => array(
					array(
						'name' => 'Icon',
						'id'   => 'icon',
						'type' => 'icon_picker',
						'default' => 'fa-facebook'
				
					),
					array(
						'name' => __( 'Link', 'mcp-custom-post' ),
						'id'   => 'link',
						'type' => 'text',
					),
					array(
						'name' => 'Target',
						'id'   => 'target',
						'type'    => 'select',
						'options' => array(
							'_blank' => __( 'Blank', 'mcp-custom-post' ),
							'_self'   => __( 'Self', 'mcp-custom-post' ),
						),
					),
				),
			),
		),
	);
	
	
	$meta_boxes['client_metabox'] = array(
		'id'         => 'client_metabox',
		'title'      => __( 'Client Metabox', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_client', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'mcp_styles' => true, // Enqueue the MCP stylesheet on the frontend
		'fields'     => array(
			
			array(
				'name' => __( 'Logo', 'mcp-custom-post' ),
				'desc' => __( 'Upload logo.', 'mcp-custom-post' ),
				'id'   => $prefix . 'client_logo',
				'type' => 'file',
			),

		),
	);
	
	$meta_boxes['portfolio_metabox'] = array(
		'id'         => 'portfolio_metabox',
		'title'      => __( 'Portfolio Metabox', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		// 'mcp_styles' => true, // Enqueue the MCP stylesheet on the frontend
		'fields'     => array(
			array(
				'name' => __( 'Featured Image', 'mcp-custom-post' ),
				'desc' => __( 'Upload image.', 'mcp-custom-post' ),
				'id'   => $prefix . 'featured_image',
				'type' => 'file',
			),
			array(
				'name' => __( 'Target', 'mcp-custom-post' ),
				'desc' => '',
				'id'   => $prefix . 'portfolio_target',
				'type' => 'select',
				'options' => array(
							'_blank' => __( 'Blank', 'mcp-custom-post' ),
							'_self'   => __( 'Self', 'mcp-custom-post' ),
						),
			),

		),
	);
	
	
	$meta_boxes['slide_metabox'] = array(
		'id'         => 'slide_metabox',
		'title'      => __( 'Slide Metabox', 'mcp-custom-post' ),
		'pages'      => array( 'mcp_slide', ), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			
			array(
				'name' => __( 'Slide Image', 'mcp-custom-post' ),
				'desc' => __( 'Upload image.', 'mcp-custom-post' ),
				'id'   => $prefix . 'slide_image',
				'type' => 'file',
			),
			array(
						'name' => __( 'Left Button Text', 'mcp-custom-post' ),
						'id'   => $prefix . 'left_btn_text',
						'type' => 'text',
						'default' => 'ALL FEATURES'
					),
			array(
						'name' => __( 'Left Button Link', 'mcp-custom-post' ),
						'id'   => $prefix . 'left_btn_link',
						'type' => 'text',
						'default' => '#'
					),
			array(
						'name' => __( 'Link Target', 'mcp-custom-post' ),
						'id'   => $prefix . 'left_btn_target',
						'type' => 'select',
						'options' => array(
							'_blank' => __( 'Blank', 'mcp-custom-post' ),
							'_self'   => __( 'Self', 'mcp-custom-post' ),
						),
						'default' => '_self'
					),
			array(
						'name' => __( 'Right Button Text', 'mcp-custom-post' ),
						'id'   => $prefix . 'right_btn_text',
						'type' => 'text',
						'default' => 'BUY NOW'
					),
			array(
						'name' => __( 'Right Button Link', 'mcp-custom-post' ),
						'id'   => $prefix . 'right_btn_link',
						'type' => 'text',
						'default' => '#'
					),
			array(
						'name' => __( 'Link Target', 'mcp-custom-post' ),
						'id'   => $prefix . 'right_btn_target',
						'type' => 'select',
						'options' => array(
							'_blank' => __( 'Blank', 'mcp-custom-post' ),
							'_self'   => __( 'Self', 'mcp-custom-post' ),
						),
						'default' => '_self'
					),

		),
	);

	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'mcp_initialize_mcp_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function mcp_initialize_mcp_meta_boxes() {

	if ( ! class_exists( 'Mcp_Meta_Box' ) )
		require_once 'init.php';

}
