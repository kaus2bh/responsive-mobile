<?php
/**
 * Title
 *
 * The template for displaying 404 pages (Not Found).
 *
 * @package      ${PACKAGE}
 * @license      license.txt
 * @copyright    ${YEAR} ${COMPANY}
 * @since        ${VERSION}
 *
 * Please do not edit this file. This file is part of the ${PACKAGE} Framework and all modifications
 * should be made in a child theme.
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

get_header(); ?>

	<div id="content" class="content-area">
			<main id="main" class="site-main error-page" role="main">

				<?php responsive_entry_before(); ?>
				<section id="post-0" class="error404 not-found">
					<?php responsive_entry_top(); ?>
					<div class="post-entry">

						<?php get_template_part( 'template-parts/content', 'none' ); ?>

					</div><!-- .post-entry -->
				</section><!-- #post-0 -->

			</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>