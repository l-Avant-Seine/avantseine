<?php
/**
 * @package lavantseine
 */

$terms = get_the_terms( get_the_ID(), 'relational_tag' );


?>


<article id="post-<?php the_ID(); ?>" class="article-item mb-2 <?php if(!$terms) { echo 'item-big'; } ?>" <?php post_class(); ?>>

	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="inner">

			<header class="item-header mb-1">

				<img class="item-cover b-lazy" 
						src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
						data-src="<?php the_post_thumbnail_url('top-thumbnail'); ?>">

				<?php 

					$categories = get_the_category();
					$separator = ' et ';
					$output = '';
					if($categories){
						foreach($categories as $category) {
							$output .= '<span class="postmeta-term label_1">'. $category->cat_name .'</span> ';
						}
					}

					$pos = strpos($output, 'Vidéo');
					if ($pos !== false) { ?>
					    <div class="icon-video">
					    	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/play_boutontransparent.png" alt="">
					    </div>
					<?php } ?>

				<div class="item-tax">
					<?php echo trim($output, $separator); ?>
				</div><!-- .post-categories -->

			</header><!-- .item-header -->

			<div class="item-text">

				<h2 class="<?php if(!$terms) { echo 'h_4 '; } else { echo 'h_4'; } ?> item-title cf">	
						<?php the_title(); ?>
				</h2>

				<?php
					if( $terms) : 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p class='clearfix item-excerpt'>".$post_shortText. "</p>";
					endif;
				?>
			</div><!-- .item-text -->


		</div><!-- .inner -->
	</a>
</article><!-- #post-## -->
