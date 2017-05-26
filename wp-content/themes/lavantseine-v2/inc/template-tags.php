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
if ( ! function_exists( 'lavantseine_display_share_buttons' ) ) :
	function lavantseine_display_share_buttons() {
		echo '<div class="one-button fb-share-button" data-type="button_count"></div>';
		echo '<a href="https://twitter.com/share" class="one-button twitter-share-button" data-lang="fr">Tweeter</a>';
		echo '<div class="one-button g-plusone"></div>';
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
				printf( '<select name="%s" class="postform">', esc_attr( $name ) );
				if ( $show_option_all ) {
					printf( '<option value="0">%s</option>', esc_html( $show_option_all ) );
				}
				if ( $show_option_none ) {
					printf( '<option value="-1">%s</option>', esc_html( $show_option_none ) );
				}
				foreach ( $terms as $term ) {
					printf( '<option value="%s">%s</option>', esc_attr( $term->slug ), esc_html( $term->name ) );
				}
				print( '</select>' );
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
				printf( '<input type="radio" value="0" name="%s" checked><label for="">%s</label>', esc_html( $taxonomy ), esc_html( $show_option_all ) );
			}

			if ( $terms ) {
				foreach ( $terms as $term ) {
					printf( '<input type="radio" value="%s" name="%s"><label for="">%s</label>', esc_attr( $term->slug ), esc_html( $taxonomy ), esc_html( $term->name ) );
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
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'lavantseine' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'lavantseine' ) ); ?>
			<?php next_post_link(     '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'lavantseine' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'lavantseine_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function lavantseine_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'lavantseine' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'lavantseine' ), '<span class="edit-link">', '</span>' ); ?>
		</div>

	<?php else : ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
		<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php if ( 0 != $args['avatar_size'] ) { echo get_avatar( $comment, $args['avatar_size'] ); } ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'lavantseine' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author -->

				<div class="comment-metadata">
					<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
						<time datetime="<?php comment_time( 'c' ); ?>">
							<?php printf( _x( '%1$s at %2$s', '1: date, 2: time', 'lavantseine' ), get_comment_date(), get_comment_time() ); ?>
						</time>
					</a>
					<?php edit_comment_link( __( 'Edit', 'lavantseine' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .comment-metadata -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'lavantseine' ); ?></p>
				<?php endif; ?>
			</footer><!-- .comment-meta -->

			<div class="comment-content">
				<?php comment_text(); ?>
			</div><!-- .comment-content -->

			<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
			?>
		</article><!-- .comment-body -->

	<?php
	endif;
}
endif; // ends check for lavantseine_comment()

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


