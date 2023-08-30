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


?>

<div class="mt-50">
    <div class="row align-items-end mt-50">
        <div class="col-lg-7 mb-20">
            <?php get_template_part('template-parts/category/category-title'); ?>
        </div>
        <!-- col-lg-7 -->
        <div class="col-lg-5 mb-20 text-start text-lg-end">
            <?php get_template_part('template-parts/common/breadcrumb'); ?>
        </div>
        <!-- col-lg-5 genz_custom_breadcrumbs-->
        <div class="col-lg-12">
            <div class="border-bottom border-gray-800 mt-10 mb-30"></div>
        </div>
        <!-- col-lg-12 -->
    </div>
    <!-- row -->

    <div class="row mt-50 mb-10">
        <?php
        while (have_posts()) :
            the_post();
        ?>
            <div class="col-lg-6">
                <?php get_template_part("template-parts/post/grid-view-border"); ?> 
            </div>
            <!-- col-lg-6 -->
        <?php endwhile; ?>
        <!-- Post Pagination -->
        <?php get_template_part('template-parts/common/post-navigation'); ?>
    </div>
    <!-- row -->


</div>
<!-- space -->