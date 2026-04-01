<?php 

global $wp;
$current_url = home_url(add_query_arg(array(),$wp->request)) . '/';

$childpages = new WP_Query( array(
  'post_type'       => 'page', 
  'post_parent'     => $root,
  'posts_per_page'  => -1,
  'orderby'         => 'date',
  'order'           => 'DESC'
)); ?>


  <ul class="pages-menu nobullets">

    <li class="page-title pages-menu-item" itemprop="name">
      <h1 class="h_3"><?php echo $root_title; ?></h1>
    </li>
    
    <?php while ( $childpages->have_posts() ) : $childpages->the_post(); ?>

      <li class="pages-menu-item <?php if( strpos($current_url, get_permalink() ) !== false ) { echo 'active'; } ?>">
        <a href="<?php the_permalink(); ?>"><span class="icon-arrow-left"></span><?php the_title(); ?></a>
      </li>

    <?php endwhile; wp_reset_query(); ?>  

  </ul>    
