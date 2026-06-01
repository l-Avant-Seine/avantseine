<?php
/**
 * Template Name: Archives Saisons Passées
 *
 * @package lavantseine
 */

get_header();

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<section class="mod_progtitle">

			<div class="wrapper flex --centered">
				<div class="txt-center">
					<h1 class="h1 mb-large"><?php the_title(); ?></h1>
				</div>
			</div>

		</section>


			<?php get_template_part( 'Components/contents/content', 'saisons' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
