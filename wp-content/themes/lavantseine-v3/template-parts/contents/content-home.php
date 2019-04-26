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
	<div id="" class="layer">
		<?php 
			global $focus_event_id;
			set_query_var('focus_event_id', $focus_event_id);
			get_template_part('template-parts/modules/module', 'focus'); 
		?>
	</div>


	<div class="row">

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
				set_query_var('services_pages', $services_pages);
				get_template_part('template-parts/modules/module', 'services'); 
			?>

			<?php
				$pages = get_field('home_pages', 'option'); 
				set_query_var('pages_list', $pages);
				get_template_part('template-parts/modules/module', 'pages'); 
			?>

		</div><!-- .col -->


	</div><!-- .row -->



	<?php get_template_part('template-parts/blocs/bloc', 'newsletter');  ?>



</div><!-- .cf -->


