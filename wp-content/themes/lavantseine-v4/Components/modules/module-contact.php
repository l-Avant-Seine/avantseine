


<section class="mod_contact">
    <div class="inner">

        <div class="mod_textures">
            <img src="<?php echo get_template_directory_uri(); ?>/Components/textures/texture_contact.jpg" class="texture">
            <img src="<?php echo get_template_directory_uri(); ?>/Components/textures/texture_contact.jpg" class="texture inversed">
        </div>

        <div class="grid wrapper">

            <div class="s_12col m_6col flex --col">
                <h2 class="mod_title h2_2 mb-medium"><?php echo $args['title_news']; ?></h2>

				<?php get_template_part('Components/blocs/bloc', 'newsletter');  ?>
            </div>

            <div class="s_12col m_6col flex --col --centered">
                <h2 class="mod_title h2_2 mb-medium"><?php echo $args['title_rs']; ?></h2>

                <div class="flex --gap-m --hcentered">
				    <?php get_template_part('Components/blocs/bloc', 'reseaux');  ?>
                </div>

            </div>

        </div>
    </div>
</section>