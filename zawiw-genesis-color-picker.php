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
register_deactivation_hook(dirname( __FILE__ ). '/zawiw-genesis-color-picker.php', 'zawiw_genesis_color_picker_deactivation');
function zawiw_genesis_color_picker_activation()
{
	if(!file_exists(dirname( __FILE__ ). "/../../themes/lifestyle-pro/functions.php.genesisbak"))
	{
		copy(dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php", dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php.genesisbak");
		copy(dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css", dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css.genesisbak");
	}
}
function zawiw_genesis_color_picker_deactivation()
{
	if(!is_user_logged_in())
	{
		echo "authentication error";
		return;
	}
	if(!isset($_POST['remove']) || !isset($_POST['submit']))
	{

?>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&subset=latin%2Clatin-ext&ver=4.1">
	<style>
		body {
			font-family: "Open Sans",sans-serif;
		}
		input[type='submit'] {
			border: 1px solid #ccc;
			align-items: flex-start;
			-webkit-font-smoothing: subpixel-antialiased;
			text-align: center;
			font-family: inherit;
			margin: 10px 8px 0 0;
			color: #555;
			vertical-align: top;
			text-decoration: none;
			-webkit-appearance:none;
			-webkit-border-radius: 3px;
			box-sizing: border-box;
			height: 28px;
			background-color: #f7f7f7;
			line-height: 26px;
			box-shadow: inset 0 1px 0 #fff,0 1px 0 rgba(0,0,0,.08);
			border-radius: 3px;
			width: 150px;
			display: block;
			padding: 0px 10px 1px 10px;
			font-size: 13px;
		}
		input[type='submit']:hover {
			border-color: #999;
			background: #fafafa;
			color: #222;
			cursor: pointer;
		}
		form > div {
			display: block;
		}
	</style>
</head>
<body>
	<h2>Remove created themes?</h2>
	<form action="" method="post">
		<div><input type="radio" name="remove" value="Yes"><label>Yes</label></div>
		<div><input type="radio" name="remove" value="No" checked><label>No</label></div>
		<input type="submit" name="submit" value="Confirm" />
	</form>
</body>
</html>

<?php
	exit;
	}
	else if($_POST['submit'] == "Confirm" && $_POST['remove'] == "Yes")
	{
		copy(dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php.genesisbak", dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php");
		copy(dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css.genesisbak", dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css");
		unlink(dirname( __FILE__ )."/../../themes/lifestyle-pro/functions.php.genesisbak");
		unlink(dirname( __FILE__ )."/../../themes/lifestyle-pro/style.css.genesisbak");
	}
}
function zawiw_genesis_color_picker_queue_stylesheet()
{
	wp_enqueue_style( 'font_awesome4.2', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css' );
    wp_enqueue_style( 'zawiw_genesis_color_picker_style', plugins_url( 'style.css', __FILE__ ) );
    wp_enqueue_style( 'chosencss', plugins_url( 'chosen/chosen.css', __FILE__ ) );
   
}
function zawiw_genesis_color_picker_queue_script()
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'zawiw_genesis_color_picker_script', plugins_url( 'helper.js', __FILE__ ) );
    wp_enqueue_script( 'chosenjs', plugins_url( 'chosen/chosen.jquery.min.js', __FILE__ ) );
    wp_enqueue_script( 'jscolor_picker', plugins_url( 'jscolor/jscolor.js', __FILE__ ) );
}
?>
