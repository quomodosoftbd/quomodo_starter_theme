<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_Blog_Starter
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="qs__post__inner__content">

		<?php //if( has_post_thumbnail() ) : ?>
		<div class="qs__post__media">
			<?php quomodo_starter_theme_prefix_post_thumbnail(); ?>
		</div>
		<?php //endif; ?>

		<div class="qs__post__content__area">

			<div class="qs__post__meta">
				<?php if ( 'post' === get_post_type() ) : ?>
					<?php
						quomodo_starter_theme_prefix_single_category_retrip();
						quomodo_starter_theme_prefix_comment_count();
						quomodo_starter_theme_prefix_posted_date();
						quomodo_starter_theme_prefix_posted_by();
					?>
				<?php endif; ?>
			</div>

			<div class="qs__post__header">
				<?php
					if ( is_singular() ) :
						the_title( '<h3 class="qs__post__title">', '</h3>' );
					else :
						the_title( '<h3 class="qs__post__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
					endif;
				?>
			</div>

			<div class="qs__post__details">
				<?php

					if( is_single() ) :
						the_content();
					else:
						the_excerpt();
					endif;

					wp_link_pages(
						array(
							'before' => '<div class="qs__link__pages">' . esc_html__( 'Pages:', 'quomodo_starter_theme_prefix' ),
							'after'  => '</div>',
						)
					);
				?>
			</div>

			<div class="qs__post__footer">
				<?php quomodo_starter_theme_prefix_entry_footer(); ?>
			</div>

		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
