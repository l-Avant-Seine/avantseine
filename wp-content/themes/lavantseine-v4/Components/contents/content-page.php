<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */


   $children = get_pages( array( 'child_of' => $post->ID, 'posts_per_page' => -1, 'sort_column' => 'post_date', 'sort_order' => 'DESC') );

if ( is_page() && count( $children ) > 0 ) : 
    // This is a parent page ?>


	<div class="page-content-wrapper wrap mb-2">

			<h1 class="h_1 page_title mb-1"><?php the_title(); ?></h1>
			
			<div class="entry-excerpt  mb-2"><?php the_content(); ?></div>

			<div id="page_grid" class="row" data-columns>

				<?php foreach( $children as $child ) { ?>

					<article class="event-item mb-2">
								<a href="<?php echo get_page_link( $child->ID ); ?>" rel="bookmark">

							<div class="item-breather">
								
								<div class="item-cover ratio2for3">

									<div class="ratio2for3-content">
										<img class=" b-lazy" 
												src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==
												data-src="<?php echo get_the_post_thumbnail_url($child->ID, 'featured-post-thumbnail'); ?>">
									</div>
								</div>

										<h3 class="h_3 item-title" itemprop="name">	
												<?php echo $child->post_title; ?>
										</h3>
							
							</div>
								</a>

					</article>

				<?php } // end foreach ?>

			</div>

	</div>

<?php 
else :
   // This is not a parent page


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

	<?php 
	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	if (strpos($url,'communautes') !== false) { ?>
		<div class="ticker-wrap">
			<div class="ticker">

				<?php for ($i=0; $i < 100; $i++) { 
					if( $i % 2 === 0 ) { ?>
						<span class="ticker__item">Ici on partage !</span>
					<?php }
					else { ?>
						<span class="ticker__item red">Ici on partage !</span>
					<?php }
				} ?>
			</div>
		</div>
	<?php } ?>

	<header class="page-header bg_cover mb-2" itemprop="image"  style="background-image: url(<?php the_post_thumbnail_url(); ?>)">
	</header><!-- .entry-header -->


	<div class="page-content-wrapper wrap row mb-2">

		<div class="m-6col page-aside mb-2">

			<div class="page-nav module-childpages mb-2">
				<?php set_query_var( 'root', $root ); ?>
				<?php set_query_var( 'root_title', $root_title ); ?>
				<?php set_query_var( 'root_title_url', $root_title_url ); ?>
				<?php get_template_part('Components/loops/loop', 'childpages'); ?>
			</div>


			<?php

				if( have_rows('add_blocs') ):

				     // loop through the rows of data
				    while ( have_rows('add_blocs') ) : the_row();

				        if( get_row_layout() == 'bloc_texte' ): ?>

									<div class="module-infos  mb-2">	
										<h3 class="h_3 module-title"><?php the_sub_field('titre'); ?></h3>

										<?php the_sub_field('texte'); ?>
									</div>
				        	

				        <?php elseif( get_row_layout() == 'la_brochure' ): ?>

									<?php get_template_part('Components/modules/module', 'brochures'); ?>


				        <?php elseif( get_row_layout() == 'cette_semaine' ): ?>

									<div class=" module-week mb-2">	
										<h3 class="h2">cette <br>semaine</h3>

										<?php the_field('cette_semaine', 'options'); ?>
									</div>


				        <?php endif;

				    endwhile;

				endif; ?>

				<?php
				$pages = get_field('rebonds'); 
				if($pages): ?>
					
					<!-- Pages -->
					<div id="" class="cf put-on-1col">
						<?php
							set_query_var('pages_list', $pages);
							set_query_var('title', '');
							set_query_var('icons', true);
							get_template_part('Components/modules/module', 'pages'); 
						?>
					</div>

				<?php endif; ?>


		</div><!-- .page-aside -->



		<div class="m-16col m-last page-content mb-2"  itemprop="mainContentOfPage">
			<div class="copy">
				<?php the_content(); ?>
			</div>
			<?php echo $page_right_col; ?>
		</div><!-- .page-content -->

	</div><!-- .row -->



	<?php if( isset($tag) ) : ?>
	<!-- Les articles et événements liés à la page par le tag 'arborescence' -->

				<?php 
					$args = array(
						'post_type' 			=> array('post', 'event'),
						'posts_per_page'	=> 6,
						'orderby'					=> 'post_date',
						'order' 					=> 'DESC',
						'arborescence'		=> $tag->slug,
					);

					$related_posts_query = new WP_Query( $args );
					$posts_found = $related_posts_query->found_posts; ?>

		<?php if ( $related_posts_query->have_posts() ) : ?>

		<section id="" class="cf page_related">
			<div class="wrap">
				<div id="salgrid_3" data-columns class="row">
				<?php while ( $related_posts_query->have_posts() ) : $related_posts_query->the_post();

					$post_type = get_post_type(); 

						switch ($post_type) {
							case 'event':
								get_template_part( 'Components/blocs/bloc', 'event' );
								break;

							case 'post':
								get_template_part( 'Components/blocs/bloc', 'article' );
								break;

							case 'page':
								get_template_part( 'Components/blocs/bloc', 'page' );
								break;

							default:
								get_template_part( 'Components/blocs/bloc', 'page' );
								break;
						}
						
						endwhile;
						wp_reset_postdata(); ?>

				</div>

				<?php if( $posts_found > 6 ) { ?>
					<a href="/magazine/?tag=<?php echo $tag->slug; ?>" class="btn-primary is-centered mb-2">Voir tous les articles du magazine</a>
				<?php } ?>

			</div> 
		</section>

		<?php endif; ?>

	<?php endif; ?>


</article><!-- #post-## -->

	
<?php
endif; // endif subpage

?>



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
