<?php


	setlocale(LC_TIME, 'fr_FR.UTF8', 'fr.UTF8', 'fr_FR.UTF-8', 'fr.UTF-8');
	$today = time();

	$args = array(
		'post_type' 			=> 'event',
		'posts_per_page' 	=> '1',
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
	$last_event = get_posts( $args );
	$last_event = $last_event[0];
	$focus_event_id = $last_event->ID;

	// $focus_event = get_field('focus_event', 'option'); 
	// $focus_event_id = $focus_event->ID;
	
	$focus_event_media_url = wp_get_attachment_image_src( get_post_thumbnail_id( $focus_event_id ), 'large' );
	$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date', $focus_event_id ) );
	$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date', $focus_event_id ) );



	if( $focus_event_id ): ?>

	<section class="module-focus bg_cover" style="background-image: url(<?php if( get_field('gif', $focus_event_id ) ) : the_field('gif', $focus_event_id); else : echo $focus_event_media_url[0]; endif; ?>);">


		<?php //if( get_field( 'eventDetail_mediaMarkup', $focus_event_id ) ) : ?>

			<?php //the_field( 'eventDetail_mediaMarkup', $focus_event_id ); ?>
			<!-- <a href="#" id="js-soundToggle" class="btn-soundToggle">le son !</a> -->

		<?php // endif; ?>


		<div class="moduleInner is-flex row_alt">

	    	<div class="focusEvent_infos m-3coll offset-right">
	    		<a href="<?php echo get_permalink($focus_event_id); ?>">
	    			<span>Le prochain rendez-vous</span><br><br>
	    			<h3 class="h1 no-margin"><?php echo get_the_title($focus_event_id); ?></h3>
	    			<span class="meta-date"><?php the_field( 'noms_principaux', $focus_event_id ); ?></span><br>
						<span class="meta-date"><?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates = false); ?></span>
	    		</a>
	    	</div>


			<?php if( have_rows('focus_elements', 'option') ): ?>

		   	<?php while ( have_rows('focus_elements', 'option') ) : the_row();

		        if( get_row_layout() == 'focusElements_page' ):
		        	$focusElements_page = get_sub_field('focusElements_page'); ?>

							<div class="focusElement_item m-1coll">
								
								<?php if( get_sub_field('pastille') != '' ) : ?>
									<div class="focusElement-pastille is-flex">
										<span><?php the_sub_field('pastille'); ?></span>
									</div>
								<?php endif; ?>

								<div class="square">
									<a href="<?php echo get_permalink( $focusElements_page->ID ); ?>">
										<div class="square-content bg_cover" style="background-image: url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_page->ID ), 'large' )[0]; ?>);">
										</div>
									</a>
								</div>
								
								<div class="inner">
									<a href="<?php echo get_permalink( $focusElements_page->ID ); ?>">
						    		<h3 class="h5"><?php echo $focusElements_page->post_title; ?></a></h3>
						    		<div><?php the_field('pageDetail_intro', $focusElements_page->ID ); ?></div>
						    	</a>
						    </div>

					    </div>

		        <?php elseif( get_row_layout() == 'focusElements_article' ): 
		        	$focusElements_article = get_sub_field('focusElements_article'); ?>
							
								<div class="focusElement_item m-1coll">

									<?php if( get_sub_field('pastille') != '' ) : ?>
										<div class="focusElement-pastille is-flex">
											<span><?php the_sub_field('pastille'); ?></span>
										</div>
									<?php endif; ?>

									<div class="square">
										<a href="<?php echo get_permalink( $focusElements_article->ID ); ?>">
											<div class="square-content bg_cover" style="background-image: url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_article->ID ), 'large' )[0]; ?>);"">
											</div>
										</a>
									</div>

									<div class="inner">
										<a href="<?php echo get_permalink( $focusElements_article->ID ); ?>">
							    		<h3 class="h5"><?php echo $focusElements_article->post_title; ?></h3>
							    		<div class="focusElement_p"><?php echo $focusElements_article->excerpt; ?></div>
							    	</a>
							    </div>
						    </div>



		        <?php elseif( get_row_layout() == 'focusElements_event' ): 
		        	$focusElements_event = get_sub_field('focusElements_page');  ?>
							
								<div class="focusElement_item m-1coll">

									<?php if( get_sub_field('pastille') != '' ) : ?>
										<div class="focusElement-pastille is-flex">
											<span><?php the_sub_field('pastille'); ?></span>
										</div>
									<?php endif; ?>

									<div class="square">
										<a href="<?php echo get_permalink( $focusElements_event->ID ); ?>">
											<div class="square-content bg_cover" style="background-image: url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_event->ID ), 'large' )[0]; ?>);"">
											</div>
										</a>
									</div>

									<div class="inner">
										<a href="<?php echo get_permalink( $focusElements_event->ID ); ?>">
							    		<h3 class="h5"><?php echo $focusElements_event->post_title; ?></h3>
							    		<div class="focusElement_p"><?php echo $focusElements_event->excerpt; ?></div>
							    	</a>
							    </div>
						    </div>
						   



		        <?php elseif( get_row_layout() == 'focusElements_libre' ): ?>
							
								<div class="focusElement_item m-1coll">

									<?php if( get_sub_field('pastille') != '' ) : ?>
										<div class="focusElement-pastille is-flex">
											<span><?php the_sub_field('pastille'); ?></span>
										</div>
									<?php endif; ?>

									<div class="square">
										<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
											<div class="square-content bg_cover" style="background-image: url(<?php the_sub_field('focusElements_libre_image'); ?>);"">
											</div>
										</a>
									</div>

									<div class="inner">
										<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
							    		<h3 class="h5"><?php the_sub_field('focusElements_libre_titre'); ?></h3>
							    		<div class="focusElement_p"><?php the_sub_field('focusElements_libre_texte'); ?></div>
							    	</a>
							    </div>
						    </div>

		        <?php endif;

		    endwhile; ?>


		<?php else :

		endif; ?>



	</div>
</section>

		<?php endif; ?>




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
