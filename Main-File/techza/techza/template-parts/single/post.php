<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techza
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php techza_post_thumbnail(); ?>
	<div class="single-post-content-wrap">
		<div class="category-date-area">


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

		</div>

		<div class="entry-content clearfix">
			<?php
			the_content(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'techza'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html(get_the_title())
				)
			);
			?>
			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . esc_html__('Pages:', 'techza'),
					'after'  => '</div>',
				)
			);
			?>
		</div>


	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->