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

<div class="mt-50 mb-50">
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

    <div class="mt-50 mb-50">
        <div class="row mt-50 mb-10">
            <?php
            $count = 1;
            while (have_posts()) :
                the_post();
                if ($count <= 2) {
                    $class = 'col-lg-6';
                } else {
                    $class = 'col-lg-4';
                }
            ?>
                <div class="<?php echo esc_attr($class); ?>">
                    <div class="card-blog-1 hover-up wow animate__animated animate__fadeIn">
                        <?php if (has_post_thumbnail()) : ?>
                        <div class="card-image mb-20">
                            <?php echo genz_post_format_badge(); ?>

                            <a href="<?php the_permalink(); ?>">
                                <?php if ($count >= 3) : ?>
                                <?php the_post_thumbnail('genz-501x282-cropped');
                                else :
                                    the_post_thumbnail('genz-312x193-cropped');
                                endif ?>
                            </a>
                        </div>
                        <!-- card-image -->
                        <?php endif; ?>            
                        <div class="card-info">
                            <?php get_template_part('template-parts/common/post-meta'); ?>
                            <a href="<?php the_permalink(); ?>">
                                <?php if ($count >= 3) : ?>
                                    <h5 class="color-white mt-20"><?php the_title() ?></h5>
                                <?php else : ?>
                                    <h4 class="color-white mt-20"><?php the_title() ?></h4>
                                <?php endif ?>
                            </a>
                            <!-- Author Meta -->
                            <?php get_template_part('template-parts/common/post-author-meta'); ?>
                            <!-- row -->
                        </div>
                        <!-- card-info -->
                    </div>
                    <!-- card-blog -->
                </div>
                <!-- col-lg-6 -->
            <?php $count++;
            endwhile; ?>
        </div>
        <!-- row -->
        <?php get_template_part("template-parts/common/post-navigation"); ?>
    </div>
    <!-- Space -->

    <div class="mb-70 mt-70">
        <div class="mb-50 section-title">
            <h2 class="color-linear d-inline-block mb-10 wow animate__ animate__fadeInUp animated"><?php echo esc_attr__('Popular Tags', 'genz'); ?></h2>
            <p class="text-lg color-gray-500 wow animate__ animate__fadeInUp animated"><?php echo esc_attr__('Most searched keywords', 'genz'); ?></p>

        </div>
        <!-- popular-tags -->
        <?php get_template_part("template-parts/common/popular-tags"); ?>
    </div>
</div>
<!-- space -->
<div class="mb-70"></div>