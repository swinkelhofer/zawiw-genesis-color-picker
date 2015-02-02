<?php
	require_once("../../../wp-load.php");
	if(!is_user_logged_in())
	{
		echo "authentication error";
		return;
	}
	if(!isset($_POST['colorrequest']))
	{
		echo "post error";
		return;
	}
	function getTheme()
	{
		return  preg_replace('/ /', '-', preg_replace('/ theme/', "", strtolower(wp_get_theme())));
	}
	function hexColorAllocate($im,$hex){
	    $hex = ltrim($hex,'#');
	    $a = hexdec(substr($hex,0,2));
	    $b = hexdec(substr($hex,2,2));
	    $c = hexdec(substr($hex,4,2));
	    return imagecolorallocate($im, $a, $b, $c); 
	}
	$matches = null;
	preg_match_all('/value.*?</i', $_POST['colorrequest'], $matches);
	$stylecss = file_get_contents(dirname( __FILE__ )."/../../themes/" . getTheme() . "/style.css");
	foreach ($matches[0] as $match)
	{
		$css = preg_replace('/.*value=.?"(.*?).?".*/', '\1', $match);
		$selected = FALSE;
		if(preg_match('/selected/', $match) === 1)
			$selected = TRUE;
		if($css == "")
		{
			echo "<option value=\"\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Default</option>\n";
			continue;
		}
			$option = preg_replace('/.*>(.*?)</', ' \1', $match);
			if(wp_get_theme() == "Lifestyle Pro Theme")
			{
				$bgcolor = preg_replace('/.*\.' . $css . ' \.nav-secondary.*?(background-color: #.*?;).*/s', '\1', $stylecss);
				$color = preg_replace('/.*\.' . $css . ' \.button,.*?\.site-footer a.*?(color: #.*?;).*/s', '\1', $stylecss);
			}
			else if(wp_get_theme() == "Metro Pro Theme")
			{
				$bgcolor = preg_replace('/.*.' . $css . ' h2 a:hover {.*?(color: #.*?;).*/s', 'background-\1', $stylecss);
				$color = preg_replace('/.*.' . $css . ' a.social-buttons {.*?(color: #.*?;).*/s', '\1', $stylecss);
			}

		if(!file_exists("images/" . $css. ".png"))
		{
			$col = imagecreatetruecolor(50, 50);
			$bgcol = imagecreatetruecolor(50, 50);
			$hex = preg_replace('/color: (.*);/', '\1', $color);
			$bghex = preg_replace('/background-color: (.*);/', '\1', $bgcolor);
			if(strlen($hex) < 7)
			{
				$hex = preg_replace('/#(.)(.)(.)/', '#\1\1\2\2\3\3', $hex);
			}

			$image = imagecreate(50, 50);
			$col = hexColorAllocate($image, $hex);
			$bgcol = hexColorAllocate($image, $bghex);
			imagefill($image, 0, 0, $bgcol);
			//imagestring($image, 1000, 0, 0, "A", $col);
			imagettftext($image, 42, 0, 9, 40, $col, dirname(__FILE__)."/arial.ttf", "a");
			imagepng($image, "images/" . $css . ".png");

		}
			
		echo "<option value=\"".$css."\" style=\"background: url(../wp-content/plugins/zawiw-genesis-color-picker/images/" . $css . ".png) no-repeat left center; background-size: 20px 20px; "  . "\" " . ($selected ? "selected=\"selected\"" : "") . ">&nbsp;&nbsp;&nbsp;&nbsp;".$option."</option>\n";
	}

?>
