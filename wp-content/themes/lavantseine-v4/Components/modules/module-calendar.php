<?php

    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

?>


<section class="mod_calendar loading">
    <div class="inner">

        <div id="loader" class="loader flex --centered">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/img/loader.gif">
        </div>

        <div id="calendar_inner"></div>

        <div class="mod_bg">
            <div class="mod_color"></div>
            <img class="mod_texture" src="<?php the_field('texture_from_one_to_none', 'option'); ?>">
        </div>

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
