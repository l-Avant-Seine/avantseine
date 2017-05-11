<?php
/**
 * l\'Avant-Seine v2.0 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package l\'Avant-Seine_v2.0
 */


define('FB_URL','https://www.facebook.com/lAvantSeine');
define('TWITTER_URL','https://twitter.com/AvantSeine');
define('INSTAGRAM_URL','http://instagram.com/avantseine');
define('GOOGLEPLUS_URL','https://plus.google.com/u/0/b/100144920076066761502/100144920076066761502');
define('VIDEOCHANNEL_URL','https://www.youtube.com/channel/UCtUb1swrX34VbClR53YcagA');

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
$today = time();
$previous_month = false;


if ( ! function_exists( 'lavantseine_v2_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function lavantseine_v2_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on l\'Avant-Seine v2.0, use a find and replace
	 * to change 'lavantseine-v2' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lavantseine-v2', get_template_directory() . '/languages' );

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
		'primary' => __( 'Menu principal', 'lavantseine-v2' ),
		'top' => __( 'Menu supérieur', 'lavantseine-v2' ),
		'all' => __( 'Menu hamburger', 'lavantseine-v2' ),
		'footer' => __( 'Footer', 'lavantseine-v2' ),
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'lavantseine_v2_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'lavantseine_v2_setup' );



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function lavantseine_v2_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'lavantseine_v2_content_width', 640 );
}
add_action( 'after_setup_theme', 'lavantseine_v2_content_width', 0 );



/**
 * Register widget area.
 */
function lavantseine_v2_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar principale', 'lavantseine' ),
		'id'            => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="box-sidebar widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
	
	register_sidebar( array(
		'name'          => __( 'Emplacements Footer ', 'lavantseine-v2' ),
		'id'            => 'footer-widgets',
		'before_widget' => '<aside id="%1$s" class="box-footer widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h5 class="box-footer-title">',
		'after_title'   => '</h5>',
	) );
}
add_action( 'widgets_init', 'lavantseine_v2_widgets_init' );



/**
 * Enqueue scripts and styles.
 */
function lavantseine_v2_scripts() {
	wp_enqueue_style( 'lavantseine-v2-style', get_stylesheet_uri() );
	wp_enqueue_script( 'lavantseine-v2-scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '', true );
}
add_action( 'wp_enqueue_scripts', 'lavantseine_v2_scripts' );



