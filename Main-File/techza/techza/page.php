<?php

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techza
 */
use TechzaTheme\Inc\Classes\Techza_Main;

get_header();
$techzaObj = new Techza_Main();

while (have_posts()) :the_post();

?>
<?php echo esc_html($techzaObj->techza_breadcrumb_bridge());?>
<div class="content-block">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<main id="primary" class="site-main">

					<?php get_template_part('template-parts/contents/content', 'page');?>
				</main><!-- #main -->

				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open() || get_comments_number()) :
					comments_template();
				endif;
				?>

			</div>
			<!-- <div class="col-md-4"><?php //get_sidebar(); ?></div> -->
		</div>
	</div>
</div>

<?php
			endwhile; // End of the loop.
get_footer();
