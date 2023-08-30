<div class="row align-items-center mt-25">
    <div class="col-7 pe-0">
        <div class="box-author">
            <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['width' => 48, 'height' => 48]); ?>
            <div class="author-info lh-1">
                <h6 class="color-gray-500"><?php the_author_posts_link(); ?></h6>
                <span class="color-gray-700 text-sm"><?php echo get_the_date(); ?></span>
            </div>
        </div>
    </div>
    <div class="col-5 text-end">
        <a class="readmore color-gray-500 text-sm" href="<?php the_permalink(); ?>"><span> <?php read_more_text(); ?></span></a>
    </div>
</div>
<!-- row -->