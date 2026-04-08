<?php
/**
 * @package lavantseine
 */

$terms = get_the_terms( get_the_ID(), 'relational_tag' );


?>


<article id="post-<?php the_ID(); ?>" class="bloc-magazine" <?php post_class(); ?>>

	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="inner">

			<header class="bloc_header mb-small">
				<div class="bloc_cover_outer">
					<img class="bloc_cover" loading="lazy" 
						src="<?php the_post_thumbnail_url('top-thumbnail'); ?>">
				</div>
			</header><!-- .item-header -->

			<div class="bloc_text mb-small">

				<div class="bloc_tax flex --gap-s mb-small">
					<?php 
					$categories = get_the_category();
					if($categories) : foreach($categories as $category) : ?>
						<span class="tag"><?php echo $category->name; ?></span>
					<?php endforeach; endif; ?>
				</div>


				<h2 class="h3 bloc_title mb-small">	
					<?php the_title(); ?>
				</h2>


				<?php
					if( $terms) : 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p class='clearfix item-excerpt'>".$post_shortText. "</p>";
					endif;
				?>
			</div>


			<div class="bloc_cta">
				<span class="btn">Lire la suite</span>
			</div>


		</div><!-- .inner -->
	</a>
</article><!-- #post-## -->
