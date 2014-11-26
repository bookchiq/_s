<?php

// Examples
/** Holidays Custom Post Type */
// require get_template_directory() . '/inc/cpt-holidays.php';

/** Shop/Products Custom Post Type */
// require get_template_directory() . '/inc/cpt-products.php';


// Set up Posts 2 Posts connections so each product can be associated with a specific holiday
function _s_cpt_connection_types() {
	p2p_register_connection_type( array(
		'name' => 'products_to_holidays',
		'from' => 'products',
		'to' => 'holidays'
	) );
}
// add_action( 'p2p_init', '_s_cpt_connection_types' );


// Customize post-save messages
function _s_cpt_update_messages( $messages ) {
	global $post, $post_ID;
	$post_type = get_post_type( $post_ID );

	$obj = get_post_type_object($post_type);
	$singular = $obj->labels->singular_name;

	$messages[$post_type] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('%2$s updated. <a href="%1$s">View %3$s &rarr;</a>', '_s' ), esc_url( get_permalink( $post_ID ) ), $singular, strtolower( $singular ) ),
		2 => __( 'Custom field updated.', '_s' ),
		3 => __( 'Custom field deleted.', '_s' ),
		4 => sprintf( __('%1$s updated.', '_s' ), $singular ),
		5 => isset($_GET['revision']) ? sprintf( __( '%2$s restored to revision from %1$s', '_s' ), wp_post_revision_title( (int) $_GET['revision'], false ), $singular ) : false,
		6 => sprintf( __('%2$s published. <a href="%1$s">View %3$s &rarr;</a>', '_s' ), esc_url( get_permalink( $post_ID ) ), $singular, strtolower( $singular ) ),
		7 => __( 'Page saved.', '_s' ),
		8 => sprintf( __('%2$s submitted. <a href="%1$s">Preview %3$s &rarr;</a>', '_s' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ), $singular, strtolower( $singular ) ),
		9 => sprintf( __('%2$s scheduled for <strong>%4$s</strong>. <a href="%1$s">Preview %3$s &rarr;</a>', '_s' ), esc_url( get_permalink( $post_ID ) ), $singular, strtolower( $singular ), date_i18n( __(  'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
		10 => sprintf( __('%2$s draft updated. <a href="%1$s">Preview %3$s &rarr;</a>', '_s' ), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ), $singular, strtolower( $singular ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', '_s_cpt_update_messages' );