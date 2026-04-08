
<section class="module module-events">

	<h2 class="moduleEvents-title h2">
		<span>la Programmation</span> <br>de l'Avant Seine<br>
	</h2>

	<div class="moduleInner row">

		<?php foreach ( $last_events as $post ) : setup_postdata( $post ); ?>
			<div class="m-3col item">
				<?php get_template_part('Components/blocs/bloc', 'event', array('post' => $post->ID)); ?>
			</div>
		<?php endforeach; ?>	

	</div>
</section>


