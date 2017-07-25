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

	$event_dealer_link = get_field( 'eventDetail_dealer-link' );

	$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
?>




<article id="event-<?php the_ID(); ?>" class="bloc-event" itemscope itemtype="http://schema.org/Event">
	<div>
		
		<div class="blocEvent-upper">
			
			<div class="blocEvent-media bg_cover" style="background-image: url(<?php the_post_thumbnail_url('featured-post-thumbnail'); ?>)"></div>	
				

			<div class="blocEvent-infos full_absolute">
				<div class="is-flex inner">
					<?php echo "<p>". $event_shortText. "</p>"; ?>

					<div class="blocEvent-actions">
						<a href="<?php the_permalink(); ?>" class="btn--big empty">en savoir plus</a>
						<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn--big">réserver mes places</a>
					</div>
				</div>
			</div>

		</div>

		<a href="<?php the_permalink(); ?>" rel="bookmark">
			<div class="blocEvent-lower">

				<div class="blocEvent-dates meta-date">
					<?php
						echo get_event_dates($event_first_date, $event_last_date, $event_other_dates);
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
