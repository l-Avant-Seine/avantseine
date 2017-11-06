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

			get_template_part( 'template-parts/contents/content', 'single' ); ?>

			<div class="wrap">
				<?php //lavantseine_post_nav(); ?>
			</div>			

		<?php endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
