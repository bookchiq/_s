<?php

function _s_add_editor_styles() {
	add_editor_style( 'editor-style.css' );
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
	// Don't use quotes in the list or it will break
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
	if ( file_exists( TEMPLATEPATH . '/inc/colors.php' ) ) {
		include( TEMPLATEPATH . '/inc/colors.php' );
	} else {
		$colors = '
			"526C73", "Blue-grey",
			"6a605f", "Brown-grey",
			"80775d", "Brown",
			"c2b85c", "Green",
			"58595b", "Dark Grey",
			"d0d2d3", "Grey",
			"e6e7e8", "Light Grey",
			"f6f6f3", "Lightest Grey",
			"b86645", "Red"
			';
	}

	$init['textcolor_map'] = '[' . $colors . ']' ;
	$init['textcolor_rows'] = 6; // expand color grid to 6 rows

	return $init;
}
add_filter('tiny_mce_before_init', '_s_tinymce_change_colors');


/**
 * Add formats for special cases
 */
function _s_tinymce_change_options( $init ) {
	// Limit formatting options
	$init['block_formats'] = "Paragraph=p; Heading 3=h3; Heading 4=h4";

	// Use style formats to assign a class (not just to allow the user to pick a specific font)
	// Usage: http://codex.wordpress.org/TinyMCE_Custom_Styles#Style_Format_Arguments
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