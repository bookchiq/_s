<?php
/**
 * _s functions and definitions
 *
 * @package _s
 */

// Useful global constants
define( '_S_VERSION', '1.0' );

/**
* Add humans.txt to the <head> element.
*/
function _s_header_meta() {
$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" />';

echo apply_filters( '_s_humans', $humans );
}
add_action( 'wp_head', '_s_header_meta' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( '_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function _s_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri() );
	wp_enqueue_style( '_s-core', get_template_directory_uri() . '/css/core.css' );

	// Typekit
	// wp_enqueue_script( 'typekit-_s', '//use.typekit.net/ntj6oqo.js' );
	// wp_enqueue_script( 'typekit-_s-start', get_template_directory_uri() . '/js/typekit.js', array( 'typekit-_s' ) );

	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	// wp_enqueue_script( '_s-functions', get_template_directory_uri() . '/js/functions-ck.js', array( 'jquery' ), false, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( '_s-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}

	// Custom file that the client can add to
	wp_enqueue_style( 'custom-theme-styles', get_template_directory_uri() . '/css/custom.css' );
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );

// function _s_mce_external_plugins($plugin_array){
// 	$plugin_array['typekit']  =  get_template_directory_uri().'/js/typekit.tinymce-ck.js';
//     return $plugin_array;
// }
// add_filter( 'mce_external_plugins', '_s_mce_external_plugins' );

/**
 * Turn off page comments and pings by default (they can still be enabled on a page-by-page basis)
 */
function _s_page_comments_off( $post_content, $post ) {
	if ( $post->post_type )
	switch ( $post->post_type ) {
		case 'page':
			$post->comment_status = 'closed';
			$post->ping_status = 'closed';
		break;
	}
	return $post_content;
}
add_filter( 'default_content', '_s_page_comments_off', 10, 2 );

/**
* Add styles for the TinyMCE editor
*/
add_editor_style( 'css/editor-style.css' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom metaboxes for this theme.
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Prepare theme options
 * The options are set up in this file, so its's the one that needs editing
 */
// require( get_template_directory() . '/inc/options.php' );