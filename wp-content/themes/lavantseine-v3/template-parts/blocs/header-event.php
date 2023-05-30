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



								
			<?php 
				$count = count($tags);
				if ( $count > 0 ) : ?>
						
							<div class="row">
								<div class="s-20col s-1col-push mb-05">
									<ul class='nobullets teaser-tagslist'>
										<?php 
											foreach ( $tags as $term ) : 
									 			$term_link = get_term_link( $term, '' ); ?>
										    	<li class='teaser-tag'>
										    		<a class='' href='<?php echo $term_link; ?>'><?php echo $term->name; ?></a>
										    	</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>

			<?php endif; ?>


						<div class="row mb-1">
			  			<h3 class="s-22col s-1col-push h_1 teaser-title"><?php the_title(); ?></h3>
						</div>

			  		<div class="row mb-1">
			  			<div class="s-22col s-1col-push">

								<?php if( !get_field('eventDetail_is_news') ) : ?>
									<span class="label_3 meta-item">
										<?php echo get_event_dates($event_first_date, $event_last_date, $event_other_dates, $exhibition); ?>
									</span>
								<?php endif; ?>

								<?php if ( isset( $main_tarif ) ) :  ?>

										<span class="meta-item label_3">
											<?php echo '<span class="label_2">tarif </span>' . $main_tarif;
											// $t = 0;
									  //   foreach ( $tarifs_list as $tarif ) {
									  //   	if( $t > 0) {
									  //   		echo ' | ';
									  //   	}
									  //   	echo '<span class="">' . $tarif->name . '</span>';
									  //   	$t++;
									  //   } ?>
								</span>
								<?php endif; ?>

								<?php if ($event_duration != '') : ?>
									<span class="meta-item label_3">
										<span class="label_2">durée</span>
										<span class=""><?php echo $event_duration; ?></span>
									</span>
								<?php endif; ?>

								<?php if ( get_field('noms_principaux') !== '') : ?>
									<span class="meta-item label_3">
										<span class="label_2">Cie</span>
										<span class="">
											<?php the_field('noms_principaux'); ?>
										</span>
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
			  		</div>




