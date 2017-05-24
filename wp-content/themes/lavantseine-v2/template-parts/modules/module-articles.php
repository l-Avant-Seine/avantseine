


<section class="module module-articles">
	
	<h2 class="moduleArticles-title  h2">
		<span>le Magazine</span> <br>de l'Avant-Seine
	</h2>

	<div class="row">
		<?php $i = 0; $excerpt = true; ?>
		<?php foreach ( $posts_list as $post ) : setup_postdata( $post ); ?>

			<?php 
				switch ($i) {
					case 1:
						$class = 'm-2col blocArticle--little';
						$excerpt = false;
						break;
					
					case 3:
						$class = 'm-first m-3col clearfix blocArticle--big';
						$excerpt = true;
						break;

					case 5:
						$class = 'm-2col blocArticle--little';
						$excerpt = false;
						break;	

					default:
						$class = 'm-3col blocArticle--big';
						$excerpt = true;
						break;
				} ?>

			<div class="<?php echo $class; ?> moduleArticles-item">
				<?php set_query_var('excerpt', $excerpt); ?>
				<?php get_template_part('template-parts/blocs/bloc', 'article'); ?>
			</div>

			<?php $i++; ?>

		<?php endforeach; ?>
	</div>

</section>