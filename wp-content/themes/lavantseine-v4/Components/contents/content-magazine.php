<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */

$today = time();
$term_queried = get_queried_object();
?>


	<?php get_template_part('Components/modules/module', 'flexibles'); ?>

			

	<div id="main-webmag" class="archives_magazine">


			<div class="mb-medium wrapper">
				<div class="mod_title">
                    <h2 class="h2_3">Tous les articles <?php echo $term_queried->name; ?></h2>
                </div>
			</div>


				<div class="webmag-filters mb-large">
					<div class="wrapper">

						<div class="flex --gap-xs --wrap">
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

									if ( is_category() ) {
										$term_list .= '<a href="/magazine" alt="" class="tag">Voir tous les articles</a>';
									}

									foreach ( $terms as $term ) {
										if ( $term_queried->term_id == $term->term_id ) $class = "tag active";
										else $class = "tag ";
										
										$term_list .= '<a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '" class="' . $class . '" cat-slug="' . $term->slug . '">' . $term->name . '</a>';
									}
									echo $term_list;
								}
							?>
						</div>
					</div>
				</div>


				<div id="" class="webmag-grid grid wrapper">

	
						<?php
						
							// QUERY ALL POST
							if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
							elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }

							if ( ! is_category() ) : 
								$args = array(
									'post_type' 		=> 'post',
									'order'				=> 'DESC',
									'posts_per_page'	=> '12',
									'paged'				=> $paged,						
								);

								$wp_query = new WP_Query( $args );

							endif; 
						?>

						<?php if ( $wp_query->have_posts() ) : ?>

							<?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); ?>

								<div class="s_8col m_4col l_3col">
									<?php get_template_part( 'Components/blocs/bloc', 'magazine' ); ?>
								</div>
							<?php endwhile; ?>


						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>

						<?php endif; ?>

				</div><!-- #grid -->

				<div class="wrap">
					<?php lavantseine_paging_nav(); ?>
				</div>
				
				<?php wp_reset_postdata(); ?>

	</div><!-- #main-magazine -->


