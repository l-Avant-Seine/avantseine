<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */

wp_enqueue_script( 'salvatorre' );

	$tax_args = array('orderby' => 'none', );
	$tags = wp_get_post_terms( $post->ID , 'arborescence', $tax_args);
$tag = $tags[0];

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


	<header class=" page-header bg_cover is-flex layer" style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
		<div class="wrap page-title">
			<h1 class="h1"><?php echo $root_title; ?></h1>
		</div>
	</header><!-- .entry-header -->

	<div class="wrap row">

		<div class="m-5col page-content entry-content">
			
			<?php if( isset($page_intro) && $page_intro !== '') : ?>
			<div class="page-extract">
				<?php echo $page_intro; ?>
			</div>
			<?php endif; ?>

			<?php the_content(); ?>

			<?php echo $page_right_col; ?>
		</div><!-- .entry-content -->

		<div class="m-3col m-last page-aside">

			<div class="page-nav module-childpages offset-right layer">
				<?php set_query_var( 'root', $root ); ?>
				<?php get_template_part('template-parts/loops/loop', 'childpages'); ?>
			</div>

			<div class="offset-right module-week">	
				<h3 class="h2">cette <br>semaine</h3>

				<?php the_field('cette_semaine', 'options'); ?>
			</div>
			
		</div>

	</div>


	<!-- Les articles liés à la page par le tag 'arborescence' -->
	<section id="" class="layer clearfix wrap">

			<?php 
				$args = array(
					'post_type' 			=> 'post',
					'posts_per_page'	=> 8,
					'orderby'					=> 'post_date',
					'order' 					=> 'DESC',
					'arborescence'		=> $tag->slug,
				);

				$related_posts_query = new WP_Query( $args );
				$posts_found = $related_posts_query->found_posts;

				set_query_var('query', $related_posts_query);
				get_template_part('template-parts/modules/module', 'articles'); 
				wp_reset_postdata();

				if( $posts_found > 0 ) { ?>
					<a href="/magazine/?tag=<?php echo $tag->slug; ?>" class="btn--big is-centered">Voir tous les articles du magazine</a>
				<?php }
			?>

	</section>


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



