<div class="skeleton-card card-list-posts wow animate__animated animate__fadeIn">
    <?php if (has_post_thumbnail()) : ?>
        <div class="card-image position-relative hover-up">
            <?php echo genz_post_format_badge(); ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                printf('<img src="%s" alt="%s" class="img-fluid">', get_the_post_thumbnail_url(get_the_ID(), 'genz-270x257-cropped'), get_the_title());

                ?>
            </a>
        </div>
    <?php endif ?>
    <!-- card-image -->
    <div class="card-info">
        <!-- Category -->
        <?php get_template_part('template-parts/common/post-category'); ?>

        <?php if (!empty(get_the_title())) : ?>
            <a href="<?php the_permalink(); ?>">
                <h4 class="mt-15 mb-20 color-white"><?php the_title(); ?></h4>
            </a>
        <?php else : ?>
            <a href="<?php the_permalink(); ?>">
                <h4 class="mt-15 mb-20 color-white"><?php echo get_the_date() ?></h4>
            </a>
        <?php endif ?>

        <p class="color-gray-500  text-sm"><?php the_excerpt() ?></p>
        <!-- post meta -->
        <?php get_template_part('template-parts/common/post-meta'); ?>
    </div>
    <!-- card-info -->
</div>