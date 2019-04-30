

			<div class="page-item mb-1 page-<?php echo $post->post_name; ?>">
				<a href="<?php the_permalink(); ?>" class="">
					<?php if( $icons ) : ?>
						<div class="rounded-icon icon- mb-05">
							<span class="icon-"></span>
						</div>
					<?php endif; ?>

					<h5 class="h_4 item-title mb-05"><?php the_title(); ?></h5>

					<div class="item-excerpt mb-05">
						<?php 
							if( get_field('pageDetail_intro') != '' ) : 
								the_field('pageDetail_intro'); 
							else : 
								the_excerpt(); 
							endif; 
							?>
							
						</div>
					
						<div class="btn-inline">En savoir plus</div>
				</a>
			</div><!-- .page-item -->
