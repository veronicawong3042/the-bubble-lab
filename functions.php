<?php
/**
 * XYZ Bubble Tea functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package XYZ_Bubble_Tea
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function xyz_bubble_tea_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on XYZ Bubble Tea, use a find and replace
		* to change 'xyz-bubble-tea' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'xyz-bubble-tea', get_template_directory() . '/languages' );

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

  add_image_size( 'swipe-icon-size', 30, 30, true);

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'xyz-bubble-tea' ),
			'footer' => esc_html__( 'Footer', 'xyz-bubble-tea' ),
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
			'xyz_bubble_tea_custom_background_args',
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
add_action( 'after_setup_theme', 'xyz_bubble_tea_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function xyz_bubble_tea_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'xyz_bubble_tea_content_width', 640 );
}
add_action( 'after_setup_theme', 'xyz_bubble_tea_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */


/**
 * Enqueue scripts and styles.
 */
function xyz_bubble_tea_scripts() {
	wp_enqueue_style( 'xyz-bubble-tea-style', get_stylesheet_uri(), array(), _S_VERSION );

  //google maps css
  wp_enqueue_style('xyz-google-maps-styling', get_theme_file_uri('./google-maps-styles.css') );
  wp_enqueue_style( 'xyz-google-maps-styles', get_stylesheet_uri(), array(), _S_VERSION  );

	wp_style_add_data( 'xyz-bubble-tea-style', 'rtl', 'replace' );

  //google maps scripts
  wp_enqueue_script( 'xyz-google-maps-scripts', get_template_directory_uri() . '/js/google-maps.js', array('jquery','xyz-google-maps-map-url'), _S_VERSION, true );
  wp_enqueue_script( 'xyz-google-maps-map-url','https://maps.googleapis.com/maps/api/js?key=AIzaSyAudThRvjkxmBgph8R02VR4JRq_-Qvf5D4&callback=console.debug&libraries=maps,marker&v=beta', array('jquery'), _S_VERSION, true );
	

  //google fonts
  wp_enqueue_style(
    'xyz-googlefonts', //handle name
    'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap',
    array(), //if u need to load anything before
    null //google fonts specific
  );


  wp_enqueue_script( 'xyz-bubble-tea-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'xyz_bubble_tea_scripts' );

require get_template_directory() . '/inc/cpt-taxonomy.php';


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

// function disable_block_editor_for_pages() {
// 	remove_post_type_support('page', 'editor');
// }
// add_action('init', 'disable_block_editor_for_pages');

/**
 * Google maps api
 */
function my_acf_google_map_api( $api ){
  $api['key'] = 'AIzaSyAudThRvjkxmBgph8R02VR4JRq_-Qvf5D4';
  return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


// Remove admin menu links for non-Administrator accounts
function fwd_remove_admin_links() {
	if ( !current_user_can( 'manage_options' ) ) {
		remove_menu_page( 'edit.php' );           // Remove Posts link
    		remove_menu_page( 'edit-comments.php' );  // Remove Comments link
	}
}
add_action( 'admin_menu', 'fwd_remove_admin_links' );


//customizing login

function xyz_login_stylesheet() {
	
  // CSS Styles
  wp_enqueue_style( 
  'custom-login',
  get_stylesheet_directory_uri() . '/css/style-login.css',
  array(),
  _S_VERSION,
);

}
add_action( 'login_enqueue_scripts', 'xyz_login_stylesheet' );

// Custom login logo URL
function xyz_login_logo_url() {
  return home_url();
}
add_filter( 'login_headerurl', 'xyz_login_logo_url' );

// Custom login URL title
function xyz_login_logo_url_title() {
  return 'The Bubble Lab';
}
add_filter( 'login_headertext', 'xyz_login_logo_url_title' );


function wporg_remove_all_dashboard_metaboxes() {
	// Remove Welcome panel
	remove_action( 'welcome_panel', 'wp_welcome_panel' );
	// Remove the rest of the dashboard widgets
	remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
	remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
	remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action( 'wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes' );

function wpdocs_add_dashboard_widgets()
{
    wp_add_dashboard_widget("dashboard_widget_example", "Client tutorial", "dashboard_widget_function");
    // function to add a dashboard widget
    // 1st paramater is the id you want to set
    //2nd parameter is the text or heading
    // 3rd parameter is the dashboard widget content that you wanna call so
    // you can actually add content to it
}
add_action('wp_dashboard_setup', 'wpdocs_add_dashboard_widgets');
// modify the wp_dashboard_setup and add call the function your using


// function to modify the content
function dashboard_widget_function()
{
    // some echos to output the content
    $link = 'https://xyzbubbletea.bcitwebdeveloper.ca/wp-content/uploads/2024/04/The-Bubble-Lab-Website-Manual.pdf';
    echo "<a href='".$link."'>Click here for the link</a>";
}