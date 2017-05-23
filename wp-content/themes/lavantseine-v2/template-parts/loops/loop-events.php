


				<?php if ( $query->have_posts() ) : ?>

					<?php while ( $query->have_posts() ) : $query->the_post(); ?>

						<?php
							// Month Test
							$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
							$month = date( 'Y/m', $event_first_date );

							// Test month of event. Display Month Date
							if ( $previous_month != $month ):
								?>
								<div class="box-month" data-date="<?php print strtotime($month.'/01') ?>">
									<h2 class="entry-title">
										<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
									</h2>
								</div><!-- .box-month -->
								<?php
								$previous_month = $month;
							endif;
						?> <!-- end month test -->

						<?php get_template_part( 'template-parts/blocs/bloc', 'event' ); ?>

					<?php endwhile; ?>

					

				<?php else : ?>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

				