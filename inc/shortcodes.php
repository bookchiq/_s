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
	global $social_networks;
	$out = '';

	$options = get_option( _S_OPTIONS );

	// If an email address is set, make sure it has "mailto:"
	if ( ! empty( $options['email'] ) ) {
		if ( 0 !== strpos( $options['email'], 'mailto:' ) ) {
			$options['email'] = 'mailto:' . $options['email'];
		}
	}

	foreach ( $social_networks as $network ) {
		// Check that this setting is populated and should be shown
		if ( ! empty( $options[ $network['slug'] ] ) && ( true === $network['show_in_account_links'] ) ) {		
			$out .= '<li class="social-link social-icon ' . $network['slug'] . '"><a href="' . $options[ $network['slug'] ] . '" title="' . $network['name'] . '">' . file_get_contents( get_template_directory() . '/images/icons/social/' . $network['slug'] . '.svg' ) . '</a></li>';
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
function _s_show_opt_in( $atts ) {
	extract( shortcode_atts( array(
		'button_text' => null,
		'form_id' => null,
		'form_id_field' => null,
	), $atts ) );

	$out = '';

	$options = get_option( _S_OPTIONS );
	$opt_in_code = $options['opt_in'];

	if ( ! empty( $opt_in_code ) ) {
		if ( ! empty( $button_text ) ) {
			$opt_in_code = preg_replace( '/(<input type="submit".*?)value=".*?"(.*?>)/', '\1value="' . $button_text .'"\2', $opt_in_code );	
		}
		
		if ( ! empty( $form_id ) && ! empty( $form_id_field ) ) {
			// Get the existing form ID from the form
			if ( preg_match( '/' . $form_id_field . '="(.*?)"/', $opt_in_code, $matches ) ) {
				if ( ! empty( $matches[1] ) ) {
					// Replace it
					$opt_in_code = str_replace( $matches[1], $form_id, $opt_in_code );
				}
			}
		}

		$out .= '<div class="opt-in">' . $opt_in_code . '</div>';
	}
	
	return $out;
}