<?php
/**
 * The template for displaying the Magazine.
 *
 * Template Name: Page Magazine
 *
 * @package lavantseine
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
			<?php get_template_part( 'Components/contents/content', 'magazine' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
