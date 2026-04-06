<?php 
    $posts = $args['relations']; 
    $title = $args['title']; 
    $simple = $args['simple']; 
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');
?>

<section class="mod_magazine">
	<div class="inner wrapper">

        <div class="swiper-magazine">

            <div class="flex --jstf --hcentered mb-large">
                <?php if( ! $simple ) : ?>
                    <div class="mod_cta">
                        <a href="/magazine" class="btn">voir toutes les actualités</a>
                    </div>
                <?php endif; ?>

                <div class="mod_title">
                    <h2 class="<?php echo $simple ? 'h2_3' : 'h1_2'; ?>"><?php echo $title; ?></h2>
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
