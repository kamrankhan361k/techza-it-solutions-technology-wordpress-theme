<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content"> *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package techza
 */

$techza = get_option( 'techza' );
?>
<!doctype html>
<html <?php language_attributes();?>>

<head>
	<meta charset="<?php bloginfo( 'charset' );?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head();?>
</head>


<body <?php body_class();?>>
	<?php wp_body_open();?>

	<!-- preloader  -->
	<?php techza_preloader()?>

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'techza' );?></a>

		<!-- end techza header -->
		<?php if ( get_header_image() ): ?>
			<div id="site-header">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
					<img src="<?php esc_url( header_image() );?>" width="<?php echo esc_attr( absint( get_custom_header()->width ) ); ?>" height="<?php echo esc_attr( absint( get_custom_header()->height ) ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
				</a>
			</div>
		<?php endif;?>

		<?php

techza_header_settings();

?>