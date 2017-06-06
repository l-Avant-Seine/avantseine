<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package l\'Avant-Seine_v2.0
 */

?>

	</div><!-- #content -->

	<footer id="mastfooter" class="site-footer transparent-background" role="contentinfo">
		<div class="wrap row">
			
			<?php
				if( have_rows('footer_cols', 'options') ):
			    while ( have_rows('footer_cols', 'options') ) : the_row(); ?>
						<div class="m-2col">
			        <?php the_sub_field('colonne'); ?>
						</div>
			    <?php endwhile;
			endif;
			?>			
		</div>

	</footer><!-- #mastfooter -->

	
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- http://addtocalendar.com/-->
    <script type="text/javascript">(function () {
            if (window.addtocalendar)if(typeof window.addtocalendar.start == "function")return;
            if (window.ifaddtocalendar == undefined) { window.ifaddtocalendar = 1;
                var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                s.type = 'text/javascript';s.charset = 'UTF-8';s.async = true;
                s.src = ('https:' == window.location.protocol ? 'https' : 'http')+'://addtocalendar.com/atc/1.5/atc.min.js';
                var h = d[g]('body')[0];h.appendChild(s); }})();
    </script>
</body>
</html>
