<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package techza
 */

if ( ! is_active_sidebar( 'techza_blog_sidebar' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'techza_blog_sidebar'); 
		
	?>

</aside><!-- #secondary -->
