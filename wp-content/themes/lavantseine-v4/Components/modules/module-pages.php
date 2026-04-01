

<section class="module-pages cf">
	<div class="inner">

		<?php if( $title != '' ) : ?>
			<h4 class="h_2 module-title"><?php echo $title; ?></h4>
		<?php endif; ?>

		<?php 
		foreach ( $pages_list as $post ) :
			set_query_var('icons', $icons);
			setup_postdata( $post );
			get_template_part( 'Components/blocs/bloc', 'page' ); 

		endforeach; wp_reset_query();?>

	</div>
</section>


