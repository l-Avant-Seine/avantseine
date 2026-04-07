<?php

    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

?>


<section class="mod_calendar">
	
    <div class="inner wrapper">

        <div class="swiper-calendar">

            <div class="mod_nav flex --gap-xs mb-small">
                <div class="swiper-btn-prev">
                    <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                </div>
                <div class="swiper-btn-next">
                    <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                </div>
            </div>

            <div class="mod_title mb-small">
                <h2 class="h2"><?php echo $args['title']; ?></h2>
            </div>

            <div class="swiper-wrapper" id="calendar_inner"></div>

            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->

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
