<?php

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();

	// Remontée des événements puis des articles liés à l'événement en cours.
	global $post; // for current $post backup

	$backup = $post;  // backup the current object
	$taxonomy = $taxo; 
	$param_type = $taxo;
	$tax_args = array('orderby' => 'none' );

	$arborescence = wp_get_post_terms($post->ID , 'arborescence', $tax_args);
	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

	// var_dump($arborescence);
	// var_dump($tags);

	if ( !empty($tags) ) {
			
			$tag_slug = $tags[0]->slug;

			// STAR POST
			$star_event = new WP_Query(array(
				"$param_type" 			=> $tag_slug,
				'post_status'    		=> 'publish',
				'post_type' 			=> 'event',
				'posts_per_page'		=> 1,
				'order' 				=> 'DESC',
			));


			 if ( $star_event->have_posts() ) : 
			 	while ( $star_event->have_posts() ) : $star_event->the_post(); 
			 		$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
					$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
					$event_other_dates = get_field('eventDetail_otherdates');

			 		$event_dealer_link = get_field( 'eventDetail_dealer-link' ); ?>

						<?php get_template_part('Components/blocs/bloc', 'event', array('post' => $post->ID)); ?>

			<?php endwhile; 
			wp_reset_postdata();
			endif; 

	} 

	elseif ( !empty($arborescence) ) {

			$arborescence_page = new WP_Query(array(
				'post_status'    	=> 'publish',
				'post_type' 			=> 'page',
				'posts_per_page'	=> 1,
				// 'tax_query' => array(
				// 	array( 
				// 		'taxonomy' => 'arborescence',
				// 		'field'    => 'term_id',
				// 		'terms'    => $arborescence[0]->term_id,
				// 	),
				// ),
			));

				if ( $arborescence_page->have_posts() ) : 
				 	while ( $arborescence_page->have_posts() ) : $arborescence_page->the_post(); ?>
						<?php get_template_part('Components/blocs/bloc', 'event'); ?>
				<?php endwhile; 
				wp_reset_postdata();
				endif; 
	}

	else {

			// next_event
			$next_event = new WP_Query(array(
				'post_status'    => 'publish',
				'post_type' 			=> 'event',
				'posts_per_page'	=> 1,
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
			));


			 if ( $next_event->have_posts() ) : 
			 	while ( $next_event->have_posts() ) : $next_event->the_post(); ?>
						<?php get_template_part('Components/blocs/bloc', 'event'); ?>

			<?php endwhile; 
			wp_reset_postdata();
			endif; 

	}
?>
