<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class="module module-events">
	<div class="moduleInner">
		
		<?php foreach ( $last_events as $post ) : setup_postdata( $post ); ?>
			<div class="moduleItem-event">

				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</div>
		<?php endforeach; ?>

	</div>
</section>


