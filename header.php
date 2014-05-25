<?php
/**
 * Header
 *
 * Displays all information in head, starts the body tag, contains theme header
 * and nav and starts the main content wrapper
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
?>
<!DOCTYPE html>
<!--[if !IE]>
<html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>
<html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>
<html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>
<html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!-->
<html <?php language_attributes(); ?>>
<head>
	<?php responsive_head_top(); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title><?php wp_title( '&#124;', true, 'right' ); ?></title>

	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php responsive_head_bottom(); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> itemscope="itemscope" itemtype="http://schema.org/WebPage">
<?php responsive_body_bottom(); ?>
<div id="container" class="site">
<?php responsive_container_top(); ?>
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'responsive' ); ?></a>
<?php if ( has_nav_menu( 'top-menu', 'responsive' ) ) { ?>
	<div id="top-menu-container" class="container-full-width">
		<nav id="top-menu" class="container" itemscope itemtype="http://schema.org/SiteNavigationElement">
			<?php responsive_header_top(); // before header content hook ?>
			<?php
			wp_nav_menu(
				array(
					'container'      => '',
					'fallback_cb'    => false,
					'menu_class'     => 'top-menu',
					'theme_location' => 'top-menu',
					'depth'          => 1
				)
			);
			?>
		</nav>
	</div><!-- top menu container -->
<?php } ?>
<?php responsive_header(); ?>
	<header id="header" class="container-full-width site-header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
		<?php responsive_in_header(); ?>

		<div class="container">
			<div id="site-branding">
				<div id="logo">
					<?php if ( get_header_image() ) : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url">
							<img src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" itemprop="image">
						</a>
					<?php endif; // End header image check. ?>
				</div>
				<div id="site-header-text">
					<?php if ( display_header_text() ) : ?>
						<h1 class="site-name" itemprop="headline"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" itemprop="url"><?php bloginfo( 'name' ); ?></a></h1>
						<h2 class="site-description" itemprop="description"><?php bloginfo( 'description' ); ?></h2>
					<?php endif; // End header text check. ?>
				</div>
			</div>
			<?php get_sidebar( 'top' ); ?>
		</div>

		<?php responsive_header_bottom(); ?>
	</header><!-- #header -->
<?php responsive_header_end(); ?>

	<div id="main-menu-container" class="container-full-width">
		<div id="main-menu" class="container">
			<nav id="site-navigation" class="main-navigation" role="navigation" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">

				<?php wp_nav_menu(
					array(
						'container'       => false,
						'container_class' => 'main-nav',
						'fallback_cb'     => 'responsive_fallback_menu',
						'theme_location'  => 'header-menu'
					)
				); ?>
			</nav><!-- #site-navigation -->
		</div><!-- #main-menu -->
	</div><!-- #main-menu-container -->
<?php responsive_wrapper(); // before wrapper container hook ?>
	<div id="wrapper" class="site-content container">
<?php responsive_wrapper_top(); // before wrapper content hook ?>
<?php responsive_in_wrapper(); // wrapper hook ?>
