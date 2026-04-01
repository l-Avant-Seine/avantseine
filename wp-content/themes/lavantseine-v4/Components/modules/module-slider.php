<?php 
    $posts = $args['posts']; 
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');
?>

<section class="module-slider cf">
	<div class="inner">
    
        <div class="swiper-cover">

            <div class="swiper-wrapper">
                <?php 
                foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="swiper-slide">

                        <?php get_template_part('Components/blocs/bloc', 'slide'); ?>
                        
                    </div>

                <?php endforeach; wp_reset_query();?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->

	</div>
</section>
