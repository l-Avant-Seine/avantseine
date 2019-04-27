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




<article id="event-<?php the_ID(); ?>" class="event-item" itemscope itemtype="http://schema.org/Event">

		<div class="item-hover">

				<div class="mb-05">
					<?php echo $event_shortText; ?>
				</div>

				<div class="">

					<?php if( intval($event_last_date) > $today ) : ?>
						<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn-primary">réserver mes places</a>
					<?php endif; ?>

					<a href="<?php the_permalink(); ?>" class="btn-primary empty">en savoir plus</a>

				</div>

		</div>

		<div class="item-breather">
			
			<div class="b-lazy item-cover">
				<img src="<?php the_post_thumbnail_url('featured-post-thumbnail'); ?>" alt="">
			</div>

			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<div class="">

					<div class="">
						<?php
							echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition);
						?>

					</div><!-- .blocEvent-dates -->

					<h3 class="h_3" itemprop="name">	
							<?php the_title(); ?>
					</h3>

					<span class="meta-name">
						<?php the_field( 'noms_principaux' ); ?>
					</span>
				</div>
			</a>
		
		</div>


</article><!-- #event-## -->
