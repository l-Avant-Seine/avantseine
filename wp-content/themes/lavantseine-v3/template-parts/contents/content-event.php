<?php
/**
 * @package lavantseine
 */

setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

$babysitting = false;

$today = time();
//$post_meta_data = get_post_custom($post->ID);

$tags = wp_get_post_terms($post->ID, array('discipline', 'rdv'), array("fields" => "all"));

$event_dates = get_field( 'eventDetail_dates' );
$event_duration = get_field( 'eventDetail_duration' );
$event_text2 = get_field( 'eventDetail_text2' );
$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
$event_first_date_babysitting = get_field( 'eventDetail_first_date_babysitting' );
$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
$event_last_date_babysitting = get_field( 'eventDetail_last_date_babysitting' );

$exhibition = get_field( 'eventDetail_exhibition' );

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
	
	<header class="event-header  wrap mb-2">

		<div class="event-titles">

			<div class="row mb-1">
				<div class="m-22col m-1col-push ">

					<div class="cf event-title " itemprop="name">
						<h1 class="h_1"><?php the_title(); ?></h1>
					</div>

					<div class="cf">

						<h4 class='h3'><?php 
							echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?>
						</h4>

						<?php if( $event_first_date != $event_last_date ) : ?>
							<p><a href="#event-details" class="scroll"><span class="icon-arrow-right"></span><strong>voir toutes les dates</strong></a></p>
						<?php endif; ?>

						<?php if ( $event_duration ) : ?>
							<p class='eventHeader-duration' itemprop='duration' content='T1M33S'>
								<?php echo $event_duration ?>
							</p>
						<?php endif; ?>
						
			
					</div>

				</div>
			</div><!-- .row -->

			<div class="row">
				<div class="m-22col m-1col-push ">

						<?php if( intval($event_last_date) > $today ) : ?>
							<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn-primary">réserver mes places</a>
						<?php endif; ?>

						<?php lavantseine_display_share_buttons(); ?>

				</div>
			</div><!-- .row -->

		</div><!-- .event-titles -->

		<div class="event-cover">
			<img src="<?php if( get_field('gif' ) ) : the_field('gif'); else : the_post_thumbnail_url('top-thumbnail'); endif; ?>" alt="">
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



	<div class="event-content ">

		<div class="wrap row">
				
			<div class="m-16col"  itemprop="mainContentOfPage">
				<div class="">
					<div class="copy mb-2">
						<?php the_content(); ?>
					</div>

					<?php if ( $eventDetail_mediaMarkup ) { ?>
						<div class="mb-2"><?php echo $eventDetail_mediaMarkup; ?></div>
					<?php } ?>

					<?php get_template_part( 'part', 'postslide' );	?>

					</div>


					<?php if( intval($event_first_date) > $today ) : ?>
						<a class="btn-primary" href="<?php echo $event_dealer_link; ?>" target="_blank" class="button saisoned-on-bg">réserver mes places</a>
					<?php endif; ?>



				<div id="event-details" class="event-details">
					<div class="">
						
						<div class="row clearfix">
							<div class=" m-first">
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

								<?php if ( $event_text2 ) : echo "<p class=''>". $event_text2 ."</p>"; endif; ?>
							</div>

							<div class="">
								<h4 class="h5">Date(s)</h4>

								<?php 
									if( $exhibition ) {
										echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition);
									}
									else {

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
											    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_last_date );	
											    if( get_field('eventDetail_last_date_babysitting')) : 
											    	echo '<a class="event-babysitting" target="_blank" title="dès 3 ans / 6 € par enfant • Informations et réservations" href="/pratiques-et-services/service-baby-sitting/"><span class="icon-cocarde"></span>Service Baby-Sitting</a>';
											    endif; 
											    echo '.</li>'; 

											endif;

											echo '</ul>';
										endif;
									}
								?>

							</div>
						</div>
						

						<div class="event-distribution row clearfix mb-2">
							<h4 class="h_5">
								Distribution et mentions complètes
							</h4>
				
							<div class="l-3col l-first ">
									<?php 
										if ( $event_distribution || $event_mentions ) : 
											echo $event_distribution;
										endif; ?>
							</div>

							<div class="">

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


			<div class="event-aside m-7col m-last">

				<?php if($babysitting) : ?>
					<a class="focusElement-pastille is-flex scroll" target="_blank" href="/pratiques-et-services/service-baby-sitting/" alt="dès 3 ans / 6 € par enfant" title="dès 3 ans / 6 € par enfant" href="#event-details">
						<span>Baby<br>Sitting</span>
					</a>
				<?php endif; ?>

				<?php set_query_var('relational_tag', 'relational_tag'); ?>
				<?php set_query_var('arborescence', 'arborescence'); ?>
				<?php get_template_part( 'template-parts/modules/module', 'relatedposts' ); ?>

			</div><!-- .event-aside -->

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



