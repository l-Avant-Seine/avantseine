<?php
/**
 * @package lavantseine
 */

			$postDetail_mediaMarkup = get_post_meta( $post->ID, 'postDetail_mediaMarkup', true );
			$postDetail_showPic = get_post_meta( $post->ID, 'postDetail_showPic', true );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="single-header bg_cover is-flex" style="background-image: url(<?php  the_post_thumbnail_url(''); ?>);">

		<div class="wrap single-title offset-right">
			<h1 class="h1 clearfix"><?php the_title(); ?></h1>
			<div class="meta-date clearfix">Publié le <?php the_date('d/m/Y', '', ''); ?></div>
			<div class="single-share clearfix">
			<?php lavantseine_display_share_buttons(); ?>
			</div>
		</div>

	</header>

	<div class="wrap single-metas">
			<?php
				$categories = get_the_category();
				$separator = ' ';
				$output = '';
				if($categories){
					foreach($categories as $category) {
						$output .= '<a href="'.get_category_link( $category->term_id ).'" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $category->name ) ) . '" class="postmeta-term">'.$category->cat_name.'</a>'.$separator;
					}
				echo trim($output, $separator);
				}
			?>
	</div><!-- .single-metas -->


	<div class="wrap single-content row">
		<div class="m-5col entry-content ">

			<?php

				get_template_part( 'part', 'postslide' );

				if ( $postDetail_mediaMarkup ) {
					echo $postDetail_mediaMarkup;
				}
			?>

			<?php the_content(); ?>
		</div>


			<div class="m-3col single-aside offset-right">
					<?php set_query_var('taxo', 'relational_tag'); ?>
					<?php get_template_part( 'template-parts/modules/module', 'relatedevent' ); ?>
			</div>


		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'lavantseine' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
