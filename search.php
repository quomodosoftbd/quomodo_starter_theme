<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Q_Blog_Starter
 */

get_header();
?>

	<main id="qs__blog__main__container" class="qs__blog__main__container qs__blog"><!-- Main Container Start -->
		<div class="qs__blog__inner__container"><!-- Inner Container Start -->
			<div class="container qs__blog__container"><!-- Inner Blog Container Start -->

				<div class="row"><!-- Inner Header Row -->
					<div class="col-xs-12"><!-- Inner Header Column -->
						<div class="qs__page__inner__header qs__search"><!-- Inner Header -->
							<h3 class="qs__inner__header__title">
								<?php
									/* translators: %s: search query. */
									printf( esc_html__( 'Search Results for: %s', 'quomodo_starter_theme_prefix' ), '<span>' . get_search_query() . '</span>' );
								?>
							</h3>
						</div><!-- Inner Header End -->
					</div><!-- Inner Header Columns End -->
				</div><!-- Inner Header Row End-->

				<div class="row"><!-- Main Row Start -->

					<div class="col-8 qs__blog__archives"><!-- Content Column Start -->
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


					<div class="col-4 qs__blog__sidebar"><!-- Widget Column Start -->
						<aside class="qs__blog__widget__area">
							<?php get_sidebar(); ?>
						</aside>
					</div><!-- Widget Column End -->

				</div><!-- Main Row End -->
			</div><!-- Inner Blog Container End -->
		</div><!-- Inner Container End -->

	</main><!-- Main Container End -->

<?php
get_sidebar();