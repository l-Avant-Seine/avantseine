<?php
/**
 * Template Name: Archives Saisons
 *
 * @package lavantseine
 */

$saisons = get_terms( array(
    'taxonomy'   => 'saison',
	'order'	=> 'ASC',
    'hide_empty' => true,
) );

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
$today = time();

?>


	<div class="archives_saisons">

		<div class="">
			
				<?php

					foreach( $saisons as $saison ) : ?>
						<section class="archives_group">

							<div class="group_title">
								<a class="wrapper --block">
									<h2 class="h1_3">
										<span>Saison <?php echo $saison->name; ?></span>
                        				<?php get_template_part('Components/svgs/svg', 'arrow'); ?>
								 	</h2>
								</a>
							</div>

							<div class="group_list ">

								<?php $previous_month = false;

								$args = array(
									'post_type' 			=> 'event',
									'posts_per_page' 		=> '-1',
									'post_status'			=> 'publish', 
									'meta_key' => 'eventDetail_first_date',
									'orderby' => 'meta_value_num',
									'order' => 'ASC',
									'tax_query' => array(
										array(
											'taxonomy' => 'saison',
											'field' => 'slug', 
											'terms' => array( $saison->slug ),
										),
									),
								);


								$query = new WP_Query( $args );
								$posts_found = $query->found_posts;

								set_query_var('query', $query);
								set_query_var('previous_month', $previous_month);
								get_template_part('Components/loops/loop', 'events'); ?>

							</div>

						</section>

					
					<?php endforeach; ?>


		</div><!-- .row -->

</div>



		

