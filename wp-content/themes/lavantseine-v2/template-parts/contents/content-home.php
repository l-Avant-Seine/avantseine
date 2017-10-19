<?php
/**
 * Template part for displaying page content in page-home.php
 *
 * @package l\'Avant-Seine_v2.0
 */

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();
?>


<div class="clearfix">
	

	<!-- Focus -->
	<div id="" class="layer">
		<?php get_template_part('template-parts/modules/module', 'focus'); ?>
	</div>

	
	<div id="" class="layer clearfix wrap row">

		<!-- Spectacle à venir -->
		<div class="m-6col">
			<?php 
				$args = array(
					'post_type' 			=> 'event',
					'posts_per_page' 	=> '4',
					'post_status'			=> 'publish', 
					'meta_key' => 'eventDetail_first_date',
					'orderby' => 'meta_value_num',
					'order' => 'ASC',
					'meta_query' => array(
					   	array(
					       'key' => 'eventDetail_last_date',
					       'value' => $today,
					       'compare' => '>=',
					    )
					)
				);

				$last_events = get_posts( $args );
				set_query_var('last_events', $last_events);
				get_template_part('template-parts/modules/module', 'events'); 
				wp_reset_postdata(); 
			?>
			
			<div class="row">
				
				<div class="m-3col">
					<div class="module-actions goto">
						<a href="/programmation" class="btn--big is-centered">Voir toute la programmation</a>
					</div>
				</div>

				<div class="m-3col">

					<?php get_template_part('template-parts/blocs/bloc', 'newsletter');  ?>
				
				</div>

			</div>
			
		</div>


		<!-- Carde à votre service -->
		<div class="m-2col is-on-right">
		<?php 
			$services_pages = get_field('services_pages', 'option'); 
			set_query_var('services_pages', $services_pages);
			get_template_part('template-parts/modules/module', 'services'); 
		?>

		</div>
	</div>



<!-- 	<div class="layer">

		<div class="footer-newsletter">
			<div class="wrap">
				
				<aside id="wp_mailjet_subscribe_widget-2" class="widget-7 widget-odd box-sidebar widget WP_Mailjet_Subscribe_Widget">
				<h1 class="footer-title">la Newsletter</h1>
        <form class="subscribe-form">
                                                                        
            <input id="email" name="email" placeholder="votre@email.com" autocomplete="off" type="text">
            <input name="list_id" value="568010" type="hidden">
            <input name="action" value="mailjet_subscribe_ajax_hook" type="hidden">
            <input name="submit" class="mailjet-subscribe btn--big" value="S'inscrire" type="submit">
        </form>
        <div class="response"></div>
        </aside>


			</div>
		</div>

	</div> -->



	<!-- Pages -->
	<div id="" class="layer clearfix">
		<?php
			$pages = get_field('home_pages', 'option'); 
			set_query_var('pages_list', $pages);
			get_template_part('template-parts/modules/module', 'pages'); 
		?>
	</div>


	<!-- Derniers articles du magazine -->
	<section id="" class="layer clearfix wrap">

			<?php 
				$args = array(
					'post_type' 		=> 'post',
					'posts_per_page'	=> 8,
					'orderby'			=> 'post_date',
					'order' 			=> 'DESC'	
				);

				$last_posts_query = new WP_Query( $args );

				set_query_var('query', $last_posts_query);
				get_template_part('template-parts/modules/module', 'articles'); 
				wp_reset_postdata(); 
			?>

		<div class="module-actions">
			<a href="/magazine" class="btn--big is-centered">Voir tous les articles du magazine</a>
		</div>

	</section>


</div>
