<?php

// File Security Check
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// theme version
if(! defined('TECHZA_THEME_VERSION') ){
    define('TECHZA_THEME_VERSION', wp_get_theme()->get('Version'));
} 

// Define the DHRUBOK Folder
if( ! defined( 'TECHZA_DIR' ) ) {
	define('TECHZA_DIR', get_template_directory() );
}

// Define the DHRUBOK Partials Folder
if( ! defined( 'TECHZA_PARTIALS_DIR' ) ) {
	define('TECHZA_PARTIALS_DIR', trailingslashit( TECHZA_DIR ) . 'partials' );
}

// Define the Inc Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_ASSETS_DIR' ) ) {
	define('TECHZA_ASSETS_DIR', trailingslashit( TECHZA_DIR ) . 'assets' );
}


// Define the Inc Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_INC_DIR' ) ) {
	define('TECHZA_INC_DIR', trailingslashit( TECHZA_DIR ) . 'inc' );
}

// Define the Inc Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_FRAMEWORK_DIR' ) ) {
	define('TECHZA_FRAMEWORK_DIR', trailingslashit( TECHZA_INC_DIR ) . 'framework' );
}

// Define the Libs Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_LIBS_DIR' ) ) {
	define('TECHZA_LIBS_DIR', trailingslashit( TECHZA_DIR ) . 'libs' );
}

// Define the Shortcodes Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_SHORTCODES_DIR' ) ) {
	define('TECHZA_SHORTCODES_DIR', trailingslashit( TECHZA_INC_DIR ) . 'shortcodes' );
}

// Define the Classes Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_CLASSES_DIR' ) ) {
	define('TECHZA_CLASSES_DIR', trailingslashit( TECHZA_INC_DIR ) . 'classes' );
}

// Define the Widgets Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_WIDGETS_DIR' ) ) {
	define('TECHZA_WIDGETS_DIR', trailingslashit( TECHZA_INC_DIR ) . 'widgets' );
}


// Define the PLUGINS Folder of the DHRUBOK Directory
if( ! defined( 'TECHZA_INC_PLUGINS_DIR' ) ) {
	define('TECHZA_INC_PLUGINS_DIR', trailingslashit( TECHZA_INC_DIR ) . 'plugins' );
}
