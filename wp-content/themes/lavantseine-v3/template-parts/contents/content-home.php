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

					<div class="webmag-ticker ticker-wrap">
						<div class="ticker">

							<?php for ($i=0; $i < 50; $i++) { 
								if( $i % 2 === 0 ) { ?>
									<span class="ticker__item">Bienvenue !</span>
								<?php }
								else { ?>
									<span class="ticker__item red">Bienvenue !</span>
								<?php }
							} ?>	
						</div>
					</div>

	<!-- Focus -->
	<div class="row">

		<?php get_template_part('template-parts/modules/module', 'focus'); ?>

	</div>


	<section class="section-transition is-flex mb-2">
		<div class="row wrap">
			<div class="m-16col m-1col-push is-centered text-on-center">
				<a href="/programmation" class="btn-primary--big">voir tous les spectacles</a>
			</div>
		</div>
	</section>


	<div class="row wrap mb-2 is-relative">

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
			
			<div class="services-outer">
				<a href="#" id="js-toggle-services" class="btn-toggle m-hide">
					<span class=""></span>À votre service !
				</a>
				<?php 
					$services_pages = get_field('services_pages', 'option'); 
					set_query_var('pages_list', $services_pages);
					set_query_var('title', 'À votre service');
					set_query_var('icons', true);
					get_template_part('template-parts/modules/module', 'pages'); 
				?>
			</div>

			<?php
				$pages = get_field('home_pages', 'option'); 
				set_query_var('pages_list', $pages);
				set_query_var('title', 'Avec vous');
				get_template_part('template-parts/modules/module', 'pages'); 
			?>

		</div><!-- .col -->


	</div><!-- .row -->






</div><!-- .cf -->


