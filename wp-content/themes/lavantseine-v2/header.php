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
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window,document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
 fbq('init', '1951786325076755'); 
fbq('track', 'PageView');
</script>
<noscript>
 <img height="1" width="1" 
src="https://www.facebook.com/tr?id=1951786325076755&ev=PageView&noscript=1"/>
</noscript>
<!-- End Facebook Pixel Code -->

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">

		<div class="site-menus">

			<nav id="site-navigation" class="siteMenus-primary" role="navigation">

				<?php
				if ( wp_is_mobile() ) {
					$header_file = get_bloginfo( 'template_url' ) . '/assets/img/logo_avtseine_horizontal.png';
				} else {
					$header_file = get_bloginfo( 'template_url' ) . '/assets/img/logo_avtseine_vertical.png';
				}
				?>

				<?php 
					wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'menu_id' => 'primary-menu',
						'walker' => new Microdot_Walker_Nav_Menu(), 
						'container' => false, 
						'items_wrap' => '<ul class="no-bullets">
																<li class="site-branding menu-item">
																	<a href="'. esc_url( home_url( '/' ) ) .'" rel="home">
																		<img class="site-logo" src="' . $header_file . '" alt="'. get_bloginfo( 'name' ) .'" title="">
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
																				<a href="https://www.facebook.com/lAvantSeine/" target="_blank"><span class="icon-facebook">
																					</span></a>
																			</li>

																			<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
																				<a href="https://twitter.com/AvantSeine" target="_blank"><span class="icon-twitter">
																					</span></a>
																			</li>

																			<li id="menu-item-9455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455"><a href="http://lavant-seine.com/lieu/equipe//">Contacts</a></li>

																			<li id="menu-item-9454" class="booking-link menu-item menu-item-type-custom menu-item-object-custom menu-item-9454"><a target="_blank" href="http://www2.aparteweb.com/awprod/SEINE/AWCatalogSub.aspx?INS=SEINE" target="_blank"><span class="icon-pop-out"></span> Réserver</a></li>

																			<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
																				<a href="#" id="js-searchTrigger"><span class="icon-search">
																					</span></a>
																			</li>

																	<div class="siteMenus-searchform">
																		<form id="searchform" class="searchbar" action="/" method="get">
																	    <input type="text" name="s" id="search" placeholder="votre recherche" value="" />
																	    <input type="submit" alt="Search" class="" value="ok" />
																	</form>
																	</div>
																	
																</ul>
															</ul>'
					) ); ?>

				<div id="ham-menu" class="ham-menu">
					<div class="wrap row">
						<?php 
							wp_nav_menu( array( 
								'theme_location' => 'all', 
								'menu_id' => 'hamburger-menu',
								'link_before'	=> '<span class="icon-arrow-left m-hide"></span>',
								'link_after'	=> '<span class="icon-fleche_accordeon m-hide is-on-right"></span>',
								'items_wrap' => '<ul id="hamburger-menu" class="menu">
																	<li class="menu-item menu-item-has-children ham-prog"><a href="/programmation">Programmation</a></li>
																	<li class="menu-item menu-item-has-children ham-mag"><a href="/magazine">Magazine</a></li>

																	%3$s

																	<li id="menu-item-9455" class="m-hide black-bg menu-item menu-item-type-post_type menu-item-object-page menu-item-9455"><a href="http://lavant-seine.com/lieu/equipe/">Contacts</a></li>

																	<li id="menu-item-9454 " class="m-hide black-bg  booking-link menu-item menu-item-type-custom menu-item-object-custom menu-item-9454"><a target="_blank" href="http://www2.aparteweb.com/awprod/SEINE/AWCatalogSub.aspx?INS=SEINE" target="_blank"><span class="icon-pop-out"></span> Réserver</a></li>

																	<li  class="m-hide menu-item black-bg menu-item-type-post_type menu-item-object-page menu-item-9455">
																		<a href="https://www.facebook.com/lAvantSeine/" target="_blank"><span class="icon-facebook"></span></a>
																		<a href="https://twitter.com/AvantSeine" target="_blank"><span class="icon-twitter"></span></a>
																	</li>

																</ul>'
								 ) 
							); 
						?>
					</div>
				</div>

			</nav><!-- #site-navigation -->


		</div>

	</header><!-- #masthead -->

	<div class="emptyModal">
		<div class="emptyModal-inner wrap">
			Nous cherchons...

		</div>
	</div>

	<div id="content" class="site-content">
