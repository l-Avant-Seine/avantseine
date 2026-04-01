<?php

    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();

	$args = array(
			'post_type' 			=> 'event',
			'posts_per_page' 		=> -1,
			'post_status'			=> 'publish', 
			'meta_key' => 'eventDetail_first_date',
			'orderby' => 'meta_value_num',
			'order' => 'ASC',
			'meta_query' => array(
			   	array(
			       'key' => 'eventDetail_last_date',
			       'value' => $today,
			       'compare' => '>=',
			    ) 
			)	
	);

	$next_events = get_posts( $args );
?>


<section class="mod_calendar">
	
    <div class="inner">

        <div class="swiper-calendar">

            <div class="swiper-wrapper">
                <?php foreach ( $next_events as $post ) : setup_postdata( $post ); ?>

                    <div class="swiper-slide">

                        <?php 
                            $focus_event_id = $post->ID;
                            $focus_event_media_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'homeslide' );
                            $event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date', $post->ID ) );
                        ?>

						<?php 
							set_query_var('focus_event_id', $focus_event_id);
							set_query_var('post', $post);
							get_template_part('Components/blocs/bloc', 'event'); ?>
                    
                    </div>

                <?php endforeach; wp_reset_query();?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->


		<?php foreach ( $next_events as $post ) : setup_postdata( $post ); ?>
		
		  	


	




		<?php endforeach; 
		wp_reset_postdata(); ?>


	</div>
</section>





<script>
	
    //   // 2. This code loads the IFrame Player API code asynchronously.
    //   var tag = document.createElement('script');

    //   tag.src = "https://www.youtube.com/iframe_api";
    //   var firstScriptTag = document.getElementsByTagName('script')[0];
    //   firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    //   // 3. This function creates an <iframe> (and YouTube player)
    //   //    after the API code downloads.
    //   var player;


    //   function toggleSound() {
    //     if (player.isMuted()) {
    //       player.unMute()
    //     } else {
    //       player.mute()
    //     }
    //   }

    //   function onYouTubeIframeAPIReady() {
    //     player = new YT.Player('player', {
    //       playerVars: { 'autoplay': 1, 'controls': 0, 'loop': 1, 'showinfo': 0, 'modestbranding': 1, 'start': 1, 'enablejsapi': 1 },
    //       events: {
    //         'onReady': onPlayerReady, toggleSound,
    //       }
    //     });
    //   }

    //   // 4. The API will call this function when the video player is ready.
    //   function onPlayerReady(event) {
    //     event.target.playVideo();
    //      player.mute();
    //   }

    //   // 5. The API calls this function when the player's state changes.
    //   //    The function indicates that when playing a video (state=1),
    //   //    the player should play for six seconds and then stop.
    //   var done = false;
    //   function onPlayerStateChange(event) {
    //     if (event.data == YT.PlayerState.PLAYING && !done) {
    //       setTimeout(stopVideo, 6000);
    //       done = true;
    //     }
    //   }
    //   function stopVideo() {
    //     player.stopVideo();
    //   }

</script>
