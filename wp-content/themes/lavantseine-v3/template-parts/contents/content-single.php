<?php
/**
 * @package lavantseine
 */

	$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
	$postDetail_showPic = get_post_meta( $post->ID, 'postDetail_showPic', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<header class="post-header wrap mb-2" itemprop="image">

		<div class="post-titles row">
			<div class="m-20col m-1col-push m-first mb-1">

				<div class="post-metas is-flex">

					<div class="flx-2">
						<?php
							$categories = get_the_category();
							$separator = ' ';
							$output = '';
							if($categories){
								foreach($categories as $category) {
									$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="post-term label_1">'.$category->cat_name.'</a>'.$separator;
								}
							echo trim($output, $separator);
							}
						?>
					</div>

					<div class="flx-1 text-on-right">
						<span class="label_1"><?php the_date('d/m/Y', '', ''); ?></span>
					</div>
				</div>
			</div><!-- .single-metas -->

			<div class="m-20col m-1col-push m-first">
				<h1 class="h_1 clearfix" itemprop="name"><?php the_title(); ?></h1>
			</div>

		</div>

		<div class="post-cover">
			<img src="<?php  the_post_thumbnail_url(''); ?>" alt="">
		</div>

	</header>



	<div class="wrap post-content row">

		<div class="m-6col post-aside mb-2">
				<?php set_query_var('taxo', 'relational_tag'); ?>
				<?php get_template_part( 'template-parts/modules/module', 'relatedevent' ); ?>
		</div>



		<div class="m-16col m-last post-copy mb-2"  itemprop="mainContentOfPage">

			<?php

			$media_items = get_posts(array(
				'post_type'		=>	'attachment',
				'post_parent' 	=> get_the_ID(),
				'posts_per_page' => -1,
				'meta_key'      => '_media_tag',
				'meta_value'	=> 'slide'
			));

			if ($media_items):
				wp_enqueue_script( 'slick' );
				 ?>
				<ul class="single-slides nobullets mb-2">
					<?php foreach ( $media_items as $media_item ) : ?>
						<li class="slide">
							<?php the_attachment_link( $media_item->ID, true, false, false ); ?>
							<div class="bx-caption">
								<?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
						</li>
					<?php endforeach; ?>
				</ul><!-- slides -->

			<?php endif; ?>


			<?php if ( $postDetail_mediaMarkup ) { ?>
					<div class="mb-2">
						<?php echo $postDetail_mediaMarkup; ?>
					</div>
			<?php } ?>
			
			<div class="copy">
				<?php the_content(); ?>

				<div class="single-share cf">
					<?php lavantseine_display_share_buttons(); ?>
				</div>

			</div>
			
		</div>




	</div><!-- .post-content -->

</article><!-- #post-## -->




    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "Article",
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
      "name": "<?php echo get_the_title(); ?>",
    }
    </script>
