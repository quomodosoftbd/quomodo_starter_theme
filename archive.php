<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_Blog_Starter
 */

get_header();
?>

<main id="qs__blog__main__container" class="qs__blog__main__container qs__blog">
		<div class="qs__blog__inner__container">
			<div class="container qs__blog__container">
				<div class="row">


					<!-- <div class="col-4 qs__blog__sidebar">
						<aside class="qs__blog__widget__area">
							<?php get_sidebar(); ?>
						</aside>
					</div> -->


					<div class="col-8 qs__blog__archives">
						<div class="qs__blog__content">
							<?php
								if ( have_posts() ) :

									/* Start the Loop */
									while ( have_posts() ) :
										the_post();

										/*
										* Include the Post-Type-specific template for the content.
										* If you want to override this in a child theme, then include a file
										* called content-___.php (where ___ is the Post Type name) and that will be used instead.
										*/
										get_template_part( 'template-parts/content', get_post_type() );

									endwhile;

									the_posts_navigation();

								else :

									get_template_part( 'template-parts/content', 'none' );

								endif;
							?>
						</div>
						<div class="qs__blog__posts__pagination">

						</div>

					</div>


					<div class="col-4 qs__blog__sidebar">
						<aside class="qs__blog__widget__area">
							<?php get_sidebar(); ?>
						</aside>
					</div>

				</div>
			</div>
		</div>

	</main><!-- #main -->
<?php
get_footer();
