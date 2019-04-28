<?php
/**
 * The template part for displaying the event listing for programmation pages.
 *
 * @package lavantseine
 */

?>


	<div id="main-agenda" class="cf mb-3">


		<div class="agenda-ticker ticker-wrap mb-1">
			<div class="ticker">

				<?php for ($i=0; $i < 100; $i++) { 
					if( $i % 2 === 0 ) { ?>
						<span class="ticker__item">Allez hop, on y va !</span>
					<?php }
					else { ?>
						<span class="ticker__item red">Allez hop, on y va !</span>
					<?php }
				} ?>	
			</div>
		</div><!-- .ticker -->



		<div class="wrap row">
			<span class="h_2">
				<?php if( is_tax() ) : echo get_the_archive_title(); endif; ?>
			</span>
		</div><!-- .row -->


		<div id="agenda-maingrid" class="row wrap">
			
				<div class="agenda-grid-item m-8col prog-filters">
					
					<form action="" id="prog-filters" class="mb-2" name="prog-filters">

							<div class="label h_4--red">filtrer</div>

							<?php custom_taxonomy_dropdown('discipline', 'date', 'DESC', '', 'discipline', 'Quelle discipline ?', ''); ?>
							<?php custom_taxonomy_dropdown('rdv', 'date', 'DESC', '', 'rdv', 'Quel type d\'événement ? ', ''); ?>
							<?php custom_taxonomy_dropdown('public', 'date', 'DESC', '', 'public', 'Pour quel âge ?', ''); ?>
							<?php custom_taxonomy_dropdown('tarif', 'date', 'DESC', '', 'tarif', 'Quel tarif ?', ''); ?>

							<div class="cf switch filter-item">
								<span>passés</span>
							  <input id="cmn-toggle-1" class="cmn-toggle cmn-toggle-round" <?php if( !isset($_GET['is_archives']) ) : echo 'checked=""'; endif; ?> name="is_archives" type="checkbox">
							  <label for="cmn-toggle-1"></label>
							  <span>à venir</span>
							</div>

							<div class="cf switch filter-item">
							  <input id="cmn-toggle-2" class="cmn-toggle cmn-toggle-round" <?php if( !isset($_GET['has_babysitting']) ) : echo 'checked=""'; endif; ?> name="has_babysitting" type="checkbox">
							  <label for="cmn-toggle-2"></label>
							  <span>avec baby-sitting</span>
							</div>

							<?php //custom_taxonomy_list('saison', 'date', 'DESC', '', 'saison', 'Toutes les saisons passées'); ?>

					</form>

					<?php get_template_part('template-parts/modules/module', 'brochures'); ?>


				</div><!-- .filters	 -->
		


<!-- 			<?php if( get_field('cette_semaine', 'options' ) ) : ?>
				<div class="offset-right module-week">	
					<h3 class="h4">cette <br>semaine <br><span class="title-diamond">&#x02666;</span></h3>

					<?php the_field('cette_semaine', 'options'); ?>
				</div>
			<?php endif; ?> -->



				<?php
					setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
					$today = time();
					$previous_month = false;

					$args = array(
					   	'post_type' 			=> 'event',
							'posts_per_page' 	=> '18',
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
			    	if( isset($discipline) OR isset($rdv) ) {
							$args['tax_query'] = array(
								'relation' => 'OR',
				        array(
				            'taxonomy' => 'discipline',
				            'field' => 'slug',
				            'terms' => $discipline
				        ),
				        array(
				            'taxonomy' => 'rdv',
				            'field' => 'slug',
				            'terms' => $rdv
				        ),
				      );
				    }
			    }

					$query = new WP_Query( $args );
					$posts_found = $query->found_posts;
					
					set_query_var('query', $query);
					set_query_var('previous_month', $previous_month);
					get_template_part('template-parts/loops/loop', 'events');
				?>


		</div><!-- .row -->



		<div class="wrap row module-actions">
			<a class="load-more btn-primary" href="#" posts_found="<?php echo $posts_found; ?>">voir plus de spectacles</a>
		</div><!-- .row -->



</div>



		

