<?php
define( '_S_METABOX_PREFIX', '_s_' );

/**
 * Initialize the metabox class
 */
add_action( 'init', '_s_initialize_cmb_meta_boxes', 9999 );
function _s_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) ) {
		require_once( get_template_directory() . '/inc/cmb/init.php' );
	}
}

/**
 * Set up metaboxes
 */
function _s_metaboxes( $meta_boxes ) {
	$meta_boxes[] = array(
		'id' => 'theme_extras',
		'title' => 'Extras',
		'pages' => array( 'page', 'post' ), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
				'name' => 'Secondary content',
				'id' => _S_METABOX_PREFIX . 'secondary_content',
				// 'desc' => 'Anything you add in here will be displayed next to the logo.',
				'type' => 'wysiwyg'
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', '_s_metaboxes' );


/**
 * Retrieve a value from the metaboxes and display it
 */
function _s_get_secondary_content( $args ) {
	$defaults = array(
		'id'      => null,  // The id of the custom field, without the prefix
		'wpautop' => false, // Whether or not to use the wpautop filter
		'before'  => null,
		'after'   => null,
		'wrapper' => 'div',
		'classes' => array(),
		'echo'    => true,
	);
	$args = wp_parse_args( $args, $defaults );

	global $post;
	$out = '';

	if ( $meta_content = get_post_meta( $post->ID, _S_METABOX_PREFIX . $args['id'], true ) ) {
		$args['classes'][] = 'secondary-content';
		$args['classes'][] = 'secondary-content-' . $args['id'];

		$out .= '<' . $args['wrapper'] . ' class="' . implode( ' ', $args['classes'] ) . '" >' . PHP_EOL;

		if ( $args['before'] ) {
			$out .= '<span class="before">' . $args['before'] . '</span>';
		}
		$out .= '<span class="content">';
		$out .= ( $args[ 'wpautop' ] ) ? wpautop( $meta_content ) : $meta_content;
		$out .= '</span>';
		if ( $args['after'] ) {
			$out .= '<span class="after">' . $args['after'] . '</span>';
		}
		$out .= '</' . $args['wrapper'] . '><!-- .secondary-content-' . $args['id'] . ' -->' . PHP_EOL;
	}
	if ( $args[ 'echo' ] ) {
		echo $out;
	} else {
		return $out;
	}
}