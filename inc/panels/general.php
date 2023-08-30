<?php
return [
    'id'                => 'general-options',
    'title'             => esc_attr__('General options', 'genz'),
    'settings_pages'    => 'theme_options',
    'fields'            => [
        [
            'id'   => 'disable_preloader',
            'type' => 'checkbox',
            'desc' => esc_attr__('Disable preloader animation?', 'genz'),
            'std'  => '0'
        ],
        [
            'id'   => 'preloader_image',
            'type' => 'single_image',
            'name' => esc_attr__('Preloader image', 'genz'),
            'visible' => ['disable_preloader', '=', false]
        ],
        [
            'type' => 'number',
            'id'   => 'preloader_logo_size',
            'name' => esc_attr__('Preloader Logo  size', 'genz'),
            'desc' => esc_attr__('Preloader logo', 'genz'),
            'suffix'     => ' px',
            'js_options' => [
                'min'   => 50,
                'max'   => 500,
                'step'  => 1,
            ],
            'std' => 100,
            'visible' => ['disable_preloader', '=', false]
        ],
        [
            'id'   => 'disable_color_mode_switcher',
            'type' => 'checkbox',
            'desc' => esc_attr__('Disable color mode switcher', 'genz'),
        ],
        [
            'type' => 'select',
            'id'   => 'default_color_mode',
            'name' => esc_attr__('Default Color Mode', 'genz'),
            'options' => [
                'dark'   => esc_attr__('Dark', 'genz'),
                'light'   => esc_attr__('Light', 'genz'),
            ],
            'std' => 'dark',
        ],

    ]


];
