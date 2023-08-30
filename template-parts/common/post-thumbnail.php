<div class="card-image mb-20">
    <?php if (has_post_thumbnail()) : ?>
        <?php echo genz_post_format_badge(); ?>
        <a href="<?php the_permalink(); ?>">
            <?php
            printf('<img src="%s" alt="%s" class="img-fluid">', get_the_post_thumbnail_url(get_the_ID(), 'genz-500x280-cropped'), get_the_title());
            ?>
        </a>
    <?php endif ?>
</div>