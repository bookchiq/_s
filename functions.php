<?php
/**
 * _s functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _s
 */

// Useful global constants
define( '_S_DESIGNER_TWITTER_HANDLE', 'wpmoxie' );
define( '_S_LATEST_SCRIPT_VERSION', date( 'Ymdhis' ) ); // Increment on every load for development only
// define( '_S_LATEST_SCRIPT_VERSION', '20150504' );
define( '_S_OPTIONS', '_s_' );
define( '_S_SHORTCODE_PREFIX', '_s' );
define( '_S_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Add social networks
 */
require( get_template_directory() . '/inc/social.php' );

/**
 * Add Redux Framework & extras
 */
require get_template_directory() . '/admin/admin-init.php';

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
	 * to change '_s' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( '_s', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', '_s' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	//add_theme_support( 'post-formats', array(
	//	'aside',
	//	'image',
	//	'video',
	//	'quote',
	//	'link',
	// ) );

	// Setup the WordPress core custom background feature.
	// add_theme_support( 'custom-background', apply_filters( '_s_custom_background_args', array(
	// 	'default-color' => 'ffffff',
	// 	'default-image' => '',
	// ) ) );
}
endif; // _s_setup
add_action( 'after_setup_theme', '_s_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function _s_content_width() {
	$GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
}
add_action( 'after_setup_theme', '_s_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _s_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', '_s' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Page Not Found', '_s' ),
		'id'            => 'four-oh-four',
		'description'   => __( 'These widgets are shown on the "Page Not Found" error page. It\'s a great place to feature your most popular content, a search box, and category archives.', '_s' ),
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
	
	// Mobile and accessibility
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr.custom.11375.min.js', array(), '11375', false );
	wp_enqueue_script( 'svgeezy', get_template_directory_uri() . '/js/svgeezy.min.js', array(), '1.0', false );
	wp_enqueue_script( '_s-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( '_s-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'placeholders', get_template_directory_uri() . '/js/placeholders.min.js', array(), '3.0.2', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( '_s-functions', get_template_directory_uri() . '/js/functions.js', array( 'svgeezy', 'jquery' ), _S_LATEST_SCRIPT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', '_s_scripts' );


/**
 * Enqueue webfonts for both the front-end and the editor
 */
// function _s_load_webfonts() {
// 	wp_enqueue_style( 'fonts-dot-com', 'http://fast.fonts.net/cssapi/3e8ae6e5-4ff3-42d1-84f5-f0bfc55a21bd.css', array(), '1.0' );
// 	add_editor_style( 'http://fast.fonts.net/cssapi/3e8ae6e5-4ff3-42d1-84f5-f0bfc55a21bd.css' );
// }
// add_action( 'wp_enqueue_scripts', '_s_load_webfonts' );
// add_action( 'init', '_s_load_webfonts' );


/**
 * Enqueue admin scripts and styles
 */
function _s_scripts_admin() {
	// wp_enqueue_style( '_s-admin', get_template_directory_uri() . '/css/admin.css', array(), _S_LATEST_SCRIPT_VERSION );
	wp_enqueue_script( '_s-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), _S_LATEST_SCRIPT_VERSION, true );
}
add_action( 'admin_enqueue_scripts', '_s_scripts_admin' );

/**
* Load inline and async CSS
*/
require get_template_directory() . '/inc/load-css.php';

/**
* Add styles for the TinyMCE editor
*/
require get_template_directory() . '/inc/tinymce.php';

/**
 * Implement the Custom Header feature.
 */
// require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom metaboxes for this theme.
 */
// require get_template_directory() . '/inc/metaboxes.php';

/**
 * Custom Post Types for this theme.
 */
// require get_template_directory() . '/inc/cpt.php';

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
 * Load utility functions
 */
require get_template_directory() . '/inc/utility.php';

/**
 * Prepare theme options
 */
if ( class_exists( 'ReduxFramework' ) ) {
	// Some custom functions for getting and displaying the options
	require( get_template_directory() . '/inc/redux-functions.php' );
}

/**
 * Add custom Visual Composer functions
 */
// require( get_template_directory() . '/inc/visual-composer.php' );

/**
 * Add custom shortcodes
 */
// require( get_template_directory() . '/inc/shortcodes.php' );

/**
 * Add debug data
 */
require get_template_directory() . '/inc/debug.php';
