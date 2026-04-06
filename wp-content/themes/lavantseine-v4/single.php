<?php
/**
 * The template for displaying all single posts
 *
 * @package l\'Avant-Seine_v2.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'Components/contents/content', 'single' ); ?>

		<?php endwhile;
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
