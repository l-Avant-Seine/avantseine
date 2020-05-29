<?php 
/**
 *
 * Template Name: Quizz
 *
 * @package cdn
 */

	include('header-quizz.php');
	// get_template_part( 'header', 'quizz' ); 

	session_destroy();
  unset($_SESSION); 
 ?>



      <?php while ( have_posts() ) : the_post(); ?>

        <div class="page" style="background-color: <?php the_field('couleur_de_la_page'); ?>">

			    <article id="post-<?php the_ID(); ?>" class="quizz-home">

			      <div class="cover">
							<?php the_post_thumbnail( 'full' ); ?> 
			      </div>


			      <div class="quizzhome-header is-relative">

			        <div class="quizzhome-intro"><?php the_content(); ?></div>

							<?php 
								$question = get_field('first_question');

								if( $question ) : ?>


							    <div class="question-choices">

							      <h3 class="question-label"><?php echo get_the_title( $question->ID ); ?></h3>

							      <div class="question-form form-outer">
							        <form id="quizzform" class="form-horizontal" accept-charset="utf-8" action="<?php the_field('next_question',  $question->ID ); ?>" method="post">

							          <div style="display: none;"><input name="questionnum" type="hidden" value="1" /></div>

							          <fieldset class="radios hidden-sm hidden-xs">

							            <?php if( have_rows('questions',  $question->ID) ): ?>
							              <?php $i = 1 ?>
							              <?php while ( have_rows('questions',  $question->ID) ) : the_row(); ?>

							                  <div class="radio-item">
							                    <label class="label_radio" for="radio-0<?php echo $i; ?>">
							                    <input id="radio-0<?php echo $i; ?>" name="reponseradio" type="radio" value="<?php the_sub_field('item-linked',  $question->ID); ?>" />
							                        <?php the_sub_field('texte',  $question->ID); ?>
							                    </label>
							                  </div>

							                  <?php $i++ ?>
							              <?php endwhile; ?>

							            <?php endif; ?>

							          </fieldset>
							        
							        </form>
							      </div><!-- .form-outer -->

							    </div>


							 	<?php endif; ?>

			      </div><!-- #post-## -->

			    </article>


        </div><!-- .page -->
      <?php endwhile; // end of the loop. ?>



  <?php include('footer-quizz.php'); ?>

