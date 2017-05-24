

<?php
	$focus_event = get_field('focus_event', 'option'); 
	$focus_event_id = $focus_event->ID;
	$focus_event_media_url = wp_get_attachment_image_src( get_post_thumbnail_id( $focus_event_id ), 'large' );


	if( $focus_event ): ?>


	<section class="module-focus bg_cover" style="background-image: url(<?php echo $focus_event_media_url[0]; ?>);">

		<div class="moduleInner is-flex row">


	    	<div class="focusEvent_infos m-3col m-1col-push">
	    		<a href="<?php echo get_permalink($focus_event_id); ?>">
	    			<span>Le prochain rendez-vous</span>
	    			<h3 class="h1 no-margin"><?php echo get_the_title($focus_event_id); ?></h3>
						<span class="meta-date">Dates</span>
	    		</a>
	    	</div>



		<?php if( have_rows('focus_elements', 'option') ): ?>


		   <?php while ( have_rows('focus_elements', 'option') ) : the_row();

		        if( get_row_layout() == 'focusElements_page' ):
		        	$focusElements_page = get_sub_field('focusElements_page'); ?>

							<div class="focusElement_item m-1col m-1col-push">
								<div class="focusElement_media bg_cover" style="background-image: url(<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_page->ID ), 'large' )[0]; ?>);">
								</div>
								
					    	<h3 class="h5"><a href="<?php echo get_permalink( $focusElements_page->ID ); ?>"><?php echo $focusElements_page->post_title; ?></a></h3>

					    	<p><?php echo 'chapo chapo chapo'; ?></p>
					    </div>

		        <?php elseif( get_row_layout() == 'focusElements_article' ): 
		        	$focusElements_article = get_sub_field('focusElements_article'); ?>

							<div class="focusElement_item m-1col m-1col-push">
								<img src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_article->ID ), 'large' )[0]; ?>" alt="">
					    	<h3 class="h5"><a href="<?php echo get_permalink( $focusElements_article->ID ); ?>"><?php echo $focusElements_article->post_title; ?></a></h3>
					    	<p><?php echo 'chapo chapo chapo'; ?></p>
					    </div>


		        <?php elseif( get_row_layout() == 'focusElements_libre' ): 
		        	$focusElements_libre = get_sub_field('focusElements_libre'); ?>
							
							<div class="focusElement_item m-1col m-1col-push">
		        		<?php echo $focusElements_libre; ?>
							</div>


		        <?php endif;

		    endwhile; ?>


		<?php else :

		endif; ?>



	</div>
</section>

		<?php endif; ?>


