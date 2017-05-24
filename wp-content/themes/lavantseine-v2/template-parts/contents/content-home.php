<?php
/**
 * Template part for displaying page content in page-home.php
 *
 * @package l\'Avant-Seine_v2.0
 */

?>


<div class="clearfix">
	

	<!-- Focus -->
	<?php get_template_part('template-parts/modules/module', 'focus'); ?>


	
	<div id="" class="clearfix wrap row">

		<!-- Spectacle à venir -->
		<div class="m-6col">
			<?php 
				$args = array(
					'post_type' 		=> 'event',
					'posts_per_page'	=> 4,
					'orderby'			=> 'post_date',
					'order' 			=> 'DESC'	
				);

				$last_events = get_posts( $args );
				set_query_var('last_events', $last_events);
				get_template_part('template-parts/modules/module', 'events'); 
				wp_reset_postdata(); 
			?>

			<a href="/programmation" class="btn is-centered">Voir toute la programmation</a>
		</div>


		<!-- Carde à votre service -->
		<div class="module-service m-2col is-on-right">
		<?php 
			$services_pages = get_field('services_pages', 'option'); 
			set_query_var('services_pages', $services_pages);
			get_template_part('template-parts/modules/module', 'services'); 
		?>

		</div>
	</div>


	<!-- Pages -->
	<div id="" class="clearfix">
		<?php
			$pages = get_field('home_pages', 'option'); 
			set_query_var('pages_list', $pages);
			get_template_part('template-parts/modules/module', 'pages'); 
		?>
	</div>


	<!-- Derniers articles du magazine -->
	<div id="" class="clearfix wrap module-lastArticles">

		<?php 
			$args = array(
				'post_type' 		=> 'post',
				'posts_per_page'	=> 6,
				'orderby'			=> 'post_date',
				'order' 			=> 'DESC'	
			);

			$last_posts = get_posts( $args );

			set_query_var('posts_list', $last_posts);
			get_template_part('template-parts/modules/module', 'articles'); 
			wp_reset_postdata(); 
		?>

		<a href="/magazine" class="btn">Voir tous les articles du magazine</a>
	
	</div>


</div>
