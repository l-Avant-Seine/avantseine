<?php
/**
 *
 * Template Name: Résultat Quizz
 *
 * @package cdn
 */

	get_template_part( 'header', 'quizz' ); 

?>

      <?php while ( have_posts() ) : the_post(); ?>


					<?php 

					  if( isset($_POST['reponseradio']) ){
					    $_SESSION['responses'][] = $_POST['reponseradio'];
					    $reponses = $_SESSION['responses'];

					    $cpt = array_count_values($reponses);
					    $winners = array();

					    foreach ($reponses as $r) {
					      $i = $cpt[$r];
					      $winners[$i] = $r;
					    }
					    sort($winners);
					    $andthewinneris = $winners[0];
					  }

					$reponses = get_field('reponses' );

					foreach ($reponses as $r) {
					  $id = $r['id_name'];
					  if( $id == $andthewinneris ) {
					    $reponse_data = $r;
					    break;
					  }
					}

					// var_dump($reponse_data);

					$titre = $reponse_data['titre'];
					$evenement = $reponse_data['evenement'];
					$visuel = $reponse_data['visuel'];
					$e_title = $evenement->post_title;
					$e_id = $evenement->ID;
					$e_url = get_permalink ($e_id);

					$texte_principal = $reponse_data['texte_principal'];
					$texte_evenement = $reponse_data['texte_evenement'];

					?>



					<article id="post-<?php the_ID(); ?>" class="quizz-result full">
					  <div class="row full">

					    <header class="m-8col question-img full quizzresult-header" style="background-color: <?php the_field('couleur_de_la_page'); ?>">


					     <h1 class="site-title">
					       <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
					     </h1>


					      <div class="table full">
					        <div class="table-cell">

					          <div class="result-titles">
					            <h2><?php the_title(); ?></h2>
					            <h3><?php echo $titre; ?></h3>
					          </div>

					          <img src="<?php echo $visuel; ?>">

					          <div class="btn-rounded white"><a href="<?php the_field('accueil_quizz'); ?>">Recommencer le Quizz</a></div>

					        </div>
					      </div>
					    </header>

					    <div class="m-6col m-1col-push full table result-content">
					      <div class="table-cell">

					        <div class="result-infos">
					          <div class="btn-cdn-logo"></div>
					          <div class="result-text"><?php echo $texte_principal; ?></div>
					          <div class="result-event"><span class=""><?php echo $e_title; ?></span> est votre spectacle. <?php echo $texte_evenement; ?></div>
					        </div>

					        <div class="row result-actions">
					          
					          <div class="result-buttons">
					            <div class="btn-rounded black"><a href="<?php echo $e_url; ?>">En savoir + sur le spectacle</a></div>          
					          </div>
					          
					          <div class="m8col m-last">
					            <ul class="result-links">

					              <li class="result-link-item"><a href="<?php bloginfo('url'); ?>#colophon">Inscription à la newsletter <span class="btn-rounded-inline">N</span></a></li>
					              
					              <li class="result-link-item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_field('accueil_quizz'); ?>&t=Tentez%20le%20Quizz%20du%20Theatre%20de%20Sartrouville" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">Partagez sur Facebook <span class="btn-rounded-inline">f</span></a></li>
					              
					              <li class="result-link-item"><a href="<?php bloginfo('url'); ?>">Voir le site du Théâtre <span class="btn-rounded-inline">w</span></a></li>

					              <li class="result-link-item"><a href="<?php bloginfo('url'); ?>/infos-pratiques/contact/">Nous envoyer un mail <span class="btn-rounded-inline">@</span></a></li>
					            </ul>
					          </div>
					        </div>

					      </div>
					    </div><!-- .m-6col -->
					  </div><!-- .row -->
					</article><!-- #post-## -->






      <?php endwhile; // end of the loop. ?>


  <?php get_template_part( 'footer', 'quizz' ); ?>

