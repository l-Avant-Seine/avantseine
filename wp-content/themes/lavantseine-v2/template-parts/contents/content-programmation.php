<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */
?>


		<div class="prog-pagetitle">
			
			<div class="wrap">
				<h1 class="h1">La programmation<br>
				<span id="archives">à venir</span></h1>
			</div>

		</div>


		<div class="prog-filters">
			
			<form action="" id="progFilter-form" class="">

				<div class="progFilterForm-upper">

					<div class="wrap">
						<?php custom_taxonomy_dropdown('discipline', 'date', 'DESC', '', 'discipline', 'Quelle discipline ?', ''); ?>
						<?php custom_taxonomy_dropdown('rdv', 'date', 'DESC', '', 'rdv', 'Quel type d\'événement ? ', ''); ?>
						<?php custom_taxonomy_dropdown('public', 'date', 'DESC', '', 'public', 'A partir de quel âge ?', ''); ?>
						<?php custom_taxonomy_dropdown('tarif', 'date', 'DESC', '', 'tarif', 'Quel tarif ?', ''); ?>

						<div class="switch">
							<span>passés</span>
						  <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" <?php if( !isset($_GET['is_archives']) ) : echo 'checked=""'; endif; ?> name="is_archives" type="checkbox">
						  <label for="cmn-toggle-1"></label>
						  <span>à venir</span>
						</div>
					</div>

				</div>

				<div class="progFilterForm-lower clearfix">
					<div class="wrap">
						<?php custom_taxonomy_list('saison', 'date', 'DESC', '', 'saison', 'Toutes les saisons passées'); ?>
					</div>
				</div>

<!-- 				<input type="submit" value="Ok">
 -->
			</form>

		</div>
		

		<div class="row_alt">
						<div class="m-2coll m-last prog-aside">

							<div class="offset-right is-relative">
								<h3 class="h2">La <br>brochure</h3>
							</div>

							<div class="offset-right is-relative">	
								<h3 class="h2">cette <br>semaine</h3>
							</div>

						</div>
</div>

		<div class="prog-grid wrap">

				<?php
					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					$today = time();
					$previous_month = false;

					$args = array(
					   	'post_type' 			=> 'event',
							'posts_per_page' 	=> '12',
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

					$query = new WP_Query( $args );
					$posts_found = $query->found_posts;
					
					set_query_var('query', $query);
					set_query_var('previous_month', $previous_month);
					get_template_part('template-parts/loops/loop', 'events');
				?>


		</div><!-- end .events-grid -->


		<div class="wrap">
			<a class="load-more btn" href="#" posts_found="<?php echo $posts_found; ?>">load more</a>
		</div>
		

