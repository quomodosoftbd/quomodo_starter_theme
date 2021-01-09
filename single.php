<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Q_Blog_Starter
 */

get_header(); ?>

	<main id="qs__blog__main__container" class="qs__blog__main__container qs__single__post"> <!-- Main Container Start -->
		<div class="qs__blog__inner__container"> <!-- Inner Container Start -->
			<div class="container qs__blog__container"> <!-- Inner Blog Container Start -->

				<div class="row"> <!-- Main Row Start -->

					<div class="col-8 qs__blog__post"> <!-- Content Column Start -->
						<div class="qs__post__content">
							<?php
								while ( have_posts() ) :
									the_post();

									get_template_part( 'template-parts/content', get_post_type() );
									?>
									
									<div class="qs__blog__posts__navigation">
										<?php
											the_post_navigation(
												array(
													'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'quomodo_starter_theme_prefix' ) . '</span> <span class="nav-title">%title</span>',
													'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'quomodo_starter_theme_prefix' ) . '</span> <span class="nav-title">%title</span>',
												)
											);
										?>
									</div>

									<?php

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
							?>
						</div>						
					</div> <!-- Content Column End -->

					<div class="col-4 qs__blog__sidebar"> <!-- Widget Column Start -->
						<aside class="qs__blog__widget__area">
							<?php get_sidebar(); ?>
						</aside>
					</div> <!-- Widget Column End -->

				</div> <!-- Main Row End -->
			</div> <!-- Inner Blog Container End -->
		</div> <!-- Inner Container End -->

	</main> <!-- Main Container End -->

<?php
get_footer();
