<?php
/**
 * @package lavantseine
 */

	$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
	$postDetail_showPic = get_post_meta( $post->ID, 'postDetail_showPic', true );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="single-header bg_cover is-flex" itemprop="image" style="background-image: url(<?php  the_post_thumbnail_url(''); ?>);">

		<div class="wrap single-title offset-right">
			<h1 class="h1 clearfix" itemprop="name"><?php the_title(); ?></h1>
			<div class="meta-date clearfix">Publié le <?php the_date('d/m/Y', '', ''); ?></div>
			<div class="single-share clearfix">
			<?php lavantseine_display_share_buttons(); ?>
			</div>
		</div>

	</header>

	<div class="wrap single-metas">
			<?php
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="postmeta-term">'.$category->cat_name.'</a>'.$separator;
					}
				echo trim($output, $separator);
				}
			?>
	</div><!-- .single-metas -->


	<div class="wrap single-content row">
		<div class="m-5col entry-content"  itemprop="mainContentOfPage">

			<?php

			$media_items = get_posts(array(
				'post_type'		=>	'attachment',
				'post_parent' 	=> get_the_ID(),
				'posts_per_page' => -1,
				'meta_key'      => '_media_tag',
				'meta_value'	=> 'slide'
			));

			if ($media_items):
				wp_enqueue_script( 'bxslider' );
				 ?>
				<ul class="slider bxslider-with-controls no-bullets">
					<?php foreach ( $media_items as $media_item ) : ?>
						<li class="slide">
							<?php the_attachment_link( $media_item->ID, true, false, false ); ?>
							<div class="bx-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></div>
						</li>
					<?php endforeach; ?>
				</ul><!-- slides -->

			<?php endif;


				if ( $postDetail_mediaMarkup ) {
					echo $postDetail_mediaMarkup;
				}
			?>

			<?php the_content(); ?>
		</div>


			<div class="m-3col single-aside offset-right">
					<?php set_query_var('taxo', 'relational_tag'); ?>
					<?php get_template_part( 'template-parts/modules/module', 'relatedevent' ); ?>
			</div>

	</div><!-- .entry-content -->

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
