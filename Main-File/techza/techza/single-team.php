<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package techza
 */
use TechzaTheme\Inc\Classes\Techza_Main;

get_header();
$techzaObj = new Techza_Main();

while (have_posts()) :
?>
<?php echo esc_html($techzaObj->techza_breadcrumb_bridge());?>

    <div class="content-block team-details-page">
        <main id="primary" class="site-main">
            <?php
            the_post();
            get_template_part('template-parts/single/team');
            ?>
        </main><!-- #main -->
    </div>
<?php
endwhile; // End of the loop.
get_footer();
