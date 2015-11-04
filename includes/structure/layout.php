<?php

if( !defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action( 'template_redirect', 'child_content_width' );
/**
 * Define $content_width
 *
 * @link http://genesissnippets.com/content_width-variable/
 */
function child_content_width() {
	global $content_width;
	$content_width = apply_filters( 'content_width', 780, 580, 900 );
}
