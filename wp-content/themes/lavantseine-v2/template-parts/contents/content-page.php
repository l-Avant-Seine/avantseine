<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */


	$tax_args = array('orderby' => 'none', );
	$tags = wp_get_post_terms( $post->ID , 'arborescence', $tax_args);
	if( !empty($tags) ) :
		$tag = $tags[0];
	endif; 

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


	<header class=" page-header bg_cover is-flex layer" itemprop="image"  style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
		<div class="wrap page-title" itemprop="name">
			<h1 class="h1"><?php echo $root_title; ?></h1>
		</div>
	</header><!-- .entry-header -->

	<div class="wrap row">

		<div class="m-5col page-content entry-content"  itemprop="mainContentOfPage">

			<?php the_content(); ?>

			<?php echo $page_right_col; ?>
		</div><!-- .entry-content -->

		<div class="m-3col m-last page-aside">

			<div class="page-nav module-childpages offset-right layer">
				<?php set_query_var( 'root', $root ); ?>
				<?php get_template_part('template-parts/loops/loop', 'childpages'); ?>
			</div>



				<?php

				// check if the flexible content field has rows of data
				if( have_rows('add_blocs') ):

				     // loop through the rows of data
				    while ( have_rows('add_blocs') ) : the_row();

				        if( get_row_layout() == 'bloc_texte' ): ?>

									<div class="offset-right module-infos layer">	
										<h3 class="h2"><?php the_sub_field('titre'); ?><br><span class="title-diamond">&#x02666;</span></h3>

										<?php the_sub_field('texte'); ?>
									</div>
				        	

				        <?php elseif( get_row_layout() == 'la_brochure' ): ?>

									<?php get_template_part('template-parts/modules/module', 'brochures'); ?>


				        <?php elseif( get_row_layout() == 'cette_semaine' ): ?>

									<div class="offset-right module-week layer">	
										<h3 class="h2">cette <br>semaine<br><span class="title-diamond">&#x02666;</span></h3>

										<?php the_field('cette_semaine', 'options'); ?>
									</div>


				        <?php endif;

				    endwhile;

				else :

				    // no layouts found

				endif;

				?>


		</div>

	</div>


	<?php if( $tag != '' ) : ?>
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
				set_query_var('module_title', '');
				get_template_part('template-parts/modules/module', 'articles'); 
				wp_reset_postdata();

				if( $posts_found > 8 ) { ?>
					<a href="/magazine/?tag=<?php echo $tag->slug; ?>" class="btn--big is-centered">Voir tous les articles du magazine</a>
				<?php }
			?>

	</section>
	<?php endif; ?>

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


    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebPage",
      "location": {
        "@type": "Place",
        "address": {
          "@type": "PostalAddress",
          "addressLocality": "Colombes",
          "postalCode": "92700",
          "streetAddress": "Parvis des Droits de l’Homme - 88 rue Saint Denis"
        },
        "name": "l'Avant Seine, Théatre de Colombes"
      },
      "name": "<?php echo get_the_title(); ?>"
    }
    </script>
