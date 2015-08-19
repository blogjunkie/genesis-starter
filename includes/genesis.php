<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Force HTML5
 *
 * See: http://www.briangardner.com/code/add-html5-markup/
 *
 * @since 1.0
 */
add_theme_support( 'html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption') );

/**
 * Adds <meta> tags for mobile responsiveness.
 *
 * See: http://www.briangardner.com/code/add-viewport-meta-tag/
 *
 * @since 1.0
 */
add_theme_support( 'genesis-responsive-viewport' );

/**
 * Add support for custom backgrounds.
 *
 * @since 1.0
 */
// add_theme_support( 'custom-background' );

/**
 * Add support for a custom header.
 *
 * @since 1.0
 */
// add_theme_support( 'genesis-custom-header', array( 'width' => 960, 'height' => 100 ) );

/**
 * Add Genesis post format support.
 *
 * @since 1.0
 */
add_theme_support( 'post-formats', array(
	'aside',
	'chat',
	'gallery',
	'image',
	'link',
	'quote',
	'status',
	'video',
	'audio'
));
// add_theme_support( 'genesis-post-format-images' );

/**
 * Add Genesis footer widget areas.
 *
 * @since 1.0
 */
add_theme_support( 'genesis-footer-widgets', 3 );

/**
 * Add Genesis after-entry widget areas.
 *
 * @since 1.0
 */
add_theme_support( 'genesis-after-entry-widget-area' );

/**
 * Add Genesis theme color scheme selection theme option.
 *
 * @since 1.0
 */
// add_theme_support(
// 	'genesis-style-selector',
// 	array(
// 		'child-red' => 'Red',
// 		'child-orange' => 'Orange'
// 	)
// );

/**
 * Declare WooCommerce support, using Genesis Connect for WooCommerce.
 *
 * See: http://wordpress.org/plugins/genesis-connect-woocommerce/
 *
 * @since 1.0
 */
// add_theme_support( 'genesis-connect-woocommerce' );

/**
 * Unregister default Genesis layouts.
 *
 * @since 1.0
 */
// remove_theme_support( 'genesis-menus' );
// add_theme_support(
// 	'genesis-menus',
// 	array(
// 		'primary' => 'Primary Menu',
// 		'secondary' => 'Secondary Menu',
// 	)
// );

// add_action( 'widgets_init', 'child_remove_genesis_widgets', 20 );
/**
 * Disable some or all of the default Genesis widgets.
 *
 * @since 1.0
 */
function child_remove_genesis_widgets() {

	unregister_widget( 'Genesis_Featured_Page' );									// Featured Page
	unregister_widget( 'Genesis_User_Profile_Widget' );								// User Profile
	unregister_widget( 'Genesis_Featured_Post' );									// Featured Posts

}

// add_action( 'init', 'child_remove_layout_meta_boxes' );
/**
 * Remove the Genesis 'Layout Settings' meta box for posts and/or pages.
 *
 * @since 1.0
 */
function child_remove_layout_meta_boxes() {

	remove_post_type_support( 'post', 'genesis-layouts' );							// Posts
	remove_post_type_support( 'page', 'genesis-layouts' );							// Pages

}

// add_action( 'init', 'child_remove_scripts_meta_boxes' );
/**
 * Remove the Genesis 'Scripts' meta box for posts and/or pages.
 *
 * @since 1.0
 */
function child_remove_scripts_meta_boxes() {

	remove_post_type_support( 'post', 'genesis-scripts' );							// Posts
	remove_post_type_support( 'page', 'genesis-scripts' );							// Pages

}

/*
 * Disable Genesis SEO
 *
 * @since 1.0
 */
// remove_action( 'after_setup_theme', 'genesis_seo_compatibility_check' );
// add_action( 'after_setup_theme', 'child_maybe_disable_genesis_seo', 8 );
function child_maybe_disable_genesis_seo() {

	genesis_disable_seo();

	//* Disable Genesis <title> generation
	if( genesis_detect_seo_plugins() && function_exists( 'seo_title_tag' ) ) {
		remove_filter( 'wp_title', 'genesis_default_title', 10, 3 );
		remove_action( 'genesis_title', 'wp_title' );
		add_action( 'genesis_title', 'seo_title_tag' );
	}

}

/*
 * Use HTML5 semantic headings
 *
 * @since 1.0
 */
// add_filter( 'genesis_pre_get_option_semantic_headings', '__return_true' );
