<?php

namespace TechzaTheme\Inc\Classes;

// File Security Check
if (!defined('ABSPATH')) {
    exit;
}

class Techza_Main
{


    /**
     *
     * Posts loop with essential markup
     *
     */
    public function postMarkupGenerator($layout, $grid)
    {
        // Set the grid layout is fullpage or else

        if (!is_active_sidebar('techza_blog_sidebar')) :
            $this->thePostLoop('col-md-12', $grid, true);
        else :

            if (isset($layout)) :

                if ($layout == 'fullpage') :

                    $this->thePostLoop('col-md-12 ' . $grid, $grid, true);

                elseif ($layout == 'left-sidebar') :

                    $this->getPulledSidebar('col-lg-4 col-md-12 left-sidebar');
                    $this->thePostLoop('col-md-8 ' . $grid, $grid);

                elseif ($layout == 'right-sidebar') :

                    $this->thePostLoop('col-lg-8 col-md-12 ' . $grid, $grid);
                    $this->getPulledSidebar('col-lg-4 col-md-12 right-sidebar');
                endif;

            else :

                $this->thePostLoop('col-lg-8 col-md-12', $grid);
                $this->getPulledSidebar('col-lg-4 col-md-12 right-sidebar col-lg-offset-1');

            endif;

        endif;
    }

    public function getShopPulledSidebar($col_class)
    {
        echo '<div class="' . esc_attr($col_class) . '">';
        echo get_template_part('template-parts/shop-sidebar');
        echo '</div>';
    }

    /**
     *
     * Posts loop with essential markup
     *
     */
    public function thePostLoop($template, $grid, $fullpage = false)
    {
        // Set the grid layout is fullpage or else

        if ($fullpage == true) {
            if (have_posts()) {
                echo '<div class="' . $template . ' post_col"> <div class="row posts-row">';
            } else {
                echo '<div class="' . $template . ' post_col"> <div class="row justify-content-center">';
            }

            $this->postLoop($grid);
            $this->pagination();

            echo '</div></div>';
        } else {

            echo '<div class="' . $template . ' post_col">
						<div class="row posts-row">';

            $this->postLoop($grid);

            echo '</div><div class="row">';

            $this->pagination();

            echo '</div>
	               </div>';
        }
    }

    /**
     *
     * Scorn Post Loop
     * @param   $template || string || accepts template column grid
     *
     */
    public function postLoop($grid)
    {
        if (have_posts()) :

            while (have_posts()) : the_post();

                get_template_part('template-parts/grids/' . $grid);

            endwhile;

        else :
            get_template_part('template-parts/contents/content-none');
        endif;
    }

    public function getPulledSidebar($col_class)
    {
        echo '<div class="' . esc_attr($col_class) . ' blog-sidebar-col">';
        get_sidebar();
        echo '</div>';
    }

    /**
     * Excert data from the content
     */
    public function postExcerpt($limit, $content = null)
    {
        if ($content) {
            $post = $content;
        } else {
            $post = get_the_content();
        }

        $post_content = explode(' ', $post);
        $sliced_content = array_slice($post_content, 0, $limit);
        $return_content = implode(' ', $sliced_content);

        if (count($post_content) > $limit) {
            return $return_content . '... ';
        } else {
            return $return_content;
        }
    }

