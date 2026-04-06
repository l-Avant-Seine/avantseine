<?php
/**
 * The template for displaying a Magazine's category.
 *
 * @package lavantseine
 */

get_header();

$discipline = get_query_var( 'discipline' );
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main page-taxonomy" cat-slug="<?php echo $discipline; ?>" role="main">

			<?php get_template_part( 'Components/contents/content', 'programmation' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
