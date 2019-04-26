	<div>
		<h3 class="h_2">L'actualité</h3>

			<?php if( have_rows('focus_elements', 'option') ): ?>

		   	<?php while ( have_rows('focus_elements', 'option') ) : the_row();

		        if( get_row_layout() == 'focusElements_page' ):
		        	$focusElements_page = get_sub_field('focusElements_page'); ?>

							<div class="focusElement_item m-1coll">
								
								<?php if( get_sub_field('pastille') != '' ) : ?>
									<div class="focusElement-pastille is-flex">
										<span><?php the_sub_field('pastille'); ?></span>
									</div>
								<?php endif; ?>

								<div class="square">
									<a href="<?php echo get_permalink( $focusElements_page->ID ); ?>">
										<div class="square-content bg_cover b-lazy" data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_page->ID ), 'large' )[0]; ?>">
										</div>
									</a>
								</div>
								
								<div class="inner">
									<a href="<?php echo get_permalink( $focusElements_page->ID ); ?>">
						    		<h3 class="h5"><?php echo $focusElements_page->post_title; ?></a></h3>
						    		<div class="focusElement_p"><?php the_sub_field( 'focusElements_page_texte' ); ?></div>
						    	</a>
						    </div>

					    </div>

		        <?php elseif( get_row_layout() == 'focusElements_article' ): 
		        	$focusElements_article = get_sub_field('focusElements_article'); ?>
							
								<div class="focusElement_item m-1coll">

									<?php if( get_sub_field('pastille') != '' ) : ?>
										<div class="focusElement-pastille is-flex">
											<span><?php the_sub_field('pastille'); ?></span>
										</div>
									<?php endif; ?>

									<div class="square">
										<a href="<?php echo get_permalink( $focusElements_article->ID ); ?>">
											<div class="square-content bg_cover b-lazy" data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_article->ID ), 'large' )[0]; ?>">
											</div>
										</a>
									</div>

									<div class="inner">
										<a href="<?php echo get_permalink( $focusElements_article->ID ); ?>">
							    		<h3 class="h5"><?php echo $focusElements_article->post_title; ?></h3>
							    		<div class="focusElement_p">
							    			<p><?php the_sub_field('focusElements_article_texte'); ?></p>
							    		</div>
							    	</a>
							    </div>
						    </div>



		        <?php elseif( get_row_layout() == 'focusElements_event' ): 
		        	$focusElements_event = get_sub_field('focusElements_event');  ?>
							
								<div class="focusElement_item m-1coll">

									<?php if( get_sub_field('pastille') != '' ) : ?>
										<div class="focusElement-pastille is-flex">
											<span><?php the_sub_field('pastille'); ?></span>
										</div>
									<?php endif; ?>
 
									<div class="square">
										<a href="<?php echo get_permalink( $focusElements_event->ID ); ?>">
											<div class="square-content bg_cover b-lazy" data-src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( $focusElements_event->ID ), 'large' )[0]; ?>">
											</div>
										</a>
									</div>

									<div class="inner">
										<a href="<?php echo get_permalink( $focusElements_event->ID ); ?>">
							    		<h3 class="h5"><?php echo $focusElements_event->post_title; ?></h3>
							    		<div class="focusElement_p">
							    			<p><?php the_sub_field('focusElements_event_texte'); ?></p>
							    		</div>
							    	</a>
							    </div>
						    </div>
						   



		        <?php elseif( get_row_layout() == 'focusElements_libre' ): ?>
							
								<div class="focusElement_item m-1coll">

									<?php if( get_sub_field('pastille') != '' ) : ?>
										<div class="focusElement-pastille is-flex">
											<span><?php the_sub_field('pastille'); ?></span>
										</div>
									<?php endif; ?>

									<div class="square">
										<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
											<div class="square-content bg_cover b-lazy" data-src="<?php the_sub_field('focusElements_libre_image'); ?>">
											</div>
										</a>
									</div>

									<div class="inner">
										<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
							    		<h3 class="h5"><?php the_sub_field('focusElements_libre_titre'); ?></h3>
							    		<div class="focusElement_p"><?php the_sub_field('focusElements_libre_texte'); ?></div>
							    	</a>
							    </div>
						    </div>

		        <?php endif;

		    endwhile; ?>


		<?php else :

		endif; ?>
		
	</div>