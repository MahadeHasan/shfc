<div class="skeleton-card card-list-posts card-list-posts-small mb-30 wow animate__ animate__fadeIn animated">
    <?php if (has_post_thumbnail()) : ?>
        <div class=" card-image hover-up">
            <a href="<?php the_permalink(); ?>">
                <?php
                printf('<img src="%s" alt="%s" class="img-fluid">', get_the_post_thumbnail_url(get_the_ID(), 'genz-170x137-cropped'), get_the_title());
                ?>
            </a>
        </div>
    <?php endif ?>
    <!-- card-image -->
    <div class="card-info">
        <!-- Category -->
        <?php get_template_part('template-parts/common/post-category'); ?>
        <a href="<?php the_permalink(); ?>">
            <h5 class="mb-10 mt-10 color-white"><?php the_title(); ?></h5>
        </a>
        <div class="row mt-10">
            <div class="col-12">
                <span class="calendar-icon color-gray-700 text-sm mr-15"><?php echo get_the_date(); ?></span>
                <span class="color-gray-700 text-sm timeread"> <?php echo genz_get_post_reading_time() ?></span>
            </div>
        </div>
    </div>
</div>