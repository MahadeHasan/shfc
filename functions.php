<?php

/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0.8
 */

define('GENZ_VERSION', '1.0.8');
define('GENZ_URI', get_template_directory_uri());
define('GENZ_DIR', get_template_directory());
define('GENZ_ASSETS', GENZ_URI . '/assets');


// theme required plugins
require get_template_directory() . '/inc/tgmpa/plugins.php';

// Enhance the theme assets
require get_template_directory() . '/inc/template-assets.php';

// Enhance the theme by hooking into WordPress.
require get_template_directory() . '/inc/admin-functions.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/comment-functions.php';
require get_template_directory() . '/inc/custom-meta-fields.php';

require get_template_directory() . '/inc/genz-widgets.php';
require get_template_directory() . '/inc/breadcums.php';




if (!function_exists('genz_setup')) {
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 *
	 * @since genz 1.0
	 *
	 * @return void
	 */
	function genz_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on genz, use a find and replace
		 * to change 'genz' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('genz', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * This theme does not use a hard-coded <title> tag in the document head,
		 * WordPress will provide it for us.
		 */
		add_theme_support('title-tag');

		/**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);
		add_theme_support('woocommerce');
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(1568, 9999);

		add_image_size('portfolio-thumbnail', 432, 498, true);
		add_image_size('genz-540x305-cropped', 540, 305, true);
		add_image_size('genz-501x282-cropped', 501, 282, true);
		add_image_size('genz-312x193-cropped', 312, 193, true);
		add_image_size('genz-170x137-cropped', 170, 137, true);
		add_image_size('genz-170x180-cropped', 170, 180, true);
		add_image_size('genz-635x385-cropped', 635, 385, true);
		add_image_size('genz-1009x450-cropped', 1009, 450, true);
		add_image_size('genz-996x618-cropped', 996, 618, true);
		add_image_size('genz-270x257-cropped', 270, 257, true);
		add_image_size('genz-354x350-cropped', 354, 350, true);
		add_image_size('genz-525x674-cropped', 525, 674, true);
		add_image_size('genz-597x314-cropped', 597, 314, true);
		add_image_size('genz-353x417-cropped', 353, 417, true);
		add_image_size('genz-500x280-cropped', 500, 280, true);
		add_image_size('genz-813x774-cropped', 813, 774, true);

		register_nav_menus(
			array(
				'primary' => esc_html__('Primary menu', 'genz'),
				'footer'  => esc_html__('Footer menu', 'genz')
			)
		);


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		$logo_width  = 120;
		$logo_height = 100;

		add_theme_support(
			'custom-logo',
			array(
				'height'               => $logo_height,
				'width'                => $logo_width,
				'flex-width'           => true,
				'flex-height'          => true,
				'unlink-homepage-logo' => true,
			)
		);

		// Add theme support for selective refresh for widgets.
		//add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support('wp-block-styles');

		// Add support for custom units.
		// This was removed in WordPress 5.6 but is still required to properly support WP 5.5.
		add_theme_support('custom-units');

		// Remove feed icon link from legacy RSS widget.
		add_filter('rss_widget_feed_link', '__return_false');

		// Enqueue editor styles.
		$font_url = Genz\Google_Fonts::get_google_fonts_url();
		add_editor_style($font_url);
		add_editor_style('./assets/css/style-editor.css');

		$GLOBALS['content_width'] = apply_filters('genz_content_width', 750);

		add_theme_support('control-block-patterns');
	}
}
add_action('after_setup_theme', 'genz_setup');

/*
* If you need to add custom class in li 
*/
function genz_nav_menu_link_attributes($atts, $item, $args)
{

	if (!isset($atts['class'])) $atts['class'] = '';
	// check if the item is in the primary menu
	if ($args->theme_location == 'primary') {
		// add the desired attributes:
		$atts['class'] = 'color-gray-500';
	}
	if (in_array('current-menu-item', $item->classes)) {
		$atts['class'] .= ' active';
	}

	return $atts;
}
add_filter('nav_menu_link_attributes', 'genz_nav_menu_link_attributes', 10, 3);

/*
* If you need to add custom class beside a-->  .nav link 
*/
function genz_nav_menu_css_class($classes)
{

	if (in_array('menu-item-has-children', $classes)) {
		$classes[] = 'has-children';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'genz_nav_menu_css_class');

//Cusst Menu item a active class 
function genz_special_nav_class($classes)
{
	if (in_array('current-menu-item', $classes)) {
		$classes[] = 'active ';
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'genz_special_nav_class');


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

// Remove Auto P tag
remove_action("term_description", "wpautop");

function genz_excerpt_length($excerpt)
{
	if (has_excerpt()) {
		$length = get_theme_mod('excerpt_length', 24);
		$excerpt = wp_trim_words(get_the_excerpt(), $length);
	}
	return $excerpt;
}
add_filter("the_excerpt", "genz_excerpt_length", 999);

add_action('admin_init', 'genz_fetch_google_fonts');
function genz_fetch_google_fonts()
{
	Genz\Google_Fonts::fetch_google_fonts();
}
