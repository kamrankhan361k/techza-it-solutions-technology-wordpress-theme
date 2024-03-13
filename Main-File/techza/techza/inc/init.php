<?php
// File Security Check
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Theme Constants
 */
require_once get_parent_theme_file_path('inc/constants.php');

/**
 *  Implement the Custom Header feature.
*/
require get_parent_theme_file_path('inc/custom-header.php');

/**
 *  Theme Style and Scripts Enqueye
*/
require_once get_parent_theme_file_path('/inc/theme-style-and-scripts.php');

/**
 *  TGM Plugin Activation.
*/
require get_parent_theme_file_path('/inc/plugins/install-plugins.php');

/**
 *   TGM Plugin Activation.
*/
require get_parent_theme_file_path('/inc/demo-setup.php');

/**
 *  Functions which enhance the theme by hooking into WordPress.
*/
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 *  Custom template tags for this theme.
*/
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 *  Bufet Main Class
*/
require_once get_parent_theme_file_path('inc/classes/Techza_Main.php');

/**
 *  Theme Options
*/
require_once get_parent_theme_file_path('/inc/theme-options.php');

/**
 *  Custom Theme Options Styles
*/
require_once get_parent_theme_file_path('/inc/custom-theme-options-styles.php');

/**
 *  Theme Widgets
*/
require_once get_parent_theme_file_path('/inc/widgets.php');


// woocomerce class
if ( class_exists( 'WooCommerce' ) ) {
	require_once get_parent_theme_file_path('/inc/woocommerce.php');
}

/**
 *   ACf
*/
require_once get_parent_theme_file_path('/inc/acf.php');
