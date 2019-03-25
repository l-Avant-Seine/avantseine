<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */

$today = time();

?>


	<div id="main-webmag" class="clearfix">


				<div class="webmag-title wrap">
						<h1 class="h1">Le Magazine<br> de l'Avant Seine</h1>

				</div>

				<div class="webmag-filters webmag-layer">
					<div class="wrap">
						<?php 
							$terms = get_terms( 
								'category', 
								array(
						    	'hide_empty' => false,
						    	'exclude'	=> array('1'),
								)
							); 

							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
							    $term_list = '';
							    foreach ( $terms as $term ) {
							        $term_list .= '<a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '" class="postmeta-term js-postmeta-term" cat-slug="' . $term->slug . '">' . $term->name . '</a>';
							            
							    }
							    echo $term_list;
							}

						?>
					</div>
				</div>


				<div id="webmag-mainGrid" class="webmag-layer clearfix wrap">

					<?php $exclude_ids = array(); ?>

					<?php if( !isset($_GET['tag']) && !isset($_GET['relational_tag']) ) : ?>

					<div class="webmag-featured webmag-layer row is-flex">
						<?php
							// Display last Featured Post
							$args = array(
								'post_type'		=> 'post',
								'posts_per_page' => 1,
								'meta_query' => array(
									array(
										'key' => 'postDetail_featured',
										'compare' => '==',
											'value' => '1'
									)
								),
								'orderby'			=> 'post_date',
								'order' 			=> 'DESC'	
							);
							$featuredPost = get_posts( $args );

							foreach ( $featuredPost as $post ) : setup_postdata( $post ); ?>
								
								<?php array_push($exclude_ids, $post->ID); ?>

								<div class="featured-media m-5col m-first">
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail(''); ?>
									</a>	
								</div>

								<div class="featured-content m-3col">

									<div class="featured-meta">
										<span class="meta-date"><?php the_time('d/m/Y'); ?></span>
									</div>

									<a href="<?php the_permalink(); ?>">
										<h2 class="h2">
											<?php the_title(); ?>
											<br><span class="title-diamond">&#x02666;</span>
										</h2>
									</a>

									<?php $post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

										echo "<p>".$post_shortText. "</p>";

									?>
								</div>

							<?php endforeach; 
							wp_reset_postdata();
						?>
					</div><!-- end .featured-post -->

				<?php endif; ?>



					<div id="webmag-innergrid" data-columns class="row">

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
								'paged'				=> $paged,						
							);

 							if( isset($_GET['tag']) ) : 
								$args['arborescence'] = $_GET['tag'];
							endif;

 							if( isset($_GET['relational_tag']) ) : 
								$args['relational_tag'] = explode(' ', $_GET['relational_tag']);
							endif;

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


