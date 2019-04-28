<?php

?>



<div class="module-brochure">
	<h3 class="h_4--red label">La brochure</h3>

	<?php if( have_rows('brochures_de_saison', 'option') ): ?>
		<?php $i = 0; ?>
		
		<ul class="no-bullets pdf-list">

	    <?php while ( have_rows('brochures_de_saison', 'option') ) : the_row(); ?>
				
				<?php if( $i == 0) : ?>
				<li class="pdf-item"><a target="_blank" class="" href="<?php the_sub_field('file'); ?>"><span class="icon-download"></span>télécharger <br>la brochure <?php the_sub_field('saison'); ?></a></li>

				<li class="pdf-item js-pdfTrigger">
					<a href="#" class=" ">Autres Saisons</a>

					<ul class="nobullets hidden">
					<?php else : ?>

						<li class="pdf-item"><a target="_blank" class="" href="<?php the_sub_field('file'); ?>"><span class="icon-download"></span>Saison <?php the_sub_field('saison'); ?></a></li>

					<?php endif; ?>
					
					<?php $i++; endwhile; ?>
					</ul>
				</li>
		</ul>
	<?php endif; ?>

</div>

