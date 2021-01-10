<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Q_Blog_Starter
 */

?>

	<footer class="qs__blog__footer__area"><!-- Footer Area Start -->

		<div class="qs__blog__default__footer"><!-- Default Footer Area -->

			<?php if ( is_active_sidebar( 'footer_sidebar_1' ) || is_active_sidebar( 'footer_sidebar_2' ) || is_active_sidebar( 'footer_sidebar_3' ) || is_active_sidebar( 'footer_sidebar_4' ) ) : ?>
			<div class="qs__blog__footer__top__area qs__blog__footer__widget__area"><!-- Footer Widget Area -->
				<div class="container"><!-- Container -->
					<div class="row"><!-- Row -->

						<?php if( is_active_sidebar( 'footer_sidebar_1' ) ) : ?>
						<div class="col-md-6 col-lg-3">
							<div class="qs__blog__single__footer">
								<?php dynamic_sidebar( 'footer_sidebar_1' ); ?>
							</div>
						</div>
						<?php endif; ?>

						<?php if( is_active_sidebar( 'footer_sidebar_2' ) ) : ?>
						<div class="col-md-6 col-lg-3">
							<div class="qs__blog__single__footer">
								<?php dynamic_sidebar( 'footer_sidebar_2' ); ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if( is_active_sidebar( 'footer_sidebar_3' ) ) : ?>
						<div class="col-md-6 col-lg-3">
							<div class="qs__blog__single__footer">
								<?php dynamic_sidebar( 'footer_sidebar_3' ); ?>
							</div>
						</div>
						<?php endif; ?>
						
						<?php if( is_active_sidebar( 'footer_sidebar_4' ) ) : ?>
						<div class="col-md-6 col-lg-3">
							<div class="qs__blog__single__footer">
								<?php dynamic_sidebar( 'footer_sidebar_4' ); ?>
							</div>
						</div>
						<?php endif; ?>

					</div><!-- Row End -->
				</div><!-- Container End -->
			</div><!-- Footer Widget Area End -->
			<?php endif; ?>


			<div class="qs__blog__footer__bottom__area qs__blog__footer__copyright__area"><!-- Footer Copyright Area -->
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="qs__blog__footer__copyright">
								<p>Copyright &copy; 2020 Quomodosoft All Rights Reserved.</p>
							</div>
						</div>
					</div>
				</div>
			</div><!-- Footer Copyright Area End-->
			
		</div><!-- Default Footer Area End-->

	</footer><!-- Footer Area Start End -->

<?php wp_footer(); ?>

</body>
</html>
