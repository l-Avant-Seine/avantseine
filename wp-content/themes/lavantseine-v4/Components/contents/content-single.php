<?php
/**
 * @package lavantseine
 */

	$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
	$postDetail_showPic = get_post_meta( $post->ID, 'postDetail_showPic', true );

?>



	<?php get_template_part('Components/modules/module', 'magtitle'); ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<nav class="single_nav wrapper --narrow mb-small">

		<div class="mb-small">
			<a href="/magazine" class="flex --gap-xs --hcentered">
                        <?php get_template_part('Components/svgs/svg', 'arrow-left'); ?>
				<span>Retour au magazine</span>
			</a>
		</div>

		<div class="single_metas flex --gap-xs --hcentered">

			<?php
							$categories = get_the_category();
							$separator = ' ';
							$output = '';
							if($categories){
								foreach($categories as $category) {
									$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="post-term tag">'.$category->cat_name.'</a>'.$separator;
								}
							echo trim($output, $separator);
							}
						?>

					<div class="flx-1 text-on-right">
						<span class="label_1"><?php the_date('d/m/Y', '', ''); ?></span>
					</div>


		</div>
	</nav>


	<header class="single_header wrapper --narrow mb-medium" itemprop="image">

		<div class="single_titles mb-small">
			<h1 class="h1_3" itemprop="name"><?php the_title(); ?></h1>
		</div>

		<div class="single_cover mb-medium">
			<img src="<?php  the_post_thumbnail_url('homeslide'); ?>" alt="">
		</div>

		<div class="single_excerpt big_typo mb-0">
			<?php the_field('postDetail_shortText') ?>
		</div>

	</header>



	<div class="single_content wrapper --narrow mb-large">


		<div class="grid">

			<div class="m_8col" itemprop="mainContentOfPage">
				<div class="copy">
					<?php the_content(); ?>
				</div>
			</div>

		</div>


		<div class="m_8col" itemprop="mainContentOfPage">

			<?php if ( $postDetail_mediaMarkup ) { ?>
					<div class="mb-2">
						<?php echo $postDetail_mediaMarkup; ?>
					</div>
			<?php } ?>
		
			
		</div>

	</div><!-- .post-content -->
</article><!-- #post-## -->


        <?php get_template_part('Components/modules/module', 'flexibles'); ?>


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
