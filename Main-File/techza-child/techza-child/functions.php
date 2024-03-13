<?php
	 add_action( 'wp_enqueue_scripts', 'techza_child_enqueue_styles' );
	 function techza_child_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 		  }
 ?>