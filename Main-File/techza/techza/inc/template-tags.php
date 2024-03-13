<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package techza
 */

if (!function_exists('techza_posted_on')) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function techza_posted_on()
	{
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if (get_the_time('U') !== get_the_modified_time('U')) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr(get_the_date(DATE_W3C)),
			esc_html(get_the_date()),
			esc_attr(get_the_modified_date(DATE_W3C)),
			esc_html(get_the_modified_date())
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x('%s', 'post date', 'techza'),
			'<a href="' . esc_url(get_permalink()) . '" rel="bookmark"> ' . $time_string . '</a>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('techza_posted_by')) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function techza_posted_by()
	{
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x('%s', 'post author', 'techza'),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '"><i class="far fa-user"></i> ' . esc_html(get_the_author()) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if (!function_exists('techza_entry_footer')) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function techza_entry_footer()
	{
		// Hide category and tag text for pages.
		if ('post' === get_post_type()) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list(esc_html__(' ', 'techza'));
			if ($categories_list) {
				/* translators: 1: list of categories. */
				printf('<span class="cat-links"><strong>' . esc_html__('Posted in:', 'techza') . '</strong> ' . esc_html__('%1$s', 'techza') . '</span>', $categories_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

			}
			?>
			<div class="post-bottom d-flex align-items-center justify-content-between">
				<div class="techza-post-author">
					<p class="mb-0">By: <span><?php echo get_the_author_meta('display_name', $author_id); ?></span></p>
				</div>
					<div class="techza-post-comments d-flex align-items-center justify-content-between">
						<div class="post-comments-icon me-1">
							<svg width="17" height="15" viewBox="0 0 17 15" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M14.5553 0.978282C14.8148 0.978282 15.0636 1.08135 15.2471 1.26481C15.4305 1.44828 15.5336 1.69711 15.5336 1.95656V9.78282C15.5336 10.0423 15.4305 10.2911 15.2471 10.4746C15.0636 10.658 14.8148 10.7611 14.5553 10.7611H12.1096C11.8059 10.7611 11.5063 10.8318 11.2346 10.9677C10.9629 11.1035 10.7266 11.3007 10.5444 11.5437L8.68563 14.0217L6.8269 11.5437C6.64465 11.3007 6.40833 11.1035 6.13665 10.9677C5.86497 10.8318 5.56539 10.7611 5.26164 10.7611H2.81594C2.55648 10.7611 2.30765 10.658 2.12419 10.4746C1.94073 10.2911 1.83766 10.0423 1.83766 9.78282V1.95656C1.83766 1.69711 1.94073 1.44828 2.12419 1.26481C2.30765 1.08135 2.55648 0.978282 2.81594 0.978282H14.5553ZM2.81594 0C2.29703 0 1.79937 0.206137 1.43244 0.573064C1.06551 0.939991 0.859375 1.43765 0.859375 1.95656L0.859375 9.78282C0.859375 10.3017 1.06551 10.7994 1.43244 11.1663C1.79937 11.5332 2.29703 11.7394 2.81594 11.7394H5.26164C5.41352 11.7394 5.56331 11.7747 5.69915 11.8427C5.83499 11.9106 5.95315 12.0092 6.04427 12.1307L7.90301 14.6087C7.99413 14.7302 8.11229 14.8288 8.24813 14.8967C8.38397 14.9646 8.53376 15 8.68563 15C8.83751 15 8.98729 14.9646 9.12313 14.8967C9.25897 14.8288 9.37713 14.7302 9.46826 14.6087L11.327 12.1307C11.4181 12.0092 11.5363 11.9106 11.6721 11.8427C11.808 11.7747 11.9577 11.7394 12.1096 11.7394H14.5553C15.0742 11.7394 15.5719 11.5332 15.9388 11.1663C16.3058 10.7994 16.5119 10.3017 16.5119 9.78282V1.95656C16.5119 1.43765 16.3058 0.939991 15.9388 0.573064C15.5719 0.206137 15.0742 0 14.5553 0L2.81594 0Z" fill="#0A1931"/>
								<path d="M3.79492 3.42396C3.79492 3.29423 3.84646 3.16981 3.93819 3.07808C4.02992 2.98635 4.15433 2.93481 4.28406 2.93481H13.0886C13.2183 2.93481 13.3427 2.98635 13.4345 3.07808C13.5262 3.16981 13.5777 3.29423 13.5777 3.42396C13.5777 3.55368 13.5262 3.6781 13.4345 3.76983C13.3427 3.86156 13.2183 3.9131 13.0886 3.9131H4.28406C4.15433 3.9131 4.02992 3.86156 3.93819 3.76983C3.84646 3.6781 3.79492 3.55368 3.79492 3.42396ZM3.79492 5.86966C3.79492 5.73993 3.84646 5.61552 3.93819 5.52379C4.02992 5.43205 4.15433 5.38052 4.28406 5.38052H13.0886C13.2183 5.38052 13.3427 5.43205 13.4345 5.52379C13.5262 5.61552 13.5777 5.73993 13.5777 5.86966C13.5777 5.99939 13.5262 6.1238 13.4345 6.21554C13.3427 6.30727 13.2183 6.3588 13.0886 6.3588H4.28406C4.15433 6.3588 4.02992 6.30727 3.93819 6.21554C3.84646 6.1238 3.79492 5.99939 3.79492 5.86966ZM3.79492 8.31537C3.79492 8.18564 3.84646 8.06122 3.93819 7.96949C4.02992 7.87776 4.15433 7.82623 4.28406 7.82623H9.17547C9.3052 7.82623 9.42962 7.87776 9.52135 7.96949C9.61308 8.06122 9.66461 8.18564 9.66461 8.31537C9.66461 8.44509 9.61308 8.56951 9.52135 8.66124C9.42962 8.75297 9.3052 8.80451 9.17547 8.80451H4.28406C4.15433 8.80451 4.02992 8.75297 3.93819 8.66124C3.84646 8.56951 3.79492 8.44509 3.79492 8.31537Z" fill="#0A1931"/>
							</svg>
						</div>
						<span class="comments-counts"><?php echo get_comments_number( $post_id ) ?></span>
					</div>
			</div>

			<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list('', esc_html_x('', 'list item separator', 'techza'));
			if ($tags_list) {
				/* translators: 1: list of tags. */
				printf('<span class="tags-links"><strong>' . esc_html__('Tagged:', 'techza') . '</strong>' . esc_html__('%1$s', 'techza') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'techza'),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					esc_html(get_the_title())
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__('Edit <span class="screen-reader-text">%s</span>', 'techza'),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				esc_html(get_the_title())
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if (!function_exists('techza_post_thumbnail')) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function techza_post_thumbnail()
	{
		if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
			return;
		}

		if (is_singular()) :
?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
				the_post_thumbnail(
					'post-thumbnail',
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</a>

		<?php
		endif; // End is_singular().
	}
endif;

if (!function_exists('wp_body_open')) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open()
	{
		do_action('wp_body_open');
	}
endif;


if (!function_exists('techza_cpt_categories')) :
	/**
	 * This for showing custom post type categories
	 */
	function techza_cpt_categories($taxonomy)
	{
		$terms = get_terms($taxonomy); // Get all terms of a taxonomy
		if ($terms && !is_wp_error($terms)) :
		?>
			<ul class="<?php echo esc_attr($taxonomy) ?> cpt-category">
				<?php foreach ($terms as $term) { ?>
					<li><a href="<?php echo esc_url(get_term_link($term->slug, $taxonomy)); ?>"><?php echo esc_html($term->name); ?></a></li>
				<?php } ?>
			</ul>
<?php endif;
	}
endif;
