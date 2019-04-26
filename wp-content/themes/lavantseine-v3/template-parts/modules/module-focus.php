<?php
	global $focus_event_id; 
	wp_enqueue_script('slick');


	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();

	$args = array(
		'post_type' 			=> 'event',
		'posts_per_page' 	=> '4',
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
	$last_events = get_posts( $args ); ?>


	<div class="home-slides">
	
		<?php foreach ( $last_events as $post ) : setup_postdata( $post ); 
		
			$focus_event_media_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
			$exhibition = get_field( 'eventDetail_exhibition', get_the_ID() );
			$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date', $post->ID ) );
			$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date', $post->ID ) );
			$event_other_dates = get_field('eventDetail_otherdates', $post->ID ); ?>

					
		  <div class="slide is-flex">
		  	
		  	<a href="<?php the_permalink(); ?>" class="slide-cover">
		  		<img src="<?php if( get_field('gif', $focus_event_id ) ) : the_field('gif', $focus_event_id); else : echo $focus_event_media_url[0]; endif; ?>" alt="">
		  	</a>

		  	<a href="<?php the_permalink(); ?>" class="slide-text">
		  		<h3 class="h_1 slide-title mb-05"><?php the_title(); ?></h3>
		  		<span class="label_2"><?php the_field( 'noms_principaux' ); ?></span><br>
					<span class="label_3"><?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?></span>
		  	</a>

		  </div>



		<?php endforeach; 
		wp_reset_postdata(); ?>
	
	</div><!-- .home-slide -->





		<?php //if( get_field( 'eventDetail_mediaMarkup', $focus_event_id ) ) : ?>

			<?php //the_field( 'eventDetail_mediaMarkup', $focus_event_id ); ?>
			<!-- <a href="#" id="js-soundToggle" class="btn-soundToggle">le son !</a> -->

		<?php // endif; ?>

		





<script>
	
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;


      function toggleSound() {
        if (player.isMuted()) {
          player.unMute()
        } else {
          player.mute()
        }
      }

      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          playerVars: { 'autoplay': 1, 'controls': 0, 'loop': 1, 'showinfo': 0, 'modestbranding': 1, 'start': 1, 'enablejsapi': 1 },
          events: {
            'onReady': onPlayerReady, toggleSound,
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
         player.mute();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }

</script>
