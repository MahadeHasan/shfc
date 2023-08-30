<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */




/**
 * Add a sidebar.
 */
function genz_widgets_init()
{
	register_sidebar([
		'name'          => esc_html__('Blog Sidebar 1', 'genz'),
		'id'            => 'sidebar1',
		'before_widget' => '<div id="%1$s" class="box-sidebar bg-gray-850 border-gray-800 %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="head-sidebar wow animate__ animate__fadeIn animated"><h5 class="line-bottom">',
		'after_title'   => '</h5></div>',
	]);

	//footer Widget
	register_sidebar(array(
		'name'          => __('Footer widget #1', 'genz'),
		'id'            => 'footer-1',
		'description'   => __('Widgets in this area will be shown on all posts and pages in footer', 'genz'),
		'before_widget' => '<div id="%1$s" class="widget about-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h5 class="footer-title text-uppercase">',
		'after_title'   => '</h5>',
	));
	register_sidebar(array(
		'name'          => __('Footer widget #2', 'genz'),
		'id'            => 'footer-2',
		'description'   => __('Widgets in this area will be shown on all posts and pages in footer', 'genz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="text-lg mb-30 color-white wow animate__ animate__fadeInUp animated">',
		'after_title'   => '</h6>',
	));
	register_sidebar(array(
		'name'          => __('Footer widget #3', 'genz'),
		'id'            => 'footer-3',
		'description'   => __('Widgets in this area will be shown on all posts and pages in footer', 'genz'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="text-lg mb-30 color-white wow animate__animated animate__fadeInUp">',
		'after_title'   => '</h6>',
	));
}
add_action('widgets_init', 'genz_widgets_init');
