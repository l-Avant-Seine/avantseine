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
	$logo_festival = get_field( 'logo_festival' );

	$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
	$exhibition = get_field( 'eventDetail_exhibition' );

?>

<article class="bloc_slide">

                        <?php the_post_thumbnail('homeslide'); ?>

                        <div class="bloc_text">

                            <div class="bloc_title">
                                <h2 class="h1 "><?php the_title(); ?></h2>
                                <p class="label_1"><?php the_field('noms_principaux'); ?></p>
                                <p class="label_2"><?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?></p>

								<?php if( !get_field('hide_booking_btn') ) : ?>
									<?php if (intval($event_last_date) > $today) : ?>
                                		<p><a href="<?php the_field('eventDetail_dealer-link'); ?>" target="_blank" class="btn">Réserver</a></p>
									<?php endif; ?>
								<?php endif; ?>

								
                            </div>

                            <img class="mod_texture" src="<?php the_field('event_texture'); ?>">
                        </div>

</article>