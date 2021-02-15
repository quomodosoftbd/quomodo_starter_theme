<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Q_Blog_Starter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="<?php echo esc_url('//gmpg.org/xfn/11'); ?>">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

	<header class="qs__blog__header__area"><!-- Header Area Start -->

		<div class="qs__blog__header__topbar__area"><!-- Topbar Area Start -->
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-lg-4 col-sm-12">
					
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
					
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
					
					</div>
				</div>
			</div>
		</div><!-- Topbar Area End -->
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container">

				<div class="site-branding navbar-brand">
					<?php the_custom_logo(); ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php endif; ?>
				</div><!-- .site-branding -->
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">

					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
						<li class="nav-item"><a class="nav-link active" aria-current="page" href="#">Home</a></li>
						<li class="nav-item"><a class="nav-link" href="#">Link</a></li>
						<li class="nav-item"><a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a></li>
					</ul>



					<form class="d-flex">
						<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success" type="submit">Search</button>
					</form>

				</div>
			</div>
		</nav>
		<div class="qs__blog__header__navigation__area"><!-- Main Navigation Area Start -->
			<div class="qs__header__mainmenu__area">
				<div class="container">
					<div class="row">

						<div class="col-md-4">
						</div>

						<div class="col-md-8">

							<nav id="site-navigation" class="main-navigation">
								<button class="menu-toggle" aria-controls="qs__blog__main__container-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'quomodo_starter_theme_prefix' ); ?></button>
		
							</nav>

						</div>

					</div>
				</div>
			</div>
		</div><!-- Main Navigation Area End -->

	</header><!-- Header Area End -->