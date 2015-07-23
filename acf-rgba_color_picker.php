<?php

/*
Plugin Name: Advanced Custom Fields: RGBA Color Picker
Plugin URI: https://github.com/mosesdev/acf_rgba_color_picker.git
Description: A simple extension to the Wordpress default color picker to allow for an alpha value and built on top of ACF as a new field type.
Version: 1.0.0
Author: Sean Johnson
Author URI: http://mosesinc.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-rgba_color_picker', false, dirname( plugin_basename(__FILE__) ) . '/lang/' ); 




// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_rgba_color_picker( $version ) {
	
	include_once('acf-rgba_color_picker-v5.php');
	
}

add_action('acf/include_field_types', 'include_field_types_rgba_color_picker');	




// 3. Include field type for ACF4
function register_fields_rgba_color_picker() {
	
	include_once('acf-rgba_color_picker-v4.php');
	
}

add_action('acf/register_fields', 'register_fields_rgba_color_picker');	



	
?>