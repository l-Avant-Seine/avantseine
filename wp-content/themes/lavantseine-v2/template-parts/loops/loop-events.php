


				<?php if ( $query->have_posts() ) : ?>
					<div class="row_alt">

						<div id="prog-grid" >
							<?php while ( $query->have_posts() ) : $query->the_post(); ?>

								<?php
									$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
									$month = date( 'Y/m', $event_first_date );

									if ( $previous_month != $month ): ?>

											<?php if($previous_month) : ?>
												</div>
											<?php endif; ?>

											<div class="h3 box-month clearfix m-first"  month="<?php echo $month; ?>" data-date="<?php print strtotime($month.'/01') ?>">
												<?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
											</div>
											<div class="row_alt event-row">
										<?php
										$previous_month = $month;
									endif;
								?>

								<div class="m-2coll">
									<?php get_template_part( 'template-parts/blocs/bloc', 'event' ); ?>
								</div>
							<?php endwhile; ?>

						</div>
					</div>
				<?php else : ?>
					
					<p>Il n'y a aucun spectacle correspondant à votre recherche.</p>

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

				