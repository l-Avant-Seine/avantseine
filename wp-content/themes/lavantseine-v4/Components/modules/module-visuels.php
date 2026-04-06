<?php 
    $visuels = $args['visuels'];
    $title = $args['title'];

    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');
?>


    <section class="mod_visuels">
        <div class="wrapper swiper-visuels">

            <div class="flex --jstf mb-medium">
                <div class="mod_title ">
                    <h3 class="h2_2"><?php echo $title; ?></h3>
                </div>
            </div>



            <div class="swiper-wrapper">
                <?php foreach ( $visuels as $visuel ) : ?>

                    <div class="swiper-slide">
                        <img src="<?php echo $visuel['sizes']['large']; ?>">  
                    </div>

                <?php endforeach; ?>
            </div>
                            
                <div class="mod_nav flex --jstf --hcentered --gap-xs">
                    <div class="swiper-btn-prev">
                        <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                    </div>

                    <div class="swiper-btn-next">
                        <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                    </div>
                </div>

                
        </div>
    </section>
