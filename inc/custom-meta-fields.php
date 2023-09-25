<?php
//Portfolio Meta Field
add_filter('ctrlbp_meta_boxes', 'genz_register_portfolio_meta_fields');
function genz_register_portfolio_meta_fields($meta_boxes)
{

    $meta_boxes[] = [
        'title' => esc_attr__('Project information', 'genz'),
        'post_types' => 'portfolio',
        'fields' => [
            [
                'id' => 'slider_images',
                'name' => esc_attr__('Project slider images', 'genz'),
                'type' => 'image_advanced',
                'force_delete' => false,
                'max_file_uploads' => 4,
                'max_status' => true,
                'image_size' => 'thumbnail',
            ],
            [
                'id' => 'gallery_images',
                'name' => esc_attr__('Project gallery', 'genz'),
                'type' => 'image_advanced',
                'force_delete' => false,
                'max_file_uploads' => 6,
                'max_status' => true,
                'image_size' => 'thumbnail',
            ],
            [
                'id' => 'gallery_desc',
                'name' => esc_attr__('Gallery description', 'genz'),
                'type' => 'textarea',
                'std' => esc_attr__('The brand identity', 'genz'),
            ],
            [
                'id' => 'project_info_title',
                'name' => esc_attr__('Project Information title', 'genz'),
                'type' => 'text',
                'std' => esc_attr__('Project Title', 'genz'),
            ],
            [
                'name' => esc_attr__('Project Information', 'genz'),
                'id' => 'project_info',
                'type' => 'key_value',
                'desc' => esc_attr__('Please enter project info title', 'genz'),
                'placeholder' => [
                    'key' => esc_attr__('Poject details label', 'genz'),
                    'value' => esc_attr__('Poject details value', 'genz'),
                ],
                'std' => [
                    ['Client', esc_attr__('Orion Coporation', 'genz')]
                ]

            ],
            [
                'name' => esc_attr__('Hire me title', 'genz'),
                'id' => 'hire_me_title',
                'type' => 'text',
                'std' => esc_attr__('Hire me', 'genz'),
            ],
            [
                'name' => esc_attr__('Hire me content', 'genz'),
                'type' => 'wysiwyg',
                'id' => 'hire_me_content',
                'raw' => false,
                'options' => [
                    'textarea_rows' => 4,
                    'teeny' => true,
                    'media_buttons' => false
                ],
            ],
        ],
    ];
    return $meta_boxes;
}

//Page Title Meta Field
add_filter('ctrlbp_meta_boxes', 'genz_register_page_meta_fields');
function genz_register_page_meta_fields($meta_boxes)
{
    $meta_boxes[] = [
        'title' => esc_attr__('Page Settings', 'genz'),
        'post_types' => 'page',
        'fields' => [
            [
                'id' => 'display_title',
                'desc' => esc_attr__('Display tilte', 'genz'),
                'type' => 'checkbox',
                'std' => '0'
            ]
        ],
    ];
    return $meta_boxes;
}

//Featured Post Meta Field
add_filter('ctrlbp_meta_boxes', 'genz_register_featured_meta_fields');
function genz_register_featured_meta_fields($meta_boxes)
{
    $meta_boxes[] = [
        'title' => esc_attr__('Featured Post Meta Fields', 'genz'),
        'post_types' => 'post',
        'fields' => [
            [
                'id' => 'is_featured_post',
                'desc' => esc_attr__('Featured Post', 'genz'),
                'type' => 'checkbox',
            ],
        ],
    ];
    return $meta_boxes;
}
