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

				<?php
				if ( wp_is_mobile() ) {
					$header_file = get_bloginfo( 'template_url' ) . '/assets/img/avtseine-logo-2019.png';
				} else {
					$header_file = get_bloginfo( 'template_url' ) . '/assets/img/avtseine-logo-2019.png';
				}
				?>
				
<!-- End Facebook Pixel Code -->

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header cf" role="banner">

		<nav class="site-branding">
			<a href="<?php echo esc_url( home_url( '/' ) ) ?>" rel="home">
				<img class="site-logo" src="<?php echo $header_file ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" title="" width="100">
			</a>
		</nav>

		<div class="site-menus is-flex">

			<nav id="site-navigation" class="cf siteMenus-primary flx-2" role="navigation">



				<?php 
					wp_nav_menu( array( 
						'theme_location' => 'primary', 
						'menu_id' => 'primary-menu',
						'walker' => new Microdot_Walker_Nav_Menu(), 
						'container' => false, 
						'items_wrap' => '<ul class="siteMenuPrimary-inner menu-item no-bullets">
																	%3$s

																<li class="js-menuTrigger menu-item">
																	<a href="#" id="js-menuTrigger">et aussi <span class="icon-menu">&#9776; </span> </a>
																</li>
															</ul>'
					) ); ?>

			</nav><!-- #site-navigation -->

			<nav class="siteMenus-actions flx-1">
				<ul class="nobullets">
					<li id="menu-item-9455" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455"><a href="<?php echo esc_url( home_url( '/' ) ) ?>equipe/" class="btn-primary">nous contacter</a></li>

					<li id="menu-item-9454" class="booking-link menu-item menu-item-type-custom menu-item-object-custom menu-item-9454"><a target="_blank" href="http://billetterie.lavant-seine.com" target="_blank" class="btn-primary">réserver</a></li>
				</ul>
			</nav>

			<nav class="siteMenus-contacts">
				<ul class=" no-bullets" role="navigation">

					<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
						<a href="https://www.facebook.com/lAvantSeine/" target="_blank">
							<span class="icon-facebook"> fb </span></a>
					</li>

					<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
						<a href="https://twitter.com/AvantSeine" target="_blank">
							<span class="icon-twitter"> tw </span></a>
					</li>

					<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
						<a href="https://twitter.com/AvantSeine" target="_blank">
							<span class="icon-twitter"> ews </span></a>
					</li>

					<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9455">
						<a href="#" id="js-searchTrigger">
							<span class="icon-search"> search </span></a>
					</li>
																	
				</ul>
			</nav>

		</div><!-- .site-menus -->


		<div id="siteMenus-searchform" class="siteMenus-searchform is-flex">
			<div class="inner">
				
				<div class="cf text-on-right">
					<a href="#" id="searchform-close" class="btn-nude">x</a>
				</div>
				<form id="searchform" class="cf searchbar" action="/" method="get">
			    <input type="text" name="s" id="search" placeholder="votre recherche" value="" />
			    <input type="submit" alt="Search" class="btn-nude" value="ok" />
				</form>

			</div>
		</div>


				<nav id="ham-menu" class="siteMenus-large">
					<div class="wrap row">
						<?php 
							wp_nav_menu( array( 
								'theme_location' => 'all', 
								'container' => false, 
								'menu_id' => 'hamburger-menu',
								'link_before'	=> '<span class="icon-arrow-left m-hide"></span>',
								'link_after'	=> '<span class="icon-fleche_accordeon m-hide is-on-right"></span>',
								'items_wrap' => '<ul id="hamburger-menu" class="menu is-flex">
																	<li class="menu-item menu-item-has-children ham-prog"><a href="/programmation">Programmation</a></li>
																	<li class="menu-item menu-item-has-children ham-mag"><a href="/magazine">Magazine</a></li>

																	%3$s

																	<li id="menu-item-9455" class="m-hide black-bg menu-item menu-item-type-post_type menu-item-object-page menu-item-9455"><a href="http://lavant-seine.com/lieu/equipe/">Contacts</a></li>

																	<li id="menu-item-9454 " class="m-hide black-bg  booking-link menu-item menu-item-type-custom menu-item-object-custom menu-item-9454"><a target="_blank" href="http://billetterie.lavant-seine.com" target="_blank"><span class="icon-pop-out"></span> Réserver</a></li>

																	<li  class="m-hide menu-item black-bg menu-item-type-post_type menu-item-object-page menu-item-9455">
																		<a href="https://www.facebook.com/lAvantSeine/" target="_blank"><span class="icon-facebook"></span></a>
																		<a href="https://twitter.com/AvantSeine" target="_blank"><span class="icon-twitter"></span></a>
																	</li>
																</ul>'
								 ) 
							); 
						?>
					</div>
				</nav>


	</header><!-- #masthead -->

	<div id="modal" class="modal">
		<div class="modal-inner wrap">
			<h2 id="modal-title" class="h_2 mb-2">Nous cherchons...</h2>

			<div id="modal-content"></div>
		</div>
	</div>

	<div id="content" class="site-content">
