<?php
/**
 * @package lavantseine
 */

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

$babysitting = false;

//$post_meta_data = get_post_custom($post->ID);

$tags = wp_get_post_terms($post->ID, array('discipline', 'rdv'), array("fields" => "all"));

$event_dates = get_field( 'eventDetail_dates' );
$event_duration = get_field( 'eventDetail_duration' );
$event_text2 = get_field( 'eventDetail_text2' );
$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
$event_first_date_babysitting = get_field( 'eventDetail_first_date_babysitting' );
$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
$event_last_date_babysitting = get_field( 'eventDetail_last_date_babysitting' );

$event_other_dates = get_field('eventDetail_otherdates');
$event_landscape_media = get_field( 'eventDetail_landscapeMedia' );

$eventDetail_mediaMarkup = get_field( 'eventDetail_mediaMarkup' );
$eventDetail_showPic = get_field( 'eventDetail_showPic' );
$noms_principaux = get_field( 'noms_principaux' );
$event_dealer_link = get_field( 'eventDetail_dealer-link' );

$attached = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);
$presskit = get_field( 'presskit' );

$event_distribution = get_field( 'eventDetail_distribution' );
$event_mentions = get_field( 'eventDetail_mentions' );

if( $event_first_date_babysitting || $event_last_date_babysitting ) {
	$babysitting = true;
}
										
if( have_rows('eventDetail_otherdates') ):
	$otherdates = '';

  while ( have_rows('eventDetail_otherdates') ) : the_row();
		$otherdates .= '<li>';
      $otherdates .= get_sub_field('date');

			if( get_sub_field('baby-sitting') ) : 
				$otherdates .= '<a class="event-babysitting" target="_blank" href="/pratiques-et-services/service-baby-sitting/" alt="dès 3 ans / 6 € par enfant • Informations et réservations" title="dès 3 ans / 6 € par enfant • Informations et réservations"><span class="icon-cocarde"></span>Service Baby-Sitting</a>';
				$babysitting = true;
			endif; 

		$otherdates .= '</li>';
  endwhile;	

endif; 


