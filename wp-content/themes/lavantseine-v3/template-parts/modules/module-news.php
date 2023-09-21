




<?php if( have_rows('focus_elements', 'option') ): ?>
	<div id="salgrid_2" class="salgrid">

	<?php while ( have_rows('focus_elements', 'option') ) : the_row(); ?>


		<div class="focus-item cf mb-1 is-flex">

		    <?php if( get_row_layout() == 'focusElements_libre' ): ?>

				<div class="item-text flx-1">
					<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
						<h3 class="h_4 item-title mb-1"><?php the_sub_field('focusElements_libre_titre'); ?></h3>
						<div class="focusElement_p"><?php the_sub_field('focusElements_libre_texte'); ?></div>
					</a>
				</div>

				<div class="item-cover ratio2for3">
					<div class="ratio2for3-content">
						<a href="<?php the_sub_field('focusElements_libre_lien'); ?>">
							<img class="b-lazy" src="<?php the_sub_field('focusElements_libre_image'); ?>" alt="">
						</a>
					</div>
				</div>

			<?php else : ?>

				<?php 
					if( get_row_layout() == 'focusElements_page' ):
		        		$posts = get_sub_field('focusElements_page');
		        		$focus_text = get_sub_field('focusElements_page_texte');

		        	elseif( get_row_layout() == 'focusElements_article' ): 
		        		$posts = get_sub_field('focusElements_article');
		        		$focus_text = get_sub_field('focusElements_article_texte');

		       		elseif( get_row_layout() == 'focusElements_event' ): 
		        		$posts = get_sub_field('focusElements_event');
		        		$focus_text = get_sub_field('focusElements_event_texte');

		        	endif;

					if( $posts ): 
						foreach( $posts as $post): setup_postdata($post); ?>

							<div class="item-text flx-1">
								<a href="<?php echo get_permalink( get_the_ID() ); ?>">
									<h3 class="h_4 item-title mb-1">
										<?php the_title(); ?>
									</h3>
									<div class="focusElement_p mb-1">
										<p><?php echo $focus_text ?></p>
									</div>

									<span class="btn-inline">en savoir plus</span>
								</a>
							</div>


							<div class="item-cover ratio2for3">
								<div class="ratio2for3-content">
									<a href="<?php echo get_permalink( get_the_ID() ); ?>">
										<img class="b-lazy" src="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' )[0]; ?>" alt="">

										<?php if( get_sub_field('pastille') != '' ) : ?>
											<div class="item-pastille is-flex">
												<span><?php the_sub_field('pastille'); ?></span>
											</div>
										<?php endif; ?>

									</a>

								</div>
							</div>

						<?php endforeach; 
					wp_reset_postdata();
				endif; 
			
			endif; ?>

		</div>

	<?php endwhile; ?>
	</div>
<?php endif; ?>
		



