<?php
/**
 * seaside functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package seaside
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'seaside_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function seaside_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on seaside, use a find and replace
		 * to change 'seaside' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'seaside', get_template_directory() . '/languages' );

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
				'menu-1' => esc_html__( 'Primary', 'seaside' ),
			)
		);
		/**
		 * Register Custom Navigation Walker
		 */
		function register_navwalker(){
			require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
		}
		add_action( 'after_setup_theme', 'register_navwalker' );
		if ( ! file_exists( get_template_directory() . '/class-wp-bootstrap-navwalker.php' ) ) {
			// File does not exist... return an error.
			return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
		} else {
			// File exists... require it.
			require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
		}
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
				'seaside_custom_background_args',
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
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'seaside_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function seaside_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'seaside_content_width', 640 );
}
add_action( 'after_setup_theme', 'seaside_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function seaside_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'seaside' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'seaside' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'seaside_widgets_init' );




/**
 * Enqueue scripts and styles.
 */
function seaside_scripts() {
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/vendor/bootstrap/css/bootstrap.min.css');
	wp_enqueue_style('icofont', get_template_directory_uri() . '/vendor/icofont/icofont.min.css');
	wp_enqueue_style('boxicons', get_template_directory_uri() . '/vendor/boxicons/css/boxicons.min.css');
	wp_enqueue_style('venobox', get_template_directory_uri() . '/vendor/venobox/venobox.css');
	wp_enqueue_style('owlcarousel', get_template_directory_uri() . '/vendor/owl.carousel/assets/owl.carousel.min.css');
	wp_enqueue_style('aos', get_template_directory_uri() . '/vendor/aos/aos.css');

	wp_enqueue_style( 'seaside-style', get_stylesheet_uri(), array(), _S_VERSION );

	
	wp_style_add_data( 'seaside-style', 'rtl', 'replace' );


	//scripts
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/vendor/jquery/jquery.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'bootstrapscript', get_template_directory_uri() . '/vendor/bootstrap/js/bootstrap.bundle.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'jqueryeasing', get_template_directory_uri() . '/vendor/jquery.easing/jquery.easing.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'phpemail', get_template_directory_uri() . '/vendor/php-email-form/validate.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'waypointsjquery', get_template_directory_uri() . '/vendor/waypoints/jquery.waypoints.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'counterup', get_template_directory_uri() . '/vendor/counterup/counterup.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'isotope-layout', get_template_directory_uri() . '/vendor/isotope-layout/isotope.pkgd.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'venoboxScript', get_template_directory_uri() . '/vendor/venobox/venobox.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/vendor/owl.carousel/owl.carousel.min.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'aosJs', get_template_directory_uri() . '/vendor/aos/aos.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'seaside-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'seaside_scripts' );

//show template 

function define_current_theme_file( $template ) {
    $GLOBALS['current_theme_template'] = basename($template);

    return $template;
}
add_action('template_include', 'define_current_theme_file', 1000);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

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
