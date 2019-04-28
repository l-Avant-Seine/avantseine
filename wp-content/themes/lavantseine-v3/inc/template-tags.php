<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package lavantseine
 */


function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}



function html_tag_schema()
{
    $schema = 'http://schema.org/';

    // Is of book post type
    if(is_singular('event'))
    {
        $type = 'Event';
    }
    // Is single post
    elseif(is_single())
    {
        $type = "Article";
    }
    // Is author page
    elseif( is_author() )
    {
        $type = 'ProfilePage';
    }
    // Is search results page
    elseif( is_search() )
    {
        $type = 'SearchResultsPage';
    }
    else
    {
        $type = 'WebPage';
    }

    echo 'itemscope="itemscope" itemtype="' . $schema . $type . '"';
}



/*
 * Display event date from start to end
 */
if ( ! function_exists( 'get_event_dates' ) ) :
	function get_event_dates($event_first_date, $event_last_date, $event_other_dates = array(), $exhibition = false) {
		$event_dates = '';
		$date_label_opentag ='<span class="label_2">';
		$date_label_closetag ='</span>';

		if( $exhibition ) {
				$event_dates .= $date_label_opentag .'Du ' . $date_label_closetag;

				if( !strcmp( strftime('%G', $event_first_date ), strftime('%G', $event_last_date ) ) ) {
					$event_dates .= strftime('%e.%m', $event_first_date );
				}
				else {
					$event_dates .= strftime('%e.%m.%G', $event_first_date );
				}
				$event_dates .= $date_label_opentag .' au ' . $date_label_closetag;
				$event_dates .= strftime('%e.%m.%G', $event_last_date );
		}
		else {

			// Si 2 dates
			if( $event_other_dates[0] != '' &&  $event_first_date != $event_last_date ) {

				if( !strcmp( strftime('%A %e %b %G', $event_first_date ), strftime('%A %e %b %G', $event_last_date ) ) ) {

					// Si même date mais plusieurs horaires dans la journée
					$event_dates .= $date_label_opentag . strftime('%A') . $date_label_closetag;
					$event_dates .= strftime('%e.%m.%G', $event_first_date );

				}
				else {

					// Si plus de 2 jours 
					$event_dates .= $date_label_opentag .'Du ' . $date_label_closetag;
					$event_dates .= strftime('%e', $event_first_date );

					if( strcmp( strftime('%b', $event_first_date ), strftime('%b', $event_last_date ) ) ) {
						$event_dates .= strftime('.%m', $event_first_date );
					}

					if( strcmp( strftime('%G', $event_first_date ), strftime('%G', $event_last_date ) ) ) {
						$event_dates .= strftime(' %G', $event_first_date );
					}
					
					$event_dates .= $date_label_opentag .' au ' . $date_label_closetag;
					$event_dates .= strftime('%e.%m.%G', $event_last_date );

				}

			}
			// Si plus de 2 dates
			elseif( $event_first_date != $event_last_date ) {

					$event_dates .=  $date_label_opentag .'Le '. $date_label_closetag;
					$event_dates .= strftime('%e', $event_first_date );

					if( strcmp( strftime('%b', $event_first_date ), strftime('%b', $event_last_date ) ) ) {
						$event_dates .= strftime('.%m', $event_first_date );
					}

					if( strcmp( strftime('%G', $event_first_date ), strftime('%G', $event_last_date ) ) ) {
						$event_dates .= strftime(' %G', $event_first_date );
					}

					$event_dates .= $date_label_opentag .' et '. $date_label_closetag;
					$event_dates .= strftime('%e.%m.%G', $event_last_date );

			}
			// si 1 seule date
			else {
				$event_dates .= $date_label_opentag . strftime('%A ') . $date_label_closetag;
				$event_dates .= strftime('%e.%m.%G', $event_first_date );
				$event_dates .= $date_label_opentag . ' à ' . $date_label_closetag;
				$event_dates .= strftime('%kh%M', $event_first_date );
			}
		}

		return $event_dates;
	}
endif;




/*
 * Social Buttons Sharing
 */
if ( ! function_exists( 'lavantseine_display_share_buttons' ) ) :
	function lavantseine_display_share_buttons() {
		echo '<a href="#" id="js-shareTrigger" class="btn-primary">Partager !</a>';
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
				printf( '<div class="cf c-select filter-item"><div class="hide-overflow">' );
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
				
				print( '</select></div></div>' );
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
	var_dump( $GLOBALS['wp_query']->max_num_pages );
	
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation" role="navigation">

		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'articles plus anciens', 'lavantseine' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'articles plus récents', 'lavantseine' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;


add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="btn-primary"';
}



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


