


	<?php if ( $query->have_posts() ) : ?>
		<?php while ( $query->have_posts() ) : $query->the_post(); ?>


			<?php
				$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
				if($event_first_date) $month = date( 'Y/m', $event_first_date );

				if ( $previous_month != $month ): ?>

					<?php if( $previous_month ) : ?>
						</div><!-- .grid -->
					<?php endif; ?>

						<div class="archive_month mb-medium"  month="<?php echo $month; ?>" data-date="<?php print strtotime($month.'/01') ?>">
							<h3 class="h2_3 wrapper"><?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?></h3>
							<img src="<?php the_field('texture_from_five_to_none', 'option'); ?>" class="archive_month_bg">
						</div>
					<div class="grid archive_list mb-medium wrapper">

					<?php $previous_month = $month;

				endif; ?>

			<div class="archive_item m_3col mb-small">
				<?php get_template_part( 'Components/blocs/bloc', 'event', array('post' => $post->ID) ); ?>
			</div>
		
		<?php endwhile; ?>

	<?php else : ?>
					
		<div class="no_results flex --centered">
			<h3 class="h2_2">
				Il n'y a aucun événement correspondant à votre recherche.
			</h3>				
		</div>

		<?php get_template_part( 'content', 'none' ); ?>

	<?php endif; wp_reset_postdata(); ?>

</div>