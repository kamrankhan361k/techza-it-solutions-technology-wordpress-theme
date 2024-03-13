<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package techza
 */

use TechzaTheme\Inc\Classes\Techza_Main;

get_header();

$techzaObj = new Techza_Main();
$techzaObj->techza_breadcrumb_bridge();

$techza = get_option('techza');
$grid = (isset($techza['blog_grid'])) ? $techza['blog_grid'] : 'one-column';

?>

<div class="content-block sp-80">
	<div class="container">
		<div class="row blog-content-row justify-content-center">

			<?php
			// If Redux Framework Active
			if (have_posts()) :

				if (class_exists('ReduxFrameworkPlugin')) :
					$techzaObj->postMarkupGenerator($techza['blog_layout'], $grid);

				else : // If Redux Framework Is Not Active

					$techzaObj->postMarkupGenerator(null, $grid);

				endif;
			else :
				get_template_part('template-parts/contents/content-none');
			endif;
			?>
		</div>
	</div>
</div>


<?php
get_footer();
