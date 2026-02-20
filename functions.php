<?php
/**
 * NIKABETON theme functions and definitions
 *
 * @package NIKABETON
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function nikabeton_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'nikabeton' ),
			'menu-footer' => esc_html__( 'Footer Menu', 'nikabeton' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);
}
add_action( 'after_setup_theme', 'nikabeton_setup' );

/**
 * Enqueue scripts and styles.
 */
function nikabeton_scripts() {
	wp_enqueue_style( 'nikabeton-style', get_stylesheet_uri(), array(), _S_VERSION );      
	wp_enqueue_style( 'nikabeton-main-style', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION );

	wp_enqueue_script( 'nikabeton-main-js', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'nikabeton_scripts' );

/**
 * Load Custom Post Types and Functionality
 */
require get_template_directory() . '/inc/cpt-product.php';
require get_template_directory() . '/inc/cpt-concrete.php';
require get_template_directory() . '/inc/cpt-service.php';
require get_template_directory() . '/inc/cpt-zone.php';
require get_template_directory() . '/inc/cpt-review.php';
require get_template_directory() . '/inc/cpt-portfolio.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
