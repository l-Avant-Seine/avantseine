<?php
/**
 * @package lavantseine
 */

$terms = get_the_terms( get_the_ID(), 'relational_tag' );


?>


<article id="post-<?php the_ID(); ?>" class="bloc-article <?php if(!$terms) { echo 'blocArticle--big'; } ?>" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="inner-box">

			<header class="blocArticle-upper square ">

				<div class="blocArticle-terms">
					<?php
						$categories = get_the_category();
						$separator = ' ';
						$output = '';
						if($categories){
							foreach($categories as $category) {
								$output .= '<span class="postmeta-term">'. $category->cat_name .'</span>';
							}
						echo trim($output, $separator);
						}
					?>
				</div><!-- .post-categories -->

				<div class="square-content bg_cover b-lazy" data-src="<?php the_post_thumbnail_url(''); ?>">
					<?php 
						$findme   = 'Vidéo';
						$pos = strpos($output, $findme);
						if ($pos === false) {
						    
						} else { ?>
						    <div>
						    	<img src="<?php echo get_template_directory_uri(); ?>/assets/img/play_boutontransparent.png" alt="">
						    </div>
						<?php }

					?>
				</div>
			</header><!-- .entry-header -->

			<div class="blocArticle-lower">

				<h2 class="<?php if(!$terms) { echo 'h4'; } else { echo 'h4'; } ?> blocArticle-title clearfix">	
						<?php the_title(); ?>
						<br><span class="title-diamond">&#x02666;</span>
				</h2>

				<?php
					if( $terms) : 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p class='clearfix blocArticle-intro'>".$post_shortText. "</p>";
					endif;
				?>
			</div><!-- .entry-summary -->

		</div>		
	</a>
</article><!-- #post-## -->
