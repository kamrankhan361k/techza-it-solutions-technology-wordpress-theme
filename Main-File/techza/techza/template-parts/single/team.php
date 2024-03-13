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
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-md-10 col-sm-12">
                <div class="techza-team-wrap">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="team-thumnbnail-wrap">
                            <?php techza_post_thumbnail(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="team-content">
                        <div class="techza-team-title">
                            <?php the_title('<h1>', '</h1>'); ?>
                            <?php if (!empty(get_field('position'))) : ?>
                                <span class="team-position"><?php the_field('position') ?></span>
                            <?php endif; ?>
                        </div>
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
                        if (have_rows('social_links')) : ?>
                            <div class="team-social-links">
                                <?php while (have_rows('social_links')) : the_row(); ?>
                                    <a href="<?php echo get_sub_field('url') ?>" class="social-item"><?php echo get_sub_field('icon') ?></a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->