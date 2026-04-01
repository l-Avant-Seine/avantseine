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
<!-- Facebook Pixel Code
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
End Facebook Pixel Code -->


<?php
	//$header_logo_file = get_bloginfo( 'template_url' ) . '/assets/img/avtseine-logo-2019-mobile.png';
	$header_logo_file = get_field('site_logo', 'option'); ?>
				
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header" role="banner">

		<img src="<?php the_field('logo_texture', 'option'); ?>" alt="" class="header_texture">

		<div class="flex --hcentered --jstf">
			<nav class="header-branding">
				<a href="<?php echo esc_url( home_url( '/' ) ) ?>" rel="home" class="logo_link">
					<img class="site-logo" id="site-logo" src="<?php echo $header_logo_file ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" title="" width="100">
				</a>
			</nav>

			<nav id="site-navigation" class="header-navigation main-navigation" role="navigation">
					<?php 
						wp_nav_menu( array( 
							'theme_location' => 'primary', 
							'menu_id' => 'primary-menu',
						) ); 
					?>
			</nav><!-- #site-navigation -->

			<div class="header-cta">
				<a href="#" class="btn">Billetterie</a>
			</div>

		</div>

		<!-- <div id="siteMenus-searchform" class="siteMenus-searchform">
			<div class="inner">
				<a href="#" id="searchform-close" class="btn-nude">x</a>

				<form id="searchform" class="cf searchbar" action="/" method="get">
			    <input type="text" name="s" id="search" placeholder="votre recherche" value="" />
			    <input type="submit" alt="Search" class="btn-nude" value="ok" />
				</form>

			</div>
		</div> -->


	</header><!-- #masthead -->

	<div id="modal" class="modal">
		<div class="modal-inner wrap">
			<h2 id="modal-title" class="h_2 mb-2">Nous cherchons...</h2>

			<div id="modal-content"></div>
		</div>
	</div>

	<div id="cta-menu" class="cta-menu m-hide">
		<?php 
		//wp_nav_menu( array(
			//'theme_location' => 'footer', 
		//) ); ?>
	</div>

	<div id="content" class="site-content">
