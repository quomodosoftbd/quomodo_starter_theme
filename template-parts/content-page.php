<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_Blog_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="qs__page__inner__content">
		<?php
			the_content();

			wp_link_pages(
				array(
					'before' => '<div class="qs__link__pages">' . esc_html__( 'Pages:', 'quomodo_starter_theme_prefix' ),
					'after'  => '</div>',
				)
			);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() && is_single() ) : ?>
		<div class="qs__blog__page__edit__area">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'quomodo_starter_theme_prefix' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						wp_kses_post( get_the_title() )
					),
					'<span class="qs__page__edit__link">',
					'</span>'
				);
			?>
		</div><!-- .qs__blog__page__edit__link -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
