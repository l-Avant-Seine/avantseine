<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lavantseine
 */



/*
 * Social Buttons Sharing
 */
if ( ! function_exists( 'get_event_dates' ) ) :
	function get_event_dates($event_first_date, $event_last_date, $event_other_dates = array()) {
		$event_dates = '';

//var_dump($event_other_dates);


		if( $event_other_dates[0] != '' ) {
			// Si plus de 2 jours 
			$event_dates .= 'Du ';
			$event_dates .= strftime('%e', $event_first_date );
			if( strcmp( strftime('%b', $event_first_date ), strftime('%b', $event_last_date ) ) ) {
				$event_dates .= strftime(' %B', $event_first_date );
			}
			if( strcmp( strftime('%G', $event_first_date ), strftime('%G', $event_last_date ) ) ) {
				$event_dates .= strftime(' %G', $event_first_date );
			}
			$event_dates .= ' au ';
			$event_dates .= strftime('%e %B %G', $event_last_date );
		}
		elseif( $event_first_date != $event_last_date ) {

			if( !strcmp( strftime('%A %e %b %G', $event_first_date ), strftime('%A %e %b %G', $event_last_date ) ) ) {
				// Si même date mais 2 horaires dans la journée
				$event_dates .= 'Le ';
				$event_dates .= strftime('%A %e %B %G', $event_first_date );
			}
			else {
				// Si 2 jours différents
				$event_dates .= 'Les ';
				$event_dates .= strftime('%e', $event_first_date );

				if( strcmp( strftime('%b', $event_first_date ), strftime('%b', $event_last_date ) ) ) {
					$event_dates .= strftime(' %B', $event_first_date );
				}

				if( strcmp( strftime('%G', $event_first_date ), strftime('%G', $event_last_date ) ) ) {
					$event_dates .= strftime(' %G', $event_first_date );
				}

				$event_dates .= ' et ';
				$event_dates .= strftime('%e %B %G', $event_last_date );
			}
		}
		else {
			// Si 1 seul représentation
			$event_dates .= strftime('%A %e %B %G - %kh%M', $event_first_date );
		}

		return $event_dates;
	}
endif;




/*
 * Social Buttons Sharing
 */
if ( ! function_exists( 'lavantseine_display_share_buttons' ) ) :
	function lavantseine_display_share_buttons() {
		echo '<a href="#" id="js-shareTrigger"><span class="icon-share"></span>Partager !</a>';
		echo '<div class="box-share-list">';
		echo '<ul class="inner no-bullets">';
		echo '<li><a class="twitter customer share" href="https://twitter.com/share?url='. get_the_permalink() .'&amp;hashtags=lavantseine" title="Twitter share" target="_blank">Twitter</a></li>';
		echo '<li><a class="facebook customer share" href="https://www.facebook.com/sharer.php?u='. get_the_permalink() .'" title="Partager sur Facebook" target="_blank">Facebook</a></li>';
		echo '</ul></div>';
	}
endif;




if ( ! function_exists( 'custom_taxonomy_dropdown' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
	function custom_taxonomy_dropdown( $taxonomy, $orderby = 'date', $order = 'DESC', $limit = '-1', $name, $show_option_all = null, $show_option_none = null  ) {

			$args = array(
				'orderby' 	=> $orderby,
				'order' 		=> $order,
				'number' 		=> $limit,
			);
			$terms = get_terms( $taxonomy, $args );
			$name = ( $name ) ? $name : $taxonomy;
			if ( $terms ) {
				printf( '<div class="c-select">' );
				printf( '<select name="%s" class="">', esc_attr( $name ) );
				if ( $show_option_all ) {
					printf( '<option value="0">%s</option>', esc_html( $show_option_all ) );
				}
				if ( $show_option_none ) {
					printf( '<option value="-1">%s</option>', esc_html( $show_option_none ) );
				}
				foreach ( $terms as $term ) {
					printf( '<option value="%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
				}
				print( '</select></div>' );
			}
	}
endif;


if ( ! function_exists( 'custom_taxonomy_list' ) ) :
/**
 * Display terms in list for filter or else
 *
 * @return void
 */
	function custom_taxonomy_list( $taxonomy, $orderby = 'date', $order = 'DESC', $limit = '-1', $name, $show_option_all = null ) {

			$args = array(
				'orderby' 	=> $orderby,
				'order' 		=> $order,
				'number' 		=> $limit,
				'hide_empty' => false,
			);

			$terms = get_terms( $taxonomy, $args ); 
			$name = ( $name ) ? $name : $taxonomy;
			
			if ( $show_option_all ) {
				printf( '<div class="c-radio">' );
				printf( '<input id="radio-%s" type="radio" value="0" name="radio-%s" checked><label for="radio-%s">%s</label>', esc_html( $taxonomy ), esc_html( $taxonomy ), esc_html( $taxonomy ), esc_html( $show_option_all ) );
				printf( '</div>' );

			}

			if ( $terms ) {
				foreach ( $terms as $term ) {
					printf( '<div class="c-radio">' );
					printf( '<input id="radio-%s" type="radio" value="%s" name="radio-%s"><label for="radio-%s">%s</label>', esc_attr( $term->slug ), esc_attr( $term->slug ), esc_attr( $taxonomy ), esc_html( $term->slug ), esc_html( $term->name ) );
					printf( '</div>' );
				}
			}

	}
endif;





if ( ! function_exists( 'lavantseine_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function lavantseine_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">

		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Eléments plus anciens', 'lavantseine' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Eléments plus récents <span class="meta-nav">&rarr;</span>', 'lavantseine' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;




if ( ! function_exists( 'lavantseine_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function lavantseine_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation clearfix post-navigation" role="navigation">
		<div class="nav-links">
			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'lavantseine' ) ); ?>
			<?php next_post_link(     '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'lavantseine' ) ); ?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;





if ( ! function_exists( 'lavantseine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function lavantseine_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	printf( __( '<span class="posted-on">Posted on %1$s</span><span class="byline"> by %2$s</span>', 'lavantseine' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;


