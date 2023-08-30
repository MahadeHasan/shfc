<?php

return [
    'id'                 => 'footer',
    'title'             => esc_attr__('Footer options', 'genz'),
    'settings_pages'    => 'theme_options',
    'panel'             => 'excerpt_settings',
    'fields'            => [
        [
            'id'   => 'copyright_text',
            'type' => 'textarea',
            'name' => esc_attr__('Copyright text', 'genz'),
            'std'  => sprintf(__('© %s Created by', 'genz'), date('Y'))
        ],
        [
            'id'   => 'copyright_author_link',
            'type' => 'text',
            'name' => esc_attr__('Copyright Author Link', 'genz'),
            'std'  => sprintf(__('http://jthemes.com', 'genz'))
        ],
        [
            'id'   => 'copyright_author_text',
            'type' => 'text',
            'name' => esc_attr__('Copyright Author Name', 'genz'),
            'std'  => sprintf(__('Jthemes.com', 'genz'))
        ],

    ]
];
