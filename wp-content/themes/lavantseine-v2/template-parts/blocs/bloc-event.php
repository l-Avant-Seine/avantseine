<?php
/**
 * @package lavantseine
 */
?>

<?php global $filter; ?>
<?php global $i; ?>

<article id="post-<?php the_ID(); ?>" class="">



				<div class="entry-meta">
					<?php
						/* Get Meta Values if event */
						if ( 'event' == get_post_type() ) :
							$event_dates = get_post_meta( $post->ID, 'eventDetail_dates', true );
							$event_hour = get_post_meta( $post->ID, 'eventDetail_hour', true );
							$event_landscape_media = get_post_meta( $post->ID, 'eventMedia_landscape', true );

							if ( isset( $event_dates ) ) {
								echo "<span class='date-main'>". $event_dates . "</span>";
							}
							if ( isset( $event_hour ) ) {
								echo " - <span class='date-main'>". $event_hour . "</span>";
							}	
							if ( isset( $eventMedia_landscape ) ) {
								echo $event_dates;
							}
							the_post_thumbnail('box-thumbnail');
						endif; // End if 'event' == get_post_type()  
					?>
			
				</div><!-- .entry-meta -->

				<h2 class="entry-title">	
					<a href="<?php the_permalink(); ?>" <?php if ( $filter ) { echo 'target="_blank"'; } ?>rel="bookmark">
		<?php the_title(); ?></a>
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


</article><!-- #post-## -->
