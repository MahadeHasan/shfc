<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package genz
 */

get_header();
get_template_part('template-parts/content/before');
?> 

    <?php
    $template = genz_get_term_meta(get_cat_ID(single_cat_title('', false)), 'cat_archive_template');
    get_template_part('template-parts/category/category', $template);

    ?> 
 
<?php
get_template_part('template-parts/content/after');

get_footer(); ?>