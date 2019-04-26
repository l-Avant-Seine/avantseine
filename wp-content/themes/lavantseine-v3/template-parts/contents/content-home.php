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
	<div class="row mb-3">

		<?php 
			get_template_part('template-parts/modules/module', 'focus'); 
		?>

	</div>


	<div class="row wrap mb-2">

		<div class="m-15col">
			<?php get_template_part('template-parts/blocs/bloc', 'newsletter');  ?>
		</div>

		<div class="m-8col m-1col-push">
			<a href="/programmation" class="btn-primary">voir tous les spectacles</a>
		</div>

	</div>


	<div class="row wrap mb-2">

		<div class="m-14col">

			<?php get_template_part('template-parts/modules/module', 'news'); ?>

			<!-- Derniers articles du magazine -->
			<section class="cf">

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

				<div class="module-actions">
					<a href="/magazine" class="btn-primary is-centered">voir tous les articles</a>
				</div>

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


