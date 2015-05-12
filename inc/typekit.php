<?php

// Add to the front end
add_action( 'wp_enqueue_scripts', '_s_typekit_frontend_scripts' );
function _s_typekit_frontend_scripts() {
	// Make sure to replace the TypeKit ID in this file
	wp_enqueue_script( '_s-typekit', get_template_directory_uri() . '/js/typekit.js' );
}

// Disabling until there's a decent fix for the hideous BESbswy issue
// // Add to the editor
// add_filter( 'mce_external_plugins', '_s_mce_external_plugins' );
// function _s_mce_external_plugins($plugin_array){
// 	$plugin_array['typekit']  =  get_template_directory_uri().'/js/typekit.tinymce.js';
//     return $plugin_array;
// }

// Prevent test data from showing up
add_filter( 'content_save_pre', '_s_clean_up_after_typekit', 20 );
add_filter( 'the_content', '_s_clean_up_after_typekit', 20 );
function _s_clean_up_after_typekit( $content ) {
	return preg_replace( "/<span.*?>BESbswy<\/span>/", '', $content );
}