?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	

	<header class="event-header bg_cover" itemprop="image"  style="background-image: url(<?php if( get_field('gif' ) ) : the_field('gif'); else : the_post_thumbnail_url('top-thumbnail'); endif; ?>);">
		<div class="eventHeader-inner row wrap is-flex">
			
			<div class="eventHeader-title m-5col offset-right" itemprop="name">
				<h1 class="h1 entry-title"><?php the_title(); ?></h1>
				<div class="eventHeader-name"><?php echo $noms_principaux; ?></div>
			</div>

			<div class="eventHeader-date m-3col">
				
				<?php if($babysitting) : ?>
					<a class="focusElement-pastille is-flex scroll" target="_blank" href="/pratiques-et-services/service-baby-sitting/" alt="dès 3 ans / 6 € par enfant" title="dès 3 ans / 6 € par enfant" href="#event-details">
						<span>Baby<br>Sitting</span>
					</a>
				<?php endif; ?>

				<div class="inner">
					<?php 
						echo "<h4 class='h3'>". get_event_dates($event_first_date, $event_last_date, $event_other_dates) ."</h4>" ;
					?>
					<?php if( $event_first_date != $event_last_date ) : ?>
						<p><a href="#event-details" class="scroll"><span class="icon-arrow-right"></span><strong>voir toutes les dates</strong></a></p>
					<?php endif; ?>

					<?php if ( $event_duration ) : echo "<p class='eventHeader-duration' itemprop='duration' content='T1M33S'> <span class='icon-horloge'></span> ". $event_duration ."</p>"; endif; ?>

					<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn--big">réserver mes places</a>
				</div>

				<div class="eventHeader-actions inner clearfix">
					<div class="eventActions-tocalendar">
						<span class="icon-calendar"> </span>
						<span class="addtocalendar atc-style-blue">
					    <var class="atc_event">
					        <var class="atc_date_start" itemprop="startDate" datetime="<?php echo strftime('%Y-%m-%dT%H:%M:00', $event_first_date ); ?>"><?php echo strftime('%Y-%m-%d %H:%M:00', $event_first_date ); ?></var>
					        <var class="atc_date_end" itemprop="endDate" datetime="<?php echo strftime('%Y-%m-%dT%H:%M:00', $event_last_date ); ?>"><?php echo strftime('%Y-%m-%d %H:%M:00', $event_last_date ); ?></var>
					        <var class="atc_timezone">Europe/Paris</var>
					        <var class="atc_title"><?php the_title(); ?></var>
					        <var class="atc_description"><?php echo $noms_principaux; ?></var>
					        <var class="atc_location">l'Avant Seine - Théâtre de Colombes - Parvis des Droits de l'Homme, 88 rue Saint Denis, 92700 Colombes</var>
					        <var class="atc_organizer">'Avant Seine</var>
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
			    	echo "<li class='eventmeta-term'><a href='". $term_link ."'>" . $term->name . "</a></li>";
			    	echo $term->description;
			    }
			    echo "</ul>";
			} 
		?>
	</div><!-- .event-meta -->



	<div class="event-layer ">

		<div class="wrap row is-flex">
				
			<div class="m-5col"  itemprop="mainContentOfPage">
				<div class="event-content entry-content">
					<?php the_content(); ?>
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

				<a class="btn--big" href="<?php echo $event_dealer_link; ?>" target="_blank" class="button saisoned-on-bg">réserver mes places</a>


				<div id="event-details" class="event-details offset-left offset-right">
					<div class="">
						
						<div class="row clearfix">
							<div class="m-2col">
								<h4 class="h5"><span class="title-diamond">♦</span><br>Tarifs</h4>

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

								<?php if ( $event_text2 ) : echo "<p class=''>". $event_text2 ."</p>"; endif; ?>
							</div>

							<div class="m-3col">
								<h4 class="h5"><span class="title-diamond">♦</span><br>Date(s)</h4>

								<?php 
									if ( $event_first_date ) : 
										echo '<ul class="no-bullets lowercase">';
										    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_first_date );
										    if( get_field('eventDetail_first_date_babysitting')) : 
										    	echo '<a class="event-babysitting" target="_blank" title="dès 3 ans / 6 € par enfant • Informations et réservations" href="/pratiques-et-services/service-baby-sitting/"><span class="icon-cocarde"></span>Service Baby-Sitting</a>';
										    endif; 
										    echo '.</li>'; 

										  if( isset($otherdates)) {
										  	echo $otherdates;
										  }

											if ( $event_other_dates ) : 
												foreach ($event_other_dates as $date) { 
													$date = strtotime($date['date']);
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
							<h4 class="h5"><span class="title-diamond">♦</span><br>Distribution et mentions complètes</h4>
				
							<div class="l-3col l-first layer">
									

									<?php 
										if ( $event_distribution || $event_mentions ) : 
											echo $event_distribution;
										endif; ?>
							</div>

							<div class="l-4col">

									<?php 
										if (  $event_mentions ) : 
											echo $event_mentions;
										endif; ?>

									<?php if ($attached) : ?>
									<p class="attached-file">
										<a href="<?php echo $attached['url']; ?>" class="btn--big">  
									    Dossier de presse
										</a>
									</p>
									<?php endif; ?>

									<?php if( $presskit ): ?>
										<a href="<?php echo $presskit['url']; ?>" class="btn--big">Dossier de presse</a>
									<?php endif; ?>

							</div>
						</div>

					</div>
				</div><!-- .event-details -->

			</div><!-- .event-details -->

			<div class="m-3col event-aside offset-right">
					<?php set_query_var('relational_tag', 'relational_tag'); ?>
					<?php set_query_var('arborescence', 'arborescence'); ?>
					<?php get_template_part( 'template-parts/modules/module', 'relatedposts' ); ?>
			</div>

		</div>

	</div><!-- .event-layer -->


</article><!-- #post-## -->


    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Event",
      "location": {
        "@type": "Place",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Colombes",
          "postalCode": "92700",
          "streetAddress": "Parvis des Droits de l’Homme - 88 rue Saint Denis"
        },
        "name": "l'Avant Seine, Théatre de Colombes"
      },
      "name": "<?php echo get_the_title(); ?>",
      "startDate": "<?php echo strftime('%Y-%m-%dT%H:%M:00', $event_first_date ); ?>",
      "duration": "<?php echo $event_duration; ?>"
    }
    </script>



