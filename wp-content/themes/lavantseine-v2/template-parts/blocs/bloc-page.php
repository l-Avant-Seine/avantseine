

			<div class="moduleItem-page">
				
				<h3 class="h5 modulePages-title">&#x02666;<br><?php the_title(); ?></h3>
				<div class="modulePages-excerpt">
					<?php 
						if( get_field('pageDetail_intro') != '' ) : 
							the_field('pageDetail_intro'); 
						else : 
							the_excerpt(); 
						endif; 
						?>
				</div>
				<a href="<?php the_permalink(); ?>" class="btn--little"><span class="icon-arrow-right"></span>En savoir plus</a>

			</div>