<?php
return [
    'id'             => 'genz_font_sizes',
    'title'          => esc_attr__('Font sizes', 'genz'),
    'settings_pages' => 'dynamic_css_options',
    'tab'           => 'font_size',
    'fields'         => genz_get_number_fields('font_sizes')
];