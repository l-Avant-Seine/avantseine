<?php
/**
 * The Template for displaying all single posts.
 *
 * @package lavantseine
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'template-parts/contents/content', 'event' ); ?>

		<?php endwhile; ?>

		</main><!-- #main -->
		<div class="clearfix"></div>


		<div id="attached-content">
			<div id="related-content" class="related-posts"  data-columns>

				<?php $taxo = 'relational_tag'; ?>
			    <?php get_template_part( 'template-parts/parts/part', 'relatedposts' ); ?>
							
			</div><!-- /.related-posts -->
		</div>	<!-- #attached-content -->


		<div id="content-to-content">
			<?php // lavantseine_post_nav(); ?>
		</div><!-- #content-to-content -->

	</div><!-- #primary -->

<?php get_footer(); ?>