<?php
return [
    'id'                => 'post',
    'title'             => esc_attr__('Post options', 'genz'),
    'settings_pages'    => 'theme_options',
    'fields'            => [

        [
            'id'   => 'post_title_tag',
            'type' => 'select',
            'name' => esc_attr__('Post Details title tag', 'genz'),
            'std' => 'h2',
            'desc'   => 'Select post details title tag',
            'options' => [
                'h1' => esc_attr__('H1', 'genz'),
                'h2' => esc_attr__('H2', 'genz'),
                'h3' => esc_attr__('H3', 'genz'),
                'h4' => esc_attr__('H4', 'genz'),
                'h5' => esc_attr__('H5', 'genz'),
                'h6' => esc_attr__('H6', 'genz'),
            ],
        ],
        [
            'id'   => 'read_more_text',
            'type' => 'text',
            'name' => esc_attr__('Post Read More Text', 'genz'),
            'desc'   => 'Add text as your need',
            'std' => 'Read More',
        ],

    ],


];
