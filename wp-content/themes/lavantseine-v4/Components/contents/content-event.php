	<?php
    /**
     * @package lavantseine
     */

    setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');

    $babysitting = false;

    $today = time();
    //$post_meta_data = get_post_custom($post->ID);

    $tags = wp_get_post_terms($post->ID, array('discipline'), array("fields" => "all"));

    $event_dates = get_field('eventDetail_dates');
    $event_duration = get_field('eventDetail_duration');
    $event_text2 = get_field('eventDetail_text2');
    $event_first_date = htmlspecialchars(get_field('eventDetail_first_date'));
    $event_first_date_babysitting = get_field('eventDetail_first_date_babysitting');
    $event_last_date = htmlspecialchars(get_field('eventDetail_last_date'));
    $event_last_date_babysitting = get_field('eventDetail_last_date_babysitting');

    $exhibition = get_field('eventDetail_exhibition');

    $event_other_dates = get_field('eventDetail_otherdates');
    $event_landscape_media = get_field('eventDetail_landscapeMedia');

    $eventDetail_mediaMarkup = get_field('eventDetail_mediaMarkup');
    $eventDetail_showPic = get_field('eventDetail_showPic');
    $noms_principaux = get_field('noms_principaux');
    $event_dealer_link = get_field('eventDetail_dealer-link');

    $attached = get_post_meta(get_the_ID(), 'wp_custom_attachment', true);
    $presskit = get_field('presskit');

    $event_distribution = get_field('eventDetail_distribution');
    $event_mentions = get_field('eventDetail_mentions');

    $enfantsdabord = get_field('enfants_dabord');
    $trenteans = get_field('trenteans');
	$logo_festival = get_field( 'event_festival_logo' );
	$partenaires = get_field( 'event_partenaires' );

    $age = get_the_terms(get_the_ID(), 'public');
    $services = get_the_terms(get_the_ID(), 'services');

    if ($event_first_date_babysitting || $event_last_date_babysitting) {
        $babysitting = true;
    }

    if (have_rows('eventDetail_otherdates')) :
        $otherdates = '';

        while (have_rows('eventDetail_otherdates')) : the_row();
            $otherdates .= '<li class="frame_row h4_2">';
            $otherdates .= get_sub_field('date');
            //$otherdates .= strftime('%A %d %B %G - %kh%M', strtotime( get_sub_field('date') ) );

            if (get_sub_field('date_endtime') != '') {
                $otherdates .= ' à ' . get_sub_field('date_endtime');
            }

            $otherdates .= '</li>';
        endwhile;

    endif;
    ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	    <header class="single_header">
            <?php get_template_part('Components/blocs/bloc', 'slide'); ?>
        </header>


        <section class="single_contents">

            <div class="wrapper grid">

                <div class="s_12col m_7col contents_main">

                    <div class="single_texts">


                        <div class="single_body body mb-medium">

                            <div class="single_chapo big_typo">
                                <?php the_field('eventDetail_shortText') ?>
                            </div>

                            <?php the_content(); ?>
                        </div>



                        <?php if ($event_distribution) : ?>
                            <div class="single_mentions">
                                <div class="entry-accordeon">

                                    <div class="accordeon-title flex --jstf --gap-xs">
                                        <h3 class="h4_2">Distribution et mentions complètes</h3>

                                        <span>
						                    <?php get_template_part('Components/svgs/svg', 'plus'); ?>
                                        </span>
                                    </div>
                                    <div class="accordeon-content">

                                        <?php echo $event_distribution; ?>

                                        <?php if ($event_mentions) :
                                            echo $event_mentions;
                                        endif; ?>
                                            

                                        <div class="">

                                            <?php if ($attached) : ?>
                                                <p class="attached-file">
                                                    <a href="<?php echo $attached['url']; ?>" class="btn--big">
                                                        Dossier de presse
                                                    </a>
                                                </p>
                                            <?php endif; ?>

                                            <?php if ($presskit) : ?>
                                                <a href="<?php echo $presskit['url']; ?>" class="btn--big">Dossier de presse</a>
                                            <?php endif; ?>

                                        </div>    
                                    </div>
                                
                                </div>
                            </div>
                            <?php endif; ?>




	                </div>
                </div>


                <div class="s_12col m_5col l_4col w_3col contents_practical">

                    <?php if( have_rows('event_keywords') ): $words = []; ?>
						<?php while( have_rows('event_keywords') ) : the_row(); ?>
							<?php array_push( $words, get_sub_field('keyword') ); ?>
						<?php endwhile; ?>
                        <?php if( ! empty($words) ) : ?>
                            <div class="single_frame mb-small">
                                <?php get_template_part('Components/modules/module', 'ticker', array('words' => $words)); ?>
                            </div>
						<?php endif; ?>
					<?php endif; ?>


                    <div class="single_frame mb-medium">

                        <?php if($tags) : ?>
                            <div class="frame_row --nopad">
                                <span class="h4_2 flex --hcentered --gap-s">
                                    <?php foreach($tags as $tag) { 
                                        $image = get_field('visuel_white', 'discipline' . '_' . $tag->term_id); ?>
                                        <img src="<?php echo $image; ?>" class="single_taxmedia">
                                        <?php echo $tag->name; ?>
                                    <?php } ?></span>
                            </div>
                        <?php endif; ?>


                        <?php

                                if ($exhibition) {
                                    echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition);
                                } 
                                else {

                                    if ($event_first_date) :
                                        echo '<ul class=" no-bullets">';
                                            echo '<li class="frame_row flex --jstf --hcentered h4_2"><span>';
                                                if (get_field('eventDetail_first_date_endtime') != '') {
                                                    echo strftime('%A %d %B %G - %kh%M', $event_first_date);
                                                } else {
                                                    echo strftime('%A %d %B %G - %kh%M', $event_first_date);
                                                }

                                                if (get_field('eventDetail_first_date_endtime') != '') {
                                                    echo ' à ' . get_field('eventDetail_first_date_endtime');
                                                }
                                                
                                                echo '</span><a href="' . get_field('eventDetail_dealer-link') . '" target="_blank" class="btn">Réserver</a>';

                                            echo '</li>';

                                        if (isset($otherdates)) {
                                            echo $otherdates;
                                        }

                                        if ($event_other_dates) :
                                            foreach ($event_other_dates as $date) {
                                                $date = strtotime($date['date']);
                                                if ($date != '') :
                                                    echo '<li class="frame_row h4_2 flex --jstf --hcentered"><span>' . strftime('%A %d %b %G - %kh%M', $date) . '</span><a href="' . get_field('eventDetail_dealer-link') . '" target="_blank" class="btn">Réserver</a></li>';
                                                endif;
                                            }
                                        endif;

                                        if ($event_last_date && $event_last_date != $event_first_date) :
                                            echo '<li class="frame_row h4_2 flex --jstf --hcentered"><span>';
                                                if (get_field('eventDetail_last_date_endtime') != '') {
                                                    echo strftime('%A %d %B %G - %kh%M', $event_last_date);
                                                } else {
                                                    echo strftime('%A %d %B %G - %kh%M', $event_last_date);
                                                }
                                                if (get_field('eventDetail_last_date_endtime') != '') {
                                                    echo ' à ' . get_field('eventDetail_last_date_endtime');
                                                }
                                            echo '</span><a href="' . get_field('eventDetail_dealer-link') . '" target="_blank" class="btn">Réserver</a></li>';

                                        endif;

                                        echo '</ul>';
                                    endif;
                                }
                                ?>


                        <div class="frame_row flex">

                            <div class="frame_col">
                                <?php

                                    $main_tarif_id = get_post_meta($post->ID, '_yoast_wpseo_primary_tarif', true);

                                    /// SI TARIF PRIMARY SEO
                                    if ($main_tarif_id) {

                                        $main_tarif = get_term($main_tarif_id, 'tarif');

                                        echo "<ul class='no-bullets'>";

                                        echo "<li class='label_0'><span>tarif " . $main_tarif->name . "</span><br>" . $main_tarif->description . "</li>";

                                        $term_list = wp_get_post_terms(
                                            $post->ID,
                                            'tarif',
                                            array(
                                                "fields" => "all",
                                                "exclude"    => array($main_tarif_id)
                                            )
                                        );

                                        $count = count($term_list);
                                        if ($count > 0) {

                                            foreach ($term_list as $term) {
                                                echo "<li class='label_0'><span>tarif " . $term->name . "</span><br>" . $term->description . "</li>";
                                            }

                                            echo '<li><a href="/pratique/tarifs/" class="btn-inline">tous les tarifs et conditions</a></li>';

                                            if ($event_text2) :
                                                echo "<li>" . $event_text2 . "</li>";
                                            endif;
                                        }

                                        echo "</ul>";
                                    }

                                    // SI PLUGIN SEO DESACTIVE
                                    else {

                                        $term_list = wp_get_post_terms(
                                            $post->ID,
                                            'tarif',
                                            array(
                                                "fields" => "all",
                                            )
                                        );

                                        $count = count($term_list);
                                        if ($count > 0) {
                                            echo "<ul class='no-bullets'>";

                                            foreach ($term_list as $term) {
                                                echo "<li class='label_0'><span>tarif " . $term->name . "</span><br>" . $term->description . "</li>";
                                            }

                                            echo '<li><a href="/pratique/tarifs/" class="btn-inline">tous les tarifs et conditions</a></li>';

                                            if ($event_text2) :
                                                echo "<li>" . $event_text2 . "</li>";
                                            endif;

                                            echo "</ul>";
                                        } else {

                                            if ($event_text2) :
                                                echo "<ul class='no-bullets'><li>" . $event_text2 . "</li></ul>";
                                            endif;
                                        }
                                    } ?>

                            </div>

                            <div class="frame_col">
                                <?php if ($age && !is_wp_error($age)) : ?>
                                    <?php foreach ($age as $term) {
                                        echo "<span class='label_0'>" . $term->name . "</span>";
                                    }; ?>
                                <?php endif; ?>
                            </div>


                        </div>

                        <?php if ($services && !is_wp_error($services)) : ?>
                            <div class="frame_row single_services flex --centered --gap-xs">
                                    <?php foreach ($services as $s) {
                                        $image = get_field('picto', 'services' . '_' . $s->term_id); ?>
                                        <img src="<?php echo $image; ?>" class="single_servicemedia">
                                    <?php }; ?>
                            </div>
                        <?php endif; ?>


                        <?php if ( ! empty($partenaires) ) : ?>
                            <div class="frame_row flex --centered --gap-xs">
                                <?php foreach( $partenaires as $p ) : ?>
                                    <img src="<?php echo $p["logo"]?> " class="single_partners_logo">
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>

                    </div><!-- .single_frame -->



                    <?php if ($enfantsdabord || $trenteans) : ?>
                        <div class="pictos-trente mb-medium">

                            <?php if ($enfantsdabord) : ?>
                                <div class="picto-enfantsdabord">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_enfantsdabord.png" class="">
                                </div>
                            <?php endif; ?>

                            <?php if ($trenteans) : ?>
                                <div class="picto-trenteans">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icon_30ans.png" class="">
                                </div>
                            <?php endif; ?>

                        </div>
                    <?php endif; ?>

                    
                    <?php if ( $logo_festival ): ?>
                        <?php if ( $logo_festival ): ?>
                            <div class="single_logo_festival mb-medium">
                                <img src="<?php echo $logo_festival; ?>" class="">
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>


                    <div class="single_cta">
                        <a href="/programmation" class="flex --gap-m --hcentered">
                            <span>Programmation <br>complète</span>
                            <?php get_template_part('Components/svgs/svg', 'arrow'); ?>
                        </a>
                    </div>

                </div>

            </div>
        </section>



        <?php get_template_part('Components/modules/module', 'flexibles'); ?>



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
	        "startDate": "<?php echo strftime('%Y-%m-%dT%H:%M:00', $event_first_date); ?>",
	        "duration": "<?php echo $event_duration; ?>"
	    }
	</script>