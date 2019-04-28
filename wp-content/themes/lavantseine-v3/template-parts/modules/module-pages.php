

<section class="module-pages cf">
	<div class="inner">

		<h4 class="h_2 module-title"><?php echo $title; ?></h4>

		<?php 
		foreach ( $pages_list as $post ) :
			set_query_var('icons', $icons);
			setup_postdata( $post );
			get_template_part( 'template-parts/blocs/bloc', 'page' ); 

		endforeach; ?>

	</div>
</section>


