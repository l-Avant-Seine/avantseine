	<div class="webmag-ticker ticker-wrap">
		<div class="ticker" style="animation-duration: <?php echo get_field('thicker_speed', 'option') . 's'; ?>">

			<?php for ($i = 0; $i < 50; $i++) {
				if ($i % 2 === 0) { ?>
					<span class="ticker__item">
						<?php if (get_field('thicker_text_a', 'option') !== '') {
							the_field('thicker_text_a', 'option');
						} else {
							printf('Bienvenue !');
						} ?>
					</span>
				<?php } else { ?>
					<span class="ticker__item red">
						<?php if (get_field('thicker_text_b', 'option') !== '') {
							the_field('thicker_text_b', 'option');
						} else {
							printf('Bienvenue !');
						} ?>
					</span>
			<?php }
			} ?>
		</div>
	</div>