<?php
/**
 * The template for displaying a Magazine's category.
 *
 * @package lavantseine
 */

get_header();

$saison = get_query_var( 'saison' );

?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main page-taxonomy" cat-slug="<?php echo $saison; ?>" role="main">

			<?php get_template_part( 'Components/contents/content', 'saisons' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
