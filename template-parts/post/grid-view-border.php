<div class="skeleton-card card-blog-1 hover-up wow animate__ animate__fadeIn animated">
    <?php if (has_post_thumbnail()) : ?>
        <div class="card-image mb-20">
            <?php echo genz_post_format_badge(); ?>
            <a href="<?php the_permalink(); ?>">
                <?php
                printf('<img src="%s" alt="%s" class="img-fluid">', get_the_post_thumbnail_url(get_the_ID(), 'genz-500x280-cropped'), get_the_title());
                ?>
            </a>
        </div>
    <?php endif ?>
    <div class="card-info">
        <?php get_template_part('template-parts/common/post-meta'); ?>
        <a href="<?php the_permalink(); ?>">
            <h4 class="color-white mt-20"><?php the_title() ?></h4>
        </a>
        <?php get_template_part('template-parts/common/post-author-meta'); ?>
        <!-- row -->
    </div>
</div>