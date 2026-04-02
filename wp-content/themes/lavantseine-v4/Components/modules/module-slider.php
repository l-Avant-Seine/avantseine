<?php 
    $posts = $args['posts']; 
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');
?>

<section class="mod_slider cf">
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

            <div class="mod_nav flex --gap-xs">
                <div class="swiper-btn-prev">
                    <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                </div>
                <div class="swiper-btn-next">
                    <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                </div>
            </div>

            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->

	</div>
</section>
