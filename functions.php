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
				'primary' => __( 'Main Menu', 'joedolson' ),
				'footer'  => __( 'Footer', 'joedolson' ),
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

// redirect to post if only one result
add_action('template_redirect', 'jd_redirect_single_post');
function jd_redirect_single_post() {
	if (is_search()) {
		global $wp_query;
		if ( $wp_query->post_count == 1 ) {
			wp_safe_redirect( get_permalink( $wp_query->posts['0']->ID ) );
			exit;
		}
	}
}

add_filter('pre_get_posts', 'mod_posts_search');
// change number of posts to show on search
function mod_posts_search() {
	if ( is_search() ) {
		set_query_var( 'posts_per_archive_page', 20 ); 
	}
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

function audit_get_criteria() {
	$criteria = get_field( 'wcag_criteria' );
	$wcag     = '';
	if ( is_array( $criteria ) ) {
		foreach ( $criteria as $crit ) {
			$post_title = get_the_title( $crit );
			$link       = get_permalink( $crit );
			$wcag .= '<li><a href="' . esc_url( $link ) . '">' . esc_html( $post_title ) . '</a></li>';
		}
	}
	echo ( $wcag ) ? '<h2>WCAG Criteria</h2><ul>' . $wcag . '</ul>' : '';
}

function wcag_get_issues() {
	$issues = get_field( 'related_issues' );
	$list   = '';
	if ( is_array( $issues ) ) {
		foreach ( $issues as $issue ) {
			$post_title = get_the_title( $issue );
			$link       = get_permalink( $issue );
			$list      .= '<li><a href="' . esc_url( $link ) . '">' . esc_html( $post_title ) . '</a></li>';
		}
	}
	echo ( $list ) ? '<h2>Related Issues</h2><ul>' . $list . '</ul>' : '';
}

function issue_resolution() {
	$resolution = get_field( 'resolved' );
	$resolution = ( isset( $resolution[0] ) ) ? 'true' : 'false';
	if ( 'true' === $resolution ) {
		
	}
	$output = '<p><input type="checkbox" id="resolve_issue" data-post_id="' . get_the_id() . '" value="true" name="resolve_issue" ' . checked( $resolution, 'true', false ) . ' /> <label for="resolve_issue">Resolved</label></p>';

	echo $output;
}

function show_resolution() {
	$resolution = get_field( 'resolved' );
	$resolution = ( isset( $resolution[0] ) ) ? 'true' : 'false';
	if ( 'true' === $resolution ) {
		echo '<span class="resolved-issue"><span class="dashicons dashicons-yes" aria-hidden="true"></span> Resolved</span>';
	}
}


add_action( 'wp_ajax_set_resolution', 'set_resolution' );
add_action( 'wp_ajax_nopriv_set_resolution', 'set_resolution' );
/**
 * Submits a discount check
 */
function set_resolution() {
	// verify nonce.
	if ( ! check_ajax_referer( 'set-resolution-nonce', 'security', false ) ) {
		echo 0;
		die;
	}
	if ( 'set_resolution' === $_REQUEST['action'] ) {
		$resolution = ( 'true' === $_REQUEST['resolution'] ) ? true : false;
		$post_id    = (int) $_REQUEST['post_id'];
		if ( $post_id ) {
			if ( $resolution ) {
				update_field( 'resolved', 'true', $post_id );
				$response = true;
			} else {
				delete_field( 'resolved', $post_id );
				$response = false;
			}
		}
		wp_send_json( $response );
	}
}

add_action( 'wp_enqueue_scripts', 'set_resolution_scripts' );
/**
 * Enqueue public-facing scripts and styles. Localize scripts.
 */
function set_resolution_scripts() {
	$version = '1.0.0';
	if ( SCRIPT_DEBUG ) {
		$version .= '-' . wp_rand( 10000, 99999 );
	}

	wp_enqueue_script( 'resolution', get_template_directory_uri() . '/js/resolution.js', array( 'jquery', 'wp-a11y' ), $version );
	wp_localize_script(
		'resolution',
		'set',
		array(
			'action'   => 'set_resolution',
			'url'      => admin_url( 'admin-ajax.php' ),
			'security' => wp_create_nonce( 'set-resolution-nonce' ),
		)
	);
}

add_shortcode( 'resolved', 'get_resolved_issues' );
function get_resolved_issues() {
	$args   = array(
		'post_type'   => 'post',
		'numberposts' => -1,
		'fields'      => 'ids',
		'post_status' => 'publish',
		'meta_query'  => array(
			array(
				'key'     => 'resolved',
				'compare' => '=',
				'value'   => 'true',
			),
		),
	);
	$posts = get_posts( $args );
	$list  = [];
	foreach ( $posts as $issue ) {
		$post_title   = get_the_title( $issue );
		$link         = get_permalink( $issue );
		$key          = sanitize_title( $post_title ) . '-' . wp_rand( 1000, 9999 );
		$list[ $key ] = '<li><a href="' . esc_url( $link ) . '">' . esc_html( $post_title ) . '</a></li>';

	}
	ksort( $list );

	return ( ! empty( $list ) ) ? '<ul>' . implode( PHP_EOL, $list ) . '</ul>' : 'No resolved issues.';
}

add_shortcode( 'unresolved', 'get_unresolved_issues' );
function get_unresolved_issues() {
	$args   = array(
		'post_type'   => 'post',
		'numberposts' => -1,
		'fields'      => 'ids',
		'post_status' => 'publish',
		'meta_query'  => array(
			'relation' => 'OR',
			array(
				'key'     => 'resolved',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key'     => 'resolved',
				'compare' => '=',
				'value'   => 'false',
			),
			array(
				'key'     => 'resolved',
				'compare' => '=',
				'value'   => '',
			),
		),
	);
	$posts = get_posts( $args );
	$list  = [];
	foreach ( $posts as $issue ) {
		$post_title   = get_the_title( $issue );
		$link         = get_permalink( $issue );
		$key          = sanitize_title( $post_title ) . '-' . wp_rand( 1000, 9999 );
		$list[ $key ] = '<li><a href="' . esc_url( $link ) . '">' . esc_html( $post_title ) . '</a></li>';
	}
	ksort( $list );

	return ( ! empty( $list ) ) ? '<ul>' . implode( PHP_EOL, $list ) . '</ul>' : 'No unresolved issues.';
}

add_action( 'pre_get_posts', 'sort_issues' );
function sort_issues( $query ) {
	if ( ! is_admin() ) {
		$query->set( 'orderby', 'title' );
		$query->set( 'order', 'ASC' );
	}
}


add_shortcode( 'wcag', 'get_wcag' );
function get_wcag() {
	$args   = array(
		'post_type'   => 'wcag',
		'numberposts' => -1,
		'fields'      => 'ids',
		'post_status' => 'publish',
	);
	$posts = get_posts( $args );
	$list  = [];
	foreach ( $posts as $issue ) {
		$post_title   = get_the_title( $issue );
		$link         = get_permalink( $issue );
		$issues       = get_field( 'related_issues', $issue );
		$count        = ( is_array( $issues ) ) ? count( $issues ) : 0;
		$key          = sanitize_title( $post_title ) . '-' . wp_rand( 1000, 9999 );
		if ( $count ) {
			$list[ $key ] = '<li><a href="' . esc_url( $link ) . '">' . esc_html( $post_title ) . ' (<strong>' . $count . '</strong>)</a></li>';
		}

	}
	ksort( $list );

	return ( ! empty( $list ) ) ? '<ul>' . implode( PHP_EOL, $list ) . '</ul>' : 'No WCAG Criteria found.';
}