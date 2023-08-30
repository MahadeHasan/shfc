<?php
return [
    'id'             => 'genz_general',
    'title'          => esc_attr__('Font Family', 'genz'),
    'settings_pages' => 'dynamic_css_options',
    'tab'           => 'general',
    'fields'         => [
        //font family
        [
            'id'   => 'genz_font_family',
            'type' => 'group',
            'sort_clone' => false,
            'clone' => true,
            'max_clone' => 2,
            'class' => 'genz-customizer',
            'collapsible' => true,
            'default_state' => 'expanded',
            'group_title' => '{title}',
            'std' => Genz\Google_Fonts::default_font_families(),
            'fields' => [
                [
                    'name' => esc_attr__('ID', 'genz'),
                    'id'   => 'id',
                    'type' => 'hidden',
                ],
                [
                    'id'   => 'title',
                    'type' => 'hidden',
                ],
                [
                    'name' => esc_attr__('Font family', 'genz'),
                    'id' => 'family',
                    'type' => 'select_advanced',
                    'multiple' => false,
                    'placeholder' => 'Select font family',
                    'options' => genz_recognized_google_font_families('font_family')
                ],
                [
                    'name' => esc_attr__('Font family','genz'),
                    'id' => 'variants',
                    'type' => 'checkbox_list',
                    'std' => '',
                    'options' => [
                        '100' => '100',
                        '300' => '300',
                        '400' => 'Regular',
                        '500' => 'Medium',
                        '600' => 'Semibold',
                        '700' => 'Bold',
                        '800' => '800',
                    ]
                ]
            ]
        ]
    ]
];