    /**
     *
     * The WordPress pagination
     *
     */
    public function pagination()
    {

        echo '<div class="col-12"><div class="techza-navigation">';
        the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="fa fa-angle-left ml-10"></i>',
            'next_text' => '<i class="fa fa-angle-right ml-10"></i>',
        ));
        echo '</div></div>';
    }

    public function techza_theContentWithComment()
    {
        echo '<div class="page-content">';

        // The content
        the_content();

        echo '</div>';

        // Wrapper for the comment
        echo '<div class="page-comments">';
        // If comments is open
        if (comments_open()) {
            comments_template();
        }
        echo '</div>';
    }

    /**
     *
     * Get posts
     *
     */
    public static function getPosts($args)
    {

        $posts = new WP_Query(
            array(
                'post_type' => $args['post_type'],
                'posts_per_page' => $args['posts_per_page'],
                'orderby' => $args['orderby'],
                'order' => $args['order'],
            )
        );

        return $posts;
    }

    public function techza_breadcrumb_bridge()
    {
        $techza = get_option('techza');

        if (isset($techza['breadcrumb_on'])) :
            if ($techza['breadcrumb_on'] == true) :
                $this->techza_get_the_breadcrumbs();
            endif;
        else :
            $this->techza_get_the_breadcrumbs();
        endif;
    }

    /**
     *
     * Breadcrumb
     * @return breadcrumb
     */
    public function techza_get_the_breadcrumbs()
    {
        $techza = get_option('techza');
        $title = $this->generateBreadCrumbTitle();

       if(!empty( $techza['blog_breadcrumbs_img']['url'] ) ){
            $techza_blog_image = $techza['blog_breadcrumbs_img']['url'];
       }else{
            $techza_blog_image = ''; 
       }
        
        $output = '<div class="blog-breadcrumb" style="background-image: url('. $techza_blog_image .')">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row text-center justify-content-center">
                        <div class="col-lg-8">
                            ';

        if ($title !== '') {
            $output .= '<h1 class="post__title">' . $title . '</h1>';
        }
       
        $output .= $this->techza_breadcrumbs();
        $output .= '
                        </div>
                    </div>
                </div>
			</div>';

        printf('%s', $output);
    }

    public function generateBreadCrumbTitle()
    {
        $techza = get_option('techza');

        // $title_size = ($settings['title_limit']['size']) ? wp_trim_words(wp_trim_words(get_the_title(), 6, ''), $settings['title_limit']['size'], '...') : wp_trim_words(get_the_title(), 6, '');


        $title_count = wp_trim_words(wp_trim_words(get_the_title(), 6, ''), 6, '');

        $title = '';

        if (is_home() || is_front_page()) {
            $title = isset($techza['bp_title']) ? esc_html($techza['bp_title']) : esc_html__('Our Blog', 'techza');
        } elseif ('case-study' == techza_get_archive_post_type()) {
            $title = isset($techza['cs_title']) ? esc_html($techza['cs_title']) : esc_html__('Case Study', 'techza');
        } elseif ('job' == techza_get_archive_post_type()) {
            $title = isset($techza['job_title']) ? esc_html($techza['job_title']) : esc_html__(' Current job openings', 'techza');
        } elseif (is_page()) {
            $title = wp_trim_words(get_the_title(), 6, '');
        } elseif (is_single()) {
            $title = $title_count;
        }elseif (function_exists('is_shop') && is_shop()) {
            $title = isset($techza['shop_title']) ? esc_html($techza['shop_title']) : esc_html__('Our Products', 'techza');
        } elseif (is_archive()) {
            $title = get_the_archive_title();
        } elseif (is_search()) {
            $title = esc_html__('Search results for: ', 'techza') . get_search_query();
        }elseif(is_404(  )){
            $title = isset($techza['404_title']) ? esc_html($techza['shop_title']) : esc_html__('404', 'techza');
        }

        return $title;
    }

    public static function techza_breadcrumbs()
    {

        $techza = get_option('techza');

        $sepOpt = (isset($techza['breadcrumb_sep']) ? $techza['breadcrumb_sep'] : '<i class="fa fa-angle-right"></i>');

        /* === OPTIONS === */
        $text['home'] = esc_html__('Home', 'techza'); // text for the 'Home' link
        $text['shop'] = esc_html__('Shop', 'techza'); // text for the 'Shop' link
        $text['category'] = esc_html__('Archive by Category "%s"', 'techza'); // text for a category page
        $text['search'] = esc_html__('Search Results for "%s" Query', 'techza'); // text for a search results page
        $text['tag'] = esc_html__('Posts Tagged "%s"', 'techza'); // text for a tag page
        $text['author'] = esc_html__('Articles Posted by %s', 'techza'); // text for an author page
        $text['404'] = esc_html__('Error 404', 'techza'); // text for the 404 page
        $text['page'] = esc_html__('Page %s', 'techza'); // text 'Page N'
        $text['cpage'] = esc_html__('Comment Page %s', 'techza'); // text 'Comment Page N'

        $wrap_before = '<div class="breadcrumbs">'; // the opening wrapper tag
        $wrap_after = '</div><!-- .breadcrumbs -->'; // the closing wrapper tag
        $sep = $sepOpt; // separator between crumbs
        $sep_before = '<span class="sep">'; // tag before separator
        $sep_after = '</span>'; // tag after separator
        $show_home_link = 1; // 1 - show the 'Home' link, 0 - don't show
        $show_on_home = 1; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $show_current = 0; // 1 - show current page title, 0 - don't show
        $before = '<span class="current">'; // tag before the current crumb
        $after = '</span>'; // tag after the current crumb
        $output = '';
        /* === END OF OPTIONS === */

        global $post;
        $home_url = esc_url(home_url('/'));



        $link_before = '<span >';
        $link_after = '</span>';
        $link_attr = '';
        $link_in_before = '<span>';
        $link_in_after = '</span>';
        $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;
        $frontpage_id = get_option('page_on_front');

        if (is_page()) {
            $parent_id = $post->post_parent;
        }
        $sep = ' ' . $sep_before . $sep . $sep_after . ' ';
        $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . ' class="home">' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;


        if (is_home() && is_front_page()) {
            if ($show_on_home) {
                $output .= $wrap_before . $home_link . $wrap_after;

            }elseif(is_home(  )){
                $output .= $sep;
                $output .= $before . sprintf('<a href="%s">%s</a>',  get_permalink( get_option( 'page_for_posts' ) ), wp_title(false, false )) . $after;
            }
        }elseif(is_home() && !is_front_page()){
            $output .= $wrap_before . $home_link ;

            if(is_home(  )){
                $output .= $sep;
                $output .= $before . sprintf('<a href="%s">%s</a>',  get_permalink( get_option( 'page_for_posts' ) ), wp_title(false, false )) . $after;
            }
            $output .= $wrap_after;
        }else {
            $output .= $wrap_before;
            if ($show_home_link) {
                $output .= $home_link;
            }

            if (is_category()) {

                $cat = get_category(get_query_var('cat'), false);
               
                $output .= $sep . $before . sprintf(single_cat_title('', false)) . $after;

                if ($cat->parent != 0) {
                    $cats = get_category_parents($cat->parent, true, $sep);
                    $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                    $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
                    if ($show_home_link) {
                        $output .= $sep;
                        
                    }
                    $output .= $cats;
                }
                
                if (get_query_var('paged')) {
                    $cat = $cat->cat_ID;
                    $output .= $sep . sprintf($link, get_category_link($cat), get_cat_name($cat)) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;

                    
                } else {
                    if ($show_current) {
                        $output .= $sep . $before . sprintf($text['category'], single_cat_title('', false)) . $after;
                        
                    }
                }
            } elseif (is_search()) {
                if (have_posts()) {
                    if ($show_home_link && $show_current) {
                        $output .= $sep;
                    }

                    if ($show_current) {
                        $output .= $before . sprintf($text['search'], get_search_query()) . $after;
                    }

                    $output .= $sep;
                    $output .= $before . get_search_query() . $after;


                } else {
                    if ($show_home_link) {
                        $output .= $sep;
                    }

                    $output .= $before . sprintf($text['search'], get_search_query()) . $after;
                }
            } elseif (is_day()) {
                if ($show_home_link) {
                    $output .= $sep;
                }

                $output .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $sep;
                $output .= sprintf($link, get_month_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
                if ($show_current) {
                    $output .= $sep . $before . get_the_time('d') . $after;
                }
            } elseif (is_month()) {
                if ($show_home_link) {
                    $output .= $sep;
                }

                $output .= sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y'));
                if ($show_current) {
                    $output .= $sep . $before . get_the_time('F') . $after;
                }

                $output .= $sep . $before . get_the_time('m') . $after;

            } elseif (is_year()) {
                if ($show_home_link && $show_current) {
                    $output .= $sep;
                }

                if ($show_current) {
                    $output .= $before . get_the_time('Y') . $after;
                }

                if ($show_home_link ) {
                    $output .= $sep;
                }
               
                $output .= $before . wp_trim_words(get_the_title(), 6, '') . $after;
            


            } elseif (is_single() && !is_attachment()) {
                
                if ($show_home_link) {
                    $output .= $sep;
                }

                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->label;
                    if ($show_current) {
                        $output .= $before . wp_trim_words(get_the_title(), 6, '') . $after;
                    }
                    if(get_post_type_archive_link( get_post_type() )){

                        $output .= sprintf('<a href="%s">%s</a>', get_post_type_archive_link( get_post_type() ), $slug);
                        
                    }else{
                        $output .= sprintf('<span>%s</span>', $slug);
                       
                    }
                } else {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = 'post' == get_post_type(  ) ? wp_trim_words(get_the_title(), 6, '') : $post_type->rewrite ;
                    $cat = get_the_category();
                    if($cat){
                        $cat = $cat[0];
                        $cats = get_category_parents($cat, true, $sep);
                        if (!$show_current || get_query_var('cpage')) {
                            $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                        }
                        $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
                        
                    }
                    $output .= sprintf('<span href="">%s</span>', $slug);
                    
                    if (get_query_var('cpage')) {
                        $output .= $sep . sprintf($link, get_permalink(), wp_trim_words(get_the_title(), 6, '')) . $sep . $before . sprintf($text['cpage'], get_query_var('cpage')) . $after;
                    } else {
                        if ($show_current) {
                            $output .= $before . wp_trim_words(get_the_title(), 6, '') . $after;
                        }
                    }
                }

                // custom post type
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                if (get_query_var('paged')) {
                    $output .= $sep . sprintf($link, get_post_type_archive_link($post_type->name), $post_type->label) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;

                    
                } else {
                    if ($show_current) {
                        $output .= $sep . $before . $post_type->label . $after;
                    }
                }
            } elseif (is_attachment()) {
                if ($show_home_link) {
                    $output .= $sep;
                }

                $parent = get_post($parent_id);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                if ($cat) {
                    $cats = get_category_parents($cat, true, $sep);
                    $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr . '>' . $link_in_before . '$2' . $link_in_after . '</a>' . $link_after, $cats);
                    $output .= $cats;
                }
                printf($link, get_permalink($parent), $parent->post_title);
                if ($show_current) {
                    $output .= $sep . $before . wp_trim_words(get_the_title(), 6, '') . $after;
                }
            } elseif (is_page() && !$parent_id) {
                if ($show_current) {
                    $output .= $sep . $before . wp_trim_words(get_the_title(), 6, '') . $after;
                }
                $output .= $sep . $before . wp_trim_words(get_the_title(), 6, '') . $after;
            } elseif (is_page() && $parent_id) {
                
                if ($show_home_link) {
                    $output .= $sep;
                }


                if ($parent_id != $frontpage_id) {
                    $breadcrumbs = array();
                    while ($parent_id) {
                        $page = get_page($parent_id);
                        if ($parent_id != $frontpage_id) {
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                        }
                        $parent_id = $page->post_parent;
                        
                    }
                    $breadcrumbs = array_reverse($breadcrumbs);
                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        $output .= $breadcrumbs[$i];
                        if ($i != count($breadcrumbs) - 1) {
                            $output .= $sep;
                        }
                    }
                }
                if ($show_current) {
                    $output .= $sep . $before . wp_trim_words(get_the_title(), 6, '') . $after;
                }
            } elseif (is_tag()) {
                
                if (get_query_var('paged')) {
                    $tag_id = get_queried_object_id();
                    $tag = get_tag($tag_id);
                    
                    $output .= $sep . sprintf($link, get_tag_link($tag_id), $tag->name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                } else {
                    if ($show_current) {
                        $output .= $sep . $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
                        
                    }
                }
            } elseif (is_author()) {
                global $author;
                $author = get_userdata($author);
                if (get_query_var('paged')) {
                    if ($show_home_link) {
                        $output .= $sep;
                    }

                    $output .= sprintf($link, get_author_posts_url($author->ID), $author->display_name) . $sep . $before . sprintf($text['page'], get_query_var('paged')) . $after;
                } else {
                    if ($show_home_link && $show_current) {
                        $output .= $sep;
                    }

                    if ($show_current) {
                        $output .= $before . sprintf($text['author'], $author->display_name) . $after;
                    }
                }
            } elseif (is_404()) {
                if ($show_home_link && $show_current) {
                    $output = $sep;
                }

                if ($show_current) {
                    $output .= $before . $text['404'] . $after;
                }
            } elseif (has_post_format() && !is_singular()) {
                if ($show_home_link) {
                    $output .= $sep;
                }

                $output .= get_post_format_string(get_post_format());
            }

            $output .= $wrap_after;

        }
        return $output;
    }
}

$techzaObj = new Techza_Main;
