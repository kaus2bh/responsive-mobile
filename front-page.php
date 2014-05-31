<?php
/**
 * Front Page
 *
 * Template for pages
 *
 * @package      ${PACKAGE}
 * @license      license.txt
 * @copyright    ${YEAR} ${COMPANY}
 * @since        ${VERSION}
 *
 * Please do not edit this file. This file is part of the ${PACKAGE} Framework and all modifications
 * should be made in a child theme.
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * If front page is set to display the
 * blog posts index, include home.php;
 * otherwise, display static front page
 * content
 */

$responsive_options = responsive_get_options();
if ( 'posts' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	get_template_part( 'home' );
} elseif ( 'page' == get_option( 'show_on_front' ) && $responsive_options['front_page'] != 1 ) {
	$template = get_post_meta( get_option( 'page_on_front' ), '_wp_page_template', true );
	$template = ( $template == 'default' ) ? 'index.php' : $template;
	locate_template( $template, true );
} else {

	get_header();

	get_template_part( 'template-parts/featured-area', apply_filters( 'responsive_filter_featured_area_layout', '' ) );

	get_sidebar( 'home' );

	get_footer();
}
