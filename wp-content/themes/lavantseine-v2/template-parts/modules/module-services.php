


<section class="module-services offset-right">
	<div class="moduleInner">
		
		<h4 class="h4 module-title">à votre <br>service &#x02666;</h4>


		<?php foreach ( $services_pages as $post ) : setup_postdata( $post ); ?>
			<div class="moduleService-item">
				<h5 class="h5 moduleService-title"><?php the_title(); ?></h5>
				<p class="moduleService-excerpt"><?php the_excerpt(); ?></p>
				<a href="<?php the_permalink(); ?>" class="btn--little">En savoir plus</a>
			</div>
		<?php endforeach; ?>

	</div>
</section>


