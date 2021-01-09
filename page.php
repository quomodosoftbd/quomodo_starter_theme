<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Q_Blog_Starter
 */

get_header(); ?>

<main id="qs__blog__main__container" class="qs__blog__main__container qs__single__page"> <!-- Main Container Start -->
	<div class="qs__blog__inner__container"> <!-- Inner Container Start -->
		<div class="container qs__blog__container"> <!-- Inner Blog Container Start -->
			<div class="row"> <!-- Main Row Start -->
				<div class="col-12"> <!-- Content Column Start -->
					<div class="qs__page__content">
						<?php
							while ( have_posts() ) :
								
								the_post();

								get_template_part( 'template-parts/content', 'page' );

								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; // End of the loop.
						?>
					</div>
				</div> <!-- Content Column End -->
			</div> <!-- Main Row End -->
		</div> <!-- Inner Blog Container End -->
	</div> <!-- Inner Container End -->
</main> <!-- Main Container End -->

<?php
get_footer();
