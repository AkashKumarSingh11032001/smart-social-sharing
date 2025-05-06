<?php
/*
Plugin Name: Smart Social Sharing Buttons
Description: Lightweight, premium social sharing buttons for WordPress.
Version: 1.0.0
Author: Your Name
License: GPL-2.0+
*/

defined('ABSPATH') || exit;

// Include files (we'll create these later)
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/frontend-display.php';
require_once plugin_dir_path(__FILE__) . 'includes/analytics.php';
require_once plugin_dir_path(__FILE__) . 'includes/onboarding.php';

// Load styles and scripts
add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css');
    wp_enqueue_style('smart-social-frontend', plugin_dir_url(__FILE__) . 'assets/css/frontend.css');
    wp_enqueue_script('smart-social-frontend', plugin_dir_url(__FILE__) . 'assets/js/frontend.js', [], '1.0.0', true);
});

add_action('admin_enqueue_scripts', function() {
    wp_enqueue_style('smart-social-admin', plugin_dir_url(__FILE__) . 'assets/css/admin.css');
    wp_enqueue_script('smart-social-admin', plugin_dir_url(__FILE__) . 'assets/js/admin.js', ['wp-color-picker'], '1.0.0', true);
    wp_enqueue_style('wp-color-picker');
});
?>