<?php
/**
 * Accessmeter functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Accessmeter
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
function accessmeter_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Accessmeter, use a find and replace
		* to change 'accessmeter' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'accessmeter', get_template_directory() . '/languages' );

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
			'menu-1' => esc_html__( 'Primary', 'accessmeter' ),
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
			'accessmeter_custom_background_args',
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
add_action( 'after_setup_theme', 'accessmeter_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function accessmeter_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'accessmeter_content_width', 640 );
}
add_action( 'after_setup_theme', 'accessmeter_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function accessmeter_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'accessmeter' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'accessmeter' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'accessmeter_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function accessmeter_scripts() {
	wp_enqueue_style( 'accessmeter-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'accessmeter-style', 'rtl', 'replace' );

	wp_enqueue_script( 'accessmeter-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'accessmeter_scripts' );

function my_custom_theme_scripts() {
    wp_enqueue_style('my-custom-style', get_template_directory_uri() . '/css/custom.css');
    wp_enqueue_script('my-custom-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'my_custom_theme_scripts');

function enqueue_bootstrap() {
    // Enqueue Bootstrap CSS
    wp_enqueue_style('bootstrap-css', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css');

    // Enqueue Bootstrap JS
    wp_enqueue_script('bootstrap-js', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}

add_action('wp_enqueue_scripts', 'enqueue_bootstrap');

/**
 * Enqueue custom admin styles to change the appearance of the Accessmeter menu item.
 */
function accessmeter_custom_admin_styles() {
    echo '
    <style>
            #adminmenu .toplevel_page_accessmeter-settings > a {            
            color: green;
            background-color: black;
        }
    </style>';
}

// Hook the function to the admin_head action to ensure it is included in the admin area
add_action('admin_head', 'accessmeter_custom_admin_styles');


/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    require_once get_template_directory() . '/class-wp-bootstrap-navwalker.php';
}
add_action( 'after_setup_theme', 'register_navwalker' );

/**
 * Register Settings
 */
add_action('admin_init', 'my_theme_settings_init');
function my_theme_settings_init() {
  register_setting('my_theme_settings', 'header_mode');
  register_setting('my_theme_settings', 'header_color');
  register_setting('my_theme_settings', 'body_sidebar');
  register_setting('my_theme_settings', 'body_mode');
  register_setting('my_theme_settings', 'footer_mode');
  register_setting('my_theme_settings', 'footer_color');
}

/**
 * Add settings page
 */
add_action('admin_menu', 'my_theme_settings_menu');
function my_theme_settings_menu() {
  // Add top-level menu
  add_menu_page(
    'Accessmeter Settings',
    'Accessmeter',
    'manage_options',
    'accessmeter-settings',
    'accessmeter_theme_settings_page', // Temporary callback
    'dashicons-admin-generic',
    1
  );

  // Add submenus
  add_submenu_page(
    'accessmeter-settings',
    'Accessibility Settings',
    'Accessibility',
    'manage_options',
    'accessmeter-accessibility',
    'accessmeter_accessibility_page'
  );

  add_submenu_page(
    'accessmeter-settings',
    'Theme Settings',
    'Theme Settings',
    'manage_options',
    'accessmeter-theme-settings',
    'accessmeter_theme_settings_page'
  );

  // Remove the first submenu which was added by add_menu_page
  remove_submenu_page('accessmeter-settings', 'accessmeter-settings');
}

/**
 * Accessibility settings page callback
 */
function accessmeter_accessibility_page() {
  echo '<div class="wrap"><h1>Accessibility Settings</h1><p>Here you can manage accessibility settings.</p></div>';
}

/**
 * Theme settings page callback
 */
function accessmeter_theme_settings_page() {
  ?>
  <div class="wrap">
    <h1>Theme Settings</h1>
    <form action="options.php" method="post">
      <?php settings_fields('my_theme_settings'); ?>
      <?php do_settings_sections('my_theme_settings'); ?>
      <table class="form-table">
        <tr valign="top">
          <th scope="row">Header Mode</th>
          <td>
            <select name="header_mode">
              <option value="collapsed" <?php selected(get_option('header_mode'), 'collapsed'); ?>>Collapsed</option>
              <option value="expanded" <?php selected(get_option('header_mode'), 'expanded'); ?>>Expanded</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Header Color</th>
          <td>
            <select name="header_color">
              <option value="red" <?php selected(get_option('header_color'), 'red'); ?>>Red</option>
              <option value="purple" <?php selected(get_option('header_color'), 'purple'); ?>>Purple</option>
              <option value="black" <?php selected(get_option('header_color'), 'black'); ?>>Black</option>
              <option value="white" <?php selected(get_option('header_color'), 'white'); ?>>White</option>
              <option value="blue" <?php selected(get_option('header_color'), 'blue'); ?>>Blue</option>
              <option value="green" <?php selected(get_option('header_color'), 'green'); ?>>Green</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Body Sidebar</th>
          <td>
            <select name="body_sidebar">
              <option value="left" <?php selected(get_option('body_sidebar'), 'left'); ?>>Left Sidebar</option>
              <option value="right" <?php selected(get_option('body_sidebar'), 'right'); ?>>Right Sidebar</option>
			  <option value="none" <?php selected(get_option('body_sidebar'), 'none'); ?>>Both Sidebars</option>
              <option value="none" <?php selected(get_option('body_sidebar'), 'none'); ?>>No Sidebar</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Body Mode</th>
          <td>
            <select name="body_mode">
              <option value="dark" <?php selected(get_option('body_mode'), 'dark'); ?>>Dark</option>
              <option value="light" <?php selected(get_option('body_mode'), 'light'); ?>>Light</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Footer Mode</th>
          <td>
            <select name="footer_mode">
              <option value="collapsed" <?php selected(get_option('footer_mode'), 'collapsed'); ?>>Collapsed</option>
              <option value="expanded" <?php selected(get_option('footer_mode'), 'expanded'); ?>>Expanded</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th scope="row">Footer Color</th>
          <td>
            <select name="footer_color">
              <option value="red" <?php selected(get_option('footer_color'), 'red'); ?>>Red</option>
              <option value="purple" <?php selected(get_option('footer_color'), 'purple'); ?>>Purple</option>
              <option value="black" <?php selected(get_option('footer_color'), 'black'); ?>>Black</option>
              <option value="white" <?php selected(get_option('footer_color'), 'white'); ?>>White</option>
              <option value="blue" <?php selected(get_option('footer_color'), 'blue'); ?>>Blue</option>
              <option value="green" <?php selected(get_option('footer_color'), 'green'); ?>>Green</option>
            </select>
          </td>
        </tr>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>
  <?php
}


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

