<?php
/**
 *
 * Template Name: Question
 *
 * @package cdn
 */

 	get_template_part( 'header', 'quizz' );
 
 	if( isset($_POST['reponseradio']) ){
    $_SESSION['responses'][] = $_POST['reponseradio'];
  } ?>



      <?php while ( have_posts() ) : the_post(); ?>

        <div class="page">


						<article id="post-<?php the_ID(); ?>" class="quizz-question full">
						  <div class="row full">

						    <div class="m-8col question-img table full" style="background-color: <?php the_field('couleur_de_la_page'); ?>">
						        <div class="table-cell">
						            <?php the_post_thumbnail( ); ?> 
						       </div>

						    </div>

						    <div class="m-7col question-choices full table">
						      <div class="table-cell">
						        <div class="btn-cdn-question table">
						          <div class="table-cell">
						            <?php the_field('numero'); ?>
						          </div> 
						        </div>

						         <h2><?php the_title(); ?></h2>

						            <div class="form-outer">
						              <form id="quizzform" class="form-horizontal" accept-charset="utf-8" action="<?php the_field('next_question'); ?>" method="post">

						                <div style="display: none;"><input name="questionnum" type="hidden" value="1" /></div>

						                <fieldset class="radios hidden-sm hidden-xs">

						                  <?php if( have_rows('questions') ): ?>
						                    <?php $i = 1 ?>
						                    <?php while ( have_rows('questions') ) : the_row(); ?>

						                        <div class="table radio-item">
						                          <div class="table-cell">
						                            <label class="label_radio" for="radio-0<?php echo $i; ?>">
						                            <input id="radio-0<?php echo $i; ?>" name="reponseradio" type="radio" value="<?php the_sub_field('item-linked'); ?>" />
						                              <?php the_sub_field('texte'); ?>
						                            </label>
						                          </div>
						                        </div>
						                        <?php $i++ ?>
						                      <?php endwhile; ?>

						                  <?php endif; ?>

						                </fieldset>
						              
						              </form>
						            </div><!-- .form-outer -->



						      </div>
						    </div><!-- .m-6col -->
						  </div><!-- .row -->
						</article><!-- #post-## -->



        </div><!-- .page -->
      <?php endwhile; // end of the loop. ?>

    <?php get_template_part( 'footer', 'quizz' ); ?>


<script>

	  jQuery( document ).ready(function($) {

	    $( "#quizzform" ).change(function(event) {
	      event.preventDefault();
	      $(this).submit();
	    });

	  });

</script>