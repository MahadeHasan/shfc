<?php
require_once __DIR__ . '/classes/class-svg-icons.php';

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

/**
 * Header logo
 *
 * @since genz 1.0.0
 *
 * @return string
 */
if (!function_exists('genz_get_logo')) :
    function genz_get_logo()
    {
        $logo = get_theme_file_uri('assets/imgs/template/logo.svg');
        if (!has_custom_logo()) return $logo;

        $custom_logo_id = get_theme_mod('custom_logo');

        $image = wp_get_attachment_image_src($custom_logo_id, 'full');

        if (empty($image[0]) || is_wp_error($image)) return $logo;

        $logo = $image[0];

        return $logo;
    }
endif;


/**
 * Adds custom classes to the array of body classes.
 *
 * @since genz 1.0
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function genz_body_classes($classes)
{

    // Helps detect if JS is enabled or not.
    $classes[] = 'no-js';

    // Adds `singular` to singular pages, and `hfeed` to all other pages.
    $classes[] = is_singular() ? 'singular' : 'hfeed';

    // Add a body class if main navigation is active.
    if (has_nav_menu('primary')) {
        $classes[] = 'has-main-navigation';
    }

    // Add a body class if there are no footer widgets.
    if (!is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-widgets';
    }

    return $classes;
}
add_filter('body_class', 'genz_body_classes');

if (!function_exists('genz_sticky_bage')) {
    function genz_sticky_bage($post_id = null)
    {
        if ($post_id == null) $post_id = get_the_ID();

        if (!is_sticky()) return;

        $sticky_text = get_theme_mod('sticky_text', 'Featured');

        echo '<span class="sticky-badge mb-1">' . esc_attr($sticky_text) . '</span>';
    }
}


//Post Pagination
add_filter('paginate_links_output', 'genz_paginate_links_output', 10, 2);
function genz_paginate_links_output($output, $args)
{
    global $wp_query, $wp_rewrite;

    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode(get_pagenum_link());
    $url_parts    = explode('?', $pagenum_link);

    // Get max pages and current page out of the current query, if available.
    $total   = isset($wp_query->max_num_pages) ? $wp_query->max_num_pages : 1;
    $current = get_query_var('paged') ? (int) get_query_var('paged') : 1;

    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit($url_parts[0]) . '%_%';

    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && !strpos($pagenum_link, 'index.php') ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit($wp_rewrite->pagination_base . '/%#%', 'paged') : '?paged=%#%';

    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => '',
        'next_text'          => '',
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'list',
        'list_class'         => 'pagination',
        'list_li_class'      => 'page-item wow animate__animated animate__fadeIn',
        'list_link_class'      => 'page-link',
        'active_class'      => 'active',
        'add_args'           => array(), // Array of query args to add.
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
        'before'  => '',
        'after'  => '',
    );



    $args = wp_parse_args($args, $defaults);

    if (!is_array($args['add_args'])) {
        $args['add_args'] = array();
    }

    // Merge additional query vars found in the original URL into 'add_args' array.
    if (isset($url_parts[1])) {
        // Find the format argument.
        $format       = explode('?', str_replace('%_%', $args['format'], $args['base']));
        $format_query = isset($format[1]) ? $format[1] : '';
        wp_parse_str($format_query, $format_args);

        // Find the query args of the requested URL.
        wp_parse_str($url_parts[1], $url_query_args);

        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ($format_args as $format_arg => $format_arg_value) {
            unset($url_query_args[$format_arg]);
        }

        $args['add_args'] = array_merge($args['add_args'], urlencode_deep($url_query_args));
    }

    // Who knows what else people pass in $args.
    $total = (int) $args['total'];
    if ($total < 2) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
    if ($end_size < 1) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ($mid_size < 0) {
        $mid_size = 2;
    }

    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;
    $li_start = $args['type'] == 'list' ? '<li>' : '';
    $li_end = $args['type'] == 'list' ? '</li>' : '';

    if ($args['prev_next'] && $current && 1 < $current) :
        $link = str_replace('%_%', 2 == $current ? '' : $args['format'], $args['base']);
        $link = str_replace('%#%', $current - 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];

        $prev_class = is_rtl() ? 'page-link page-next' : 'page-link page-prev';
        $page_links[] = sprintf(
            '%3$s<a class="%1$s" href="%2$s"><i class="fi-rr-arrow-small-left"></i></a>%4$s',
            $prev_class,
            esc_url(apply_filters('paginate_links', $link)),
            $li_start,
            $li_end
        );
    endif;

    for ($n = 1; $n <= $total; $n++) :
        if ($n == $current) :
            $active_li_class = $args['list_link_class'] . ' ' . $args['active_class'];
            $page_links[] = sprintf(
                '%3$s<a class="%1$s" href="">%2$s</a>%4$s',
                $active_li_class,
                $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number'],
                $li_start,
                $li_end
            );

            $dots = true;
        else :
            if ($args['show_all'] || ($n <= $end_size || ($current && $n >= $current - $mid_size && $n <= $current + $mid_size) || $n > $total - $end_size)) :
                $link = str_replace('%_%', 1 == $n ? '' : $args['format'], $args['base']);
                $link = str_replace('%#%', $n, $link);
                if ($add_args) {
                    $link = add_query_arg($add_args, $link);
                }
                $link .= $args['add_fragment'];

                $page_links[] = sprintf(
                    '%4$s<a class="%1$s" href="%2$s">%3$s</a>%5$s',
                    /** This filter is documented in wp-includes/general-template.php */
                    $args['list_link_class'],
                    esc_url(apply_filters('paginate_links', $link)),
                    $args['before_page_number'] . number_format_i18n($n) . $args['after_page_number'],
                    $li_start,
                    $li_end
                );

                $dots = true;
            elseif ($dots && !$args['show_all']) :
                $page_links[] = sprintf(
                    '%2$s<a class="page-link %1$s dots">' . esc_attr__('&hellip;', 'genz') . '</a>%3$s',
                    $args['list_link_class'],
                    $li_start,
                    $li_end
                );

                $dots = false;
            endif;
        endif;
    endfor;

    if ($args['prev_next'] && $current && $current < $total) :
        $link = str_replace('%_%', $args['format'], $args['base']);
        $link = str_replace('%#%', $current + 1, $link);
        if ($add_args) {
            $link = add_query_arg($add_args, $link);
        }
        $link .= $args['add_fragment'];

        $next_class = is_rtl() ? 'page-link page-prev' : 'page-link page-next';
        $page_links[] = sprintf(
            '%3$s<a class="%1$s" href="%2$s"><i class="fi-rr-arrow-small-right"></i></a>%4$s',
            $next_class,
            esc_url(apply_filters('paginate_links', $link)),
            $li_start,
            $li_end
        );
    endif;

    switch ($args['type']) {
        case 'array':
            return $page_links;

        case 'list':

            $r .= sprintf("<div class='paginations'><ul class='%s'>\n\t", $args['list_class']);
            $r .= implode("\n", $page_links);
            $r .= "\n</ul></div>\n";
            break;

        default:
            $r = implode("\n", $page_links);
            break;
    }

    /**
     * Filters the HTML output of paginated links for archives.
     *
     * @since 5.7.0
     *
     * @param string $r    HTML output.
     * @param array  $args An array of arguments. See paginate_links()
     *                     for information on accepted arguments.
     */
    $output = apply_filters('genz_paginate_links_output', $r, $args);

    return $output;
}

