<div class="skeleton-card card-style-1 hover-up mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
    <div class="card-image">
        <?php if (has_post_thumbnail()) : ?>

            <a class="link-post" href="<?php the_permalink(); ?>">
                <?php echo genz_post_format_badge(); ?>
                <?php
                printf('<img src="%s" alt="%s" class="img-fluid">', get_the_post_thumbnail_url(get_the_ID(), 'genz-353x417-cropped'), get_the_title());
                ?>
            </a>

        <?php endif ?>

        <div class="card-info card-bg-2">
            <div class="info-bottom mb-15">
                <h4 class="color-white mb-15"><a href="<?php the_permalink(); ?>E"><?php the_title(); ?></a></h4>
                <div class="box-author">
                    <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['width' => 48, 'height' => 48]); ?>
                    <div class="author-info lh-1">
                        <h6 class="mr-15 color-gray-500"><?php the_author_posts_link(); ?></h6>
                        <span class="color-gray-700 text-sm"><?php echo get_the_date(); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>