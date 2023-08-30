<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

get_header();

get_template_part('template-parts/content/before');

/* Start the Loop */
while (have_posts()) :
	the_post();
	get_template_part('template-parts/post/content-single');

endwhile;
// End of the loop.

get_template_part('template-parts/content/after');

get_footer();
