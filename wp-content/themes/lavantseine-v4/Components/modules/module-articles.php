


<section class="module module-articles">
	
	<?php if ( $query->have_posts() ) : ?>


		<?php if( !isset($module_title) ) : ?>
			<h2 class="moduleArticles-title h_2">
				<span>Le magazine !</span>
			</h2>
		<?php else : ?>
			<h2 class="moduleArticles-title h_2">
				<?php echo $module_title; ?>
			</h2>
		<?php endif; ?>


		<div id="salgrid_1" class="salgrid">
			<?php $excerpt = true; ?>
			<?php while ( $query->have_posts() ) : $query->the_post(); ?>

				<?php set_query_var('excerpt', $excerpt); ?>
				<?php get_template_part('Components/blocs/bloc', 'article'); ?>	 

			<?php endwhile; ?>
		</div>

		<div class="module-actions">
				<a href="/magazine" class="btn-primary">voir tous les articles</a>
			</div>
			
	<?php endif; ?>
</section>