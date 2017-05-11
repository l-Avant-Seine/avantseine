<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class=" module-services">
	<div class="moduleInner">
		
		<?php foreach ( $services_pages as $post ) : setup_postdata( $post ); ?>
			<div class="moduleItem-service">

				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php endforeach; ?>

	</div>
</section>


