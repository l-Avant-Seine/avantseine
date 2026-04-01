<?php 
    $posts = $args['relations']; 
    $title = $args['title']; 
?>

<section class="module-magazine">
	<div class="inner wrapper">
    

        <div class="mod_title">
            <h2><?php echo $title; ?></h2>
        </div>

        <div class="swiper-magazine">

            <div class="swiper-wrapper">
                <?php 
                foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="swiper-slide">
                        <a href="<?php the_permalink(); ?>" class="--block">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php the_title(); ?></h2>
                        </a>
                    </div>

                <?php endforeach; wp_reset_query();?>
            </div>

            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
            
        </div><!-- .swiper-container -->

        
	</div>
</section>