// Post tags 
function genz_post_tags()
{
    $post_tags = get_the_tags();
    $tags = [];
    if (!empty($post_tags)) {
        foreach ($post_tags as $post_tag) {
            $tags[] = '<a class="color-gray-700 text-sm" href="' . get_tag_link($post_tag) . '">#' . $post_tag->name . '</a>';
        }
    }
    echo implode(' ', $tags);
}

// Post tags 
function genz_post_tags_style2()
{
    $post_tags = get_the_tags();
    if (!empty($post_tags)) {
        foreach ($post_tags as $post_tag) {
            echo '<a class="btn btn-tags bg-gray-850 border-gray-800 mr-10 hover-up" href="' . get_tag_link($post_tag) . '">' . $post_tag->name . '</a>';
        }
    }
}


/* Word read count */
if (!function_exists('genz_get_post_reading_time')) :
    function genz_get_post_reading_time($post_id = NULL, $args = [])
    {
        $args = wp_parse_args($args, [
            'before' => '',
            'after' => '',
            'singular' => esc_attr_x('min to read', 'Singlular form of minute', 'genz'),
            'plural' => esc_attr_x('mins to read', 'Plural form of minute', 'genz'),
        ]);
        $output = '';

        if (empty($post_id)) $post_id = get_the_ID();

        $content = get_post_field('post_content', $post_id);
        $word_count = str_word_count(strip_tags($content));
        if (empty($word_count)) return $output;

        $readingtime = ceil($word_count / 200);
        if ($readingtime == 1) {
            $timer = $args['singular'];
        } else {
            $timer = $args['plural'];
        }
        $output = $args['before'] . $readingtime . " " . $timer . $args['after'];
        return $output;
    }
