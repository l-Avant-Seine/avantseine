<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class="module module-pages">
	<div class="wrap moduleInner">
		
		<?php foreach ( $pages_list as $post ) : setup_postdata( $post ); ?>
			<div class="moduleItem-page">

				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php endforeach; ?>

	</div>
</section>


