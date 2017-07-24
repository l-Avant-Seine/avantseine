<?php

	// TODO 
	// _> get variable passed
	// _> loop

?>



<section class="module module-events">

	<h2 class="moduleEvents-title h2">
		<span>la Programmation</span> <br><br>
	</h2>

	<div class="moduleInner row">

		<?php foreach ( $last_events as $post ) : setup_postdata( $post ); ?>
			<div class="m-3col item">
				<?php get_template_part('template-parts/blocs/bloc', 'event'); ?>
			</div>
		<?php endforeach; ?>	

	</div>
</section>


