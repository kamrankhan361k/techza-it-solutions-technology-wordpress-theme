<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package techza
 */
get_header();
while (have_posts()) :
?>
    <div class="content-block project-details-page">
        <main id="primary" class="site-main">
            <?php
            the_post();
            get_template_part('template-parts/single/service');
            ?>
        </main><!-- #main -->
    </div>
    <?php
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;
    ?>
<?php
endwhile; // End of the loop.
get_footer();
