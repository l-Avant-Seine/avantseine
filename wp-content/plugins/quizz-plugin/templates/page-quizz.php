<?php 
/**
 *
 * Template Name: Quizz
 *
 * @package cdn
 */

	include('header-quizz.php');

	session_destroy();
  unset($_SESSION); ?>



      <?php while ( have_posts() ) : the_post(); ?>

        <div class="page" style="background-color: <?php the_field('couleur_de_la_page'); ?>">

			    <article id="post-<?php the_ID(); ?>" class="quizz-home">

			      <div class="cover">
							<?php the_post_thumbnail( 'full' ); ?> 
			      </div>

			      <div class="quizzhome-header is-relative">
			      	<div class="quizzhome-header--inner">

				        <div class="quizzhome-intro"><?php the_content(); ?></div>

							</div>
			      </div>

			    </article>


        </div><!-- .page -->
      <?php endwhile; // end of the loop. ?>



  <?php include('footer-quizz.php'); ?>

