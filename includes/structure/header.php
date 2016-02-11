<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Cleanup <head>
 *
 * @since 1.0
 */
remove_action( 'wp_head', 'rsd_link' );									// RSD link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );				// Parent rel link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );				// Start post rel link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );	// Adjacent post rel link
remove_action( 'wp_head', 'wp_generator' );								// WP Version
remove_action( 'wp_head', 'wlwmanifest_link');							// WLW Manifest
// remove_action( 'wp_head', 'feed_links', 2 ); // Remove feed links
// remove_action( 'wp_head', 'feed_links_extra', 3 ); // Remove comment feed links

remove_action( 'genesis_doctype', 'genesis_do_doctype' );
add_action( 'genesis_doctype', 'child_do_doctype' );
/**
 * Overrides the default Genesis doctype with IE and JS identifier classes.
 *
 * See: http://html5boilerplate.com/
 *
 * @since 1.0
 */
function child_do_doctype() {

	if( genesis_html5() ) {
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9" <?php language_attributes( 'html' ); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes( 'html' ); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- <meta name="format-detection" content="telephone=no"> -->
<!-- <meta name="referrer" content="origin"> -->
<?php
	} else {
		genesis_xhtml_doctype();
	}

}

add_action( 'wp_enqueue_scripts', 'child_load_styles' );
/**
 * Enqueue webfonts or additional stylesheets
 * 
 * @since 1.0
 */
function child_load_styles() {

	// Google Fonts
	wp_enqueue_style(
		'google-fonts',
		'//fonts.googleapis.com/css?family=Open+Sans:700,700italic,400,400italic|Roboto+Slab:400,300',	
		array(),
		null
	);
	
	// Fontawesome
	wp_enqueue_style('fontawesome-style', '//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css','','4.5.0','all');

}

add_action( 'wp_enqueue_scripts', 'child_load_scripts' );
/**
 * Enqueue scripts in the footer
 *
 * @since 1.0 
 */
function child_load_scripts() {

	if( ( is_single() || is_page() || is_attachment() ) && comments_open() & get_option( 'thread_comments' ) == 1 && !is_front_page() ) {
		wp_enqueue_script( 'comment-reply' );
	} else {
		wp_dequeue_script( 'comment-reply' );
	}

	// Override WP default self-hosted jQuery with version from Google's CDN
	// wp_deregister_script( 'jquery' );
	// wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', array(), null, true );
	// add_filter( 'script_loader_src', 'child_jquery_local_fallback', 10, 2 );
	
	// register other scripts
	wp_register_script('backstretch', '//cdnjs.cloudflare.com/ajax/libs/jquery-backstretch/2.0.4/jquery.backstretch.min.js', array('jquery'), '2.0.4' );

	// Main script file (in footer)
	wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/lib/js/scripts.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_enqueue_script( 'child-init', get_stylesheet_directory_uri() . '/lib/js/init.js', array( 'child-scripts', 'jquery' ), CHILD_THEME_VERSION, true );
		
}

// add_filter( 'genesis_pre_load_favicon', 'child_pre_load_favicon' );
/**
 * Simple favicon override to specify your favicon's location.
 *
 * @since 1.0
 */
function child_pre_load_favicon() {

	return get_stylesheet_directory_uri() . '/images/favicon.ico';

}

// remove_action( 'wp_head', 'genesis_load_favicon' );
// add_action( 'wp_head', 'child_load_favicons' );
/**
 * Show the best favicon, within reason.
 *
 * See: http://www.jonathantneal.com/blog/understand-the-favicon/
 *
 * @since 1.0
 */
function child_load_favicons() {

	$favicon_path = get_stylesheet_directory_uri() . '/images/favicons';

	// Use a 192px X 192px PNG for the homescreen for Chrome on Android
	echo '<meta name="mobile-web-app-capable" content="yes">';
	echo '<link rel="icon" sizes="192x192" href="' . $favicon_path . '/favicon-192.png">';

	// Use a 152px X 152px PNG for the latest iOS devices, also setup app styles
	echo '<link rel="apple-touch-icon" href="' . $favicon_path . '/favicon-152.png">';
	echo '<meta name="apple-mobile-web-app-capable" content="yes">';
	echo '<meta name="apple-mobile-web-app-status-bar-style" content="black">';
	echo '<meta name="apple-mobile-web-app-title" content="' . get_bloginfo('name') . '">';

	// Use a 96px X 96px PNG for modern desktop browsers
	echo '<link rel="icon" href="' . $favicon_path . '/favicon-96.png">';

	// Give IE <= 9 the old favicon.ico (16px X 16px)
	echo '<!--[if IE]><link rel="shortcut icon" href="' . $favicon_path . '/favicon.ico"><![endif]-->';

	// Use a 144px X 144px PNG for Windows tablets, or just serve them the iOS7 152px icon
	// echo '<meta name="msapplication-TileImage" content="' . $favicon_path . '/favicon-144.png">';
	echo '<meta name="msapplication-TileImage" content="' . $favicon_path . '/favicon-152.png">';

	// Optional: specify a background color for your Windows tablet icon
	// echo '<meta name="msapplication-TileColor" content="#d83434">';

}

/*
 * Remove the header
 *
 * @since 1.0
 */
// remove_action( 'genesis_header', 'genesis_do_header' );

/*
 * Remove the site title and/or description
 *
 * @since 1.0
 */
// remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
// remove_action( 'genesis_site_description', 'genesis_seo_site_description' );
