
<?php 
    $post = $args['page']; 
    setup_postdata( $post );
?>

<section class="mod_pagealone" style="background-image: url('<?php the_field('texture_from_five_to_none', 'option'); ?>');
">
    <div class="inner wrapper">

        <div class="grid --centered">

            <div class="s_12col m_6col bloc_texts">

                <div class="mb-xlarge">
                    <h2 class="h2 mb-medium"><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                </div>

                <div class="mod_cta">
                    <a href="<?php the_permalink(); ?>" class="btn">En savoir plus</a>
                </div>
            </div>

            <div class="s_12col m_6col bloc_cover_outer">
                <?php the_post_thumbnail('top-thumbnail'); ?>
            </div>

        </div>
    </div>
</section>

<?php wp_reset_query();?>

