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
$techza = get_option('techza');
$use_custom_layout = get_post_meta(get_the_ID(), 'use_custom_page_layout', true);
$custom_page_layout = get_post_meta(get_the_ID(), 'select_custom_layout', true);
$prev_icon = '<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M14.8555 6.5C14.8555 6.25377 14.7577 6.01763 14.5835 5.84352C14.4094 5.66941 14.1733 5.5716 13.9271 5.5716H3.17058L7.15714 1.58689C7.33147 1.41256 7.42941 1.17612 7.42941 0.929577C7.42941 0.683038 7.33147 0.446596 7.15714 0.272267C6.98281 0.0979375 6.74637 0 6.49983 0C6.25329 0 6.01685 0.0979375 5.84252 0.272267L0.272099 5.84269C0.18564 5.92893 0.117044 6.03138 0.070241 6.14417C0.0234375 6.25697 -0.000654221 6.37788 -0.000654221 6.5C-0.000654221 6.62212 0.0234375 6.74303 0.070241 6.85583C0.117044 6.96862 0.18564 7.07107 0.272099 7.15731L5.84252 12.7277C6.01685 12.9021 6.25329 13 6.49983 13C6.74637 13 6.98281 12.9021 7.15714 12.7277C7.33147 12.5534 7.42941 12.317 7.42941 12.0704C7.42941 11.8239 7.33147 11.5874 7.15714 11.4131L3.17058 7.4284H13.9271C14.1733 7.4284 14.4094 7.33059 14.5835 7.15648C14.7577 6.98237 14.8555 6.74623 14.8555 6.5Z" fill="#0A1931"/>
</svg>';
$next_icon = '<svg width="15" height="13" viewBox="0 0 15 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6.5C0 6.25377 0.0978139 6.01763 0.271923 5.84352C0.446033 5.66941 0.682176 5.5716 0.928404 5.5716H11.6849L7.69833 1.58689C7.524 1.41256 7.42606 1.17612 7.42606 0.929577C7.42606 0.683038 7.524 0.446596 7.69833 0.272267C7.87265 0.0979375 8.1091 0 8.35564 0C8.60217 0 8.83862 0.0979375 9.01295 0.272267L14.5834 5.84269C14.6698 5.92893 14.7384 6.03138 14.7852 6.14417C14.832 6.25697 14.8561 6.37788 14.8561 6.5C14.8561 6.62212 14.832 6.74303 14.7852 6.85583C14.7384 6.96862 14.6698 7.07107 14.5834 7.15731L9.01295 12.7277C8.83862 12.9021 8.60217 13 8.35564 13C8.1091 13 7.87265 12.9021 7.69833 12.7277C7.524 12.5534 7.42606 12.317 7.42606 12.0704C7.42606 11.8239 7.524 11.5874 7.69833 11.4131L11.6849 7.4284H0.928404C0.682176 7.4284 0.446033 7.33059 0.271923 7.15648C0.0978139 6.98237 0 6.74623 0 6.5Z" fill="#0A1931"/>
</svg>';
$layout = '';
if (!empty($custom_page_layout && $use_custom_layout)) {
	$layout = $custom_page_layout;
} elseif (isset($techza['single_page_layout'])) {
	$layout = $techza['single_page_layout'];
} else {
	$layout = 'right-sidebar';
}


while (have_posts()) : the_post();
?>
	<?php echo esc_html($techzaObj->techza_breadcrumb_bridge()); ?>
	<div class=" post-details-page">
		<div class="container">
			<div class="row justify-content-center blog-content-row">

				<?php if ('left-sidebar' == $layout &&  is_active_sidebar('techza_blog_sidebar')) : ?>
					<div class="col-lg-4 col-md-10 left-sidebar"><?php get_sidebar('techza_blog_sidebar'); ?></div>

				<?php endif; ?>
				<div class="col-lg-8 col-md-12">
					<main id="primary" class="site-main">

						<?php
						get_template_part('template-parts/single/post');

						the_post_navigation(
							array(
								'prev_text' => '<span class="nav-subtitle">' . esc_html__('Previous post:', 'techza') . '</span> <span class="nav-title">' . $prev_icon . ' %title</span>',
								'next_text' => '<span class="nav-subtitle">' . esc_html__('Next post:', 'techza') . '</span> <span class="nav-title">%title ' . $next_icon . '</span>',
							)
						);

						?>
						<div class="comment-form-main-wrapper">
							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) :
								comments_template();
							endif;
							?>
						</div>
					</main><!-- #main -->

				</div>
				<?php if ('right-sidebar' == $layout && is_active_sidebar('techza_blog_sidebar')) : ?>
					<div class="col-lg-4 col-md-10 right-sidebar order-lg-1 order-0"><?php get_sidebar(); ?></div>
				<?php endif; ?>
			</div>

		</div>
	</div>



<?php
endwhile; // End of the loop.

get_footer();
