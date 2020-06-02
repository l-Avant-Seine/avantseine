<?php
/**
 *
 * Template Name: Résultat Quizz
 *
 * @package cdn
 */

	include('header-quizz.php');

?>

      <?php while ( have_posts() ) : the_post(); ?>


					<?php 

					  if( isset($_POST['reponseradio']) ){
					    $_SESSION['responses'][] = $_POST['reponseradio'];
					    $session_reponses = $_SESSION['responses'];

					    $cpt = array_count_values($session_reponses);
					    $winners = array();

					    foreach ($session_reponses as $r) {
					      $i = $cpt[$r];
								$winners[$i] = $r;
					    }

					    krsort($winners);
					    $andthewinneris = reset($winners);
					    //$andthewinneris = $winners[0];

					  }

					$reponses = get_field('reponses');


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

        <div class="page">


					<article id="post-<?php the_ID(); ?>" class="quizz-result full">


					    <header class="cover quizzresult-header" style="background-color: <?php the_field('couleur_de_la_page'); ?>">
					      <img src="<?php echo $visuel; ?>">
					    </header>



					    <div class="result-content">

					        <div class="">
					          <div>
					          	<?php echo $texte_principal; ?>
					          </div>
					           
					          <a href="<?php echo $e_url; ?>">
					          	 <h3 class="result_title"><?php echo $titre; ?></h3>
					          </a>        

					          <div class="result_maintext">
					          	<?php echo $texte_evenement; ?>
					         	</div>

					        </div>


					        <div class="result-actions">

										<div class="result_outro">Pour recevoir toute la programmation 2020/2021, <br><a href="<?php bloginfo('url'); ?>#section-transition">inscrivez-vous à la newsletter !</a></div>

					          <ul class="result-links">
					              
					              <li class="result-link-item"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_field('accueil_quizz'); ?>&t=Tentez%20le%20Quizz%20du%20Theatre%20de%20Sartrouville" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank" title="Share on Facebook">Partagez sur Facebook</a> </li>| 
												
												<li><a href="<?php the_field('accueil_quizz'); ?>"> Recommencer le Quizz</a></li>
					          </ul>




					        </div>


					    </div><!-- .result-content -->


					</article><!-- #post-## -->

				</div><!-- .page -->



      <?php endwhile; // end of the loop. ?>


  <?php include('footer-quizz.php'); ?>

