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


// Add a class to the post and body classes if there is a featured image for this post
function _s_add_blog_post_body_classes( $classes ) {
	if ( ! is_single() ) {
		return $classes;
	}

	global $post;

	if ( has_post_thumbnail( $post->ID ) ) {
		$classes[] = 'has-post-thumbnail';
	}

	return $classes;
}
add_filter( 'body_class', '_s_add_blog_post_body_classes' );
add_filter( 'post_class', '_s_add_blog_post_body_classes' );


// Remove Visual Composer frontend editor (it doesn't always play nicely with the custom themes)
function _s_vc_remove_frontend_links() {
	vc_disable_frontend(); // this will disable frontend editor
}
add_action( 'vc_after_init', '_s_vc_remove_frontend_links' );


/**
 * Change default fields, add placeholder and change type attributes.
 *
 * @param  array $fields
 * @return array
 */
// function _s_comment_placeholders( $fields )
// {
// 	$commenter = wp_get_current_commenter();
// 	$req = get_option( 'require_name_email' );
// 	$aria_req = ( $req ? " aria-required='true'" : '' );

// 	$fields['author'] =
// 		'<p class="comment-form-author">
// 			<input required minlength="3" maxlength="30" placeholder="Your name (required)" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />
// 		</p>';

// 	$fields['email'] =
// 		'<p class="comment-form-email">
// 			<input required placeholder="Your email address (required)" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />
// 		</p>';

// 	$fields['url'] =
// 		'<p class="comment-form-url">
// 			<input placeholder="Your website URL" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" />
// 		</p>';
// 	return $fields;
// }
// add_filter( 'comment_form_default_fields', '_s_comment_placeholders' );


// function _s_comment_textarea_placeholder( $comment_field ) {
// 	$comment_field =
// 		'<p class="comment-form-comment">
// 			<textarea required placeholder="Enter your comment…" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
// 		</p>';
// 	return $comment_field;
// }
// add_filter('comment_form_field_comment','_s_comment_textarea_placeholder');