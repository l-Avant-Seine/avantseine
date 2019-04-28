<?php
/**
 * Template part for displaying page content in page-home.php
 *
 * @package l\'Avant-Seine_v2.0
 */

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();
?>


<div class="cf">

	<!-- Focus -->
	<div class="row">

		<?php get_template_part('template-parts/modules/module', 'focus'); ?>

	</div>


	<section class="section-transition is-flex mb-2">
		<div class="row wrap">
			<div class="m-15col m-1col-push">
				<?php get_template_part('template-parts/blocs/bloc', 'newsletter');  ?>
			</div>

			<div class="m-8col m-1col-push">
				<a href="/programmation" class="btn-primary">voir tous les spectacles</a>
			</div>
		</div>
	</section>


	<div class="row wrap mb-2">

		<div class="m-14col">

			<section class="module-news cf mb-2">
			
				<h3 class="h_2">L'actualité</h3>
			
				<?php get_template_part('template-parts/modules/module', 'news'); ?>
			
			</section>


			<!-- Derniers articles du magazine -->
			<section class="module-lastarticles cf mb-2">

					<?php 
						$args = array(
							'post_type' 		=> 'post',
							'posts_per_page'	=> 4,
							'orderby'			=> 'post_date',
							'order' 			=> 'DESC'	
						);

						$last_posts_query = new WP_Query( $args );

						set_query_var('query', $last_posts_query);
						get_template_part('template-parts/modules/module', 'articles'); 
						wp_reset_postdata(); 
					?>

				

			</section>


		</div><!-- .col -->



		<div class="m-8col m-last">
			
			<?php 
				$services_pages = get_field('services_pages', 'option'); 
				set_query_var('pages_list', $services_pages);
				set_query_var('title', 'à votre service');
				get_template_part('template-parts/modules/module', 'pages'); 
			?>

			<?php
				$pages = get_field('home_pages', 'option'); 
				set_query_var('pages_list', $pages);
				set_query_var('title', 'avec vous');
				get_template_part('template-parts/modules/module', 'pages'); 
			?>

		</div><!-- .col -->


	</div><!-- .row -->






</div><!-- .cf -->


