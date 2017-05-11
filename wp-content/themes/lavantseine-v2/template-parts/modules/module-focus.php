



<section class="module-focus">
	<div class="moduleInner">
		
		<?php 
			$focus_event = get_field('focus_event', 'option'); 
 
			if( $focus_event ): 
				$post = $focus_event;
				setup_postdata( $post ); ?>

	    <div class="">
	    	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	    </div>
    	<?php wp_reset_postdata();  ?>
		<?php endif; ?>



		<?php if( have_rows('focus_elements', 'option') ):

		    while ( have_rows('focus_elements', 'option') ) : the_row();

		        if( get_row_layout() == 'focusElements_page' ):
		        	$focusElements_page = get_sub_field('focusElements_page'); ?>

							<div class="">
					    	<h3><a href="<?php echo get_permalink( $focusElements_page->ID ); ?>"><?php echo $focusElements_page->post_title; ?></a></h3>
					    </div>

		        <?php elseif( get_row_layout() == 'focusElements_article' ): 
		        	$focusElements_article = get_sub_field('focusElements_article'); ?>

							<div class="">
					    	<h3><a href="<?php echo get_permalink( $focusElements_article->ID ); ?>"><?php echo $focusElements_article->post_title; ?></a></h3>
					    </div>


		        <?php elseif( get_row_layout() == 'focusElements_libre' ): 
		        	$focusElements_libre = get_sub_field('focusElements_libre'); ?>
							
							<div class="">
		        		<?php echo $focusElements_libre; ?>
							</div>


		        <?php endif;

		    endwhile;

		else :

		endif; ?>



	</div>
</section>


