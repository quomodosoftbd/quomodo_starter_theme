<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_Blog_Starter
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div class="qs__blog__comments__container"> <!-- Comments Container Start -->

	<div id="qs__blog__comments" class="qs__blog__comments__area"> <!-- Comments Area Start -->

		<?php if ( have_comments() ) : // Check for have_comments(). ?>
			<div class="qs__blog__comments__header"><!-- Comments Header -->
				<h3 class="qs__blog__comments__title">
					<?php
						$quomodo_starter_theme_prefix_comment_count = get_comments_number();
						if ( '1' === $quomodo_starter_theme_prefix_comment_count ) {
							printf(
								esc_html__( 'One thought on &ldquo;%1$s&rdquo;', 'quomodo_starter_theme_prefix' ),
								'<span>' . wp_kses_post( get_the_title() ) . '</span>'
							);
						} else {
							printf(
								esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $quomodo_starter_theme_prefix_comment_count, 'comments title', 'quomodo_starter_theme_prefix' ) ),
								number_format_i18n( $quomodo_starter_theme_prefix_comment_count ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
								'<span>' . wp_kses_post( get_the_title() ) . '</span>'
							);
						}
					?>
				</h3>
			</div><!-- Comments Header End -->
			
			<div class="qs__blog__comments__pagination">
				<?php the_comments_navigation(); ?>
			</div>

			<div class="qs__blog__comments__lists__area"><!-- Comments list Area Start -->
				<div class="qs__blog__comments__list"><!-- Comments list Start -->
					<?php
						wp_list_comments(
							array(
								'style'      => 'div',
								'short_ping' => true,
								'walker'     => new quomodo_starter_theme_prefix_Custom_Walker_Comment(),
							)
						);
					?>
				</div><!-- Comments list End -->
			</div><!-- Comments list Area End -->

			<div class="qs__blog__comments__pagination">
				<?php the_comments_navigation(); ?>
			</div>
			
			<div class="qs__blog__colse__comment">
				<?php if ( ! comments_open() ) : ?>
					<p class="qs__block__no__comments__msg"><?php esc_html_e( 'Comments are closed.', 'quomodo_starter_theme_prefix' ); ?></p>
				<?php endif; ?>
			</div>

		<?php endif; // Check for have_comments(). ?>

		<div class="qs__blog__comment__form">
		  <?php quomodo_starter_theme_prefix_comment_form() ?>
		</div>
		
	</div> <!-- Comments Area Start -->
</div> <!-- Comments Container Start -->