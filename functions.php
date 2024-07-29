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
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function accessmeter_widgets_init() {
    // Register Sidebar Widgets
    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar 1', 'accessmeter' ),
            'id'            => 'sidebar-1',
            'description'   => esc_html__( 'Add widgets here for Sidebar 1.', 'accessmeter' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Sidebar 2', 'accessmeter' ),
            'id'            => 'sidebar-2',
            'description'   => esc_html__( 'Add widgets here for Sidebar 2.', 'accessmeter' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    // Register Footer Widgets
    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 1', 'accessmeter' ),
            'id'            => 'footer-1',
            'description'   => esc_html__( 'Add widgets here for Footer 1.', 'accessmeter' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 2', 'accessmeter' ),
            'id'            => 'footer-2',
            'description'   => esc_html__( 'Add widgets here for Footer 2.', 'accessmeter' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 3', 'accessmeter' ),
            'id'            => 'footer-3',
            'description'   => esc_html__( 'Add widgets here for Footer 3.', 'accessmeter' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
        array(
            'name'          => esc_html__( 'Footer 4', 'accessmeter' ),
            'id'            => 'footer-4',
            'description'   => esc_html__( 'Add widgets here for Footer 4.', 'accessmeter' ),
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

    // Enqueue Bootstrap Icons CSS
    wp_enqueue_style('bootstrap-icons', get_template_directory_uri() . '/assets/icons/bootstrap-icons.min.css');

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
            font-weight: bolder;
            background-color: #007A00;
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

// Add WooCommerce support
function accessmeter_add_woocommerce_support() {
    add_theme_support('woocommerce');
}
add_action( 'after_setup_theme', 'accessmeter_add_woocommerce_support' );

//Ensure Compatibility with WooCommerce Styles and Scripts
function accessmeter_woocommerce_setup() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'accessmeter_woocommerce_setup' );


// Set default theme options
function accessmeter_set_default_options() {
    if (false === get_option('woocommerce_enabled')) {
        update_option('woocommerce_enabled', 0);
    }
}
add_action('after_switch_theme', 'accessmeter_set_default_options');

// Load WooCommerce features conditionally
function accessmeter_load_woocommerce() {
    if (get_option('woocommerce_enabled')) {
        // Add WooCommerce support
        add_action('after_setup_theme', 'accessmeter_add_woocommerce_support');
        
        // Customize WooCommerce product layout
        add_action('woocommerce_before_main_content', 'custom_single_product_start', 5);
        add_action('woocommerce_after_main_content', 'custom_single_product_end', 15);

        function custom_single_product_start() {
            echo '<div class="custom-single-product">';
        }

        function custom_single_product_end() {
            echo '</div>';
        }

        // Add custom product thumbnails
        add_action('after_setup_theme', 'custom_woocommerce_image_sizes');
        function custom_woocommerce_image_sizes() {
            add_image_size('custom-shop-catalog', 800, 800, true);
            add_image_size('custom-shop-single', 1200, 1200, true);
        }

        // Customize WooCommerce breadcrumbs
        add_filter('woocommerce_breadcrumb_defaults', 'custom_woocommerce_breadcrumbs');
        function custom_woocommerce_breadcrumbs($defaults) {
            $defaults['delimiter'] = ' &gt; ';
            $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb">';
            $defaults['wrap_after'] = '</nav>';
            return $defaults;
        }

        // Modify checkout fields
        add_filter('woocommerce_checkout_fields', 'custom_woocommerce_checkout_fields');
        function custom_woocommerce_checkout_fields($fields) {
            // Remove the company name field
            unset($fields['billing']['billing_company']);
            
            // Add a custom field
            $fields['billing']['billing_custom_field'] = array(
                'label'     => __('Custom Field', 'woocommerce'),
                'placeholder'   => _x('Custom Field', 'placeholder', 'woocommerce'),
                'required'  => true,
                'class'     => array('form-row-wide'),
                'clear'     => true
            );
            
            return $fields;
        }

        // Enqueue custom WooCommerce styles and scripts
        add_action('wp_enqueue_scripts', 'custom_woocommerce_scripts');
        function custom_woocommerce_scripts() {
            wp_enqueue_style('custom-woocommerce-styles', get_template_directory_uri() . '/woocommerce.css');
            wp_enqueue_script('custom-woocommerce-scripts', get_template_directory_uri() . '/woocommerce.js', array('jquery'), '', true);
        }

        // Customize WooCommerce notices
        add_action('woocommerce_before_customer_login_form', 'custom_woocommerce_notices');
        function custom_woocommerce_notices() {
            wc_print_notices(); // Custom styling can be applied via CSS
        }

        // Add custom sorting options
        add_filter('woocommerce_get_catalog_ordering_args', 'custom_woocommerce_catalog_ordering_args');
        function custom_woocommerce_catalog_ordering_args($args) {
            $args['orderby'] = 'meta_value_num'; // Sort by meta field value
            return $args;
        }
    }
}
add_action('init', 'accessmeter_load_woocommerce');


/**
 * Register Settings
 */
add_action('admin_init', 'my_theme_settings_init');
function my_theme_settings_init() {
    register_setting('my_theme_settings', 'menu_mode', 'sanitize_text_field');
    register_setting('my_theme_settings', 'basic_color_mode', 'sanitize_text_field');
    register_setting('my_theme_settings', 'header_color', 'sanitize_text_field');
    register_setting('my_theme_settings', 'body_sidebar', 'sanitize_text_field');
    register_setting('my_theme_settings', 'body_mode', 'sanitize_text_field');
    register_setting('my_theme_settings', 'footer_mode', 'sanitize_text_field');
    register_setting('my_theme_settings', 'footer_position', 'sanitize_text_field');
    register_setting('my_theme_settings', 'footer_color', 'sanitize_text_field');
    register_setting('my_theme_settings', 'footer_widgets', 'sanitize_text_field');
    register_setting('my_theme_settings', 'footer_credits', 'sanitize_text_field');    
    register_setting('my_theme_settings', 'accessmeter_language', 'sanitize_text_field');
    register_setting('my_theme_settings', 'breadcrumb_code', 'sanitize_textarea_field');
    register_setting('my_theme_settings', 'woocommerce_enabled', 'sanitize_text_field');
    register_setting('my_theme_settings', 'footer_mode_enabled', 'sanitize_text_field');
    register_setting('my_theme_settings', 'google_analytics_script', 'sanitize_js_code');
    register_setting('my_theme_settings', 'site_verification_code', 'sanitize_text_field');
    register_setting('my_theme_settings', 'marketing_pixel_code', 'sanitize_js_code');
    register_setting('my_theme_settings', 'email_service_provider_code', 'sanitize_js_code');    
    register_setting('my_theme_settings', 'cookie_consent', 'sanitize_text_field');
    register_setting('my_theme_settings', 'gdpr_compliance', 'sanitize_text_field');
    register_setting('my_theme_settings', 'cookie_consent_custom_text', 'sanitize_textarea_field');
    register_setting('my_theme_settings', 'gdpr_compliance_custom_text', 'sanitize_textarea_field');
    register_setting('my_theme_settings', 'custom_js', 'sanitize_js_code');
}

/**
 * Custom sanitization functions for JavaScript code fields.
 */
function sanitize_js_code($input) {
    return wp_kses($input, array(
        'script' => array(
            'type' => true,
            'src' => true,
            'async' => true,
            'defer' => true,
            'crossorigin' => true,
            'integrity' => true
        ),
        'noscript' => array(),
    ));
}

/**
 * Add settings page
 */
add_action('admin_menu', 'my_theme_settings_menu');
function my_theme_settings_menu() {
    // Add top-level menu
    add_menu_page(
        __('Accessmeter Settings', 'accessmeter'),
        __('Accessmeter', 'accessmeter'),
        'manage_options',
        'accessmeter-settings',
        'accessmeter_theme_settings_page', // Temporary callback
        'dashicons-admin-generic',
        1
    );

    // Add submenus
    add_submenu_page(
        'accessmeter-settings',
        __('Accessibility Settings', 'accessmeter'),
        __('Accessibility', 'accessmeter'),
        'manage_options',
        'accessmeter-accessibility',
        'accessmeter_accessibility_page'
    );

    add_submenu_page(
        'accessmeter-settings',
        __('Theme Settings', 'accessmeter'),
        __('Theme Settings', 'accessmeter'),
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
    echo '<div class="wrap"><h1>' . __('Accessibility Settings', 'accessmeter') . '</h1><p>' . __('Here you can manage accessibility settings.', 'accessmeter') . '</p></div>';
}

add_action('admin_notices', 'my_theme_admin_notices');
function my_theme_admin_notices() {
    if (isset($_GET['settings-updated'])) {
        if ($_GET['settings-updated'] === 'true') {
            echo '<div class="notice notice-success is-dismissible">
                <p><span style="font-size: 20px; color: green;">&#10004;</span> ' . __('Settings saved successfully!', 'accessmeter') . '</p>
            </div>';
        } else {
            echo '<div class="notice notice-error is-dismissible">
                <p><span style="font-size: 20px; color: red;">&#10008;</span> ' . __('Settings failed to save!', 'accessmeter') . '</p>
            </div>';
        }
    }
}

/**
 * Theme settings page callback
 */
function accessmeter_theme_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Theme Settings', 'accessmeter'); ?></h1>
        <form action="options.php" method="post">
            <?php settings_fields('my_theme_settings'); ?>
            <?php do_settings_sections('my_theme_settings'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><?php _e('Select Language', 'accessmeter'); ?></th>
                    <td>
                        <select name="accessmeter_language">
                            <?php
                            $languages = get_available_languages();
                            foreach ($languages as $language) {
                                echo '<option value="' . esc_attr($language) . '"' . selected(get_option('accessmeter_language'), $language, false) . '>' . esc_html($language) . '</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Enable WooCommerce', 'accessmeter'); ?></th>
                    <td>
                        <input type="checkbox" name="woocommerce_enabled" value="1" <?php checked(get_option('woocommerce_enabled'), 1); ?>>
                        <label for="woocommerce_enabled"><?php _e('Enable WooCommerce Features.', 'accessmeter'); ?></label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Enable Footer Mode', 'accessmeter'); ?></th>
                    <td>
                        <input type="checkbox" name="footer_mode_enabled" value="1" <?php checked(get_option('footer_mode_enabled'), 1); ?>>
                        <label for="footer_mode_enabled"><?php _e('Enable Collapse/Expand of the Footer.', 'accessmeter'); ?></label>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Basic Color Scheme', 'accessmeter'); ?></th>
                    <td>
                        <select name="basic_color_mode">
                            <option value="darkred" <?php selected(get_option('basic_color_mode'), 'darkred'); ?>><?php _e('Red', 'accessmeter'); ?></option>
                            <option value="purple" <?php selected(get_option('basic_color_mode'), 'purple'); ?>><?php _e('Purple', 'accessmeter'); ?></option>
                            <option value="black" <?php selected(get_option('basic_color_mode'), 'black'); ?>><?php _e('Black', 'accessmeter'); ?></option>
                            <option value="#452B1F" <?php selected(get_option('basic_color_mode'), '#452B1F'); ?>><?php _e('Brown', 'accessmeter'); ?></option>
                            <option value="darkblue" <?php selected(get_option('basic_color_mode'), 'darkblue'); ?>><?php _e('Blue', 'accessmeter'); ?></option>
                            <option value="green" <?php selected(get_option('basic_color_mode'), 'green'); ?>><?php _e('Green', 'accessmeter'); ?></option>
                        </select>
                        <p class="description"><?php _e('Select a color for the scroll progress bar.', 'accessmeter'); ?></p>
                    </td>
                </tr>                                
                <tr valign="top">
                    <th scope="row"><?php _e('Menu Mode', 'accessmeter'); ?></th>
                    <td>
                        <select name="menu_mode">
                            <option value="expanded" <?php selected(get_option('menu_mode'), 'expanded'); ?>><?php _e('Expanded', 'accessmeter'); ?></option>
                            <option value="collapsed" <?php selected(get_option('menu_mode'), 'collapsed'); ?>><?php _e('Collapsed', 'accessmeter'); ?></option> 
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Header Color', 'accessmeter'); ?></th>
                    <td>
                        <select name="header_color">
                            <option value="darkred" <?php selected(get_option('header_color'), 'darkred'); ?>><?php _e('Red', 'accessmeter'); ?></option>
                            <option value="purple" <?php selected(get_option('header_color'), 'purple'); ?>><?php _e('Purple', 'accessmeter'); ?></option>
                            <option value="black" <?php selected(get_option('header_color'), 'black'); ?>><?php _e('Black', 'accessmeter'); ?></option>
                            <option value="whitesmoke" <?php selected(get_option('header_color'), 'whitesmoke'); ?>><?php _e('White', 'accessmeter'); ?></option>
                            <option value="#452B1F" <?php selected(get_option('header_color'), '#452B1F'); ?>><?php _e('Brown', 'accessmeter'); ?></option>
                            <option value="darkblue" <?php selected(get_option('header_color'), 'darkblue'); ?>><?php _e('Blue', 'accessmeter'); ?></option>
                            <option value="green" <?php selected(get_option('header_color'), 'green'); ?>><?php _e('Green', 'accessmeter'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Body Sidebar', 'accessmeter'); ?></th>
                    <td>
                        <select name="body_sidebar">
                            <option value="left" <?php selected(get_option('body_sidebar'), 'left'); ?>><?php _e('Left Sidebar', 'accessmeter'); ?></option>
                            <option value="right" <?php selected(get_option('body_sidebar'), 'right'); ?>><?php _e('Right Sidebar', 'accessmeter'); ?></option>
                            <option value="both" <?php selected(get_option('body_sidebar'), 'both'); ?>><?php _e('Both Sidebars', 'accessmeter'); ?></option>
                            <option value="none" <?php selected(get_option('body_sidebar'), 'none'); ?>><?php _e('No Sidebar', 'accessmeter'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Body Mode', 'accessmeter'); ?></th>
                    <td>
                        <select name="body_mode">
                            <option value="dark" <?php selected(get_option('body_mode'), 'dark'); ?>><?php _e('Dark', 'accessmeter'); ?></option>
                            <option value="light" <?php selected(get_option('body_mode'), 'light'); ?>><?php _e('Light', 'accessmeter'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Footer Mode', 'accessmeter'); ?></th>
                    <td>
                        <select name="footer_mode">
                            <option value="collapsed" <?php selected(get_option('footer_mode'), 'collapsed'); ?>><?php _e('Collapsed', 'accessmeter'); ?></option>
                            <option value="expanded" <?php selected(get_option('footer_mode'), 'expanded'); ?>><?php _e('Expanded', 'accessmeter'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Footer Position', 'accessmeter'); ?></th>
                    <td>
                        <select name="footer_position">
                            <option value="fixed-bottom" <?php selected(get_option('footer_position'), 'fixed-bottom'); ?>><?php _e('Fixed => always at bottom', 'accessmeter'); ?></option>
                            <option value="static-bottom" <?php selected(get_option('footer_position'), 'static-bottom'); ?>><?php _e('Hidden => no footer visibility', 'accessmeter'); ?></option>
                        </select>

                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Footer Color', 'accessmeter'); ?></th>
                    <td>
                        <select name="footer_color">
                            <option value="darkred" <?php selected(get_option('footer_color'), 'darkred'); ?>><?php _e('Red', 'accessmeter'); ?></option>
                            <option value="purple" <?php selected(get_option('footer_color'), 'purple'); ?>><?php _e('Purple', 'accessmeter'); ?></option>
                            <option value="black" <?php selected(get_option('footer_color'), 'black'); ?>><?php _e('Black', 'accessmeter'); ?></option>
                            <option value="whitesmoke" <?php selected(get_option('footer_color'), 'whitesmoke'); ?>><?php _e('White', 'accessmeter'); ?></option>
                            <option value="#452B1F" <?php selected(get_option('footer_color'), '#452B1F'); ?>><?php _e('Brown', 'accessmeter'); ?></option>
                            <option value="darkblue" <?php selected(get_option('footer_color'), 'darkblue'); ?>><?php _e('Blue', 'accessmeter'); ?></option>
                            <option value="green" <?php selected(get_option('footer_color'), 'green'); ?>><?php _e('Green', 'accessmeter'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Footer Widgets', 'accessmeter'); ?></th>
                    <td>
                        <select name="footer_widgets">
                            <option value="4-widgets" <?php selected(get_option('footer_widgets'), '4-widgets'); ?>><?php _e('4-Widgets', 'accessmeter'); ?></option>
                            <option value="3-widgets" <?php selected(get_option('footer_widgets'), '3-widgets'); ?>><?php _e('3-Widgets', 'accessmeter'); ?></option>
                            <option value="2-widgets" <?php selected(get_option('footer_widgets'), '2-widgets'); ?>><?php _e('2-Widgets', 'accessmeter'); ?></option>
                            <option value="1-widget" <?php selected(get_option('footer_widgets'), '1-widget'); ?>><?php _e('1-Widget', 'accessmeter'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Footer Credits', 'accessmeter'); ?></th>
                    <td>
                        <input type="text" name="footer_credits" style="width: 500px" value="<?php echo esc_attr(get_option('footer_credits')); ?>" class="regular-text">
                        <p style="width: 500px" class="description"><?php _e('Enter footer credits text here (example: "Accessmeter. All rights reserved.", "Designed by Accessmeter Agency.", "Powered by Accessmeter Inc.")', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Cookie Consent', 'accessmeter'); ?></th>
                    <td>
                        <input type="checkbox" name="cookie_consent" value="1" <?php checked(get_option('cookie_consent'), 1); ?>>
                        <p style="width: 500px" class="description"><?php _e('Enable or disable the default cookie consent modal.', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Cookie Consent Custom Text', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="cookie_consent_custom_text" rows="5" style="width: 500px" class="large-text"><?php echo esc_textarea(get_option('cookie_consent_custom_text')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Enter custom text for the cookie consent modal. Leave empty to use the default text.', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('GDPR Compliance', 'accessmeter'); ?></th>
                    <td>
                        <input type="checkbox" name="gdpr_compliance" value="1" <?php checked(get_option('gdpr_compliance'), 1); ?>>
                        <p style="width: 500px" class="description"><?php _e('Enable or disable the default GDPR compliance modal.', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('GDPR Compliance Custom Text', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="gdpr_compliance_custom_text" rows="5" style="width: 500px" class="large-text"><?php echo esc_textarea(get_option('gdpr_compliance_custom_text')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Enter custom text for the GDPR compliance modal. Leave empty to use the default text.', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Breadcrumb Code', 'accessmeter'); ?></th>
                    <td>
                    <textarea name="breadcrumb_code" rows="5" class="large-text" style="width: 500px;"><?php echo esc_textarea(get_option('breadcrumb_code')); ?></textarea>
                    <p style="width: 500px" class="description"><?php _e('Paste the breadcrumb snippet from your SEO plugin (e.g., Yoast, Rank Math) here.', 'accessmeter'); ?></p>
                    </td>
                </tr>                
                <tr valign="top">
                    <th scope="row"><?php _e('Custom JavaScript', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="custom_js" rows="5" class="large-text" style="width: 500px;"><?php echo esc_textarea(get_option('custom_js')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Enter custom JavaScript code to extend the functionality of the site here.', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Google Analytics Script', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="google_analytics_script" rows="5" class="large-text" style="width: 500px;"><?php echo esc_textarea(get_option('google_analytics_script')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Paste your Google Analytics script here. For example: Script code from Google Analytics to track website traffic and user behavior.', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Site Verification Code', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="site_verification_code" rows="5" class="large-text" style="width: 500px;"><?php echo esc_textarea(get_option('site_verification_code')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Paste your site verification code here (example: "Google Search Console verification code.", "Bing Webmaster Tools verification meta tag.", "Yandex verification code to prove site ownership.")', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Marketing Pixel Code', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="marketing_pixel_code" rows="5" class="large-text" style="width: 500px;"><?php echo esc_textarea(get_option('marketing_pixel_code')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Paste your marketing pixel code here. For example: "Facebook pixel code for tracking user interactions and ad conversions."', 'accessmeter'); ?></p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><?php _e('Email Service Provider Code', 'accessmeter'); ?></th>
                    <td>
                        <textarea name="email_service_provider_code" rows="5" class="large-text" style="width: 500px;"><?php echo esc_textarea(get_option('email_service_provider_code')); ?></textarea>
                        <p style="width: 500px" class="description"><?php _e('Paste your email service provider code here. For example: "Mailchimp code for subscribing users to your email lists.", "ConvertKit code for integrating email marketing forms with your site."', 'accessmeter'); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
/**
 * Set the locale based on the selected language
 */
function accessmeter_set_locale($locale) {
    $selected_language = get_option('accessmeter_language');
    if ($selected_language) {
        $locale = $selected_language;
    }
    return $locale;
}
add_filter('locale', 'accessmeter_set_locale');

// Function to get the user's choice for progress bar color
function display_progress_bar() {
    $color = get_option('basic_color_mode', 'green'); // Default color is green
    $allowed_colors = ['darkred', 'purple', 'black', '#452B1F', 'darkblue', 'green'];

    // Sanitize color choice dynamically
    $color = in_array($color, $allowed_colors) ? $color : 'green';

    echo '<div id="progress-bar-container">';
    echo '<div id="progress-bar" style="background-color: ' . esc_attr($color) . ';"></div>';
    echo '</div>';
}

// Function to check if the Menu Mode is enabled
function get_menu_mode() {
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $is_mobile_or_tablet = preg_match('/Mobile|Tablet/', $user_agent);

    // Debugging output
    error_log('User Agent: ' . $user_agent);
    error_log('Is Mobile/Tablet: ' . ($is_mobile_or_tablet ? 'Yes' : 'No'));

    if ($is_mobile_or_tablet) {
        return 'collapsed';
    }

    return get_option('menu_mode', 'expanded');
}

// Function to check if the footer mode is enabled
function is_footer_mode_enabled() {
    return (bool) get_option('footer_mode_enabled', 0);
}

// Footer mode functions
function get_footer_mode() {
    if (!is_footer_mode_enabled()) {
        return 'always-expanded';
    }

    // Get the user's choice from the database; default to 'expanded' if not set
    $footer_mode = get_option('footer_mode', 'expanded');
    return $footer_mode;
}

//Header color
function get_header_color() {
    $color = get_option('header_color', 'white'); // Default color is white
    $allowed_colors = ['darkred', 'purple', 'black', 'whitesmoke', '#452B1F', 'darkblue', 'green'];

    // Sanitize color choice dynamically
    $color = in_array($color, $allowed_colors) ? $color : 'whitesmoke';
    echo 'background-color: ' . $color . ';';
}

//Footer position functions
function get_footer_position() {
    // Get the user’s choice from the database; default to 'static-bottom' if not set
    $footer_position = get_option('footer_position', 'static-bottom');
    return $footer_position;
}

//Footer color
function get_footer_color() {
    $color = get_option('footer_color', 'black'); // Default color is black
    $allowed_colors = ['darkred', 'purple', 'black', 'whitesmoke', '#452B1F', 'darkblue', 'green'];

    // Sanitize color choice dynamically
    $color = in_array($color, $allowed_colors) ? $color : 'black';
    echo 'background-color: ' . $color . ';';
}

//Footer Widgets
function get_footer_widgets() {
    // Get the user’s choice from the database; default to '4-Widgets' if not set
    $footer_widgets = get_option('footer_widgets', '4-widgets');
    return $footer_widgets;
}

// Footer Credits
function get_footer_credits() {
    // Sanitize the footer credits option
    $footer_credits = sanitize_text_field(get_option('footer_credits', get_bloginfo('name')));
    $current_year = date('Y');
    return sprintf(
        '&copy; %s %s. All rights reserved.',
        esc_html($current_year),
        esc_html($footer_credits)
    );
}

function control_sidebar_layout() {
    $selected_option = get_option('body_sidebar');
  
    if ($selected_option == 'left') {
      // Hide right sidebar and expand content
      echo '<style>
        .col-md-3:last-child {
          display: none;
        }
        #progress-bar-content {
          flex: 0 0 75%;
          max-width: 75%;
        }
      </style>';
    } elseif ($selected_option == 'right') {
      // Hide left sidebar and expand content
      echo '<style>
        .col-md-3:first-child {
          display: none;
        }
        #progress-bar-content {
          flex: 0 0 75%;
          max-width: 75%;
        }
      </style>';
    } elseif ($selected_option == 'none') {
      // Hide both sidebars and expand content
      echo '<style>
        .col-md-3 {
          display: none;
        }
        #progress-bar-content {
          flex: 0 0 100%;
          max-width: 100%;
        }
      </style>';
    } else {
      // Do nothing, keep default layout
    }
  }
  

// Function to get Google Analytics script
function accessmeter_google_analytics_script() {
    $google_analytics_script = get_option('google_analytics_script');
    if ($google_analytics_script) {
        echo $google_analytics_script;
    }
}

// Function to get site verification code
function accessmeter_site_verification_code() {
    $site_verification_code = get_option('site_verification_code');
    if ($site_verification_code) {
        echo '<meta name="google-site-verification" content="' . esc_attr($site_verification_code) . '">';
    }
}

// Function to get marketing pixel code
function accessmeter_marketing_pixel_code() {
    $marketing_pixel_code = get_option('marketing_pixel_code');
    if ($marketing_pixel_code) {
        echo $marketing_pixel_code;
    }
}

// Function to get email service provider code
function accessmeter_email_service_provider_code() {
    $email_service_provider_code = get_option('email_service_provider_code');
    if ($email_service_provider_code) {
        echo $email_service_provider_code;
    }
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

