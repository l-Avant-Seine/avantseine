
<?php 
    $title = $args['title']; 
    $visuel = $args['visuel'];
    $content = $args['content']; 
    $label = $args['label']; 
    $link = $args['link']; 
?>

<section class="mod_pagealone" style="background-image: url('<?php the_field('texture_from_five_to_none', 'option'); ?>');
">
    <div class="inner wrapper">

        <div class="grid --centered">

            <div class="s_12col m_6col bloc_texts">

                <div class="mb-xlarge">
                    <h2 class="h2 mb-medium"><?php echo $title ?></h2>
                    <?php echo $content; ?>
                </div>

                <div class="mod_cta">
                    <a href="<?php echo $link; ?>" class="btn"><?php echo $label; ?></a>
                </div>
            </div>

            <div class="s_12col m_6col bloc_cover_outer">
                <img src="<?php echo $visuel["sizes"]['top-thumbnail']; ?>" alt="<?php echo $visuel["title"]; ?>">
            </div>

        </div>
    </div>
</section>

<?php wp_reset_query();?>

