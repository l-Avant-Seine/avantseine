<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class="module-services">
	<div class="moduleInner">
		
		<h4 class="module-title">à votre service &#x02666;</h4>


		<?php foreach ( $services_pages as $post ) : setup_postdata( $post ); ?>
			<div class="moduleService-item">
				<h5><?php the_title(); ?></h5>
				<p><?php the_excerpt(); ?></p>
				<a href="<?php the_permalink(); ?>" class="btn">En savoir plus</a>
			</div>
		<?php endforeach; ?>

	</div>
</section>


