<?php
/**
 * _s functions and definitions
 *
 * @package _s
 */

// Useful global constants
define( '_S_DESIGNER_TWITTER_HANDLE', 'wpmoxie' );
define( '_S_LATEST_SCRIPT_VERSION', date( 'Ymdhis' ) ); // Increment on every load for development only
// define( '_S_LATEST_SCRIPT_VERSION', '20131030a' );
define( '_S_OPTIONS', '_s_' );
define( '_S_SHORTCODE_PREFIX', '_s' );
define( '_S_VERSION', wp_get_theme()->get( 'Version' ) );

/**
* Add humans.txt to the <head> element.
*/
add_action( 'wp_head', '_s_header_meta' );
function _s_header_meta() {
	$humans = '<link type="text/plain" rel="author" href="' . get_template_directory_uri() . '/humans.txt" />';

	echo apply_filters( '_s_humans', $humans );
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( '_s_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function _s_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change '_s' to the name of your theme in all the template files
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', '_s' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', '_s_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _s_scripts() {
	wp_enqueue_style( '_s-style', get_stylesheet_uri(), array(), _S_LATEST_SCRIPT_VERSION );
	wp_enqueue_style( '_s-screen', get_template_directory_uri() . '/css/screen.css', array(), _S_LATEST_SCRIPT_VERSION );

	// wp_enqueue_style( '_s-webflow', get_template_directory_uri() . '/css/webflow.css', array(), _S_LATEST_SCRIPT_VERSION );
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.18416.js', array(), '2.8.2', false );
	// wp_enqueue_script( '_s-webflow', get_template_directory_uri() . '/js/webflow.js', array( 'jquery' ), _S_LATEST_SCRIPT_VERSION, true );

	// Mobile and accessibility
	// wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	// wp_enqueue_script( 'placeholders', get_template_directory_uri() . '/js/placeholders.min.js', array(), '3.0.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// wp_enqueue_script( '_s-functions', get_template_directory_uri() . '/js/functions-ck.js', array( 'jquery' ), _S_LATEST_SCRIPT_VERSION, true );

	// Custom file that the client can add to
	wp_enqueue_style( 'custom-theme-styles', get_template_directory_uri() . '/css/custom.css' );
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );


/**
 * Enqueue admin scripts and styles
 */
function _s_scripts_admin() {
	wp_enqueue_style( '_s-admin', get_template_directory_uri() . '/css/admin.css', array(), _S_LATEST_SCRIPT_VERSION );
}
add_action( 'admin_enqueue_scripts', '_s_scripts_admin' );


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
* Add page slug body class
*/ 
add_filter( 'body_class', '_s_add_slug_body_class' );
function _s_add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}


/**
* Add styles for the TinyMCE editor
*/
require get_template_directory() . '/inc/tinymce.php';

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom metaboxes for this theme.
 */
// require get_template_directory() . '/inc/metaboxes.php';

/**
 * Add TypeKit scripts.
 */
// require get_template_directory() . '/inc/typekit.php';

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
// require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Add Webflow customizations to Visual Composer
 */
// require get_template_directory() . '/inc/webflow.php';

/**
 * Load utility functions
 */
require get_template_directory() . '/inc/utility.php';

/**
 * Prepare theme options
 */
// Only load the class here if it's not included as a plugin
// if ( ! class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/inc/redux/ReduxCore/framework.php' ) ) {
// 	require_once( dirname( __FILE__ ) . '/inc/redux/ReduxCore/framework.php' );
// }
// // The config file
// if ( ! isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/inc/redux-config.php' ) ) {
// 	require_once( dirname( __FILE__ ) . '/inc/redux-config.php' );
// }

/**
 * Add custom shortcodes
 */
// require( get_template_directory() . '/inc/shortcodes.php' );

/**
 * Add debug data
 */
require get_template_directory() . '/inc/debug.php';
