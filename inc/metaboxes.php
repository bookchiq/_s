<?php

global $_s_metabox_prefix;
$_s_metabox_prefix = '__s_';

/**
 * Initialize meta boxes
 */
// if ( ! class_exists( 'cmb_Meta_Box' ) ) {
// 	require( get_template_directory() . '/inc/cmb/init.php' );
// }

/**
 * Set up metaboxes
 */
function _s_metaboxes( $meta_boxes ) {
	global $_s_metabox_prefix;

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
				'id' => $_s_metabox_prefix . 'secondary_content',
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
 * @param  string  $meta_name The id of the field
 * @param  boolean $wpautop   Whether or not to use the wpautop filter
 */
function _s_get_secondary_content( $meta_name, $wpautop = true ) {
	global $_s_metabox_prefix, $post;

	if ( $meta_content = get_post_meta( $post->ID, $_s_metabox_prefix . $meta_name, true ) ) {
		echo '<div class="secondary-content secondary-content-' . $meta_name . '" >' . "\r\n";
		echo ( $wpautop ) ? wpautop( $meta_content ) : $meta_content;
		echo '</div><!-- .secondary-content-' . $meta_name . ' -->' . "\r\n";
	}
}