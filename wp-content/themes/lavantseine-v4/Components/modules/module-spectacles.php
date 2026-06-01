<?php 
    $posts = $args['relations'];
    $title = $args['title'];
    $label = $args['label'];
    $link = $args['link'];
    $by_tags = $args['by_tags'];

    wp_enqueue_script('swiper');
    wp_enqueue_style('swiper');


    if( $by_tags ) {

        $relational_tags = wp_get_post_terms($post->ID, 'relational_tag', array('orderby' => 'none',));
        $tags = [];


        if (!empty($relational_tags)) :
            foreach( $relational_tags as $tag ) {
                array_push($tags, $tag->slug );
            }
        endif;

        $args = array(
            'post_type'          => array('event'),
            'posts_per_page'    => -1,
            'orderby'           => 'post_date',
            'order'            => 'DESC',
            'post__not_in'     => array($post->ID),
            'tax_query' => array(
                array(
                    'taxonomy' => 'relational_tag',
                    'field' => 'slug',
                    'terms' => $tags
                ),
            ),
        );

        $posts = get_posts($args);

    }





?>


    <section class="mod_spectacles"  style="background-image: url('<?php the_field('texture_from_five_to_none', 'option'); ?>')">

        <div class="mod_bg flex --col">
            <div class="bg_upper">
            </div>
            <div class="bg_lower">
            </div>
        </div>
        
        <div class="wrapper swiper-spectacles">

            <div class="flex --jstf mb-medium">

                <div class="mod_title ">
                    <h3 class="h2_2"><?php echo $title; ?></h3>
                </div>


                <div class="mod_nav flex --hcentered --gap-xs">
                    <div class="swiper-btn-prev">
                        <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
                    </div>

                    <a class="btn" href="<?php echo $link; ?>"><?php echo $label; ?></a>

                    <div class="swiper-btn-next">
                        <?php get_template_part('Components/svgs/svg', 'arrow'); ?> 
                    </div>
                </div>

            </div>



            <div class="swiper-wrapper">
                <?php foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="swiper-slide">
                         <?php get_template_part('Components/blocs/bloc', 'event', array('post' => $post->ID)); ?>
                    </div>

                <?php endforeach; wp_reset_query();?>
            </div>
                            

        </div>
    </section>
