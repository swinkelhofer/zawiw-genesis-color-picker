<?php
/*
Plugin Name: Zawiw Genesis Color Picker
Plgin URI:
Description: Color Picker to create new theme colors
Version: 1.0
Author: Sascha Winkelhofer
Author URI:
License: MIT
*/
add_action( 'admin_head', 'zawiw_genesis_color_picker_queue_script' );
add_action( 'admin_head', 'zawiw_genesis_color_picker_queue_stylesheet' );
register_activation_hook( dirname( __FILE__ ).'/zawiw-genesis-color-picker.php', 'zawiw_genesis_color_picker_activation');
function zawiw_genesis_color_picker_activation()
{
	if(!file_exists(dirname( __FILE__ ). "/../../themes/lifestyle-pro/functions.php.bak"))
	{
		copy(dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php", dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php.bak");
		copy(dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css", dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css.bak");
	}
}
function zawiw_genesis_color_picker_queue_stylesheet()
{
	wp_enqueue_style( 'font_awesome4.2', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'zawiw_genesis_color_picker_style', plugins_url( 'style.css', __FILE__ ) );
   
}
function zawiw_genesis_color_picker_queue_script()
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'zawiw_genesis_color_picker_script', plugins_url( 'helper.js', __FILE__ ) );
    wp_enqueue_script( 'jscolor_picker', plugins_url( 'jscolor/jscolor.js', __FILE__ ) );
}
?>
