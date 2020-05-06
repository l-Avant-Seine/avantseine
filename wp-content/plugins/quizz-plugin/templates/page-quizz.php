<?php 
/**
 *
 * Template Name: Quizz
 *
 * @package cdn
 */

	get_template_part( 'header', 'quizz' ); 

  session_destroy();
  unset($_SESSION); ?>



      <?php while ( have_posts() ) : the_post(); ?>

        <div class="page" style="background-color: <?php the_field('couleur_de_la_page'); ?>">



			    <article id="post-<?php the_ID(); ?>" class="quizz-home wrap row">


			      <div class="logo m-3col">
			        <h1 class="site-title">
			          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			        </h1>
			        <div class="site-logo-common mobile"></div>
			      </div>


			      <header class="m-12col m-last quizzhome-header is-relative">

			          <h2><?php the_title(); ?></h2>
			          <h3><?php the_field('subtitle'); ?></h3>


			          <div class="quizzhome-img">
			            <div class="btn-rounded white is-absolute"><a href="<?php the_field('first_question'); ?>">Commencer le Quizz !</a></div>

			            <?php the_post_thumbnail( 'full' ); ?> 
			          </div>

			      </header><!-- #post-## -->


			      <div class="row">
			        <div><?php the_content(); ?></div>
			      </div>

			    </article>




        </div><!-- .page -->
      <?php endwhile; // end of the loop. ?>



  <?php get_template_part( 'footer', 'quizz' ); ?>

