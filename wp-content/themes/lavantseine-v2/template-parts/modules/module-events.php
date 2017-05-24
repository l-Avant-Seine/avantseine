<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class="module module-events">
	<div class="moduleInner row">

		<?php foreach ( $last_events as $post ) : setup_postdata( $post ); ?>
			<div class="m-3col item">
				<?php get_template_part('template-parts/blocs/bloc', 'event'); ?>
			</div>
		<?php endforeach; ?>	

	</div>
</section>


