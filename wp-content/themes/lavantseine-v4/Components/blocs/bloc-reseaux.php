
<div class="bloc-reseaux">

    <div classs="">
        <ul class="no-bullets flex --gap-xs">
            <li><a href="<?php the_field('link_facebook', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'fb'); ?>
            </a></li>
            <li><a href="<?php the_field('link_instagram', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'ig'); ?>
            </a></li>
            <li><a href="<?php the_field('link_youtube', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'yt'); ?>
            </a></li>
            <li><a href="<?php the_field('link_linkedin', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'li'); ?>
            </a></li>
            <li><a href="<?php the_field('link_tiktok', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'tt'); ?>
            </a></li>
        </ul>
    </div>
</div>



