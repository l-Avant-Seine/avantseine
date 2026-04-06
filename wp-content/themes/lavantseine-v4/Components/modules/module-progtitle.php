

<section class="mod_progtitle">

    <div class="wrapper flex --jstf --centered">
        <img src="<?php the_field('prog_picto', 'option'); ?>">

        <div class="txt-center">
            <h1 class="h1 mb-large">Saison 26-27</h1>

            <div class="mb-large">
                <a href="<?php the_field('prog_brochure', 'option'); ?>" class="btn" target="_blank">Télécharger la brochure</a>
            </div>
                        
			<div class="flex --gap-xs --wrap --centered mb-small">
				<?php 
                    if( is_archive() )
                        custom_taxonomy_buttons('discipline', 'date', 'DESC', '', 'discipline', 'Voir tout'); 
                    else
                        custom_taxonomy_buttons('discipline', 'date', 'DESC', '', 'discipline', false); 
                    ?>
			</div>

            <div class="mb-large">
                <a href="/saison/2012-2013/" class="tag">Saisons passées</a>
            </div>

        </div>
        
        <img src="<?php the_field('prog_picto', 'option'); ?>" class="inversed">
    </div>

</section>