<?php 
    $posts = $args['relations']; 
?>

<section class="mod_pagecolumns cf">
	<div class="inner wrapper">
    
        <div class="flex --jstf --vcentered mb-large">
            <div class="">
                <h2 class="h2"><?php echo $args['title']; ?></h2>
            </div>
            <div class="">
                <a href="<?php echo $args['link']; ?>" class="btn"><?php echo $args['label']; ?></a>
            </div>
        </div>
        
        <div class="grid">

                <?php 
                foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="s_6col m_3col">

                        <img src="<?php echo get_template_directory_uri(); ?>/Components/textures/moon.png">
                        <a href="<?php the_permalink(); ?>" class="--block">
                            <h2 class="mod_title h2_2 mb-small"><?php the_title(); ?></h2>
                            <div class="mod_excerpt mb-small"><?php the_field('pageDetail_intro'); ?></div>
                            <div class="mod_cta"><?php get_template_part('Components/svgs/svg', 'arrow'); ?></div>
                        </a>
                    </div>

                <?php endforeach; wp_reset_query();?>
        </div>

        
	</div>
</section>
