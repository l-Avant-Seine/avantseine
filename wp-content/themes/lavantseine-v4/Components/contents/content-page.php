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



	<div class="">

		<h1 class=""><?php the_title(); ?></h1>
		<div class=""><?php the_content(); ?></div>

	</div><!-- .row -->


	<?php get_template_part('Components/modules/module', 'flexibles'); ?>


</article><!-- #post-## -->



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
