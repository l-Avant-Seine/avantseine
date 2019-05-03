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
	
		<?php foreach ( $last_events as $post ) : setup_postdata( $post ); ?>
		
		  <div class="slide is-flex ">
		  	
		  	<div class="event-teaser">
					<?php 
						$focus_event_media_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
						$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date', $post->ID ) );
						$event_dealer_link = get_field( 'eventDetail_dealer-link' ); ?>

			  	<a href="<?php the_permalink(); ?>" class="slide-cover">
			  		<img src="<?php if( get_field('gif', $focus_event_id ) ) : the_field('gif', $focus_event_id); else : echo $focus_event_media_url[0]; endif; ?>" alt="">
			  	</a>

			  	<div class="slide-text">
			  		<div class="inner">
	
							<?php 
								set_query_var('focus_event_id', $focus_event_id);
								set_query_var('post', $post);
								get_template_part('template-parts/blocs/header', 'event'); ?>

				  		<div class="row teaser-actions">

				  			<div class="s-20col m-10col s-1col-push ">

									<?php if( intval($event_last_date) > $today ) : ?>
										<a href="<?php echo $event_dealer_link; ?>" target="_blank" class="btn-primary--white">réserver</a>
									<?php endif; ?>
				  				<a href="<?php the_permalink(); ?>" class="btn-primary--white">en savoir plus</a>

				  			</div>

				  			<div class="m-8col m-last s-hide m-show">
									<span class="meta-names"><?php the_field( 'noms_principaux' ); ?></span>
				  			</div>

				  		</div>
				  		
						</div>
					</div>
			  </div>
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
