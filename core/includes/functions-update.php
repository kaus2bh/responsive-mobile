<?php

// @TODO Add functions needed for update

/*
 * Update page templete meta data
 *
 * E.g: Change from `full-width-page.php` to `page-templates/full-width-page.php`
 *
 * This function only needes to be run once but it does not mater when. after_setup_theme should be fine.
 *
 */
function responsive_update_page_template_meta(){

	$args = array (
		'post_type' => 'page',
	);

	$pages = get_pages( $args );

	foreach ( $pages as $page ) {

		$meta_value = get_post_meta( $page->ID, '_wp_page_template', true );
		$page_templates_dir = 'page-templates/';
		$pos = strpos( $meta_value, $page_templates_dir );

		if ( $pos !== false ) {
			$meta_value = $page_templates_dir . $meta_value;
			update_post_meta( $post_id, '_wp_page_template', $meta_value );
			//update_post_meta( $post_id, '_wp_page_template_responsive', $meta_value );
		}

	}

}