endif;


//post formats
function genz_post_format_badge()
{
    $post_id = get_the_ID();
    $post_format = get_post_format($post_id);

    if (empty($post_format) || in_array($post_format, ['standard', 'image'])) {
        return '';
    }

    $class = 'post-type ';
    if ($post_format == 'gallery') {
        $class .= "post-image";
    }
    if ($post_format == 'audio') {
        $class .= "post-audio";
    }
    if ($post_format == 'video') {
        $class .= "post-video";
    }
    if ($post_format == 'quote') {
        $class .= "post-quote";
    }
    if ($post_format == 'link') {
        $class .= "post-link";
    }
    $html = '<a class="' . $class . '" href="' . get_the_permalink() . '"></a>';

    return $html;
}

// Category image taxtonomoy size
if (!function_exists('genz_category_image')) {
    function genz_category_image($term_id, $key, $size = 'full')
    {
        if (!function_exists('ctrlbp_meta') || empty($term_id) || empty($key)) return;

        $cat_image_id = ctrlbp_meta($key, ['object_type' => 'post'], $term_id);
        if (!empty($cat_image_id) && !is_wp_error($cat_image_id)) {
            $cat_image = wp_get_attachment_image_src($cat_image_id, $size);
            $cat_image_url = (!is_wp_error($cat_image) || !empty($cat_image)) ?  $cat_image[0] : '';
        } else {
            $cat_image_url = '';
        }
        return $cat_image_url;
    }
}



add_filter('ctrlbp_meta_boxes', 'genz_register_taxonomy_meta_boxes');
function genz_register_taxonomy_meta_boxes($meta_boxes)
{
    $meta_boxes[] = array(
        'title'      => '',
        'taxonomies' => 'category',
        'fields' => array(
            array(
                'name' =>  esc_attr__('Category Image', 'genz'),
                'id'   => 'category_image',
                'type' => 'single_image',
                'admin_columns' => array(
                    'position' => 'after name',
                    'title' => 'Image'
                )
            ),
            // Category Template
            array(
                'name' =>  esc_attr__('Category Template', 'genz'),
                'id'   => 'cat_archive_template',
                'type' => 'select',
                'std'  =>   '',
                'options' => array(
                    ''           => esc_attr__('Select Templete', 'genz'),
                    'style1'     => esc_attr__('Template Style 1', 'genz'),
                    'style2'     => esc_attr__('Template Style 2', 'genz'),
                    'style3'     => esc_attr__('Template Style 3', 'genz'),
                    'style4'     => esc_attr__('Template Style 4', 'genz'),
                    'style5'     => esc_attr__('Template Style 5', 'genz'),
                )
            ),
        ),
    );
    $meta_boxes[] = array(
        'title'      => '',
        'taxonomies' => ['post_tag', 'portfolio_cat'],
        'fields' => array(
            array(
                'name' =>  esc_attr__('Image', 'genz'),
                'id'   => 'tag_image',
                'type' => 'single_image',
                'admin_columns' => array(
                    'position' => 'after name',
                    'title' => 'Image'
                )
            ),
        ),
    );

    return $meta_boxes;
}




