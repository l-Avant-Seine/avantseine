<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php $page_intro = get_field( 'pageDetail_intro' ); ?>
	<?php $page_right_col = get_field( 'pageDetail_rightCol' ); ?>


	<div class="wrap entry-media">
		<?php the_post_thumbnail(''); ?>
	</div>

	<header class="wrap entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

		<div class="wrap entry-extract">
			<?php echo $page_intro; ?>
		</div>

	<div class="wrap entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->



	<div class="wrap entry-aside">

		<?php echo $page_right_col; ?>
		<?php // echo $page_right_col; ?>
		
	</div><!-- .practical-aside -->



</article><!-- #post-## -->



	
	<?php
	$posts = get_field('rebonds');

	if($posts): ?>

		<div class="page-rebonds wrap">
		<h3>Ces pages pourraient vous intéresser</h3>
		<ul>
			<?php 
				foreach( $posts as $post): // ne pas changer $post IMPORTANT
					setup_postdata($post); 
			?>

			<li>
				<?php the_post_thumbnail(); ?>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				<?php the_excerpt(); ?>
			</li>

			<?php endforeach; ?>
		</ul>

		<?php 
				wp_reset_postdata(); ?>
		</div>
			<?php endif; ?>



