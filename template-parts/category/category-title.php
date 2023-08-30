<div class="d-inline-block position-relative">
    <h1 class="color-white mb-20 color-linear wow animate__animated animate__fadeIn">
        <?php single_cat_title() ?>
    </h1>
    <?php
    $category = get_category(get_cat_ID(single_cat_title('', false)));
    $count = $category->category_count;
    $text = sprintf(_n('%s article', '%s articles', $count, 'genz'), $count);
    ?>
    <span class="sticky-badge text-center btn-number-arts"><?php echo esc_attr($text) ?></span>
</div>
<p class="color-gray-500 text-base wow animate__animated animate__fadeIn">
    <?php echo category_description() ?>
</p>