<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */

	$ancestors = get_post_ancestors($post);
	$level = count($ancestors);
	$ariane = '';

	if( $level == 0 ) {
		$root = get_the_ID();
		$children = get_page_children($root, $pages);
		$root_title = get_the_title($root);
		$root_title_url = get_permalink($root);	
	} 
	else {
		$root = end($ancestors);
		$root_title = get_the_title($root);
		$root_title_url = get_permalink($root);	
	}

	$page_intro = get_field( 'pageDetail_intro' ); 
	$page_right_col = get_field( 'pageDetail_rightCol' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<h1><?php echo $root_title; ?></h1>

	<div class="page-nav">
		
		<?php set_query_var( 'root', $root ); ?>
		<?php get_template_part('template-parts/loops/loop', 'childpages'); ?>

	</div>

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
	$pages = get_field('rebonds'); 
	if($pages): ?>
		
		<!-- Pages -->
		<div id="" class="layer clearfix">
			<?php
				set_query_var('pages_list', $pages);
				set_query_var('title', '<h3>Ces pages pourraient vous intéresser</h3>');
				get_template_part('template-parts/modules/module', 'pages'); 
			?>
		</div>

	<?php endif; ?>



