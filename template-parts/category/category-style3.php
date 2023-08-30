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
    <div class="col-lg-8 mx-auto text-center">
        <div class="d-inline-block position-relative">
            <h1 class="color-white mb-10 color-linear wow animate__animated animate__fadeIn"><?php single_cat_title() ?></h1>
        </div>
        <p class="color-gray-500 text-base mb-20 wow animate__animated animate__fadeIn"> <?php echo category_description() ?></p>
    </div>
    <!-- col-lg-12 -->
    <div class="col-lg-12 text-center">
        <?php get_template_part('template-parts/common/breadcrumb'); ?>
    </div>
    <!-- col-lg-12 -->
    <div class="col-lg-12">
        <div class="border-bottom border-gray-800 mt-30 mb-30"></div>
    </div>
    <!-- col-lg-12 -->
</div>
<!-- row -->

<div class="box-list-posts mt-40">
    <div class="row">
        <div class="col-lg-9 m-auto">
            <div class="box-list-posts mt-30">
                <?php
                while (have_posts()) :
                    the_post();
                ?>
                    <div class="card-list-posts card-list-posts-small border-bottom border-gray-800 pb-30 mb-30 wow animate__animated animate__fadeIn">
                        <div class="card-image hover-up">
                            <div class="box-author mb-20">
                                <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['width' => 48, 'height' => 48]); ?>
                                <div class="author-info lh-1">
                                    <h6 class="color-gray-500"><?php the_author_posts_link(); ?></h6>
                                    <span class="color-gray-700 text-sm"><?php the_date(); ?></span>
                                </div>
                            </div>

                            <?php
                            $categories = get_the_terms($post->ID, 'category');
                            if (!empty($categories[0]->name)) :  ?>
                                <a class="btn btn-tag bg-gray-800 hover-up" href="<?php echo esc_attr(get_category_link($categories[0]->term_id)); ?>">
                                    <?php echo esc_attr($categories[0]->name); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="card-info">
                            <a href="<?php the_permalink() ?>">
                                <h3 class="mb-20 color-white"><?php the_title(); ?></h3>
                            </a>
                            <p class="color-gray-500"><?php the_excerpt(); ?></p>
                            <?php get_template_part("template-parts/common/post-meta"); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php get_template_part("template-parts/common/post-navigation"); ?>
        </div>
        <!-- col-lg-8 -->
    </div>
    <!-- row -->
</div>
<!-- box-list-posts -->