<?php

	$today = time();


			$exhibition = get_field( 'eventDetail_exhibition', get_the_ID() );
			$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date', $post->ID ) );
			$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date', $post->ID ) );
			$event_other_dates = get_field('eventDetail_otherdates', $post->ID ); 
			$event_duration = get_field( 'eventDetail_duration', $post->ID );
			$tags = wp_get_post_terms($post->ID, array('discipline'), array("fields" => "all"));


			$main_tarif_id = get_post_meta($post->ID,'_yoast_wpseo_primary_tarif',true);

			if( $main_tarif_id ){
			   $main_tarif = get_term($main_tarif_id, 'tarif');
			   if(isset($main_tarif->name)) 
			       $main_tarif = $main_tarif->name;
			}

			$tarifs_list = wp_get_post_terms($post->ID, 'tarif', array("fields" => "all")); 
			?>

						<div class="row mb-2">

							<div class="s-17col s-1col-push">

								<h1 class=" h_1 teaser-title">
									<?php the_title(); ?>
								</h1>

								<?php if ( get_field('noms_principaux') !== '') : ?>
									<p class="teaser-subtitle">
										<?php the_field('noms_principaux'); ?>
									</p>
								<?php endif; ?>
							</div>

							<div class="s-2col-push s-5col">
								<?php 
									$count = count($tags);
									if ( $count > 0 ) : ?>
										<div class="keywords_container">
											<div class='teaser-tagslist'>
												<?php foreach ( $tags as $term ) : 
													$term_link = get_term_link( $term, '' ); ?>
														<p class='teaser-tag'>
															<a class='' href='<?php echo $term_link; ?>'>
																<img src="<?php the_field('visuel_white', $term); ?>">
																<?php echo $term->name; ?>
															</a>
														</p>
												<?php endforeach; ?>
											</div>


										</div>
								<?php endif; ?>
							</div>

						</div>


			  		<div class="row mb-2">
			  			<div class="s-17col s-1col-push">

								<?php if( !get_field('eventDetail_is_news') ) : ?>
									<span class="label_3 meta-item">
										<?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?>
									</span>
								<?php endif; ?>

								<?php if ( isset( $main_tarif ) ) :  ?>

										<span class="meta-item label_3">
											<?php echo '<span class="label_2">tarif </span>' . $main_tarif; ?>
									</span>
								<?php endif; ?>

								<?php if ($event_duration != '') : ?>
									<span class="meta-item label_3">
										<span class="label_2">durée</span>
										<span class=""><?php echo $event_duration; ?></span>
									</span>
								<?php endif; ?>

								<?php 
									$public_label = get_field('eventDetail_publiclabel');

									if( $public_label !== '0' ) : 
										if( $public_label !== null ) : ?>
										<span class="meta-item label_3">
											<span class="label_2">pour tous dès</span>
											<span class=""><?php echo $public_label; ?></span>
										</span>							
									<?php endif; ?>
								<?php endif; ?>

			  			</div>


						<div class="s-2col-push s-5col">
							<?php if( have_rows('event_keywords') ): ?>
								<div class="keywords"> 
									<?php while( have_rows('event_keywords') ) : the_row(); ?>
										<p class="keyword"><?php the_sub_field('keyword'); ?></p>	
									<?php endwhile; ?>
								</div>
							<?php endif; ?>
						</div>
			  		</div>




