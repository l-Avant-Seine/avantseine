<?php

	global $post;
	$backup = $post;

	$taxonomy = $relational_tag; 
	$param_type = $relational_tag;

	$tax_args = array('orderby' => 'none' );

	$relational_tags_slug = array();
	$arborescence_tags_slug = array();

	$relational_tags = wp_get_post_terms( $post->ID , $relational_tag, $tax_args);
	$arborescence_tags = wp_get_post_terms( $post->ID , $arborescence, $tax_args);

	foreach ($relational_tags as $tag) {
		$relational_tags_slug[] = $tag->slug;
	}
	foreach ($arborescence_tags as $tag) {
		$arborescence_tags_slug[] = $tag->slug;
	}

	$relational_tags_slug_string = implode(',', $relational_tags_slug);
	$arborescence_tags_slug_string = implode(',', $arborescence_tags_slug);



			$other_posts = new WP_Query(array(
				"$param_type" 			=> $relational_tags_slug_string,
				'post_status'				=> 'publish',
				'post_type' 			=> 'post',
				'posts_per_page'	=> 3,
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

			// STAR POST
			$star_post = new WP_Query(array(
				"$param_type" 			=> $relational_tags_slug_string,
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



// Il y a un tag relationnel et des posts liés

	if ( ( $other_posts->have_posts() || $star_post->have_posts() ) && !empty($relational_tags_slug) ) {

			
			echo '<h3 class="h_2">Allez plus loin avec le magazine </h3>';

			 if ( $star_post->have_posts() ) :

			 	while ( $star_post->have_posts() ) : $star_post->the_post(); ?>

					<?php get_template_part('template-parts/blocs/bloc', 'article'); ?>	 

			<?php endwhile; 
			wp_reset_postdata();

			endif; 


			// OTHER POSTS


			$k = 0;

 			if ( $other_posts->have_posts() ) : 
			 	while ( $other_posts->have_posts() ) : $other_posts->the_post(); ?>

			 		<?php if ( !$star_post->have_posts() ) : ?>

						<?php if( $k === 0 ) : ?>
							<?php get_template_part('template-parts/blocs/bloc', 'article'); ?>	 

						<?php else : ?>
							<?php get_template_part('template-parts/blocs/bloc', 'article'); ?>	 

					<?php endif; ?>
				<?php endif; ?>
				
			<?php 
				$k++;
				endwhile; 
				$found_posts = $other_posts->found_posts;
				$max_pages = $other_posts->max_num_pages;

			if( $found_posts > $max_pages) : ?>
				<a href="/magazine/?relational_tag=<?php echo $relational_tags_slug_string; ?>" class="btn-primary mb-2">voir tous les articles liés au spectacle</a>
			<?php endif; 

			wp_reset_postdata();
			endif; 


	} 




// Il n'y a pas de tag relationnel, mais il y a une page (taxo arborescence)


	elseif( isset($arborescence_tags_slug) && !empty($arborescence_tags_slug) ) {

			$arbo_pages = new WP_Query(array(
				'post_type' 				=> 'page',
				'posts_per_page'		=> 1,
				'order' 						=> 'DESC',
				'post_status'				=> 'publish',
				'arborescence'	=> $arborescence_tags_slug
			));

 			if ( $arbo_pages->have_posts() ) : 
			 	while ( $arbo_pages->have_posts() ) : $arbo_pages->the_post();

			 		echo '<div class="put-on-1col">';
						set_query_var('icons', false);
						get_template_part('template-parts/blocs/bloc', 'page');
					echo '</div>';
				endwhile;
			endif;

	}



// Il n'y a ni tag relationnel, ni tag arborescence

	elseif(false) {
	
			echo '<h3 class="h_4">Allez plus loin avec le magazine </h3>';

			// OTHER POSTS
			$default_posts = new WP_Query(array(
				'post_type' 			=> 'post',
				'posts_per_page'	=> 3,
				'order' 					=> 'DESC',
				'post_status'				=> 'publish',
			));

			$j = 0; 

 			if ( $default_posts->have_posts() ) : 
			 	while ( $default_posts->have_posts() ) : $default_posts->the_post();?>


					<?php if( $j === 0 ) : ?>

						<div class="">
							<div class="">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
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
							
							<!-- <span class="relatedPost-date meta-date">Publié le <?php //the_time('d/m/Y'); ?></span> -->
							<h4 class="h_3">
								<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
							</h4>
							
							<div class="">
								<?php 
									$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
									echo "<div class='mb-05'>".$post_shortText. "</div>"; 
								?>
							</div>

							<a href="<?php the_permalink(); ?>" class="btn-inline">en savoir plus</a>

						</div>

					<?php else : ?>


					<div class="">
					<?php 
						$terms = wp_get_post_terms( $post->ID, array('category') );
						$count = count($terms);
						if ( $count > 0 ){
						    echo "<ul class='no-bullets'>";
						    foreach ( $terms as $term ) {
						    	//$term_link = get_term_link( $term, '' );
							    echo "<li class='postmeta-term'>" . $term->name . "</li><br>";
						    }
						    echo "</ul>";
						}

						if( is_paged()) {
							//echo 'paged ! ';
						}
					?>

					<h4 class="h_3">
						<a href="<?php the_permalink(); ?>"><?php the_title() ?></a>
					</h4>

					<?php 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<div class='mb-05'>".$post_shortText. "</p>"; 
					?>

					<a href="<?php the_permalink(); ?>" class="btn-inline">en savoir plus</a>
					
				</div>

			<?php 
				endif;
				$j++;

				endwhile; 
				$found_posts = $default_posts->found_posts;
				$max_pages = $default_posts->max_num_pages;

			if( $found_posts > $max_pages) : ?>
				<a href="/magazine/?relational_tag=<?php echo $tag_slug; ?>" class="btn-primary">voir tous les articles</a>
			<?php endif; 

			wp_reset_postdata();
			endif; 



	}
		?>

