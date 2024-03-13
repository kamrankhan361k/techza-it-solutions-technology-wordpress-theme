<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techza
 */

 
use TechzaTheme\Inc\Classes\Techza_Main;

$techzaObj = new Techza_Main();

$techza        = get_option('techza');
$show_excerpt = isset($techza['show_excerpt']) ? $techza['show_excerpt'] : false;
$grid         = (isset($techza['blog_grid'])) ? $techza['blog_grid'] : 'two-column';
switch ($grid) {
	case 'two-column':
		$limit = 17;
		$title = wp_trim_words(get_the_title(), 11, '...');
		break;

	case 'one-column':
		$limit = 30;
		$title = get_the_title();
		break;

	default:
		$limit = 17;
		$title = wp_trim_words(get_the_title(), 11, '...');
		break;
}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="single-post-item <?php echo esc_attr($grid)  ?>">
			<div class="post-thumbnail-wrapper">
				<?php
				if (is_sticky()) {
					echo '<span class="sticky-text" >' . esc_html__('Sticky', 'techza') . '</span>';
				}
				?>
				<?php if (has_post_thumbnail()) : ?>
					<div class="post-thumbnail">

						<?php the_post_thumbnail('full'); ?>
					</div>

				<?php endif; ?>
			</div>


		<div class="post-content">
			<div class="post-meta bottom">
				
				<div class="comment-meta">
					<?php comments_popup_link('No Comment ', '1 Comment ', '% Comments '); ?>
				</div>

				<div class="post-date">
					<?php techza_posted_on() ?>
				</div>
				<?php  $category = get_the_category(); if (!empty($category)):  ?>
							<div class="post-category">
								<?php
									echo '<a href="' . get_category_link($category[0]->term_id) . '"><span class="category-list">' . $category[0]->cat_name . '</span></a>';
								?>
								
							</div>
							
						<?php endif; ?>
			</div>
			
			<?php
			echo '<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">';
			echo esc_html($title);
			echo '</a></h2>';
			?>

			

			<?php 
				echo '<p>' . esc_html($techzaObj->postExcerpt($limit, get_the_excerpt())) . '</p>';
			 ?>

			<div class="post-read-more">
				<a href="<?php echo esc_url(get_permalink()); ?>">
					<?php echo (isset($techza['continue_reading_title'])) ? $techza['continue_reading_title'] : esc_html__('Read More', 'techza') ?>


					<svg width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M0 6C0 5.77271 0.0902897 5.55473 0.251006 5.39402C0.411723 5.2333 0.629701 5.14301 0.856988 5.14301H10.7861L7.10615 1.46482C6.94523 1.3039 6.85482 1.08565 6.85482 0.858071C6.85482 0.630497 6.94523 0.412243 7.10615 0.251323C7.26707 0.0904038 7.48532 0 7.71289 0C7.94047 0 8.15872 0.0904038 8.31964 0.251323L13.4616 5.39325C13.5414 5.47286 13.6047 5.56743 13.6479 5.67154C13.6911 5.77566 13.7133 5.88728 13.7133 6C13.7133 6.11272 13.6911 6.22434 13.6479 6.32845C13.6047 6.43257 13.5414 6.52714 13.4616 6.60675L8.31964 11.7487C8.15872 11.9096 7.94047 12 7.71289 12C7.48532 12 7.26707 11.9096 7.10615 11.7487C6.94523 11.5878 6.85482 11.3695 6.85482 11.1419C6.85482 10.9144 6.94523 10.6961 7.10615 10.5352L10.7861 6.85699H0.856988C0.629701 6.85699 0.411723 6.7667 0.251006 6.60598C0.0902897 6.44527 0 6.22729 0 6Z" fill="#5B7486" />
					</svg>

				</a>
			</div>
		</div>
	</div>

</div><!-- #post-<?php the_ID(); ?> -->