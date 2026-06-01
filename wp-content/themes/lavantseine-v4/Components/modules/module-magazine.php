<?php 
    $posts = $args['relations']; 
    $title = $args['title']; 
    $simple = $args['simple']; 
    $auto = $args['auto']; 
    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');

    if( $auto ) {

        $args = array(
            'post_type'          => array('post'),
            'posts_per_page'    => 8,
            'orderby'           => 'post_date',
            'order'            => 'DESC',
        );

        $posts = get_posts($args);

    }

?>

<section class="mod_magazine" style="background-image: url('<?php the_field('texture_from_five_to_none', 'option'); ?>')">

    <div class="mod_bg flex --col">
        <div class="bg_upper">
        </div>
        <div class="bg_lower">
        </div>
    </div>

	<div class="inner wrapper">

        <div class="swiper-magazine">

            <div class="mod_upper flex --jstf --hcentered mb-large">
                <?php if( ! $simple ) : ?>
                    <div class="mod_cta">
                        <a href="/magazine" class="btn">voir toutes les actualités</a>
                    </div>
                <?php endif; ?>

                <div class="mod_title txt-center">
                    <h2 class="<?php echo $simple ? 'h2_3' : 'h1_2'; ?>"><?php echo $title; ?></h2>
                </div>

                <div class="mod_nav flex --end --gap-xs">
                    <div class="swiper-btn-prev">
                        <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                    </div>
                    <div class="swiper-btn-next">
                        <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                    </div>
                </div>

            </div>
            
            <div class="mod_lower swiper-wrapper">
                <?php 
                foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="swiper-slide">
                        <?php get_template_part('Components/blocs/bloc', 'magazine'); ?>
                    </div>

                <?php endforeach; wp_reset_query();?>
            </div>

            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->

        
	</div>
</section>