// Header option function
function genz_get_header_args()
{
    $default =  array(
        'display_search' => false,
        'disable_color_mode_switcher' => false,
        'search_placeholder' => esc_attr__('Search', 'genz'),
        'display_popular_terms' =>  true,
        'search_popular_type' => 'post_tag',
        'search_popular_text' => esc_attr__('Pupular text', 'genz'),
        'display_button' => false,
        'button_link' => '#',
        'button_text' => esc_attr__('Subscribe', 'genz'),
    );
    $args =  array(
        'display_search' => get_theme_mod('display_navbar_search'),
        'disable_color_mode_switcher' => get_theme_mod('disable_color_mode_switcher', false),
        'search_placeholder' => get_theme_mod('navbar_search_placeholder'),
        'display_popular_terms' => get_theme_mod('navbar_display_popular_terms'),
        'search_popular_type' => get_theme_mod('navbar_search_popular_type'),
        'search_popular_text' => get_theme_mod('navbar_search_popular_text'),
        'display_button' => get_theme_mod('display_navbar_button'),
        'button_link' => get_theme_mod('navbar_button_link'),
        'button_text' => get_theme_mod('navbar_button_text'),

    );
    return wp_parse_args($args, $default);
}

add_action('wp_head', 'genz_load_global_variables');
function genz_load_global_variables()
{
    $GLOBALS['genz_header'] = genz_get_header_args();
}

function genz_get_term_meta($term_id, $meta_key, $default = NULL)
{
    if (!function_exists('ctrlbp_meta')) return $default;
    return ctrlbp_meta($meta_key, ['object_type' => 'taxonomy'], $term_id);
}


/**
 * Footer Social Media with SVG icon.
 *
 * @since Genz 1.0
 *
 * @param string $group The icon group.
 * @param string $icon  The icon.
 * @param int    $size  The icon size in pixels.
 * @return string
 */
function genz_get_icon_svg($group, $icon, $size = 24)
{
    return Genz_SVG_Icons::get_svg($group, $icon, $size);
}

/**
 * Detects the social network from a URL and returns the SVG code for its icon.
 *
 * @since Genz 1.0
 *
 * @param string $uri  Social link.
 * @param int    $size The icon size in pixels.
 * @return string
 */
function genz_get_social_link_svg($uri, $size = 24, $show_title = true)
{
    return Genz_SVG_Icons::get_social_link_svg($uri, $size, $show_title);
}
/**
 * Displays SVG icons in the footer navigation.
 *
 * @param string   $item_output The menu item's starting HTML output.
 * @param WP_Post  $item        Menu item data object.
 * @param int      $depth       Depth of the menu. Used for padding.
 * @param stdClass $args        An object of wp_nav_menu() arguments.
 * @return string The menu item output with social icon.
 */
function genz_nav_menu_social_icons($item_output, $item, $depth, $args)
{
    // Change SVG icon inside social links menu if there is supported URL.
    if ('footer' === $args->theme_location) {
        $svg = genz_get_social_link_svg($item->url, 24);
        if (!empty($svg)) {
            $item_output = str_replace($args->link_before, $svg, $item_output);
        }
    }

    return $item_output;
}

add_filter('walker_nav_menu_start_el', 'genz_nav_menu_social_icons', 10, 4);

