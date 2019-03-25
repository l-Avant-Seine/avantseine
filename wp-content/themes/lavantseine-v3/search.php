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

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="search-pagetitle">
				<div class="wrap page-title" itemprop="name">
					<h1 class="h1"><?php printf( esc_html__( 'Résultats de votre recherche : %s', 'lavantseine-v2' ), '<br><em>' . get_search_query() . '</em>' ); ?></h1>
				</div>
			</header><!-- .page-header -->

			<div id="webmag-innergrid" data-columns class="wrap row">

				<?php

				while ( have_posts() ) : the_post();
				$post_type = get_post_type(); 

				switch ($post_type) {
					case 'event':
						get_template_part( 'template-parts/blocs/bloc', 'event' );
						break;

					case 'post':
						get_template_part( 'template-parts/blocs/bloc', 'article' );
						break;

					case 'page':
						get_template_part( 'template-parts/blocs/bloc', 'page' );
						break;

					default:
						get_template_part( 'template-parts/blocs/bloc', 'page' );
						break;
				}

				endwhile;
				?>
			</div>

			<div class="clearfix wrap layer">
				<?php lavantseine_paging_nav(); ?>
			</div>

		<?php else :
			get_template_part( 'template-parts/contents/content', 'none' ); ?>
		
		

		<?php endif; ?>


		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
