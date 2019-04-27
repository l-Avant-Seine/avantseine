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

		<footer id="mastfooter" class="site-footer" role="contentinfo">


			<div class="footer-infos wrap row mb-3">
				
				<?php
					if( have_rows('footer_cols', 'options') ):
				    while ( have_rows('footer_cols', 'options') ) : the_row(); ?>
							<div class="footer-col m-5col">
				        <?php the_sub_field('colonne'); ?>
							</div>
							<div class="footer-col--empty m-1col">
								&nbsp;
							</div>
				    <?php endwhile;
				endif;
				?>			
			</div>

			<div class="footer-logos">
				<?php 

				$images = get_field('logos_partenaires', 'options');

				if( $images ): ?>
				    <ul class="wrap no-bullets is-flex">
				        <?php foreach( $images as $image ): ?>
				            <li class="logo-item">
											<img src="<?php echo $image['sizes']['logo']; ?>" alt="<?php echo $image['alt']; ?>" />
				            </li>
				        <?php endforeach; ?>
				    </ul>
				<?php endif; ?>
			</div>

		</footer><!-- #mastfooter -->

		
	</div><!-- #page -->

	<?php wp_footer(); ?>


		<?php if( is_home() ) : ?>
			<img src="https://secure.adnxs.com/seg?add=17307151&t=2" width="1" height="1" />
		<?php elseif( is_page( 'programmation' ) ) : ?>
			<img src="https://secure.adnxs.com/seg?add=17307153&t=2" width="1" height="1" />
		<?php else : ?>
			<img src="https://secure.adnxs.com/seg?add=17307149&t=2" width="1" height="1" />	
		<?php endif; ?>


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
