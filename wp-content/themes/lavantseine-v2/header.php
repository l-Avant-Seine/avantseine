<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package l\'Avant-Seine_v2.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">

		<div class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="site-logo" src="<?php bloginfo( 'template_url' ); ?>/assets/img/logo_avtseine_horizontal.png" alt="<?php bloginfo( 'name' ); ?>" title=""></a>
		</div><!-- .site-branding -->
	

		<div class="site-menus">


			<nav id="site-navigation" class="siteMenus-primary" role="navigation">

				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>

				<div id="ham-menu" class="ham-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'all', 'menu_id' => 'hamburger-menu' ) ); ?>
				</div>

			</nav><!-- #site-navigation -->


			<nav class="siteMenus-secondary" role="navigation">

				<?php wp_nav_menu( array( 'theme_location' => 'top', 'menu_id' => 'top-menu' ) ); ?>

				<div class="siteMenus-searchform">
					<?php get_search_form(); ?>
				</div>
				

			</nav>

		</div>

	</header><!-- #masthead -->

	<div class="emptyModal">
		<div class="emptyModal-inner"></div>
	</div>

	<div id="content" class="site-content">
