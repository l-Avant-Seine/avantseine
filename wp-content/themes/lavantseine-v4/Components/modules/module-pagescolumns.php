<?php 
    $posts = $args['relations'];
?>

<section class="mod_pagecolumns">
	<div class="inner wrapper">
    
        <div class="flex --jstf --vcentered mb-large">
            <div class="">
                <h2 class="h2"><?php echo $args['title']; ?></h2>
            </div>
            <?php if( $args['label'] !== '') : ?>
            <div class="">
                <a href="<?php echo $args['link']; ?>" class="btn"><?php echo $args['label']; ?></a>
            </div>
            <?php endif; ?>
        </div>
        
        <div class="flex --justf --wrap --gap-s">
            <?php foreach ( $posts as $key => $post) : setup_postdata( $post ); ?>

                <div class="s_12col m_6col l_3col">

                    <a href="<?php the_permalink(); ?>" class="flex --jstf --col">

                        <div>
                            <img class="mod_icon mb-small" src="<?php echo get_template_directory_uri(); ?>/assets/img/demilunes/demilune<?php echo $key+1; ?>.png">

                            <h2 class="mod_title h2_2 mb-small"><?php the_title(); ?></h2>
                            <div class="mod_excerpt mb-small"><?php the_field('pageDetail_intro'); ?></div>
                        </div>
                        <div>
                            <div class="mod_cta"><?php get_template_part('Components/svgs/svg', 'arrow'); ?></div>
                        </div>
                    </a>

                </div>

            <?php endforeach; wp_reset_query();?>
        </div>

        
	</div>
</section>
