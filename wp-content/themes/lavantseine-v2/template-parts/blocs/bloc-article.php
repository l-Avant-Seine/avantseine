<?php
/**
 * @package lavantseine
 */
?>


<article id="post-<?php the_ID(); ?>" class="bloc-article" <?php post_class(); ?>>
	<a href="<?php the_permalink(); ?>" rel="bookmark">
		<div class="inner-box">

			<header class="blocArticle-upper">
					<?php the_post_thumbnail('box-thumbnail'); ?>
			</header><!-- .entry-header -->


			<div class="blocArticle-lower">

				<h2 class="h5 blocArticle-title clearfix">	
						<?php the_title(); ?>
						<br>&#x02666;
				</h2>

				<?php
					if( $excerpt) : 
						$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );
						echo "<p class='clearfix blocArticle-intro'>".$post_shortText. "</p>";
					endif;
				?>
			</div><!-- .entry-summary -->

		</div>		
	</a>
</article><!-- #post-## -->
