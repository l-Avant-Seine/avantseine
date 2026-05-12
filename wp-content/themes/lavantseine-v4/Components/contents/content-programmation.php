<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */

?>


	<div id="main-agenda" class="cf mb-3">

		<?php if( ! is_archive()) : ?>
			<div class="">
				<?php get_template_part('Components/modules/module', 'calendar', array( 'title' => 'À venir', 'context' => 'programmation' )); ?>
			</div>
		<?php endif; ?>

		<?php get_template_part('Components/modules/module', 'progtitle'); ?>


		<div id="agenda-maingrid" class="row">
			
				<?php
					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					$today = time();
					$previous_month = false;

					$args = array(
					   	'post_type' 			=> 'event',
						'posts_per_page' 	=> '-1',
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

			    if ( is_tax() ) {
			    	if( isset($discipline) ) {
							$args['tax_query'] = array(
								'relation' => 'OR',
				        array(
				            'taxonomy' => 'discipline',
				            'field' => 'slug',
				            'terms' => $discipline
				        ),
				      );
				    }
			    }

					$query = new WP_Query( $args );
					$posts_found = $query->found_posts;

					set_query_var('query', $query);
					set_query_var('previous_month', $previous_month);
					get_template_part('Components/loops/loop', 'events');
				?>


		</div><!-- .row -->


</div>



		

