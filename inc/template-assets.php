<?php

/**
 * Enqueue scripts and styles.
 *
 * @since genz 1.0
 *
 * @return void
 */
function genz_scripts()
{
	// Google fonts
	wp_enqueue_style('genz-google-fonts', Genz\Google_Fonts::get_google_fonts_url(), [], '1.0');


	wp_enqueue_style('genz-normalize', get_template_directory_uri() . '/assets/css/vendors/normalize.css', false, '1.0');
	wp_enqueue_style('genz-uicons-regular-rounded', get_template_directory_uri() . '/assets/css/vendors/uicons-regular-rounded.css', false, '1.0');
	wp_enqueue_style('swiper-bundle', get_template_directory_uri() . '/assets/css/vendors/swiper-bundle.min.css', false, '9.0.5');
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/vendors/animate.min.css', false, '4.1.1');
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/css/vendors/bootstrap.min.css', false, '1.0');

	if (function_exists('is_woocommerce')) {
		wp_dequeue_style('woocommerce-layout');
		wp_dequeue_style('woocommerce-general');
		wp_dequeue_style('woocommerce-smallscreen');
		wp_enqueue_style('genz-woocommerce', GENZ_ASSETS . '/css/woocommerce.css', false, GENZ_VERSION);
	}

	wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', false, GENZ_VERSION);
	wp_enqueue_style('genz-style', get_template_directory_uri() . '/assets/css/genz.css', false, GENZ_VERSION);

	wp_enqueue_style('genz', get_stylesheet_uri());
	wp_add_inline_style('genz', genz_dynamic_styles());


	// Threaded comment reply styles.
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/assets/js/vendors/bootstrap.bundle.min.js',	false, '5.2.2', true);
	wp_enqueue_script('waypoints', get_template_directory_uri() . '/assets/js/vendors/waypoints.js',	array('jquery'), '1.1.0', true);
	wp_enqueue_script('wow', get_template_directory_uri() . '/assets/js/vendors/wow.js',	array('jquery'), '1.1.3', true);
	wp_enqueue_script('text-type', get_template_directory_uri() . '/assets/js/vendors/text-type.js',	array('jquery'), '1.1.3', true);
	wp_enqueue_script('swiper-bundle.min', get_template_directory_uri() . '/assets/js/vendors/swiper-bundle.min.js',	array('jquery'), '8.4.3', true);
	wp_enqueue_script('progress-scroll', get_template_directory_uri() . '/assets/js/vendors/jquery.progressScroll.min.js',	array('jquery'), '1.0.0', true);

	wp_enqueue_script('genz-main', get_template_directory_uri() . '/assets/js/main.js',	array('jquery', 'jquery-masonry'), GENZ_VERSION, true);
	wp_localize_script('genz-main', 'GENZ', [
		'ajax_url' => admin_url('admin-ajax.php')
	]);
}
add_action('wp_enqueue_scripts', 'genz_scripts');
