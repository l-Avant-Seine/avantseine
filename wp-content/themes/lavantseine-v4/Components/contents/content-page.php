<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */
 ?>

<?php if( ! is_home() ) : ?>
  <img src="<?php the_field('texture_from_five_to_none', 'option'); ?>" alt="" class="page_bg --inversed">
<?php endif; ?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	

	<div class="wrapper">

    <header class="pagehead">

      <?php if( ! get_field('hide_title') ) : ?>
        <div class="mb-large">
          <h1 class="h1_2 txt-center"><?php the_title(); ?></h1>
        </div>
      <?php endif; ?>

      <?php if (get_field('pageDetail_intro') !== '' ) : ?>
        <div class="flex --centered">
          <div class="big_typo m_10col mb-large txt-center">
            <?php the_field('pageDetail_intro'); ?>
          </div>
        </div>
      <?php endif; ?>

    </header>

    <div class="flex --centered">
      <div class="pagecontent copy">
        <?php the_content(); ?>
      </div>
      
    </div>

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
