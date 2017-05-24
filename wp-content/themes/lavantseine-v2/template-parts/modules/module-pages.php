<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class="module module-pages">
	<div class="wrap moduleInner row">
		
		<?php foreach ( $pages_list as $post ) : setup_postdata( $post ); ?>
			<div class="moduleItem-page m-2col">
				
				<h3 class="h5 moduleService-title">&#x02666;<br><?php the_title(); ?></h3>
				<p class="moduleService-excerpt"><?php the_excerpt(); ?></p>
				<a href="<?php the_permalink(); ?>" class="btn--little"><span class="icon-arrow"></span>En savoir plus</a>

			</div>
		<?php endforeach; ?>

	</div>
</section>


