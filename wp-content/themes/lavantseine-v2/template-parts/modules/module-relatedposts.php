<?php

	// Remontée des événements puis des articles liés à l'événement en cours.
	global $post; // for current $post backup
	
	$backup = $post;  // backup the current object
	$taxonomy = $taxo; 
	$param_type = $taxo;
	$tax_args = array('orderby' => 'none' );

	$tags = wp_get_post_terms( $post->ID , $taxonomy, $tax_args);

	if( !empty($tags) ) {
		$tag_slug = $tags[0]->slug;
		$tag_count = $tags[0]->count;
	}

	if ( !empty($tag_slug) && $tag_count > 1 ) {
			
			// STAR POST
			$star_post = new WP_Query(array(
				"$param_type" 			=> $tag_slug,
				'post_status'    => 'publish',
				'post_type' 			=> 'post',
				'posts_per_page'	=> 1,
				'order' 					=> 'DESC',
				'meta_query' => array(
					array(
						'key' => 'star_article',
						'compare' => '==',
						'value' => '1'
					)
				)
			));


			 if ( $star_post->have_posts() ) : 

				echo '<h3 class="h4">autour du <br>spectacle <br><span class="title-diamond">&#x02666;</span></h3>';

			 	while ( $star_post->have_posts() ) : $star_post->the_post(); ?>
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
				</div>
			<?php endwhile; 
			wp_reset_postdata();
			endif; 


			// OTHER POSTS
			$other_posts = new WP_Query(array(
				"$param_type" 			=> $tag_slug,
				'post_type' 			=> 'post',
				'posts_per_page'	=> 2,
				'order' 					=> 'DESC',
				'meta_query' => array(
					'relation'	=> 'OR',
					array(
						'key' => 'star_article',
						'compare' => '==',
						'value' => '0'
					),
					array(
						'key' => 'star_article',
						'compare' => 'NOT EXISTS'
					)
				)
			));

 			if ( $other_posts->have_posts() ) : 
			 	while ( $other_posts->have_posts() ) : $other_posts->the_post(); ?>
					<div class="relatedPost">
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

						if( is_paged()) {
							echo 'paged ! ';
						}
					?>

					<div class="entry-meta">
						<span class="meta-date">Publié le <?php the_time('d/m/Y'); ?></span>
					</div><!-- .entry-meta -->
					<h4 class="h3 relatedPost-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
					<?php 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p>".$post_shortText. "</p>"; 
					?>
				</div>
			<?php endwhile; 
			$found_posts = $other_posts->found_posts;
			$max_pages = $other_posts->max_num_pages;

			if( $found_posts > $max_pages) : ?>
				<a href="/magazine/?taxo=<?php echo $tag_slug; ?>" class="btn--big bordered"><span class="icon-arrow-right"></span>Voir tous les articles</a>
			<?php endif; 

			wp_reset_postdata();
			endif; 


	} else {
	
			echo '<h3 class="h4">l\'actualité de <br>l\'Avant-Seine <br><span class="title-diamond">&#x02666;</span></h3>';

			// OTHER POSTS
			$default_posts = new WP_Query(array(
				'post_type' 			=> 'post',
				'posts_per_page'	=> 3,
				'order' 					=> 'DESC',
			));

 			if ( $default_posts->have_posts() ) : 
			 	while ( $default_posts->have_posts() ) : $default_posts->the_post(); ?>
					<div class="relatedPost">
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

						if( is_paged()) {
							echo 'paged ! ';
						}
					?>

					<div class="entry-meta">
						<span class="meta-date">Publié le <?php the_time('d/m/Y'); ?></span>
					</div><!-- .entry-meta -->
					<h4 class="h3 relatedPost-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h4>
					<?php 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p>".$post_shortText. "</p>"; 
					?>
				</div>
			<?php endwhile; 
			$found_posts = $default_posts->found_posts;
			$max_pages = $default_posts->max_num_pages;

			if( $found_posts > $max_pages) : ?>
				<a href="/magazine/?taxo=<?php echo $tag_slug; ?>" class="btn--big bordered-black"><span class="icon-arrow-right"></span>voir tous les articles</a>
			<?php endif; 

			wp_reset_postdata();
			endif; 



	}
		?>

