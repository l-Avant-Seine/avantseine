<?php
/**
 * @package lavantseine
 */

$post_type = get_post_type(); 

switch ($post_type) {
	case 'event':
		$type = 'événement';
		break;

	case 'post':
		$type = 'Article';
		break;

	case 'page':
		$type = 'Page d\'information';
		break;

	default:
		$type = ' ';
		break;
}
?>


<article <?php post_class(); ?>>


			<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php echo $type; ?>

				<h2 class="entry-title">	
						<?php the_title(); ?>
				</h2>
			</a>

</article><!-- #post-## -->
