
<div class="bloc-reseaux">

    <div classs="">
        <ul class="no-bullets flex --gap-xs">
            <li><a href="<?php the_field('link_facebook', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'social-fb'); ?>
            </a></li>
            <li><a href="<?php the_field('link_instagram', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'social-ig'); ?>
            </a></li>
            <li><a href="<?php the_field('link_youtube', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'social-yt'); ?>
            </a></li>
            <li><a href="<?php the_field('link_linkedin', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'social-li'); ?>
            </a></li>
            <li><a href="<?php the_field('link_tiktok', 'option'); ?>" target="_blank" class="btn--social">
                <?php get_template_part('Components/svgs/svg', 'social-tt'); ?>
            </a></li>
        </ul>
    </div>
</div>



