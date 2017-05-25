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
$event_other_dates = unserialize( get_field('eventDetail_otherdates')[0]);
$event_landscape_media = get_field( 'eventDetail_landscapeMedia' );

$eventDetail_mediaMarkup = get_field( 'eventDetail_mediaMarkup' );
$eventDetail_showPic = get_field( 'eventDetail_showPic' );

$attached = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);

$event_distribution = get_field( 'eventDetail_distribution' );
$event_mentions = get_field( 'eventDetail_mentions' );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	


	<header class="event-header bg_cover" style="background-image: url(<?php the_post_thumbnail_url('top-thumbnail'); ?>);">
		<div class="eventHeader-inner row wrap is-flex">
			
			<div class="eventHeader-title m-5col">
				<h1 class="h1 entry-title"><?php the_title(); ?></h1>
			</div>

			<div class="eventHeader-dates m-3col">
				<?php 

					// if ( $event_dates ) : echo "<span class='date-main'>". $event_dates ."</span>" ; endif; 
					if ( $event_first_date ) : 
						echo '<ul class="event-repeatable-dates">';
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

				<?php if ( $event_duration ) : echo "<span class='eventHeader-duration'> Durée : ". $event_duration ."</p>"; endif; ?>


				<?php
					$publics =  get_the_terms( $post->ID, 'public' );
					if($publics) {
					  foreach ($publics as $public) {
					  	echo '<div class="event-public-item">';
						    $tax_term_id = $public->term_taxonomy_id;
						    $images = get_option('taxonomy_image_plugin');
						    
						    echo '<p class="public-label">A partir de</p>';
						    echo '<div class="public-img">';
						    	echo wp_get_attachment_image( $images[$tax_term_id], '' );
						    	echo '<p class="public-name">'. $public->name .'</p>';
						    echo '</div>';
   					  echo '</div>';
					  }
					}
				?>


				<div title="Add to Calendar" class="addeventatc">
			    Ajouter à mon calendrier
			    <span class="start">06/05/2017 09:00 AM</span>
			    <span class="end">06/05/2017 11:00 AM</span>
			    <span class="timezone">Europe/Paris</span>
			    <span class="title"><?php the_title(); ?></span>
			    <span class="description">Description of the event</span>
			    <span class="location">l'Avant-Seine, théâtre de Colombes</span>
			    <span class="organizer">l'Avant-Seine, théâtre de Colombes</span>
			    <span class="organizer_email">Organizer e-mail</span>
			    <span class="facebook_event">https://www.facebook.com/events/703782616363133</span>
			    <span class="all_day_event">true</span>
			    <span class="date_format">MM/DD/YYYY</span>
			    <span class="alarm_reminder">15</span>
			    <span class="recurring">FREQ=DAILY;COUNT=10</span>
			    <span class="calname">Custom event filename</span>
			    <span class="uid">event123</span>
			    <span class="status">confirmed</span>
			    <span class="client">asIudnvhizljTCuevmzc28585</span>
			    <span class="method">REQUEST</span>
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
			    	echo "<li class='meta-term'>" . $term->name . "</li>";
			    	echo $term->description;
			    }
			    echo "</ul>";
			} 
		?>
	</div><!-- .event-meta -->


	

	<div class="event-content event-layer wrap row">
		
		<div class="m-5col">
			<?php 
				the_content(); 
				
				if ( $eventDetail_mediaMarkup ) {
					echo $eventDetail_mediaMarkup;
				}

				get_template_part( 'part', 'postslide' );
			?>
			
			<a class="btn--big" href="<?php bloginfo('url'); ?>/les-infos-pratiques/tarifs-et-reservations/" class="button saisoned-on-bg">Réservation</a>

		</div>


		<div class="m-3col">
			<h3 class="h2">autour du <br>spectacle</h3>

		</div>
	</div><!-- .event-content -->



	<div class="event-details event-layer clearfix">
		<div class="wrap">
			
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
					<h4 class="h5">Dates</h4>


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





			</div><!-- .event-price -->



			<div class="">
				<?php
					$event_dealer_link = get_field( 'eventDetail_dealer-link' );
					$event_dealer_name = get_field( 'eventDetail_dealer-name' );
				?>		

				
				<?php 
					if ( $event_dealer_name ) : ?>
						<button href="<?php echo $event_dealer_link; ?>" target="_blank" class="button saisoned-on-bg">Réservez sur <?php echo $event_dealer_name; ?></button>
				<?php endif; ?>
			</div><!-- .event-dealers -->


			<div class="">
				<?php // lavantseine_display_share_buttons(); ?>
			</div><!-- .event-social -->

		</div><!-- .entry-meta -->








</article><!-- #post-## -->
