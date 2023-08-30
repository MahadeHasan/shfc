<?php
/* 
* Template Name: Home Template
* Template Post Type: page  
*
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

get_header();

get_template_part('template-parts/content/before');


get_template_part('template-parts/content/content-page');


get_template_part('template-parts/content/after');

get_footer();
