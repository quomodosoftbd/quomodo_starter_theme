<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_Blog_Starter
 */

?>

<section class="no-results not-found">
	<div class="qs__page__inner__header">
		<h3 class="qs__inner__header__title"><?php esc_html_e( 'Nothing Found', 'quomodo_starter_theme_prefix' ); ?></h3>
	</div><!-- .qs__page__inner__header -->

	<div class="qs__error__page__content">
		<?php
			if ( is_home() && current_user_can( 'publish_posts' ) ) :

				printf(
					'<p>' . wp_kses(
						/* translators: 1: link to WP admin new post page. */
						esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'quomodo_starter_theme_prefix' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					) . '</p>',
					esc_url( admin_url( 'post-new.php' ) )
				);

			elseif ( is_search() ) :
				?>

				<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'quomodo_starter_theme_prefix' ); ?></p>
				<?php
				get_search_form();

			else :
				?>

				<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'quomodo_starter_theme_prefix' ); ?></p>
				<?php
				get_search_form();

			endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
