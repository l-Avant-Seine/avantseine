<?php
/**
 * @package lavantseine
 */


	$event_dates = get_field( 'eventDetail_dates' );
	$event_text2 = get_field( 'eventDetail_text2' );
	$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
	$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
	$event_other_dates = get_field('eventDetail_otherdates');
	$today = time();

	$enfantsdabord = get_field( 'enfants_dabord' );
	$trenteans = get_field( 'trenteans' );
	$logo_festival = get_field( 'logo_festival' );


	$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
	$exhibition = get_field( 'eventDetail_exhibition' );
?>




	<article id="event-<?php the_ID(); ?>" class="bloc_event" itemscope itemtype="http://schema.org/Event">
			
		<a href="<?php the_permalink(); ?>" class="--block" rel="bookmark">

			<div class="bloc_upper">

				<?php if( !get_field('eventDetail_is_news') ) : ?>
					<div class="item-dates">
						<?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?>
					</div>
				<?php endif; ?>

			</div>


			<div class="bloc_lower">

				<div class="bloc_title mb-small">
					<h3 class="h2_2" itemprop="name">	
						<?php the_title(); ?>
					</h3>
				</div>

				<div class="bloc_content flex --hbottom --jstf mb-small">


					<?php if( get_field('noms_principaux') ) { ?>
						<div class="item-names">
							<?php the_field( 'noms_principaux' ); ?>
						</div>
					<?php } ?>	

						<div class="item-names txt-right">
							À 19h<br>
							Durée 1h20<br>
							De 2 à 5 ans
						</div>

				</div>

					<div class="bloc_cover">

						<?php if ( $logo_festival ): ?>
							<?php if ( $logo_festival ): ?>
								<div class="logo_festival">
									<img src="<?php echo $logo_festival['url']; ?>" class="">
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<?php if ( $enfantsdabord || $trenteans ): ?>
							<div class="pictos-trente">
									
								<?php if ( $enfantsdabord ): ?>
									<div class="picto-enfantsdabord">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_enfantsdabord.png" class="">
									</div>
								<?php endif; ?>

								<?php if ( $trenteans ): ?>
									<div class="picto-trenteans">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_30ans.png" class="">
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<img class="bloc_img" src="<?php the_post_thumbnail_url('featured-post-thumbnail'); ?>">
					</div>
					
			</div>

		</a>
		


</article><!-- #event-## -->
