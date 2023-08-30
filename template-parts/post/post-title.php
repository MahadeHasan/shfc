<?php
extract(wp_parse_args($args, [
    'title' => esc_attr__('Recent posts', 'genz'),
    'subtitle' => esc_attr__('Don\'t miss the latest trends', 'genz'),
]));
?>


<?php if (!empty($title) || !empty($subtitle)) : ?>
    <div class="mb-50">
        <h2 class="color-linear d-inline-block mb-10"><?php echo esc_attr($title) ?></h2>
        <p class="text-lg mb-0 color-gray-500"><?php echo esc_attr($subtitle) ?></p>
    </div>
<?php endif; ?>