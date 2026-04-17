<?php
/**
 * @package lavantseine
 */

	$event_shortText = get_field( 'eventDetail_shortText' );
	$event_dates = get_field( 'eventDetail_dates' );
	$event_text2 = get_field( 'eventDetail_text2' );
	$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
	$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
	$event_other_dates = get_field('eventDetail_otherdates');
	$today = time();

	$enfantsdabord = get_field( 'enfants_dabord' );
	$trenteans = get_field( 'trenteans' );
	$logo_festival = get_field( 'event_festival_logo' );

	$video = get_field( 'eventDetail_mediaMarkup' );
	$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
	$exhibition = get_field( 'eventDetail_exhibition' );

	$linked = isset($args['linked']) ? $args['linked'] : false;
    $tags = wp_get_post_terms($post->ID, array('discipline'), array("fields" => "all"));

	if( $video !== ''  ) {
		wp_enqueue_script('plyr');
		wp_enqueue_style('plyr');
	}

?>

<article class="bloc_slide">


					<?php if( str_contains($video, '<iframe' ) ) : ?>

						<div class="plyr__video-embed js-player" id="player">
							<?php echo $video; ?>
						</div>

					<?php elseif( $video !== '' ) : ?>

						<div class="plyr__video-embed js-player" id="player">
							  <iframe
								src="https://www.youtube.com/embed/<?php echo $video; ?>?origin=https://plyr.io&iv_load_policy=3&modestbranding=1&playsinline=1&showinfo=0&rel=0&enablejsapi=1&mute=1&autoplay=1"
								allowfullscreen
								allowtransparency
								allow="autoplay"
							></iframe>
						</div>

					<?php else :
					 	the_post_thumbnail('homeslide');
					endif; ?>

                        <div class="bloc_text ">

                            <div class="bloc_title">

								<?php if($linked) : ?>
									<a class="block" href="<?php the_permalink(); ?>">
								<?php endif; ?>
                                
									<h2 class="h1 "><?php the_title(); ?></h2>

								<?php if($linked) : ?>
									</a>
								<?php endif; ?>
								
								<div class="flex --gap-l">

									<div>
										<p class="label_1"><?php the_field('noms_principaux'); ?></p>
										<p class="label_2"><?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?></p>

										<?php if( !get_field('hide_booking_btn') ) : ?>
											<?php if (intval($event_last_date) > $today) : ?>
												<p class="mb-0"><a href="<?php the_field('eventDetail_dealer-link'); ?>" target="_blank" class="btn">Réserver</a></p>
											<?php endif; ?>
										<?php endif; ?>
									</div>

									<div class="">
										<?php if( $logo_festival && $linked) : ?>
											<img src="<?php echo $logo_festival; ?>" class="bloc_festival">
										<?php endif; ?>
									</div>

								</div>
                            </div>

                        </div>


		<?php foreach($tags as $tag) { 
                $image = get_field('visuel_colored', 'discipline' . '_' . $tag->term_id); ?>
                <img class="bloc_texture" src="<?php echo $image; ?>">
        <?php } ?>

		
</article>