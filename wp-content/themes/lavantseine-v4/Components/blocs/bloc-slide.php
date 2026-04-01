<?php
/**
 * @package lavantseine
 */
$babysitting = false;

	$event_shortText = get_field( 'eventDetail_shortText' );
	$event_dates = get_field( 'eventDetail_dates' );
	$event_text2 = get_field( 'eventDetail_text2' );
	$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
	$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
	$event_other_dates = get_field('eventDetail_otherdates');
	$today = time();
	$event_dealer_link = get_field( 'eventDetail_dealer-link' );
	$event_first_date_babysitting = get_field( 'eventDetail_first_date_babysitting' );
	$event_last_date_babysitting = get_field( 'eventDetail_last_date_babysitting' );

	$enfantsdabord = get_field( 'enfants_dabord' );
	$trenteans = get_field( 'trenteans' );
	$logo_festival = get_field( 'logo_festival' );


	$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );
	$exhibition = get_field( 'eventDetail_exhibition' );

	if( $event_first_date_babysitting || $event_last_date_babysitting ) {
		$babysitting = true;
	}

	if( have_rows('eventDetail_otherdates') ):
	  while ( have_rows('eventDetail_otherdates') ) : the_row();
				if( get_sub_field('baby-sitting') ) : 
					$babysitting = true;
				endif; 
	  endwhile;	
	endif; 

?>

<article>

                        <?php the_post_thumbnail(); ?>

                        <div class="mod_text">

                            <div class="mod_title">
                                <h2 class="h1 "><?php the_title(); ?></h2>
                                <p class="label_1"><?php the_field('noms_principaux'); ?></p>
                                <p class="label_2"><?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?></p>
                                <p><a href="<?php the_field('eventDetail_dealer-link'); ?>" target="_blank" class="btn">Réserver</a></p>
                            </div>

                            <img class="mod_texture" src="<?php the_field('event_texture'); ?>">
                        </div>

</article>