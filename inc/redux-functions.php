<?php

function _s_show_option( $option_name, $args = array() ) {
	// Get the option
	if ( $option_value = _s_get_option( $option_name, $args ) ) {

		// Display it
		echo $option_value;
	}
}

function _s_get_option( $option_name, $args = array() ) {
	$defaults = array(
		'container'       => null,
		'container_class' => '',
		'container_id'    => '',
		'filter_content'  => false,
		'attributes'      => array(),
	);

	// log_it( 'let us talk about attributes', $args );

	$args = wp_parse_args( $args, $defaults );
	$out = false;

	// Get the option
	$options = get_option( _S_OPTIONS );

	if ( ! empty( $options[$option_name] ) ) {
		$option_value = $options[$option_name];
		
		// Filter it as needed
		if ( $args['filter_content'] ) {
			$option_value = apply_filters( 'the_content', $option_value );
		}

		// Wrap it as needed
		if ( ! empty( $args['container'] ) ) {
			$out = '<' . $args['container'];
			if ( ! empty( $args['container_class'] ) ) {
				$out .= ' class="' . $args['container_class'] . '"';
			}
			if ( ! empty( $args['container_id'] ) ) {
				$out .= ' id="' . $args['container_id'] . '"';
			}
			if ( ! empty( $args['attributes'] ) ) {
				foreach ( $args['attributes'] as $attribute_name => $attribute_value ) {
					$out .= ' ' . $attribute_name . '="' . $attribute_value . '"';
				}
			}
			$out .= '>' . $option_value . '</' . $args['container'] . '>';
		} else {
			$out = $option_value;
		}

	}

	return $out;
}