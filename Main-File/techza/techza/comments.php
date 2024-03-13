<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package techza
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}

$techza_comment_count = get_comments_number();
$techza = get_option('techza');
$center = '';

if (is_single() && 'post' == get_post_type() && false == is_active_sidebar('techza_blog_sidebar')) {
	$center = 'justify-content-center';
} elseif (isset($techza['single_page_layout'])) {
	if ('fullpage' == $techza['single_page_layout']) {
		$center = 'justify-content-center';
	}
}

?>
<div class="comment-form-area">


	<?php if ($techza_comment_count != 0) : ?>
		<div id="comments" class="comments-area">

			<?php
			// You can start editing here -- including this comment!
			if (have_comments()) :
			?>
				<h2 class="comments-title">
					<?php

					if ('1' === $techza_comment_count) {
						printf(
							/* translators: 1: title. */
							esc_html__('1 Response on this post', 'techza')
						);
					} else {
						printf(
							/* translators: 1: comment count number, 2: title. */
							esc_html(
								_nx(
									'%1$s Response on this post',
									'%1$s Responses on this post',
									$techza_comment_count,
									'Responses title',
									'techza'
								)
							),
							number_format_i18n($techza_comment_count), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							'<span>' . esc_html(get_the_title()) . '</span>'
						);
					}
					?>
				</h2><!-- .comments-title -->

				<?php the_comments_navigation(); ?>

				<ol class="comment-list">
					<?php
					wp_list_comments(
						array(
							'style'      => 'ol',
							'short_ping' => true,
						)
					);
					?>
				</ol><!-- .comment-list -->

				<?php
				// the_comments_navigation();
				$cpage = get_query_var('cpage') ? get_query_var('cpage') : 1;

				if ($cpage > 1) : ?>
					<div class="techza-comment-loadmore-btn"><?php echo esc_html__('Load more comments', 'techza') ?> <i class="fa fa-caret-down"></i></div>
			<?php
					$cpage = get_query_var('cpage') ? get_query_var('cpage') : 1;
					wp_localize_script(
						'techza-main',
						'techza_comment_loadmore',
						array(
							'ajaxurl' => admin_url('admin-ajax.php'),
							'parent_post_id' => get_the_ID(),
							'cpage' => $cpage,
						)
					);

				endif;


			endif; // Check for have_comments().

			?>

		</div><!-- #comments -->
	<?php endif; ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if (!comments_open()) :
	?>
		<p class="no-comments"><?php esc_html_e('Comments are closed.', 'techza'); ?></p>
	<?php
	else :

		$args = array(
			// 'title_reply' => esc_html_e('Leave a comment', 'techza'),
			'class_form' => 'row',
			'comment_field' => '<p class="col-md-12 comment-form-comment">
						<textarea id="comment" name="comment" aria-required="true" placeholder="' . esc_attr__('Write your comment', 'techza') . '"></textarea>
					</p>',
			'fields' => array(
				//Author field
				'author' => '<p class="col-md-6 comment-form-author">
					<input id="author" name="author" aria-required="true" placeholder="' . esc_attr__('Name', 'techza') . '" required="required" />
					</p>',
				//Email Field
				'email' => '<p class="col-md-6 comment-form-email">
					<input id="email" name="email" placeholder="' . esc_attr__('Email address', 'techza') . '" required="required" />
					</p>',
				//URL Field
				'url' => '',
			),

		);
		comment_form($args);
	endif;
	?>

</div>