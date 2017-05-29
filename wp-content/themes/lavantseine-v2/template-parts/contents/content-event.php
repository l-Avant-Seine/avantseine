<?php
/**
 * @package lavantseine
 */

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

$post_meta_data = get_post_custom($post->ID);

$tags = wp_get_post_terms($post->ID, array('discipline', 'rdv'), array("fields" => "all"));

$event_dates = get_field( 'eventDetail_dates' );
$event_duration = get_field( 'eventDetail_duration' );
$event_text2 = get_field( 'eventDetail_text2' );
$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
$event_other_dates = get_field('eventDetail_otherdates');
$event_landscape_media = get_field( 'eventDetail_landscapeMedia' );

$eventDetail_mediaMarkup = get_field( 'eventDetail_mediaMarkup' );
$eventDetail_showPic = get_field( 'eventDetail_showPic' );
$noms_principaux = get_field( 'noms_principaux' );

$attached = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);

$event_distribution = get_field( 'eventDetail_distribution' );
$event_mentions = get_field( 'eventDetail_mentions' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<header class="event-header bg_cover" style="background-image: url(<?php the_post_thumbnail_url('top-thumbnail'); ?>);">
		<div class="eventHeader-inner row wrap is-flex">
			
			<div class="eventHeader-title m-5col">
				<h1 class="h1 entry-title"><?php the_title(); ?></h1>
				<div class="eventHeader-name"><?php echo $noms_principaux; ?></div>
			</div>

			<div class="eventHeader-date m-3col">
				<div class="inner">
					<?php 
						echo "<h4 class='h3'>". get_event_dates($event_first_date, $event_last_date, $event_other_dates = false) ."</h4>" ;
					?>
					<p><a href="#event-details"><span class="icon-arrow-right"></span><strong>voir toutes les dates</strong></a></p>


					<?php if ( $event_duration ) : echo "<span class='eventHeader-duration'> Durée : ". $event_duration ."</p>"; endif; ?>

					<a href="#" class="btn--big">Réservation</a>
				</div>

				<div class="eventHeader-actions inner clearfix">
					<div class="eventActions-tocalendar">
						<span class="icon-calendar"> </span>
						<span class="addtocalendar atc-style-blue">
					    <var class="atc_event">
					        <var class="atc_date_start"><?php echo strftime('%Y-%m-%d %H:%M:00', $event_first_date ); ?></var>
					        <var class="atc_date_end"><?php echo strftime('%Y-%m-%d %H:%M:00', $event_last_date ); ?></var>

					        <var class="atc_timezone">Europe/Paris</var>
					        <var class="atc_title">S<?php the_title(); ?>rty</var>
					        <var class="atc_description"><?php echo $noms_principaux; ?></var>
					        <var class="atc_location">l'Avant-Seine - Théâtre de Colombes - Parvis des Droits de l'Homme, 88 rue Saint Denis, 92700 Colombes</var>
					        <var class="atc_organizer">'Avant-Seine</var>
					        <var class="atc_organizer_email">anne.legall@lavant-seine.com</var>
					    </var>
					  </span>
					</div>

					<div class="eventActions-share">
						<?php lavantseine_display_share_buttons(); ?>
					</div><!-- .event-social -->

				</div>
			  
			</div>

		</div>
	</header><!-- .event-header -->


	<div class="event-meta event-layer wrap">
		<?php 
			$count = count($tags);
			if ( $count > 0 ){
			    echo "<ul class='no-bullets'>";
			    foreach ( $tags as $term ) {
		  			$term_link = get_term_link( $term, '' );
			    	echo "<li class='eventmeta-term'>" . $term->name . "</li>";
			    	echo $term->description;
			    }
			    echo "</ul>";
			} 
		?>
	</div><!-- .event-meta -->



	<div class="event-layer ">

		<div class="wrap row is-flex">
				
			<div class="m-5col ">
				<div class="event-content"><?php 
					the_content(); ?></div>
				<div>
					<?php
					if ( $eventDetail_mediaMarkup ) {
						echo $eventDetail_mediaMarkup;
					}
					get_template_part( 'part', 'postslide' );
				?>
				</div>

					<?php
						$publics =  get_the_terms( $post->ID, 'public' );
						if($publics) {
						  foreach ($publics as $public) {
						  	echo '<div class="event-public-item">';
							    $tax_term_id = $public->term_taxonomy_id;
							    $images = get_option('taxonomy_image_plugin');
							    
							    echo '<span class="public-label">A partir de</span>';
							    echo '<div class="public-img">';
							    	echo wp_get_attachment_image( $images[$tax_term_id], '' );
							    	echo '<p class="public-name">'. $public->name .'</p>';
							    echo '</div>';
	   					  echo '</div>';
						  }
						}
					?>

				<a class="btn--big" href="<?php bloginfo('url'); ?>/les-infos-pratiques/tarifs-et-reservations/" class="button saisoned-on-bg">Réservation</a>


				<div id="event-details" class="event-details offset-left offset-right">
					<div class="">
						
						<div class="row clearfix">
							<div class="m-2col">
								<h4 class="h5">Tarifs</h4>

								<?php				
									$term_list = wp_get_post_terms($post->ID, 'tarif', array("fields" => "all"));
									$count = count($term_list);
									if ( $count > 0 ){
									    echo "<ul class='no-bullets'>";
									    foreach ( $term_list as $term ) {
									    	echo "<li class=''>#" . $term->name . "</li>";
									    	echo $term->description;
									    }
									    echo "</ul>";
									}
								?>
							</div>

							<div class="m-3col">
								<h4 class="h5">Date(s)</h4>

								<?php 
									if ( $event_first_date ) : 
										echo '<ul class="no-bullets">';
										    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_first_date ) .'.</li>'; 

										if ( $event_other_dates ) : 
											foreach ($event_other_dates as $date) { 
												$date = strtotime($date);
											    if ( $date != '' ) : 
											    	echo '<li>'. strftime('%A %e %b %G - %kh%M', $date ) .'.</li>'; 
											    endif;
											} 
										endif; 

										if ( $event_last_date && $event_last_date != $event_first_date ) : 
										    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_last_date ) .'.</li>'; 							    
										endif;

										echo '</ul>';
									endif; 
								?>

							</div>
						</div>
						

						<div class="row clearfix">
							<h4 class="h5">Distribution et mentions complètes</h4>
				
							<div class="m-2col m-first">
									<?php if ( $event_text2 ) : echo "<p class=''>". $event_text2 ."</p>"; endif; ?>

									<?php 
										if ( $event_distribution || $event_mentions ) : 
											echo $event_distribution;
										endif; ?>
							</div>

							<div class="m-3col">

									<?php 
										if (  $event_mentions ) : 
											echo $event_mentions;
										endif; ?>

									<?php if ($attached) : ?>
									<p class="attached-file"><a href="<?php echo $attached['url']; ?>">  
									    Téléchargez le dossier de presse
									</a></p>
									<?php endif; ?>
							</div>
						</div>

					</div>
				</div><!-- .event-details -->

			</div><!-- .event-details -->

			<div class="m-3col event-aside offset-right">
					<?php set_query_var('taxo', 'relational_tag'); ?>
					<?php get_template_part( 'template-parts/modules/module', 'relatedposts' ); ?>
			</div>

		</div>

	</div><!-- .event-layer -->






</article><!-- #post-## -->
