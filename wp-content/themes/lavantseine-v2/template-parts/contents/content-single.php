<?php
/**
 * @package lavantseine
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="wrap entry-media">
		<?php
			$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
			$postDetail_showPic = get_post_meta( $post->ID, 'postDetail_showPic', true );
			
			get_template_part( 'part', 'postslide' );

			if ( !$postDetail_showPic ) {
				the_post_thumbnail(''); 
			}
			if ( $postDetail_mediaMarkup ) {
				echo $postDetail_mediaMarkup;
			}
		?>
	</div>

	<header class="wrap entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="wrap entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lavantseine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="wrap entry-meta">
		<?php the_date('d/m/Y', '<span class="date-main">Publié le ', '</span>'); ?>

		<div class="">
			<?php
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="saisoned-on-color">#'.$category->cat_name.'</a>'.$separator;
					}
				echo trim($output, $separator);
				}
			?>
		</div><!-- .post-categories -->

		<div class="share-buttons">
			<?php // lavantseine_display_share_buttons(); ?>
		</div><!-- .post-social -->

	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
