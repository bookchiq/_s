<?php

// Allow SVG uploads
add_filter( 'upload_mimes', '_s_mime_types' );
function _s_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}


// Display SVGs on the admin side
function _s_admin_svg_display() {
	$css = 'td.media-icon img[src$=".svg"] { width: 100% !important; height: auto !important; }';

	echo '<style type="text/css">'.$css.'</style>';
}
add_action('admin_head', '_s_admin_svg_display');