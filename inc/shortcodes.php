<?php

/**
 * Execute shortcodes in widgets
 */
add_filter( 'widget_text', 'do_shortcode' );


/**
 * [_s-social]
 */
add_shortcode( _S_SHORTCODE_PREFIX . '-social', '_s_show_social_links' );
function _s_show_social_links() {	
	$out = '';

	$options = get_option( _S_OPTIONS );

	$networks = array( 'pinterest', 'facebook', 'twitter', 'instagram', 'rss' );

	foreach ( $networks as $network ) {
		// Check if this setting is populated
		if ( ! empty( $options[ $network ] ) ) {
			$out .= '<li class="social-link social-' . $network . '"><a href="' . $options[ $network ] . '">' . ucfirst( $network ) . '</a></li>';
		}
	}
	$out = '<ul class="social-links">' . $out . '</ul>';
	
	return $out;
}


/**
 * [_s-opt-in]
 */
add_shortcode( _S_SHORTCODE_PREFIX . '-opt-in', '_s_show_opt_in' );
function _s_show_opt_in() {	
	$out = '';

	$options = get_option( _S_OPTIONS );

	if ( ! empty( $options['opt_in'] ) ) {
		$out .= '<div class="opt-in">' . $options['opt_in'] . '</div>';
	}
	
	return $out;
}