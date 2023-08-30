<?php
$title = get_post_meta(get_the_ID(), 'project_info_title', true);
$project_info = get_post_meta(get_the_ID(), 'project_info', true);

?>
<div class="box-sidebar bg-gray-850 border-gray-800">
    <div class="head-sidebar wow animate__animated animate__fadeIn">
        <h5 class="line-bottom"><?php echo esc_attr($title) ?></h5>
    </div>
    <div class="content-sidebar">
        <div class="list-comments">
            <div class="item-comment border-gray-800 wow animate__animated animate__fadeIn">
                <p class="color-gray-200 mb-10 text-uppercase"><?php echo esc_attr__('Category', 'genz') ?></p>
                <?php echo get_the_term_list(get_the_ID(), 'portfolio_cat', '<p class="color-gray-500">', ', ', '</p>'); ?>
            </div>
            <?php if (!empty($project_info)) :
                foreach ($project_info as $value) :
                    if (empty($value[0]) || empty($value[1])) continue;
            ?>
                    <div class="item-comment border-gray-800 wow animate__animated animate__fadeIn">
                        <p class="color-gray-200 mb-10 text-uppercase"><?php echo esc_attr($value[0]) ?></p>
                        <p class="color-gray-500"><?php echo esc_attr($value[1]) ?></p>
                    </div>
            <?php
                endforeach;
            endif;
            ?>

        </div>
    </div>
</div>