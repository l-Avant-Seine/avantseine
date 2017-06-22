<?php

?>



<div class="offset-right module-brochure layer">
	<h3 class="h4">La <br>brochure <br><span class="title-diamond">&#x02666;</span></h3>

	<?php if( have_rows('brochures_de_saison', 'option') ): ?>
		<?php $i = 0; ?>
		
		<p>Télécharer les brochures au format pdf</p>
		<ul class="no-bullets pdf-list">

	    <?php while ( have_rows('brochures_de_saison', 'option') ) : the_row(); ?>
				
				<?php if( $i == 0) : ?>
				<li class="pdfItem-first btn--big text-on-left"><a target="_blank" class="" href="<?php the_sub_field('file'); ?>"><span class="icon-download"></span>Saison <?php the_sub_field('saison'); ?></a></li>

				<li class="pdfItem-others btn--big js-pdfTrigger text-on-left"><a href="#" class=" ">Autres Saisons	<span class="icon-dropdown"></span></a></li>

				<ul class="no-bullets">
				<?php else : ?>

					<li class=""><a target="_blank" class="" href="<?php the_sub_field('file'); ?>"><span class="icon-download"></span>Saison <?php the_sub_field('saison'); ?></a></li>

				<?php endif; ?>
				
			<?php $i++; endwhile; ?>
			</ul>
		</ul>
	<?php endif; ?>

</div>

