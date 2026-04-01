<?php 
    $posts = $args['relations']; 
?>

<section class="module-slider cf">
	<div class="inner wrapper">
    
        <div class="grid">

                <?php 
                foreach ( $posts as $post ) : setup_postdata( $post ); ?>

                    <div class="s_6col m_3col">

                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>
                            <h2><?php the_title(); ?></h2>
                            <?php get_template_part('Components/svgs/svg', 'arrow'); ?>
                        </a>
                    </div>

                <?php endforeach; wp_reset_query();?>
        </div>

        
	</div>
</section>
