
	<?php $words = $args['words']; ?>

	<div class="webmag-ticker ticker-wrap">
		<div class="ticker" style="animation-duration: <?php echo get_field('thicker_speed', 'option') . 's'; ?>">

			<?php for ($i = 0; $i < 500; $i++) {
				if ($i % 2 === 0) { ?>
					<span class="ticker__item">
						<?php foreach( $words as $word ) : ?>
							<p class="word"><?php echo $word; ?></p>
							<span class="sep">&#8226;</span>

						<?php endforeach; ?>
					</span>
				<?php } else { ?>
					<span class="ticker__item">
						<?php foreach( $words as $word ) : ?>
							<p class="word"><?php echo $word; ?></p>
							<span class="sep">&#8226;</span>
						<?php endforeach; ?>
					</span>
			<?php }
			} ?>
		</div>
	</div>