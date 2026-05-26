


<section class="mod_contact">
    <div class="inner">

        <div class="mod_textures">
            <img src="<?php echo get_template_directory_uri(); ?>/Components/textures/texture_newsletter.jpg" class="texture">
        </div>

        <div class="flex --centered --col --gap-m wrapper">

            <div class="s_6col flex --centered --col">
                <h2 class="mod_title h2_2 mb-medium"><?php echo $args['title_news']; ?></h2>

				<?php get_template_part('Components/blocs/bloc', 'newsletter');  ?>
            </div>

            <div class="s_6col flex --col --centered">
                <h2 class="mod_title h2_2 mb-medium"><?php echo $args['title_rs']; ?></h2>

                <div class="flex --gap-m --hcentered">
				    <?php get_template_part('Components/blocs/bloc', 'reseaux');  ?>
                </div>

            </div>

        </div>
    </div>
</section>