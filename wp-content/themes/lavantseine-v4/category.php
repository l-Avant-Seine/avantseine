<?php
/**
 * The template for displaying a Magazine's category.
 *
 * @package lavantseine
 */

get_header();

$term = get_query_var( 'cat' );
$category = get_category($term);


?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main page-category" cat-slug="<?php echo $category->slug; ?>" role="main">
			
			<?php get_template_part( 'Components/contents/content', 'magazine' ); ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
