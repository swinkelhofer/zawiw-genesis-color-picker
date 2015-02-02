<?php
	require_once("../../../wp-load.php");
	header('Content-Type: text/html; charset=utf-8');
	mb_internal_encoding("UTF-8");
	if(!is_user_logged_in())
	{
		echo "authentication error";
		return;
	}
	if(!isset($_POST['colorscheme_name']) || !isset($_POST['colorscheme_color']) || !isset($_POST['colorscheme_bgcolor']) || !isset($_POST['colorscheme_css_name']))
	{
		echo "post error";
		return;
	}

	function getTheme()
	{
		return  preg_replace('/ /', '-', preg_replace('/ theme/', "", strtolower(wp_get_theme())));
	}
	$functionsphp = file_get_contents(dirname( __FILE__ )."/../../themes/". getTheme() ."/functions.php");
	$stylecss = file_get_contents(dirname( __FILE__ )."/../../themes/". getTheme() ."/style.css");
	$pattern1 = '/' . $_POST['colorscheme_name'] . '/';
	$pattern2 = '/.' . $_POST['colorscheme_css_name'] . '/';
	if(preg_match($pattern1, $functionsphp) === 1 || preg_match($pattern2, $functionsphp) === 1 || preg_match($pattern2, $stylecss) === 1)
	{
		echo "alreadyfound error";
		return;
	}
	else
	{
		if(wp_get_theme() == "Lifestyle Pro Theme" )
			$css = "\n/* CUSTOM: " . $_POST['colorscheme_name'] . "\n\n--------------------------------------------- */\n\n." .$_POST['colorscheme_css_name'] ." .archive-pagination li a:hover,\n." .$_POST['colorscheme_css_name'] ." .archive-pagination li.active a,\n." .$_POST['colorscheme_css_name'] ." .entry-title a:hover,\n." .$_POST['colorscheme_css_name'] ." a  {\n        color:". $_POST['colorscheme_bgcolor'] ."; \n}\n\n." .$_POST['colorscheme_css_name'] ." .button,\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu a,\n." .$_POST['colorscheme_css_name'] ." .site-footer a,\n." .$_POST['colorscheme_css_name'] ." .site-title a,\n." .$_POST['colorscheme_css_name'] ." .site-title a:hover {\n        color: " . $_POST['colorscheme_color']. ";\n}\n\n." .$_POST['colorscheme_css_name'] ." .entry-title a,\n." .$_POST['colorscheme_css_name'] ." .sidebar .widget-title a,\n." .$_POST['colorscheme_css_name'] ." .site-footer a:hover,\n." .$_POST['colorscheme_css_name'] ." a:hover {\n        color: #222;\n}\n\n." .$_POST['colorscheme_css_name'] ." .archive-pagination li a,\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu .current-menu-item > a,\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu .sub-menu a,\n." .$_POST['colorscheme_css_name'] ." .nav-primary a {\n        color: #a5a5a3;\n}\n\n." .$_POST['colorscheme_css_name'] ." .button,\n." .$_POST['colorscheme_css_name'] ." .entry-content .button,\n." .$_POST['colorscheme_css_name'] ." .site-footer,\n." .$_POST['colorscheme_css_name'] ." .site-header,\n." .$_POST['colorscheme_css_name'] ." button,\n." .$_POST['colorscheme_css_name'] ." input[type=\"button\"],\n." .$_POST['colorscheme_css_name'] ." input[type=\"reset\"],\n." .$_POST['colorscheme_css_name'] ." input[type=\"submit\"],\n." .$_POST['colorscheme_css_name']. "lifestyle-pro-home .content .widget-title {\n        background-color: ".$_POST['colorscheme_bgcolor'].";\n}\n\n." .$_POST['colorscheme_css_name'] ." .button:hover,\n." .$_POST['colorscheme_css_name'] ." .entry-content .button:hover,\n." .$_POST['colorscheme_css_name'] ." button:hover,\n." .$_POST['colorscheme_css_name'] ." input:hover[type=\"button\"],\n." .$_POST['colorscheme_css_name'] ." input:hover[type=\"reset\"],\n." .$_POST['colorscheme_css_name'] ." input:hover[type=\"submit\"] {\n        background-color: #eeeee8;\n}\n\n." .$_POST['colorscheme_css_name'] ." .nav-secondary {\n        background-color: ".$_POST['colorscheme_bgcolor'].";\n}\n";
		else if(wp_get_theme() == "Metro Pro Theme" )
			$css = "\n/* CUSTOM: " .  $_POST['colorscheme_name'] . "\n\n--------------------------------------------- */\n\n." .$_POST['colorscheme_css_name'] ." .entry-title a:hover,\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu > .right > a:hover,\n." .$_POST['colorscheme_css_name'] ." .site-footer a:hover,\n." .$_POST['colorscheme_css_name'] ." a,\n." .$_POST['colorscheme_css_name'] ." h2 a:hover {\n        color: ".$_POST['colorscheme_bgcolor'].";\n}\n\n." .$_POST['colorscheme_css_name'] ." .entry-title a,\n." .$_POST['colorscheme_css_name'] ." .entry-meta a:hover,\n." .$_POST['colorscheme_css_name'] ." a:hover {\n        color: #222;\n}\n\n." .$_POST['colorscheme_css_name'] ." .entry-meta a {\n        color: #999;\n}\n\n." .$_POST['colorscheme_css_name'] ." .archive-pagination li a:hover,\n." .$_POST['colorscheme_css_name'] ." .entry-comments-link a,\n." .$_POST['colorscheme_css_name'] ." .entry-comments-link a:hover,\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu a,\n." .$_POST['colorscheme_css_name'] ." .site-footer a,\n." .$_POST['colorscheme_css_name'] ." .site-title a,\n." .$_POST['colorscheme_css_name'] ." .site-title a:hover,\n." .$_POST['colorscheme_css_name'] ." a.social-buttons {\n        color: ".$_POST['colorscheme_color'].";\n}\n\n." .$_POST['colorscheme_css_name'] ." h2 a,\n." .$_POST['colorscheme_css_name'] ." h2 a:visited {\n        color: #333;\n}\n\n." .$_POST['colorscheme_css_name'] ." .archive-pagination li a:hover,\n." .$_POST['colorscheme_css_name'] ." .archive-pagination li.active a,\n." .$_POST['colorscheme_css_name'] ." .btn:hover,\n." .$_POST['colorscheme_css_name'] ." .content .entry-comments-link a,\n." .$_POST['colorscheme_css_name'] ." .enews-widget input:hover[type=\"submit\"],\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu .current-menu-item > a,\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu a:hover,\n." .$_POST['colorscheme_css_name'] ." .sidebar .enews-widget input[type=\"submit\"],\n." .$_POST['colorscheme_css_name'] ." .site-title a,\n." .$_POST['colorscheme_css_name'] ." a.social-buttons:hover,\n." .$_POST['colorscheme_css_name'] ." button:hover,\n." .$_POST['colorscheme_css_name'] ." input:hover[type=\"button\"],\n." .$_POST['colorscheme_css_name'] ." input:hover[type=\"reset\"],\n." .$_POST['colorscheme_css_name'] ." input:hover[type=\"submit\"] {\n        background-color: ".$_POST['colorscheme_bgcolor'].";\n}\n\n." .$_POST['colorscheme_css_name'] ." .entry-comments-link a:hover {\n        background-color: #333;\n}\n\n." .$_POST['colorscheme_css_name'] ." .sidebar .enews-widget input:hover[type=\"submit\"] {\n        background-color: ".$_POST['colorscheme_color'].";\n}\n\n." .$_POST['colorscheme_css_name'] ." .genesis-nav-menu > .right > a,\n." .$_POST['colorscheme_css_name'] .".header-image .site-title a {\n        background: none;\n}\n";
		file_put_contents(dirname( __FILE__ )."/../../themes/". getTheme() ."/style.css", $stylecss.$css);
		if(wp_get_theme() == "Lifestyle Pro Theme" )
			$functionsphp = preg_replace('/(add_theme_support\( \'genesis-style-selector\', array\()/', '\1' . "\n\t'". $_POST['colorscheme_css_name'] .'\'    => __( \''. $_POST['colorscheme_name'] .'\', \'lifestyle\' ),', $functionsphp);
		else if(wp_get_theme() == "Metro Pro Theme" )
			$functionsphp = preg_replace('/(add_theme_support\( \'genesis-style-selector\', array\()/', '\1' . "\n\t'". $_POST['colorscheme_css_name'] .'\'    => __( \''. $_POST['colorscheme_name'] .'\', \'metro\' ),', $functionsphp);
		$functionsphp = preg_replace('/\r/', "", $functionsphp);
		file_put_contents(dirname( __FILE__ )."/../../themes/". getTheme() ."/functions.php", $functionsphp);
		echo "successful";
	}


?>