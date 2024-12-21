<?php
/*
Plugin Name: Accessmeter
Plugin URI: https://github.com/Sammy10000/accessmeter
Description: Real-time automated accessibility audit reports using A11y APIs, and full issues remediation support.
Version: 1.0
Author: Samuel Enyi
Author URI: https://accessmeter.com
License: GPL-2.0-or-later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

// Enqueue Bootstrap CSS and JS for the admin dashboard
function accessmeter_enqueue_admin_assets($hook_suffix) {
    if ($hook_suffix !== 'toplevel_page_accessmeter-dashboard' && strpos($hook_suffix, 'accessmeter-') === false) {
        return;
    }
    wp_enqueue_style('bootstrap-css', plugin_dir_url(__FILE__) . 'assets/bootstrap.min.css');
    wp_enqueue_script('jquery'); // Enqueue jQuery
    wp_enqueue_script('bootstrap-js', plugin_dir_url(__FILE__) . 'assets/bootstrap.bundle.min.js', array('jquery'), null, true);
    wp_enqueue_style('accessmeter-style', plugin_dir_url(__FILE__) . 'assets/style.css');
    wp_enqueue_script('accessmeter-scripts', plugin_dir_url(__FILE__) . 'assets/scripts.js', array(), null, true);
}
add_action('admin_enqueue_scripts', 'accessmeter_enqueue_admin_assets');

// Enqueue AJAX script
function enqueue_custom_ajax_script() {
    wp_enqueue_script('jquery'); // Enqueue jQuery
    wp_enqueue_script('accessmeter-ajax-script', plugin_dir_url(__FILE__) . 'js/my-ajax-script.js', array('jquery'), null, true);
    wp_localize_script('accessmeter-ajax-script', 'ajax_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('admin_enqueue_scripts', 'enqueue_custom_ajax_script'); // Use admin_enqueue_scripts instead of wp_enqueue_scripts

// Add a menu item
function accessmeter_admin_menu() {
    add_menu_page(
        'AccessMeter', 'AccessMeter', 'manage_options', 'accessmeter-dashboard',
        'accessmeter_dashboard', 'dashicons-universal-access-alt', 2.000006756455
    );

    require_once(plugin_dir_path(__FILE__) . 'inc/audits.php');
    require_once(plugin_dir_path(__FILE__) . 'inc/remediation.php');
    require_once(plugin_dir_path(__FILE__) . 'inc/settings.php');

    add_submenu_page('accessmeter-dashboard', 'Audits', 'Audits', 'manage_options', 'accessmeter-audits', 'accessmeter_audits');
    add_submenu_page('accessmeter-dashboard', 'Remediation', 'Remediation', 'manage_options', 'accessmeter-remediation', 'accessmeter_remediation');
    add_submenu_page('accessmeter-dashboard', 'Settings', 'Settings', 'manage_options', 'accessmeter-settings', 'accessmeter_settings');
    
    remove_submenu_page('accessmeter-dashboard', 'accessmeter-dashboard');
}
add_action('admin_menu', 'accessmeter_admin_menu');

// Disable WordPress notifications on the AccessMeter page
function accessmeter_hide_wp_notices() {
    if (isset($_GET['page']) && strpos($_GET['page'], 'accessmeter') !== false) {
        remove_all_actions('admin_notices');
        remove_all_actions('all_admin_notices');
        remove_all_actions('network_admin_notices');
        remove_all_actions('user_admin_notices');
    }
}
add_action('admin_head', 'accessmeter_hide_wp_notices');

function load_more_lap_posts() {
    $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
    $loaded_posts = isset($_POST['loaded_posts']) ? array_map('intval', $_POST['loaded_posts']) : [];

    $args = [
        'numberposts' => 5,
        'offset' => $offset,
        'post_status' => 'publish',
        'post__not_in' => $loaded_posts,
    ];

    $posts = wp_get_recent_posts($args);

    if (empty($posts)) {
        echo json_encode(['no_more_posts' => true]);
    } else {
        $post_data = [];
        foreach ($posts as $post) {
            $issues = rand(1, 2000);
            $post_title = esc_html($post['post_title']);
            $aria_label = $post_title . '. ' . $issues . ' issues - Click to view audit details';
            $post_data[] = [
                'id' => $post['ID'],
                'title' => $post_title,
                'issues' => $issues,
                'aria_label' => esc_attr($aria_label),
            ];
        }
        echo json_encode($post_data);
    }
    wp_die();
}
add_action('wp_ajax_load_more_lap_posts', 'load_more_lap_posts');
add_action('wp_ajax_nopriv_load_more_lap_posts', 'load_more_lap_posts');




