<?php
/**
 * @package lavantseine
 */

$terms = get_the_terms( get_the_ID(), 'relational_tag' );


?>


<article id="post-<?php the_ID(); ?>" class="bloc-magazine" <?php post_class(); ?>>

	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="inner">

			<header class="item-header  mb-1">

				<div class="ratio2for3">
					<div class="ratio2for3-content">
						<img class="item-cover b-lazy" 
						src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
						data-src="<?php the_post_thumbnail_url('top-thumbnail'); ?>">
					</div>
				</div>
			</header><!-- .item-header -->

			<div class="bloc_text mb-small">


				<div class="item-tax flex --gap-s">

					<?php 
					$categories = get_the_category();
					if($categories) : foreach($categories as $category) : ?>
						<span class="tag"><?php echo $category->name; ?></span>
					<?php endforeach; endif; ?>


				</div><!-- .post-categories -->

				<h2 class="h3 item-title cf">	
					<?php the_title(); ?>
				</h2>

				<?php
					if( $terms) : 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p class='clearfix item-excerpt'>".$post_shortText. "</p>";
					endif;
				?>
			</div><!-- .item-text -->

			<div class="bloc_cta">
				<span class="btn">Lire la suite</span>
			</div>


		</div><!-- .inner -->
	</a>
</article><!-- #post-## -->
