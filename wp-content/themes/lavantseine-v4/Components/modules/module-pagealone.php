
<?php 
    $post = $args['page']; 
    setup_postdata( $post );
?>

<section class="">
    <div class="inner wrapper">


        <div class="grid">

            <div class="m_6col">
                <h2><?php the_title(); ?></h2>
                <?php the_content(); ?>

                <a href="<?php the_permalink(); ?>">En savoir plus</a>
            </div>

            <div class="m_6col">
                <?php the_post_thumbnail(); ?>
            </div>

        </div>
    </div>
</section>

<?php wp_reset_query();?>

