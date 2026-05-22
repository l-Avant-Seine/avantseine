<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package l\'Avant-Seine_v2.0
 */

get_header(); 

?>

	<section id="primary" class="search-content">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="wrapper mb-medium">
				<div class="wrap search-title" itemprop="name">
					<h1 class="h_1"><?php printf( esc_html__( 'Résultats de votre recherche : %s', 'lavantseine-v3' ), '<br><em>' . get_search_query() . '</em>' ); ?></h1>
				</div>
			</header><!-- .page-header -->

			<div id="" class="wrapper flex --gap-m --search mb-medium">

				<?php

				while ( have_posts() ) : the_post();
				$post_type = get_post_type(); 

				switch ($post_type) {
					case 'event':

						get_template_part( 'Components/blocs/bloc', 'event', array('post' => $post->ID)  );
						break;

					case 'post':
						get_template_part( 'Components/blocs/bloc', 'magazine' );
						break;

					case 'page':
						get_template_part( 'Components/blocs/bloc', 'page' );
						break;

					default:
						get_template_part( 'Components/blocs/bloc', 'page' );
						break;
				}

				endwhile;
				?>
			</div>

			<div class="clearfix wrapper mb-3">
				<?php lavantseine_paging_nav(); ?>
			</div>

		<?php else :
			get_template_part( 'Components/contents/content', 'none' ); ?>

		<?php endif; ?>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
