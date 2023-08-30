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

<div class="box-list-posts mt-40">
    <div class="row">
        <div class="col-lg-8">
            <?php
            $count = 1;
            while (have_posts()) :
                the_post();
                if ($count == 1) {
                    get_template_part('template-parts/post/grid-view');
                } else {
                    get_template_part('template-parts/post/list-view');
                }
            ?>
            <?php $count++;
            endwhile; ?>

            <?php get_template_part('template-parts/common/post-navigation'); ?>
        </div>
        <!-- col-lg-8 -->
        <?php if (is_active_sidebar('sidebar1')) : ?>
            <div class="col-lg-4">
                <div class="sidebar">
                    <?php dynamic_sidebar('sidebar1'); ?>
                </div>
                <!-- sidebar -->
            </div>
        <?php endif; ?>
        <!-- col-lg-4 -->
    </div>
    <!-- row -->
</div>
<!-- box-list-posts -->

<div class="mb-70">
    <div class="mb-50 section-title">
        <h2 class="color-linear d-inline-block mb-10 wow animate__ animate__fadeInUp animated"><?php echo esc_attr__('Popular Tags', 'genz'); ?></h2>
        <p class="text-lg color-gray-500 wow animate__ animate__fadeInUp animated"><?php echo esc_attr__('Most searched keywords', 'genz'); ?></p>
    </div>
    <!-- popular-tags -->
    <?php get_template_part("template-parts/common/popular-tags"); ?>
</div>