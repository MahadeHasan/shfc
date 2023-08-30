<div id="post-<?php the_ID(); ?>" <?php post_class('project'); ?> data-category="<?php echo genz_get_the_term_list(get_the_ID(), 'portfolio_cat', '', ' ', '', false); ?>">
    <div class="item-content">
        <div class="card-style-1 hover-up mb-30" data-wow-delay=".0s">
            <div class="card-image">
                <a class="link-post" href="<?php the_permalink() ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('genz-354x350-cropped'); ?>
                    <?php endif ?>
                    <div class="card-info card-bg-2">
                        <div class="info-bottom mb-15">
                            <h3 class="color-white mb-10"><?php the_title(); ?></h3>
                            <p class="color-white text-md"><?php the_excerpt(); ?></p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>