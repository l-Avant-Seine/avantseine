<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */

$today = time();

?>


	<div id="main-webmag" class="cf mb-3">


					<div class="webmag-ticker ticker-wrap">
						<div class="ticker">

							<?php for ($i=0; $i < 100; $i++) { 
								if( $i % 2 === 0 ) { ?>
									<span class="ticker__item">Le magazine de l'Avant Seine !</span>
								<?php }
								else { ?>
									<span class="ticker__item red">Le magazine de l'Avant Seine !</span>
								<?php }
							} ?>	
						</div>
					</div>



				<div class="webmag-filters mb-2">
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
							        $term_list .= '<a href="' . esc_url( get_term_link( $term ) ) . '" alt="' . esc_attr( sprintf( __( 'View all post filed under %s', 'my_localization_domain' ), $term->name ) ) . '" class="postmeta-term js-postmeta-term btn-primary" cat-slug="' . $term->slug . '">' . $term->name . '</a>';
							    }
							    echo $term_list;
							}
						?>
					</div>
				</div>

				<div class=" wrap row mb-2">
					<div class="m-8col">
						<h1 class="webmag-title h_1">Allez plus loin <br> avec le magazine</h1>
					</div>
				</div>


				<div id="salgrid_2" data-columns class="webmag-grid cf wrap row">

	
						<?php
							// QUERY ALL POST
							if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
							elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
							else { $paged = 1; }

							$args = array(
								'post_type' 		=> 'post',
								'order'				=> 'DESC',
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

				</div><!-- #grid -->

				<div class="wrap">
					<?php lavantseine_paging_nav(); ?>
				</div>
				
				<?php wp_reset_postdata(); ?>

	</div><!-- #main-magazine -->


