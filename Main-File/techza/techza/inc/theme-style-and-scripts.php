<?php

/**
 * Enqueue scripts and styles.
 */
function techza_scripts() {



    wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css2?family=Cabin:wght@500;600;700&family=Inter:wght@300;400;500&display=swap');

 
    wp_enqueue_style( 'font-awesomes', get_theme_file_uri( '/assets/css/all.min.css' ), array(), '5.15.1' );
	wp_enqueue_style('select2', get_theme_file_uri( '/assets/css/select2.min.css'), array(), null);
    wp_enqueue_style( 'bootstrap', get_theme_file_uri( '/assets/css/bootstrap.min.css' ), array(), '4.0' );
    wp_enqueue_style( 'nice-select', get_theme_file_uri( '/assets/css/nice-select.min.css' ), array(), 'null' );

    wp_enqueue_style( 'techza-core', get_theme_file_uri( '/assets/css/core.css' ), array(), TECHZA_THEME_VERSION );
    wp_style_add_data( 'techza-core', 'rtl', 'replace' );

    wp_enqueue_style( 'techza-custom', get_theme_file_uri( '/assets/css/theme-style.css' ), array(), TECHZA_THEME_VERSION );
    wp_style_add_data( 'techza-custom', 'rtl', 'replace' );

    wp_enqueue_style( 'techza-style', get_stylesheet_uri(), array(), TECHZA_THEME_VERSION );


    wp_enqueue_style( 'techza-responsive', get_theme_file_uri( '/assets/css/theme-responsive.css' ), array(), TECHZA_THEME_VERSION );
    wp_style_add_data( 'techza-responsive', 'rtl', 'replace' );

    wp_enqueue_script( 'jquery-masonry' );
	wp_enqueue_script('select2', get_theme_file_uri( '/assets/js/select2.min.js'), array('jquery'), null, true);
    wp_enqueue_script( 'nice-select', get_theme_file_uri( '/assets/js/jquery.nice-select.min.js' ), array( 'jquery' ), null, true );
    wp_enqueue_script( 'techza-main', get_theme_file_uri( '/assets/js/techza-main.js' ), array( 'jquery' ), TECHZA_THEME_VERSION, true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'techza_scripts' );



/**
 * Registers an editor stylesheet for the theme.
 */
function techza_theme_add_editor_styles() {
    add_editor_style( get_theme_file_uri( '/assets/css/editor-style.css' ) );
}
add_action( 'admin_init', 'techza_theme_add_editor_styles' );