function genz_footer_nav_menu_link_attributes($atts, $menu_item, $args, $depth)
{
    if ('footer' === $args->theme_location) {
        //print_r($atts);
        $new_class = 'color-gray-500 d-flex align-items-center gap-1';

        $atts['class'] = !empty($atts['class']) ? $new_class . ' ' . $atts['class'] : $new_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'genz_footer_nav_menu_link_attributes', 10, 4);




//Category image
function genz_list_cats($output, $category)
{
    if (empty($category) || $category == null) return;
    if (!is_admin()) {
        $attachment_id = genz_get_term_meta($category->term_id, 'category_image');
        $image_url = wp_get_attachment_image_url($attachment_id, 'thumbnail');
        if (!empty($image_url)) {
            $output = '<div class="d-inline-flex  align-items-center gap-2"><img class="rounded-circle" src="' . esc_url($image_url) . '" width="32" height="32" alt="' . esc_attr($category->name) . '">' . $output . '</div>';
        }
    }

    return $output;
}
add_filter('list_cats', 'genz_list_cats', 10, 2);

function genz_get_the_term_list($post_id, $taxonomy, $before = '', $sep = '', $after = '', $link_html = true)
{
    $terms = get_the_terms($post_id, $taxonomy);

    if (is_wp_error($terms)) {
        return $terms;
    }

    if (empty($terms)) {
        return false;
    }

    $links = array();

    foreach ($terms as $term) {
        $link = get_term_link($term, $taxonomy);
        if (is_wp_error($link)) {
            return $link;
        }
        $links[] = $link_html ? '<a href="' . esc_url($link) . '" rel="tag">' . $term->name . '</a>' : $term->slug;
    }

    /**
     * Filters the term links for a given taxonomy.
     *
     * The dynamic portion of the hook name, `$taxonomy`, refers
     * to the taxonomy slug.
     *
     * Possible hook names include:
     *
     *  - `term_links-category`
     *  - `term_links-post_tag`
     *  - `term_links-post_format`
     *
     * @since 2.5.0
     *
     * @param string[] $links An array of term links.
     */
    $term_links = apply_filters("genz_term_links-{$taxonomy}", $links);  // phpcs:ignore WordPress.NamingConventions.ValidHookName.UseUnderscores

    return $before . implode($sep, $term_links) . $after;
}


if (!function_exists('genz_return_data')) {
    function genz_return_data($data)
    {
        return $data;
    }
}
if (!function_exists('genz_primary_menu_fallback')) {
    function genz_primary_menu_fallback()
    {
        if (!is_user_logged_in()) return;

        echo '<div class="d-block menu-fallback"><ul class="navbar-nav main-menu"><li class="nav-item"><a class="color-gray-500" href="' . admin_url('nav-menus.php') . '">' . esc_attr__('Add menu', 'genz') . '</a></li></ul></div>';
    }
}

/**
 * Change the excerpt more string
 */
function genz_excerpt_more($more)
{
    return '&hellip;';
}
add_filter('excerpt_more', 'genz_excerpt_more');


function genz_the_password_form($output, $post)
{
    $post   = get_post($post);
    $label  = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
    $output = '<form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" class="post-password-form" method="post">
	<p>' . esc_attr__('This content is password protected. To view it please enter your password below:', 'genz') . '</p>
	<p><label for="' . $label . '">' . esc_attr__('Password:', 'genz') . ' <input  class="form-control mt-2" name="post_password" id="' . $label . '" type="password" size="20" /></label> <input class="btn btn-linear" type="submit" name="' . esc_attr__('Submit', 'genz') . '" value="' . esc_attr_x('Enter', 'post password form', 'genz') . '" /></p></form>
	';

    return apply_filters('genz_the_password_form', $output, $post);
}
add_filter('the_password_form', 'genz_the_password_form', 999, 2);

function genz_get_color_mode()
{
    $color_mode = get_theme_mod('default_color_mode', 'theme--dark');

    return empty($color_mode) ? 'theme--dark' : $color_mode;
}

function genz_color_mode_attributes()
{
    echo 'data-theme="' . esc_attr(genz_get_color_mode()) . '"';
}


//post title

function genz_post_title()
{
    $title_tag = get_theme_mod('post_title_tag', 'h2');
    echo '<' . esc_attr($title_tag) . ' class="color-linear mb-30 text-heading-2">' . get_the_title() . '</' . esc_attr($title_tag) . '>';
}

function read_more_text()
{
    $read_more_text = get_theme_mod('read_more_text', 'Read more');
    echo $read_more_text;
}


add_action('wp_ajax_genz_posts_action', 'genz_posts_action_callback');
add_action('wp_ajax_nopriv_genz_posts_action', 'genz_posts_action_callback');
function genz_posts_action_callback()
{
    $paged = $_POST['paged'];
    add_query_arg('paged', $paged);
    $settings = json_decode(base64_decode($_POST['settings']), true);
    $settings['paged'] = $paged;
    genz_framework_template('elements/posts', '', $settings);

    wp_die();
}
