
<?php 
    $post = $args['page']; 
    setup_postdata( $post );
?>

<section class="mod_pagealone">
    <div class="inner wrapper">

        <div class="grid --centered">

            <div class="m_6col">

                <div class="mb-large">
                    <h2 class="h2 mb-medium"><?php the_title(); ?></h2>
                    <?php the_excerpt(); ?>
                </div>

                <div class="mod_cta">
                    <a href="<?php the_permalink(); ?>" class="btn">En savoir plus</a>
                </div>
            </div>

            <div class="m_6col">
                <?php the_post_thumbnail(); ?>
            </div>

        </div>
    </div>
</section>

<?php wp_reset_query();?>

