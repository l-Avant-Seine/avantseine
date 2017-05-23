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
			
			<form action="" id="progFilter-form" class="">

				<div class="switch">
					<p>passés</p>
				  <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" <?php if( !isset($_GET['is_archives']) ) : echo 'checked=""'; endif; ?> name="is_archives" type="checkbox">
				  <label for="cmn-toggle-1">à venir</label>
				  <p>à venir</p>
				</div>

				<?php custom_taxonomy_dropdown('discipline', 'date', 'DESC', '', 'discipline', 'Quelle discipline ?', ''); ?>
				<?php custom_taxonomy_dropdown('rdv', 'date', 'DESC', '', 'rdv', 'Quel type d\'événement ? ', ''); ?>
				<?php custom_taxonomy_dropdown('public', 'date', 'DESC', '', 'public', 'A partir de quel âge ?', ''); ?>
				<?php //custom_taxonomy_dropdown('saison', 'date', 'DESC', '', 'saison', 'Select All', ''); ?>
				<?php custom_taxonomy_dropdown('tarif', 'date', 'DESC', '', 'tarif', 'Quel tarif ?', ''); ?>

				<input type="submit" value="Ok">

			</form>

		</div>
		

		<div id="prog-grid" class="prog-grid wrap">

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
					
					set_query_var('query', $query);
					set_query_var('previous_month', $previous_month);
					get_template_part('template-parts/loops/loop', 'events');
				?>


			</div><!-- end .events-grid -->


		<a class="load-more btn" href="#">load more</a>

