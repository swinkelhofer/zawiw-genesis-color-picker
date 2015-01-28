jQuery(document).ready(function(){
	jQuery('#genesis-theme-settings-style-selector .inside').prepend('<div id="genesis_theme_settings_color_picker"></div>');
	jQuery('#genesis-theme-settings-style-selector .inside').prepend('<a class="fa fa-chevron-down" id="genesis_theme_settings_exandor" href="javascript: expand(\'#genesis_theme_settings_color_picker\')">Create New Colorscheme</a>')

	jQuery('#genesis_theme_settings_color_picker').append('<div id="genesis_theme_settings_colorscheme_warnings"></div>');
	jQuery('#genesis_theme_settings_color_picker').append('<label for="genesis_theme_settings_colorscheme_name">Name For ColorScheme:</label><input type="text" id="genesis_theme_settings_colorscheme_name" /><br />');
	jQuery('#genesis_theme_settings_color_picker').append('<label for="genesis_theme_settings_colorscheme_bgcolor">Background Color:</label><input type="text" id="genesis_theme_settings_colorscheme_bgcolor" class="color {hash:true}" value="#65FF36" /><br />');
	jQuery('#genesis_theme_settings_color_picker').append('<label for="genesis_theme_settings_colorscheme_color">Font Color:</label><input type="text" id="genesis_theme_settings_colorscheme_color" class="color {hash:true}" value="#333333" />');
	jQuery('#genesis_theme_settings_color_picker').append('<input type="button" id="genesis_theme_settings_colorscheme_apply" onClick="javascript: apply_color_scheme()" value="Create" class="button button-primary" />');
  
	jQuery.post("../wp-content/plugins/zawiw-genesis-color-picker/getcolor.php", {colorrequest: jQuery('#genesis-theme-settings-style-selector select').html()}).done(function(data) {
		if(data != "authentication error" && data != "post error")
		{
			jQuery('#genesis-theme-settings-style-selector select').addClass('chosen-select-width');
			jQuery('#genesis-theme-settings-style-selector select').html(data);
			var config = {
		      '.chosen-select'           : {},
		      '.chosen-select-deselect'  : {allow_single_deselect:true},
		      '.chosen-select-no-single' : {disable_search_threshold:10},
		      '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
		      '.chosen-select-width'     : {width:"250px"}
		    }
		    for (var selector in config) {
		      jQuery(selector).chosen(config[selector]);
		    }
		}
	});
});

function apply_color_scheme()
{
	var name = jQuery('#genesis_theme_settings_colorscheme_name').val();
	var bgcolor = jQuery('#genesis_theme_settings_colorscheme_bgcolor').val();
	var color = jQuery('#genesis_theme_settings_colorscheme_color').val();
	jQuery.post("../wp-content/plugins/zawiw-genesis-color-picker/ajax.php", {colorscheme_name: name, colorscheme_css_name: name.toLowerCase().replace(/ /g, "_"), colorscheme_color: color, colorscheme_bgcolor: bgcolor}).done(function(data) {
		if(data == "authentication error")
			alert("You have to be logged in!!!");
		else if(data == "alreadyfound error")
		{
			jQuery('#genesis_theme_settings_colorscheme_warnings').text("Colorscheme name already existing. Please type other name!");
			jQuery('#genesis_theme_settings_colorscheme_warnings').addClass("warning");
			jQuery('#genesis_theme_settings_colorscheme_name').addClass("warning");
		}
		else if(data == "post error")
		{
			alert("Your sent post data are not valid!!!");
		}
		else if(data == "successful")
		{
			var select = jQuery('#genesis-theme-settings-style-selector select');
			jQuery('#genesis_theme_settings_colorscheme_warnings').text("");
			jQuery('#genesis_theme_settings_colorscheme_warnings').removeClass("warning");
			jQuery('#genesis_theme_settings_colorscheme_name').removeClass("warning");
			select.append('<option value="' + name.toLowerCase().replace(/\s/g, "_") + '" style="background-color: ' + bgcolor + '; color: ' + color + ';">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' + name + '</option>');
			jQuery('#genesis_theme_settings_colorscheme_name').val("");
			jQuery('#genesis_theme_settings_bgcolorscheme_color').val("#FFFFFF");
			jQuery('#genesis_theme_settings_colorscheme_color').val("#000000");
			document.getElementById("genesis-settings[style_selection]").options.selectedIndex = document.getElementById("genesis-settings[style_selection]").options.length - 1;
			jQuery('#genesis_theme_settings_colorscheme_color').css('background-color', '#000');
			jQuery('#genesis_theme_settings_colorscheme_bgcolor').css('background-color', '#FFF');
			expand('#genesis_theme_settings_color_picker');
			jQuery('#genesis-theme-settings-style-selector select').trigger("chosen:updated");
		}
		else
		{
			alert("Strange error!!!");
		}
	});
}

function expand(a)
{
	a = jQuery(a);
	var b = jQuery('#genesis_theme_settings_exandor');
	if(a.css('max-height') == '0px')
	{
		a.css('max-height','200px');
		a.css('padding-top','10px');
		a.css('padding-bottom','10px');
		a.css('border', '1px solid #DDD');
		b.addClass('fa-chevron-up');
		b.removeClass('fa-chevron-down');
	}
	else
	{
		a.css('max-height','0px');
		a.css('padding-top','0px');
		a.css('padding-bottom','0px');
		a.css('border', '1px solid transparent');
		b.addClass('fa-chevron-down');
		b.removeClass('fa-chevron-up');
	}
}