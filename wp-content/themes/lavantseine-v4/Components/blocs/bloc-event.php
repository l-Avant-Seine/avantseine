<?php
/**
 * @package lavantseine
 */

	$post = $args['post'];
	setup_postdata( $post );

	$event_dates = get_field( 'eventDetail_dates' );
	$event_text2 = get_field( 'eventDetail_text2' );
	$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
	$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
	$event_other_dates = get_field('eventDetail_otherdates');

	if($event_first_date) {
		$event_hour = strftime('%M', $event_first_date ) === '00' ? strftime('%kh', $event_first_date ) : strftime('%kh%M', $event_first_date );
	} 

	$event_duration = get_field( 'eventDetail_duration' );
    $age = get_the_terms(get_the_ID(), 'public');
    $tags = wp_get_post_terms($post, array('discipline'), array("fields" => "all"));

	$today = new DateTime("today"); // This object represents current date/time with time set to midnight

	$enfantsdabord = get_field( 'enfants_dabord' );
	$trenteans = get_field( 'trenteans' );
	$logo_festival = get_field( 'logo_festival' );

	$event_landscape_media = get_post_meta( get_the_ID(), 'eventMedia_landscape', true );
	$exhibition = get_field( 'eventDetail_exhibition' );
?>




	<article id="event-<?php the_ID(); ?>" class="bloc_event" itemscope itemtype="http://schema.org/Event">
			
		<a href="<?php the_permalink(); ?>" class="flex --col " rel="bookmark">

			<div class="bloc_upper flex --jstf --hcentered --gap-s">

				<?php if( !get_field('eventDetail_is_news') ) : ?>
					<div class="item-dates h4_2">
						<?php 
							if( isset($args['date']) ) {

								$match_date = new DateTime('@' . $args['date']);
								$match_date->setTime( 0, 0, 0 ); 
								$diff = $today->diff( $match_date );
								$diffDays = $diff->format( "%R%a" ); 

								switch( $diffDays ) {
									case 0:
										echo "Aujourd'hui";
										break;
									case +1:
										echo "Demain";
										break;
									default:
										echo get_event_dates( intval($args['date']), intval($args['date']) );
								}

							} 
							else {
								echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); 
							} ?>
					</div>
				<?php endif; ?>

				<?php if($tags) : $icon_name = ""; ?>
					<div class="item-tags">
                        <span class="h4_2 flex --hcentered --gap-xs">
                            <?php foreach($tags as $tag) { 
								$icon_name .= $tag->slug;
                                //$image = get_field('visuel_white', 'discipline' . '_' . $tag->term_id); 
								$image = get_template_directory_uri() . '/assets/img/disciplines/' . $icon_name . '.png'; 
							?>
                                <span><?php echo $tag->name; ?></span>
                                <img src="<?php echo $image; ?>" class="bloc_taxmedia">
                            <?php } ?></span>
                    </div>
                <?php endif; ?>


			</div>


			<div class="bloc_lower flex --col --jstf">
				<div>

					<div class="bloc_title mb-small">
						<h3 class="h2_2" itemprop="name">	
							<?php the_title(); ?>
						</h3>
					</div>

					<div class="bloc_content flex --hbottom --jstf mb-small">

						<div class="item-names label_1">
							<?php if( get_field('noms_principaux') ) { ?>
								<?php the_field( 'noms_principaux' ); ?>
							<?php } ?>	
						</div>

							<div class="item-names txt-right meta">
								<?php if ($age && !is_wp_error($age)) { ?>
									<p class="meta">
										<?php
											foreach ($age as $term) {
												echo $term->name;
											}; ?>
									</p>
								<?php } ?>
							</div>

					</div>
				</div>				

					<div class="bloc_cover_outer">

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
