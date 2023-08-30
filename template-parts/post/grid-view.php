<div class="skeleton-card card-blog-1 card-blog-2 hover-up wow animate__ animate__fadeIn animated  mb-60">
    <?php if (has_post_thumbnail()) : ?>
        <div class="card-image mb-20">
            <?php echo genz_post_format_badge(); ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                printf('<img src="%s" alt="%s" class="img-fluid">', get_the_post_thumbnail_url(get_the_ID(), 'genz-635x385-cropped'), get_the_title());
                ?>
            </a>
        </div>
    <?php endif ?>
    <div class="card-info">
        <a href="<?php the_permalink(); ?>">
            <h4 class="color-white mt-30"><?php the_title(); ?></h4>
        </a>
        <p class="mt-25 text-lg color-gray-700"><?php the_excerpt(); ?></p>
        <?php get_template_part('template-parts/common/post-author-meta'); ?>
    </div>
</div>