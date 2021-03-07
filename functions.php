<?php
/**
 * Q_Blog Starter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Q_Blog_Starter
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'quomodo_starter_theme_prefix_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function quomodo_starter_theme_prefix_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Q_Blog Starter, use a find and replace
		 * to change 'quomodo_starter_theme_prefix' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'quomodo_starter_theme_prefix', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary_menu' => esc_html__( 'Primary', 'quomodo_starter_theme_prefix' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'quomodo_starter_theme_prefix_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'               => 250,
				'width'                => 250,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'quomodo_starter_theme_prefix_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quomodo_starter_theme_prefix_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'quomodo_starter_theme_prefix_content_width', 640 );
}
add_action( 'after_setup_theme', 'quomodo_starter_theme_prefix_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quomodo_starter_theme_prefix_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Main Sidebar', 'quomodo_starter_theme_prefix' ),
			'id'            => 'main_sidebar',
			'description'   => esc_html__( 'Add blog posts widgets here.', 'quomodo_starter_theme_prefix' ),
			'before_widget' => '<div id="%1$s" class="qs__blog__widget qs__blog__single__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="qs__blog__widget__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 1', 'quomodo_starter_theme_prefix' ),
			'id'            => 'footer_sidebar_1',
			'description'   => esc_html__( 'Add footer widgets here.', 'quomodo_starter_theme_prefix' ),
			'before_widget' => '<div id="%1$s" class="qs__blog__widget qs__blog__single__footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="qs__blog__widget__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 2', 'quomodo_starter_theme_prefix' ),
			'id'            => 'footer_sidebar_2',
			'description'   => esc_html__( 'Add footer widgets here.', 'quomodo_starter_theme_prefix' ),
			'before_widget' => '<div id="%1$s" class="qs__blog__widget qs__blog__single__footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="qs__blog__widget__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 3', 'quomodo_starter_theme_prefix' ),
			'id'            => 'footer_sidebar_3',
			'description'   => esc_html__( 'Add footer widgets here.', 'quomodo_starter_theme_prefix' ),
			'before_widget' => '<div id="%1$s" class="qs__blog__widget qs__blog__single__footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="qs__blog__widget__title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Sidebar 4', 'quomodo_starter_theme_prefix' ),
			'id'            => 'footer_sidebar_4',
			'description'   => esc_html__( 'Add footer widgets here.', 'quomodo_starter_theme_prefix' ),
			'before_widget' => '<div id="%1$s" class="qs__blog__widget qs__blog__single__footer__widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="qs__blog__widget__title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'quomodo_starter_theme_prefix_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function quomodo_starter_theme_prefix_scripts() {
	wp_enqueue_style( 'beicons', get_theme_file_uri('/assets/css/beicons.css'), array(), '1.0.0' );
	wp_enqueue_style( 'fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css', array(), '5.0.0' );
	wp_enqueue_style( 'bootstrap', '//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css', array(), '5.0.0' );
	wp_enqueue_style( 'quomodo_starter_theme_prefix-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_enqueue_style( 'quomodo_starter_theme_prefix-default', get_theme_file_uri('/assets/css/default.css'), array(), _S_VERSION );
	wp_enqueue_style( 'quomodo_starter_theme_prefix-blog', get_theme_file_uri('/assets/css/blog.css'), array(), _S_VERSION );
	wp_style_add_data( 'quomodo_starter_theme_prefix-style', 'rtl', 'replace' );

	wp_enqueue_script( 'quomodo_starter_theme_prefix-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quomodo_starter_theme_prefix_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom Comments Walker for this theme.
 */
require get_theme_file_path('/inc/Comments_Walker.php');

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}
