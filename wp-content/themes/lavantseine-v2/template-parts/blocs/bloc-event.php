<?php
/**
 * @package lavantseine
 */
?>

<?php global $filter; ?>
<?php global $i; ?>


<article id="event-<?php the_ID(); ?>" class="bloc-event">



		<div class="entry-meta">
			<?php
				/* Get Meta Values if event */

						$event_dates = get_field( 'eventDetail_dates' );
						$event_duration = get_field( 'eventDetail_duration' );
						$event_text2 = get_field( 'eventDetail_text2' );
						$event_first_date = htmlspecialchars( get_field( 'eventDetail_first_date' ) );
						$event_last_date = htmlspecialchars( get_field( 'eventDetail_last_date' ) );
						$event_other_dates = unserialize( get_field('eventDetail_otherdates')[0]);

					$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );

					the_post_thumbnail('box-thumbnail');



					// IF NEW DATE METHOD IS SET 

							if( have_rows('eventDetail_newdates') ):

						    while ( have_rows('eventDetail_newdates') ) : the_row();

					        the_sub_field('date');
					        echo ' - ';
									the_sub_field('horaire');
									echo '<br>';

							   endwhile;

							else :

							// IF OLD DATE METHOD 
								// if ( $event_dates ) : echo "<span class='date-main'>". $event_dates ."</span>" ; endif; 
								if ( $event_first_date ) : 
									echo '<ul class="event-repeatable-dates">';
									    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_first_date ) .'.</li>'; 

									if ( $event_other_dates ) : 
										foreach ($event_other_dates as $date) { 
											$date = strtotime($date);
										    if ( $date != '' ) : 
										    	echo '<li>'. strftime('%A %e %b %G - %kh%M', $date ) .'.</li>'; 
										    endif;
										} 
									endif; 

									if ( $event_last_date && $event_last_date != $event_first_date ) : 
									    echo '<li>'. strftime('%A %e %b %G - %kh%M', $event_last_date ) .'.</li>'; 							    
									endif;

									echo '</ul>';
								endif; 


							endif; ?>


		
		</div><!-- .entry-meta -->



		<h2 class="entry-title">	
			<a href="<?php the_permalink(); ?>" <?php if ( $filter ) { echo 'target="_blank"'; } ?>rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
				
		

		<div class="entry-summary">
			<?php
				$event_shortText = get_field( 'eventDetail_shortText' );
				$post_shortText = get_post_meta( $post->ID, 'postDetail_shortText', true );

				if ( $event_shortText ) {
					echo "<p>". $event_shortText. "</p>";
				} elseif ($post_shortText) {
					echo "<p>".$post_shortText. "</p>";
				}
			?>
		</div><!-- .entry-summary -->


				<?php 
					$terms = wp_get_post_terms( $post->ID, array('discipline', 'rdv')  );
					$count = count($terms);
					if ( $count > 0 ){
					    echo "<ul>";
					    foreach ( $terms as $term ) {
					    	$term_link = get_term_link( $term, '' );
						    echo "<a href='". $term_link ."'><li class='saisoned-on-color'>#" . $term->name . "</li></a>";
					    }
					    echo "</ul>";
					}
				?>


</article><!-- #event-## -->
