<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package lavantseine
 */

$today = time();

?>


	<div id="main-webmag" class=" clearfix wrap">


				<div class="webmag-filters">
		
					<?php 
						$terms = get_terms( 
							'category', 
							array(
					    	'hide_empty' => false,
							)
						); 

						if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
						    $count = count( $terms );
						    $i = 0;
						    $term_list = '<p class="my_term-archive">';
						    foreach ( $terms as $term ) {
						        $i++;
						        $term_list .= '<a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '" class="get-term" cat-slug="' . $term->slug . '">' . $term->name . '</a>';
						        if ( $count != $i ) {
						            $term_list .= ' &middot; ';
						        }
						        else {
						            $term_list .= '</p>';
						        }
						    }
						    echo $term_list;
						}

					?>

				</div>


				<div id="webmag-grid" class="clearfix">
					


					<?php $exclude_ids = array(); ?>

					<div class="webmag-featured">
						<?php
							// Display last Featured Post
							$args = array(
								'post_type'		=> 'post',
								'posts_per_page' => 1,
								'meta_query' => array(
									array(
										'key' => 'postDetail_featured',
										'value' => on,
									)
								)
							);
							$featuredPost = get_posts( $args );

							foreach ( $featuredPost as $post ) : setup_postdata( $post ); ?>
								
								<?php array_push($exclude_ids, $post->ID); ?>

								<div class="featured-media">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(''); ?>
									</a>	
									<h1>le <b>Magazine</b> de l'Avant Seine</h1>
								</div>

								<div class="featured-content">
									<a href="<?php the_permalink(); ?>"><h2>
										<?php the_title(); ?>
									</h2></a>

									<div class="entry-meta">
										<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
									</div><!-- .entry-meta -->

									<?php $post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

										echo "<p>".$post_shortText. "</p>";

									?>
								</div>

							<?php endforeach; 
							wp_reset_postdata();
						?>
					</div><!-- end .featured-post -->

						<?php

							// Query events to come
							$args = array(
								'post_type' 		=> 'event',
								'posts_per_page' 	=> 1,
							   	'meta_key' => 'eventDetail_first_date',
							   	'orderby' => 'meta_value_num',
							   	'order' => 'ASC',
							   	'meta_query' => array(
							       	array(
							           'key' => 'eventDetail_first_date',
							           'value' => $today,
							           'compare' => '>=',
							        )
							    )
							);
							$nextEvent = get_posts( $args );

							foreach ( $nextEvent as $post ) : setup_postdata( $post ); ?>

								<?php array_push($exclude_ids, $post->ID); ?>
								<?php $eventRelTagTerms = wp_get_post_terms( $post->ID, 'relational_tag' ); ?>
								<?php $eventRelTag = $eventRelTagTerms[0]->slug; ?>

								<?php

									// Query events to come
									$args = array(
										'post_type' 		=> 'post',
										'posts_per_page'	=> 1,
										'tax_query' => array(
											array(
												'taxonomy' => 'relational_tag',
												'field' => 'slug',
												'terms' => $eventRelTag
											)
										),
										'orderby'			=> 'post_date',
										'order' 			=> 'DESC'	
									);
									$nextEventPost = get_posts( $args );
								?>

								<?php foreach ($nextEventPost as $post) : ?>
									<?php if($post) : ?>
									<div class="last-event-post backgrounded-box">
									<h1>le prochain <b>Spectacle</b></h1>

									<?php array_push($exclude_ids, $post->ID); ?>

									<div class="featured-content">
										<a href="<?php the_permalink(); ?>">
											<h2>
												<?php the_title(); ?>
											</h2>

										<div class="entry-meta">
											<span class="date-main">Publié le <?php the_time('d/m/Y'); ?></span>
										</div><!-- .entry-meta -->

										<div class="featured-media">
											<?php the_post_thumbnail('2col-thumbnail'); ?>
										</div>

										<?php
											$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
											echo "<p>".$post_shortText. "</p>";
										?>
										</a>
									</div><!-- .featured-content -->
									
								</div><!-- end .last-event-post -->
								<?php endif; endforeach; ?>


							<?php endforeach; 
							wp_reset_postdata();
						?>

					<div id="magazineGrid" data-columns class="last-post-list">

						<div id="categories-replaced" class="transparent-background">
							<?php //display_mag_filter_menu(); ?>
						</div>

						<?php
							// QUERY ALL POST
							if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
							elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }
							$args = array(
								'post_type' 		=> 'post',
								'order'				=> 'DESC',
								'post__not_in'		=> $exclude_ids,
								'posts_per_page'	=> '12',
								'paged'				=> $paged							
							);
							$wp_query = new WP_Query( $args );

						?>

						<?php if ( $wp_query->have_posts() ) : ?>

							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>
	 
								<?php
									get_template_part( 'template-parts/blocs/bloc', 'article' );
								?>

							<?php endwhile; ?>


						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>

						<?php endif; ?>

					</div><!-- #magazineGrid -->

					<?php lavantseine_paging_nav(); ?>
					<?php wp_reset_postdata(); ?>




				</div>

	</div><!-- #main-magazine -->


