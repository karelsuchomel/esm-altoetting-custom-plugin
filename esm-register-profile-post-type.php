<?php
// create custom post type for profiles. ( featured image, name, description )
function esm_register_post_type_contact() 
{
	$singular = "Profile";
	$plural = "Profiles";

	$labels = array(
		'name' 								=> $plural,
		'singular_name' 			=> $singular,
		'add_name'						=> 'Add new',
		'add_new_item' 				=> 'Add new ' . $singular,
		'edit' 								=> 'Edit',
		'edit_item' 					=> 'Edit ' . $singular,
		'new_item' 						=> 'New ' . $singular,
		'view' 								=> 'View ' . $singular,
		'view_item' 					=> 'View ' . $singular,
		'search_term' 				=> 'Search ' . $plural,
		'parent' 							=> 'Parent ' . $singular,
		'not_found' 					=> 'No ' . $plural . ' found',
		'not_found_in_trash' 	=> 'No ' . $plural . ' found in the trash bin'
	);

	$args = array(
		'labels'							=> $labels,
		'public'							=> true,
		'publicly_queryable'	=> true,
		'exclude_from_search'	=> true,
		'show_ui'							=> true,
		'show_in_menu'				=> true,
		'query_var'						=> true,
		'can_export'					=> true,
		'menu_icon'						=> 'dashicons-id',
		'rewrite'							=> array( 'slug' => 'profiles' ),
		'capability_type'			=> 'post',
		'hierarchical'				=> false,
		'has_archive'					=> true,
		'menu_position'				=> null,
		'supports'						=> array( 'thumbnail', 'custom_fields' )
	);
	register_post_type( 'profile', $args );
}
add_action( 'init', 'esm_register_post_type_contact' );