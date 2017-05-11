


<section class="module module-articles">
	

	<?php foreach ( $posts_list as $post ) : setup_postdata( $post ); ?>
		<div class="moduleItem-article">

			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</div>
	<?php endforeach; ?>


</section>