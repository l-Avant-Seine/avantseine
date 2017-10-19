<?php


?>



<section class="module module-pages">
	<div class="wrap moduleInner row">
		
		<?php foreach ( $pages_list as $post ) : setup_postdata( $post ); ?>
			<div class="m-2col">
				<?php get_template_part( 'template-parts/blocs/bloc', 'page' ); ?>
			</div>
		<?php endforeach; ?>

	</div>
</section>


