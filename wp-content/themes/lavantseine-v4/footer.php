

		</div><!-- #content -->

		<footer id="mastfooter" class="site-footer" role="contentinfo" style="background-image: url('<?php the_field('texture_from_one_to_none', 'option'); ?>');">


			<div class="mod_bg flex --col">
				<div class="bg_upper">
				</div>
				<div class="bg_lower">
				</div>
			</div>

			
			<div class="footer_upper ">

				<div class="wrapper">

					<div class="grid mb-large">
						<div class="s_12col m_6col">
							<div class="wrap">
								<h3 class="h3 mb-small">Recevez les dernières actualités de l’Avant Seine !</h3>

								<?php get_template_part('Components/blocs/bloc', 'newsletter');  ?>
							</div>
						</div>
						
						<div class="s_12col m_6col">
							<div class="wrap">

								<div class="mb-small">
									<h3 class="h3">Suivez-nous sur les réseaux !</h3>
								</div>

								<div class="flex --jstf --hcentered --wrap --gap-s">
									<?php get_template_part('Components/blocs/bloc', 'reseaux');  ?>

									<div class="">
										<a href="<?php the_field('prog_brochure', 'option'); ?>" class="btn" target="_blank">Télécharger la brochure</a>
									</div>
									
								</div>


							</div>
						</div>
					</div>


					<div class="grid">
						<div class="s_12col m_2col">
							<nav class="header-branding">
								<a href="<?php echo esc_url( home_url( '/' ) ) ?>" rel="home" class="logo_link">
									<img class="site-logo" id="site-logo" src="<?php the_field('footer_logo', 'option'); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>" title="" width="100">
								</a>
							</nav>
						</div>
						<?php
							if( have_rows('footer_cols', 'options') ):
							while ( have_rows('footer_cols', 'options') ) : the_row(); ?>
								<div class="footer-col s_12col m_3col">
									<?php the_sub_field('colonne'); ?>
								</div>
							<?php endwhile;
						endif;
						?>			
					</div>
				</div>
			</div>

			<div class="footer_lower">
				<div class="wrapper ">
					<div class="">
						<?php 

						$images = get_field('logos_partenaires', 'options');

						if( $images ): ?>
						    <ul class="no-bullets flex --gap-m --centered">
						        <?php foreach( $images as $image ): ?>
						            <li class="logo-item flx-1">
										<img src="<?php echo $image['sizes']['logo']; ?>" alt="<?php echo $image['alt']; ?>" />
						            </li>
						        <?php endforeach; ?>
						    </ul>
						<?php endif; ?>
					</div>

					<nav id="footer-navigation" class="footer-navigation" role="navigation">
							<?php 
								wp_nav_menu( array( 
									'theme_location' => 'footer', 
									'menu_id' => 'footer-menu',
								) ); 
							?>
					</nav><!-- #site-navigation -->
					
				</div>
			</div>








		</footer><!-- #mastfooter -->

		
	</div><!-- #page -->

	<?php wp_footer(); ?>


	<div id="modal" class="modal">
		<div class="modal-inner wrap">
			<h2 id="modal-title" class="h_2 mb-2">Nous cherchons...</h2>

			<div id="modal-content"></div>
		</div>
	</div>


<?php if( get_field('popin_content', "options") !== '' ) : ?>
		<div id="popin" class="popin_outer hidden">

			<div class="popin_inner"  style="background-image: url('<?php the_field('texture_from_four_to_none', 'option'); ?>')">

				<div class="popin_bg">
					<div class="bg_upper"></div>
					<div class="bg_lower"></div>
				</div>

				<div class="popin_contents">
				
					<div class="popin_title mb-medium">
						<h3 class="h1_3"><?php the_field('popin_title', "options"); ?></h3>
					</div>

					<?php 
						$cover = get_field('popin_media', "options"); 
						$size = 'medium';
						if( $cover ) {
							echo "<img class='popin_media mb-medium' src='" . $cover['url'] . "'>";
						}
					?>
					
					<button id="popin_close" class="popin_close">
						<?php get_template_part('Components/svgs/svg', 'close'); ?>
					</button>

					<div class="popin_content copy">
						<div><?php the_field('popin_content', "options"); ?></div>

						<?php if( get_field('popin_label', "options") !== '' ) : ?>
							<div class="popin_cta">
								<a href="<?php the_field('popin_url', "options"); ?>" class="btn"><?php the_field('popin_label', "options"); ?></a>
							</div>
						<?php endif; ?>

					</div>

				</div>
			</div>
		</div>
<?php endif; ?>




		<?php if( is_home() ) : ?>
			<img src="https://secure.adnxs.com/seg?add=17307151&t=2" width="1" height="1" />
		<?php elseif( is_page( 'programmation' ) ) : ?>
			<img src="https://secure.adnxs.com/seg?add=17307153&t=2" width="1" height="1" />
		<?php else : ?>
			<img src="https://secure.adnxs.com/seg?add=17307149&t=2" width="1" height="1" />	
		<?php endif; ?>




		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130862498-1"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-130862498-1');
		</script>


	</body>
</html>
