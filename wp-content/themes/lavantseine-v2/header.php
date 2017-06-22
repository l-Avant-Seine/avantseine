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
<html  <?php html_tag_schema(); ?> <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">


	

		<div class="site-menus">

			<nav id="site-navigation" class="siteMenus-primary" role="navigation">

				<?php 
					wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'menu_id' => 'primary-menu',
						'walker' => new Microdot_Walker_Nav_Menu(), 
						'container' => false, 
						'items_wrap' => '<ul class="no-bullets">
																<li class="site-branding menu-item">
																	<a href="'. esc_url( home_url( '/' ) ) .'" rel="home">
																		<img class="site-logo" src="' . get_bloginfo( 'template_url' ) . '/assets/img/logo_avtseine_horizontal.png" alt="'. get_bloginfo( 'name' ) .'" title="">
																	</a>
																</li>

																<li class="js-menuTrigger menu-item">
																	<a href="#"> <span class="icon-menu"></span> Menu</a>
																</li>

																<ul class="siteMenuPrimary-inner menu-item no-bullets">
																	%3$s
																</ul>
															
																<ul class="siteMenus-secondary no-bullets" role="navigation">

																			<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
																				<a href="https://facebook.fr" target="_blank"><span class="icon-facebook">
																					</span></a>
																			</li>

																			<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
																				<a href="https://twitter.fr" target="_blank"><span class="icon-twitter">
																					</span></a>
																			</li>

																			<li id="menu-item-9455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455"><a href="http://lavantseine.dev/pratique/contacts/">Contacts</a></li>

																			<li id="menu-item-9454" class="booking-link menu-item menu-item-type-custom menu-item-object-custom menu-item-9454"><a target="_blank" href="http://www2.aparteweb.com/awprod/SEINE/AWCatalogSub.aspx?INS=SEINE" target="_blank"><span class="icon-pop-out"></span> Réserver</a></li>

																			<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
																				<a href="#" id="js-searchTrigger"><span class="icon-search">
																					</span></a>
																			</li>

																	<div class="siteMenus-searchform">
																		<?php get_search_form(); ?>
																	</div>
																	
																</ul>
															</ul>'
					) ); ?>

				<div id="ham-menu" class="ham-menu">
					<div class="wrap row">
						<?php wp_nav_menu( array( 
						'theme_location' => 'all', 
						'menu_id' => 'hamburger-menu' ) ); ?>
					</div>
				</div>

			</nav><!-- #site-navigation -->


		</div>

	</header><!-- #masthead -->

	<div class="emptyModal">
		<div class="emptyModal-inner wrap"></div>
	</div>

	<div id="content" class="site-content">
