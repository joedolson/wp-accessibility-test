<?php
if ( ! function_exists( 'jcd_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function jcd_setup() {
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

		// This theme uses wp_nav_menu() in three location.
		register_nav_menus(
			array(
				'primary' => __( 'Main Menu', 'wp-accessibility-test' ),
				'footer'  => __( 'Footer', 'wp-accessibility-test' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'navigation-widgets',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Responsive embeds.
		 */
		add_theme_support( 'responsive-embeds' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 150,
			'width'       => 300,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'jcd_setup' );

/* load theme functions */
add_action( 'widgets_init', 'register_widgets' );
function register_widgets() {
	register_sidebar( array(
		'name'=>'Sidebar',
		'id' => 'sidebar',
		'before_widget' => '<div class="site-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	));
}

/**
 * Enqueue site scripts.
 */
function jcd_enqueue_scripts() {
	$css_ver = gmdate( 'ymd-Gis', filemtime( get_stylesheet_directory() . '/style.css' ) );
	$js_ver  = gmdate( 'ymd-Gis', filemtime( get_stylesheet_directory() . '/js/toc.js' ) );

	wp_enqueue_script( 'universal.toc', get_template_directory_uri() . '/js/toc.js', array(), $js_ver );
	wp_enqueue_style( 'jcd-fonts', 'https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Atkinson+Hyperlegible:ital,wght@0,400;0,700;1,400;1,700&display=swap' );
	wp_enqueue_style( 'jcd-style', get_stylesheet_uri(), array( 'jcd-fonts', 'dashicons' ), $css_ver );
}
add_action( 'wp_enqueue_scripts', 'jcd_enqueue_scripts' );
