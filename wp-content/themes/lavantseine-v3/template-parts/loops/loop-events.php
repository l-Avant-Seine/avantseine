


				<?php if ( $query->have_posts() ) : ?>

							<?php while ( $query->have_posts() ) : $query->the_post(); ?>

								<div class="agenda-grid-item event-outer m-8col">

									<?php
										$event_first_date = get_post_meta( $post->ID, 'eventDetail_first_date', true );
										$month = date( 'Y/m', $event_first_date );

										if ( $previous_month != $month ): ?>

												<span class="h_2 month"  month="<?php echo $month; ?>" data-date="<?php print strtotime($month.'/01') ?>">
													en <?php print strftime('%B %Y', htmlentities( strtotime($month.'/01')) )?>
												</span>

											<?php $previous_month = $month;

										endif;
									
										get_template_part( 'template-parts/blocs/bloc', 'event' ); ?>
								</div>
							<?php endwhile; ?>

				<?php else : ?>
					
					<div class="no-posts m-16col">
						<h3 class="h_3 ">
							Il n'y a aucun événement correspondant à votre recherche.
						</h3>
						<div class="clearfix">
							<a class="btn--big " href="/programmation">Rejouer</a>
						</div>					
					</div>

					

					<?php get_template_part( 'content', 'none' ); ?>

				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

				