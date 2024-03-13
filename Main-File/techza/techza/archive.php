<?php

/**
 * The template for displaying archive pages
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

<div class="content-block">
	<div class="container">
		<div class="row blog-content-row">

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
</div>


<?php
get_footer();
