<?php
/**
 *
 * Template Name: Question
 *
 * @package cdn
 */

	include('header-quizz.php');
 
 	if( isset($_POST['reponseradio']) ){
    $_SESSION['responses'][] = $_POST['reponseradio'];
  } ?>



      <?php while ( have_posts() ) : the_post(); ?>

        <div class="page">


						<article id="post-<?php the_ID(); ?>" class="quizz-question full">

						    <div class="cover" style="background-color: <?php the_field('couleur_de_la_page'); ?>">
									<?php the_post_thumbnail( ); ?> 
						    </div>

						    <div class="question-choices full ">

						      <h2 class="question-label"><?php the_title(); ?></h2>

						      <div class="question-form form-outer">
						        <form id="quizzform" class="form-horizontal" accept-charset="utf-8" action="<?php the_field('next_question'); ?>" method="post">

						          <div style="display: none;"><input name="questionnum" type="hidden" value="1" /></div>

						          <fieldset class="radios hidden-sm hidden-xs">

						            <?php if( have_rows('questions') ): ?>
						              <?php $i = 1 ?>
						              <?php while ( have_rows('questions') ) : the_row(); ?>

						                  <div class="radio-item">
						                    <label class="label_radio" for="radio-0<?php echo $i; ?>">
						                    <input id="radio-0<?php echo $i; ?>" name="reponseradio" type="radio" value="<?php the_sub_field('item-linked'); ?>" />
						                        <?php the_sub_field('texte'); ?>
						                    </label>
						                  </div>

						                  <?php $i++ ?>
						              <?php endwhile; ?>

						            <?php endif; ?>

						          </fieldset>
						        
						        </form>
						      </div><!-- .form-outer -->

						    </div>

						</article><!-- #post-## -->



        </div><!-- .page -->
      <?php endwhile; // end of the loop. ?>

    <?php 	include('footer-quizz.php'); ?>


<script>

	  jQuery( document ).ready(function($) {

	    $( "#quizzform" ).change(function(event) {
	      event.preventDefault();
	      $(this).submit();
	    });

	  });

</script>