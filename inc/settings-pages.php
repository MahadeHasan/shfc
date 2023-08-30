<?php
add_filter('ctrlbp_settings_pages', function ($settings_pages) {
    $settings_pages[] = [
        'id'          => 'theme_options',
        'option_name' => genz_option_name(),
        'menu_title'  => esc_attr__('Theme Options', 'genz'),
        'priority'    => 100,
        'parent'      => 'themes.php',
        'customizer'  => true, // THIS       
        'customizer_only'  => true, // THIS 
    ];

    $settings_pages[] = [
        'id'          => 'dynamic_css_options',
        'option_name' => genz_option_name(),
        'menu_title'  => esc_attr__('Design options', 'genz'),
        'priority'    => 100,
        'parent'      => 'themes.php',
        'class' => 'genz-customizer',
        'customizer'  => true, // THIS       
        'customizer_only'  => true, // THIS  
        'tabs'           => [
            'general' => esc_attr__('General', 'genz'),
            'text_color' => esc_attr__('Text Color', 'genz'),
            'text_color_light' => esc_attr__('Text Color Light', 'genz'),
            'shadow' => esc_attr__('Shadow', 'genz'),
        ],
    ];

    return $settings_pages;
});

add_filter('ctrlbp_meta_boxes', function ($meta_boxes) {
    //dynamic css 
    $meta_boxes[] = include __DIR__ . '/panels/dynamic-css/general.php';
    $meta_boxes[] = include __DIR__ . '/panels/dynamic-css/text-color.php';
    $meta_boxes[] = include __DIR__ . '/panels/dynamic-css/text-color-light.php';
    $meta_boxes[] = include __DIR__ . '/panels/dynamic-css/font-size.php';
    $meta_boxes[] = include __DIR__ . '/panels/general.php';
    $meta_boxes[] = include __DIR__ . '/panels/header.php';
    $meta_boxes[] = include __DIR__ . '/panels/footer.php';
    $meta_boxes[] = include __DIR__ . '/panels/post.php';

    return $meta_boxes;
});
