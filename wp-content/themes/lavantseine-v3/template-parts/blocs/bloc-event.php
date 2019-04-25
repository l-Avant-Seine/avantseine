<?php
/**
 * @package lavantseine
 */

	$event_shortText = get_field( 'eventDetail_shortText' );
	$event_dates = get_field( 'eventDetail_dates' );
	$event_text2 = get_field( 'eventDetail_text2' );
	$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
	$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
	 $event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
	$event_other_dates = get_field('eventDetail_otherdates');
	$today = time();
	$event_dealer_link = get_field( 'eventDetail_dealer-link' );

	$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
	$exhibition = get_field( 'eventDetail_exhibition' );

?>




<article id="event-<?php the_ID(); ?>" class="bloc-event" itemscope itemtype="http://schema.org/Event">
	<div>
		
		<div class="blocEvent-upper">
			
			<div class="blocEvent-media bg_cover b-lazy" data-src="<?php the_post_thumbnail_url('featured-post-thumbnail'); ?>"></div>	
				

			<div class="blocEvent-infos full_absolute">
				<div class="is-flex inner">
					<?php echo "<div>". $event_shortText. "</div>"; ?>

					<div class="blocEvent-actions">
						<a href="<?php the_permalink(); ?>" class="btn--big empty">en savoir plus</a>

						<?php if( intval($event_last_date) > $today ) : ?>
							<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn--big">réserver mes places</a>
						<?php endif; ?>

					</div>
				</div>
			</div>

		</div>

		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="blocEvent-lower">

				<div class="blocEvent-dates meta-date">
					<?php
						echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition);
					?>

				</div><!-- .blocEvent-dates -->

				<h3 class="h4 blocEvent-title" itemprop="name">	
						<?php the_title(); ?>
				</h3>
				<span class="meta-name"><?php the_field( 'noms_principaux' ); ?></span><br>
			</div>
		</a>
	

	</div>
</article><!-- #event-## -->
