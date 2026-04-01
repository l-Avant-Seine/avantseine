<?php
/**
 * The Template for displaying all single posts.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php 
				while ( have_posts() ) : the_post();
					get_template_part( 'Components/contents/content', 'event' );
			 	endwhile; 
			?>

		</main><!-- #main -->

		<div id="content-to-content">
			<?php // lavantseine_post_nav(); ?>
		</div><!-- #content-to-content -->

	</div><!-- #primary -->

<?php get_footer(); ?>