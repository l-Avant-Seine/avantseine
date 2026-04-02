<?php 
    $posts = $args['relations']; 
    $title = $args['title']; 
?>

<section class="mod_magazine">
	<div class="inner wrapper">

        <div class="swiper-magazine">

            <div class="flex --jstf --hcentered mb-large">
                <div class="mod_cta">
                    <a href="/magazine" class="btn">voir toutes les actualités</a>
                </div>

                <div class="mod_title">
                    <h2 class="h1_2"><?php echo $title; ?></h2>
                </div>

                <div class="mod_nav flex --gap-xs">
                    <div class="swiper-btn-prev">
                        <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                    </div>
                    <div class="swiper-btn-next">
                        <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                    </div>
                </div>

            </div>
            
            <div class="swiper-wrapper">
                <?php 
                foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="swiper-slide">
                        <?php get_template_part('Components/Blocs/bloc', 'magazine'); ?>
                    </div>

                <?php endforeach; wp_reset_query();?>
            </div>

            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->

        
	</div>
</section>
