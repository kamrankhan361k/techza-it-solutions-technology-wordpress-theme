<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techza
 */

use TechzaTheme\Inc\Classes\Techza_Main;

get_header();

$techzaObj = new Techza_Main();
echo esc_html($techzaObj->techza_breadcrumb_bridge());

$techza = get_option('techza');
$grid = (isset($techza['blog_grid'])) ? $techza['blog_grid'] : 'two-column';

?>

	<div class="container">
		<div class="row blog-content-row justify-content-center">

			<?php
			// If Redux Framework Active
			if (class_exists('ReduxFrameworkPlugin')) :
				$techzaObj->postMarkupGenerator($techza['blog_layout'], $grid);
			else : // If Redux Framework Is Not Active
				$techzaObj->postMarkupGenerator(null, $grid);
			endif;

			?>


		</div>
	</div>


<?php
get_footer();
