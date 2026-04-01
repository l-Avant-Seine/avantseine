<?php
/**
 * The template for displaying the HomePage
 *
 * @package l\'Avant-Seine_v2.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php get_template_part( 'template-parts/contents/content', 'home' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
