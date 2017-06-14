


<section class="module-services offset-right">
	<div class="moduleInner">
		
		<h4 class="h4 module-title">à votre <br>service <span class="title-diamond">&#x02666;</span></h4>


		<?php foreach ( $services_pages as $post ) : setup_postdata( $post ); ?>
			<div class="moduleService-item">
				<h5 class="h5 moduleService-title"><?php the_title(); ?></h5>
				<div class="moduleService-excerpt"><?php the_excerpt(); ?></div>
				<a href="<?php the_permalink(); ?>" class="btn--little"><span class="icon-arrow-right"></span>En savoir plus</a>
			</div>
		<?php endforeach; ?>

	</div>
</section>


