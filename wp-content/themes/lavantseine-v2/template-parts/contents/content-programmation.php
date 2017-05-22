<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */

function custom_taxonomy_dropdown( $taxonomy, $orderby = 'date', $order = 'DESC', $limit = '-1', $name, $show_option_all = null, $show_option_none = null  ) {

		$args = array(
			'orderby' => $orderby,
			'order' => $order,
			'number' => $limit,
		);
		$terms = get_terms( $taxonomy, $args );
		$name = ( $name ) ? $name : $taxonomy;
		if ( $terms ) {
			printf( '<select name="%s" class="postform">', esc_attr( $name ) );
			if ( $show_option_all ) {
				printf( '<option value="0">%s</option>', esc_html( $show_option_all ) );
			}
			if ( $show_option_none ) {
				printf( '<option value="-1">%s</option>', esc_html( $show_option_none ) );
			}
			foreach ( $terms as $term ) {
				printf( '<option value="%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
			}
			print( '</select>' );
		}


}


?>



		<div class="prog-filters">
			
			<form action="" id="" class="">

				<div class="switch">
					<p>passés</p>
				  <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" <?php if( isset($_GET['is_archives']) ) : echo 'checked'; endif; ?> name="is_archives" type="checkbox">
				  <label for="cmn-toggle-1">à venir</label>
				  <p>à venir</p>
				</div>

				<?php custom_taxonomy_dropdown('discipline', 'date', 'DESC', '', 'my_custom_taxonomy', 'Select All', 'Select None'); ?>
				<?php custom_taxonomy_dropdown('rdv', 'date', 'DESC', '', 'my_custom_taxonomy', 'Select All', 'Select None'); ?>
				<?php custom_taxonomy_dropdown('public', 'date', 'DESC', '', 'my_custom_taxonomy', 'Select All', 'Select None'); ?>
				<?php custom_taxonomy_dropdown('saison', 'date', 'DESC', '', 'my_custom_taxonomy', 'Select All', 'Select None'); ?>
				<?php custom_taxonomy_dropdown('tarif', 'date', 'DESC', '', 'my_custom_taxonomy', 'Select All', 'Select None'); ?>

				<input type="submit" value="Ok">

			</form>

		</div>
		

		<div class="prog-grid wrap">

				<?php
					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					$today = time();
					$previous_month = false;

					$args = array(
					   	'post_type' => 'event',
							'posts_per_page' => '6',   
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

					$query = new WP_Query( $args );
				?>

				<?php if ( $query->have_posts() ) : ?>

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php
							// Month Test
							$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
							$month = date( 'Y/m', $event_first_date );

							// Test month of event. Display Month Date
							if ( $previous_month != $month ):
								?>
								<div class="box-month" data-date="<?php print strtotime($month.'/01') ?>">
									<h2 class="entry-title">
										<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
									</h2>
								</div><!-- .box-month -->
								<?php
								$previous_month = $month;
							endif;
						?> <!-- end month test -->

						<?php get_template_part( 'template-parts/blocs/bloc', 'event' ); ?>

					<?php endwhile; ?>

					

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>
			</div><!-- end .events-grid -->


		<a class="load-more btn" href="#">load more</a>

