




<?php if( have_rows('focus_elements', 'option') ): ?>
	<?php while ( have_rows('focus_elements', 'option') ) : the_row(); ?>


					<div class="focus-item cf mb-1">

		        <?php if( get_row_layout() == 'focusElements_libre' ): ?>

									<div class="item-cover">
										<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
											<img class="b-lazy" src="<?php the_sub_field('focusElements_libre_image'); ?>" alt="">
										</a>
									</div>

									<div class="item-text">
										<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
							    		<h3 class="h_4 item_title mb-1"><?php the_sub_field('focusElements_libre_titre'); ?></h3>
							    		<div class="focusElement_p"><?php the_sub_field('focusElements_libre_texte'); ?></div>
							    	</a>
							    </div>


						<?php else : ?>

							<?php 
								if( get_row_layout() == 'focusElements_page' ):
		        			$focus_item = get_sub_field('focusElements_page');
		        			$focus_text = get_sub_field('focusElements_page_texte');

		        		elseif( get_row_layout() == 'focusElements_article' ): 
		        			$focus_item = get_sub_field('focusElements_article');
		        			$focus_text = get_sub_field('focusElements_article_texte');

		       			elseif( get_row_layout() == 'focusElements_event' ): 
		        			$focus_item = get_sub_field('focusElements_event');
		        			$focus_text = get_sub_field('focusElements_event_texte');

		        		endif;
								$focus_title = $focus_item->post_title; ?>


									<div class="item-cover">
										<a href="<?php echo get_permalink( $focus_item->ID ); ?>">
											<img class="b-lazy" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focus_item->ID ), 'large' )[0]; ?>" alt="">
										</a>
									</div>

									<div class="item-text">
										<a href="<?php echo get_permalink( $focus_item->ID ); ?>">
							    		<h3 class="h_4 item_title mb-1"><?php echo $focus_title; ?></h3>
							    		<div class="focusElement_p">
							    			<p><?php echo $focus_text ?></p>
							    		</div>
							    	</a>
							    </div>


		        <?php endif; ?>


					</div>

	<?php endwhile; ?>
<?php endif; ?>
		



