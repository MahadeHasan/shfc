<?php
return [
    'id'             => 'genz_text_color_light',
    'title'          => esc_attr__('Colors - Light mode', 'genz'),
    'settings_pages' => 'dynamic_css_options',
    'tab'           => 'text_color_light',
    'fields'         => genz_get_color_fields('text_light')
];
