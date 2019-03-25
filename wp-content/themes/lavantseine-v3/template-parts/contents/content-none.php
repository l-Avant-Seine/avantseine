<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package l\'Avant-Seine_v2.0
 */

?>

<section class="no-results not-found">


	<header class="prog-pagetitle is-flex layer">
		<div class="wrap page-title" itemprop="name">
			<h1 class="h1"><?php esc_html_e( 'Aucun résulat...', 'lavantseine-v2' ); ?></h1>
		</div>
	</header><!-- .entry-header -->



	<div class="page-content wrap">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lavantseine-v2' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Désolé, il n\'y aucun résultat pour la recherche demandée. Merci d\'essayer un autre terme.', 'lavantseine-v2' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lavantseine-v2' ); ?></p>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
