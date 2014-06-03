<?php

function _s_filter_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
	error_log( 'starting class_string: ' . $class_string );
	if ( $tag=='vc_row' OR $tag == 'vc_row_inner' ) {
		if ( FALSE !== strpos( $class_string, 'vc_row-fluid') ) {
			$class_string .= ' w-container';
		}
		// $class_string = str_replace( 'vc_row-fluid', 'my_row-fluid', $class_string );
	}
	if ( $tag=='vc_column' OR $tag == 'vc_column_inner' ) {
		preg_match_all( '/vc_span(\d{1,2})/', $class_string, $visual_composer_column_classes );
		// $class_string = preg_replace( '/vc_span(\d{1,2})/', 'w-col-$1', $class_string );
		if ( ! empty ( $visual_composer_column_classes[1] ) ) {
			foreach ( $visual_composer_column_classes[1] as $column_number ) {
				$class_string .= ' w-col-' . $column_number;
			}
		}

		error_log( 'matching $visual_composer_column_classes: ' . print_r( $visual_composer_column_classes, true ) );
	}
	return $class_string;
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter( 'vc_shortcodes_css_class', '_s_filter_css_classes_for_vc_row_and_vc_column', 10, 2 );