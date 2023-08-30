<?php
return [
    'id'                => 'header',
    'title'             => esc_attr__('Header options', 'genz'),
    'settings_pages'    => 'theme_options',
    'fields'            => [

        [
            'type' => 'number',
            'id'   => 'logo_size',
            'name' => esc_attr__('Logo width in large screen', 'genz'),
            'desc' => esc_attr__('Header logo dimension for large screen', 'genz'),
            'suffix'     => ' px',
            'std'   => 150,
        ],
        [
            'type' => 'number',
            'id'   => 'logo_size_sm',
            'name' => esc_attr__('Logo width in mobile screen', 'genz'),
            'desc' => esc_attr__('Effective when your layout can be adapted at a particular viewport or device size < 575px', 'genz'),
            'suffix'     => ' px',
            'std'   => 100,
        ],
        [
            'id'   => 'display_navbar_search',
            'type' => 'checkbox',
            'desc' => esc_attr__('Display Search in Navbar', 'genz'),
        ],
        [
            'id'   => 'navbar_search_placeholder',
            'type' => 'text',
            'name' => esc_attr__('Search placeholder', 'genz'),
            'placeholder' => esc_attr__('Search', 'genz'),
            'std' => esc_attr__('Search', 'genz'),
            'visible' => ['display_navbar_search', '=', true]
        ],
        [
            'id'   => 'navbar_display_popular_terms',
            'type' => 'checkbox',
            'desc' => esc_attr__('Display poular terms in Search', 'genz'),
            'std' => true,
            'visible' => ['display_navbar_search', '=', true]
        ],
        [
            'id'   => 'navbar_search_popular_type',
            'type' => 'select',
            'name' => esc_attr__('Pupular terms type', 'genz'),
            'std' => 'post_tag',
            'options' => [
                'post_tag' => 'Tags',
                'category' => 'Categories',
            ],
            'visible' => ['navbar_display_popular_terms', '=', true]
        ],
        [
            'id'   => 'navbar_search_popular_text',
            'type' => 'text',
            'name' => esc_attr__('Pupular text', 'genz'),
            'std' => esc_attr__('Popular tags:', 'genz'),
            'visible' => ['navbar_display_popular_terms', '=', true]
        ],


        // Button
        [
            'id'   => 'display_navbar_button',
            'type' => 'checkbox',
            'desc' => esc_attr__('Display button in Navbar', 'genz'),
        ],
        [
            'id'   => 'navbar_button_text',
            'type' => 'text',
            'name' => esc_attr__('Button text', 'genz'),
            'placeholder' => esc_attr__('Subscribe', 'genz'),
            'std' => esc_attr__('Subscribe', 'genz'),
            'visible' => ['display_navbar_button', '=', true]
        ],
        [
            'id'   => 'navbar_button_link',
            'type' => 'text',
            'name' => esc_attr__('Button link', 'genz'),
            'std' => '#',
            'visible' => ['display_navbar_button', '=', true]
        ],

    ],


];
