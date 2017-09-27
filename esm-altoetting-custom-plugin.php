<?php
/**
* Plugin Name: Emmanuel School of Mission (custom enhancements)
* Description: Adding custom taxonomy to organize posts, adding custom post type to CRUD with students info.
* Authro: Karel Suchomel (Marie je pomohla...)
* Version: 1.0
* License: GPLv2
*/

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

// remove all metaboxes from dashboard page and remove unused menu items
require_once( plugin_dir_path(__FILE__) . 'esm-filter-default-wordpress-ui.php');

// create custom post type for profiles. ( featured image, name, description )
require_once( plugin_dir_path(__FILE__) . 'esm-register-profile-post-type.php');

// profile post, custom field
require_once( plugin_dir_path(__FILE__) . 'fields/esm-profile-fields.php');

/*
// create custom post type for projects. ( name, year, LHP/LHO )
require_once( plugin_dir_path(__FILE__) . 'lspbce-register-projects-post-type.php');

// create custom post type for examples. ( name, picture, annotation, full details )
require_once( plugin_dir_path(__FILE__) . 'lspbce-register-example-post-type.php');


// project post, custom field
require_once( plugin_dir_path(__FILE__) . 'fields/lspbce-project-fields.php');

// example post, custom field
require_once( plugin_dir_path(__FILE__) . 'fields/lspbce-example-fields.php');
*/