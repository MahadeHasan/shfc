<?php
return [
    'id'             => 'genz_text_color',
    'title'          => esc_attr__('Colors - Dark mode', 'genz'),
    'settings_pages' => 'dynamic_css_options',
    'tab'           => 'text_color',
    'fields'         => genz_get_color_fields('text')
];
