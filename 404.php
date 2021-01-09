<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Q_Blog_Starter
 */

get_header();
?>

	<main id="qs__blog__main__container" class="qs__blog__main__container qs__blog"><!-- Main Container Start -->
		<div class="qs__blog__inner__container"><!-- Inner Container Start -->
			<div class="container qs__blog__container"><!-- Inner Blog Container Start -->
				<div class="qs__error__404"><!-- ERROR 404 Start -->

					<div class="row"><!-- Inner Header Row -->
						<div class="col-xs-12"><!-- Inner Header Column -->

							<div class="qs__page__inner__header qs__404">
								<h3 class="qs__inner__header__title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'quomodo_starter_theme_prefix' ); ?></h3>
							</div>

							<div class="search__content"><!-- Search Content  -->
								<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'quomodo_starter_theme_prefix' ); ?></p>

								<a href="<?php echo esc_url( home_url('/') ) ?>"><?php echo esc_html__( 'Go Back Home', 'quomodo_starter_theme_prefix' ); ?></a>
							</div><!-- search-content End -->

						</div><!-- Inner Header Columns End -->
					</div><!-- Inner Header Row End-->

				</div><!-- ERROR 404 END -->

			</div><!-- Inner Blog Container End -->
		</div><!-- Inner Container End -->

	</main><!-- Main Container End -->

<?php
get_footer();
