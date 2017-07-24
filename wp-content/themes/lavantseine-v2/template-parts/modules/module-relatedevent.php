<?php

	// Remontée des événements puis des articles liés à l'événement en cours.
	global $post; // for current $post backup
	
	$backup = $post;  // backup the current object
	$taxonomy = $taxo; 
	$param_type = $taxo;
	$tax_args = array('orderby' => 'none' );

	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					$today = time();


	if ( !empty($tags) ) {
			
			echo '<h3 class="h4">à voir sur <br>scène <br><span class="title-diamond">&#x02666;</span></h3>';

			$tag_slug = $tags[0]->slug;

			// STAR POST
			$star_event = new WP_Query(array(
				"$param_type" 			=> $tag_slug,
				'post_status'    => 'publish',
				'post_type' 			=> 'event',
				'posts_per_page'	=> 1,
				'order' 					=> 'DESC',
			));


			 if ( $star_event->have_posts() ) : 
			 	while ( $star_event->have_posts() ) : $star_event->the_post(); 
			 		$event_dealer_link = get_field( 'eventDetail_dealer-link' ); ?>
				<div class="relatedPost star">
					<div class="relatedPost-media">
						<?php the_post_thumbnail(); ?>					
					</div>
					
					<span class="relatedPost-date meta-date">
						<?php the_time('D d M Y'); ?>
					</span>

					<h4 class="h3 relatedPost-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
					
					<div class="relatedPost-text">
						<?php 
							$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
							echo "<p>".$post_shortText. "</p>"; 
						?>
					</div>

					<div class="clearfix"><a href="<?php the_permalink(); ?>" class="btn--big bordered"><span class="icon-arrow-right"></span>en savoir plus</a></div>
					<div class="clearfix">
						<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn--big black">Acheter mes places</a>
					</div>
					
				</div>
			<?php endwhile; 
			wp_reset_postdata();
			endif; 



	} else {

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

			echo '<h3 class="h4">le prochain <br>spectacle <br><span class="title-diamond">&#x02666;</span></h3>';


			 if ( $next_event->have_posts() ) : 
			 	while ( $next_event->have_posts() ) : $next_event->the_post(); ?>
				<div class="relatedPost star">
					<div class="relatedPost-media">
						<?php the_post_thumbnail(); ?>
						<?php 
							$terms = wp_get_post_terms( $post->ID, array('category') );
							$count = count($terms);
							if ( $count > 0 ){
							    echo "<ul class='no-bullets'>";
							    foreach ( $terms as $term ) {
							    	$term_link = get_term_link( $term, '' );
								    echo "<a href='". $term_link ."'><li class='postmeta-term'>" . $term->name . "</li></a><br>";
							    }
							    echo "</ul>";
							}
						?>						
					</div>
					
					<span class="relatedPost-date meta-date">Publié le <?php the_time('d/m/Y'); ?></span>
					<h4 class="h3 relatedPost-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
					<div class="relatedPost-text">
						<?php 
							$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
							echo "<p>".$post_shortText. "</p>"; 
						?>
					</div>

					<div class="clearfix"><a href="<?php the_permalink(); ?>" class="btn--big bordered"><span class="icon-arrow-right"></span>en savoir plus</a></div>
					<div class="clearfix">
						<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn--big black">Acheter mes places</a>
					</div>
					
				</div>
			<?php endwhile; 
			wp_reset_postdata();
			endif; 

	}
?>
