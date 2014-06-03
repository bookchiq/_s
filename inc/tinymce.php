<?php

function _s_add_editor_styles() {
	add_editor_style( 'css/editor-style.css' );
}
add_action( 'init', '_s_add_editor_styles' );

// Add the dropdowns
function _s_tinymce_change_buttons( $buttons ) {
	$buttons[] = 'styleselect';
	$buttons[] = 'fontselect';
	$buttons[] = 'fontsizeselect';
	return $buttons;
}
// add_filter('mce_buttons_3', '_s_tinymce_change_buttons');


/**
 * Change the font face and size options
 * 
 * Be sure to also enable the buttons in _s_tinymce_change_buttons
 */
function _s_change_tinymce_fonts( $init ) {
	$init['font_formats'] = 'Lato=Lato;Andale Mono=andale mono,times;Arial=arial,helvetica,sans-serif;Arial Black=arial black,avant garde;Book Antiqua=book antiqua,palatino;Comic Sans MS=comic sans ms,sans-serif;Courier New=courier new,courier;Georgia=georgia,palatino;Helvetica=helvetica;Impact=impact,chicago;Symbol=symbol;Tahoma=tahoma,arial,helvetica,sans-serif;Terminal=terminal,monaco;Times New Roman=times new roman,times;Trebuchet MS=trebuchet ms,geneva;Verdana=verdana,geneva;Webdings=webdings;Wingdings=wingdings,zapf dingbats';
	$init['fontsize_formats'] = "12px 14px 18px 20px 22px 24px 26px 28px 30px 36px 48px 60px 72px";

	return $init;
}
// add_filter('tiny_mce_before_init', '_s_change_tinymce_fonts');


// Add Google Scripts for use with the editor
if ( ! function_exists( '_s_tinymce_add_google_fonts_styles' ) ) {
	function _s_tinymce_add_google_fonts_styles() {
		$font_url = 'http://fonts.googleapis.com/css?family=Lato:300,400,700';
		add_editor_style( str_replace( ',', '%2C', $font_url ) );
	}
}
// add_action( 'init', '_s_tinymce_add_google_fonts_styles' );

/**
 * Change the text colors in the existing drowpdown
 * 
 * This function includes the default colors and adds custom colors
 */
function _s_tinymce_change_colors( $init ) {
	$default_colors = '
		"000000", "Black",
		"993300", "Burnt orange",
		"333300", "Dark olive",
		"003300", "Dark green",
		"003366", "Dark azure",
		"000080", "Navy Blue",
		"333399", "Indigo",
		"333333", "Very dark gray",
		"800000", "Maroon",
		"FF6600", "Orange",
		"808000", "Olive",
		"008000", "Green",
		"008080", "Teal",
		"0000FF", "Blue",
		"666699", "Grayish blue",
		"808080", "Gray",
		"FF0000", "Red",
		"FF9900", "Amber",
		"99CC00", "Yellow green",
		"339966", "Sea green",
		"33CCCC", "Turquoise",
		"3366FF", "Royal blue",
		"800080", "Purple",
		"999999", "Medium gray",
		"FF00FF", "Magenta",
		"FFCC00", "Gold",
		"FFFF00", "Yellow",
		"00FF00", "Lime",
		"00FFFF", "Aqua",
		"00CCFF", "Sky blue",
		"993366", "Brown",
		"C0C0C0", "Silver",
		"FF99CC", "Pink",
		"FFCC99", "Peach",
		"FFFF99", "Light yellow",
		"CCFFCC", "Pale green",
		"CCFFFF", "Pale cyan",
		"99CCFF", "Light sky blue",
		"CC99FF", "Plum",
		"FFFFFF", "White"
		';
	$custom_colors = '
		"e14d43", "Color 1 Name",
		"d83131", "Color 2 Name",
		"ed1c24", "Color 3 Name",
		"f99b1c", "Color 4 Name",
		"50b848", "Color 5 Name",
		"00a859", "Color 6 Name",
		"00aae7", "Color 7 Name",
		"282828", "Color 8 Name"
		';
	$init['textcolor_map'] = '['.$default_colors.','.$custom_colors.']';
	$init['textcolor_rows'] = 6; // expand color grid to 6 rows

	return $init;
}
// add_filter('tiny_mce_before_init', '_s_tinymce_change_colors');


/**
 * Add formats for special cases
 */
function _s_tinymce_change_options( $init ) {
	// Limit formatting options
	$init['block_formats'] = "Paragraph=p; Heading 3=h3; Heading 4=h4";

	// Use style formats to assign a class (not just to allow the user to pick a specific font)
	$style_formats = array(
		array(
			'title' => 'Special bit of goodness',
			'classes' => 'special-goodness',
			'block' => 'span',
			'wrapper' => true
		)
	);
	$init['style_formats'] = json_encode( $style_formats );

	return $init;
}
// add_filter('tiny_mce_before_init', '_s_tinymce_change_options');