

			<div class="page-item">
		
				<?php if( $icons ) : ?>
					<div class="rounded-icon mb-05">
						d
					</div>
				<?php endif; ?>

				<h5 class="h_4 item-title"><?php the_title(); ?></h5>

				<div class="item-excerpt">
					<?php 
						if( get_field('pageDetail_intro') != '' ) : 
							the_field('pageDetail_intro'); 
						else : 
							the_excerpt(); 
						endif; 
						?>
						
					</div>
				
				<a href="<?php the_permalink(); ?>" class="btn--little">
					<span class="icon-plus"></span>En savoir plus
				</a>

			</div><!-- .page-item -->
