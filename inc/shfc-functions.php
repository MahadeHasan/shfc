<?php
function my_first_shortcode_function($atts)
{
    $attributes = shortcode_atts(array(
        'rounded_image' => 'https://picsum.photos/500/450',
        'title' => 'Card title',
        'cardtext' => 'This is a wider card with supporting text below as a natural lead-in to additional content.',
        'card_text2' => 'Last updated 3 mins ago',
        'btn_text' => 'Go somewhere',
        'btn_link' => '#',
    ), $atts, 'my_first_shortcode_function');
    //extract($attributes);

    ob_start();

    // include template with the arguments (The $args parameter was added in v5.5.0)
    get_template_part('template-parts/shortcode/test-template', '', $attributes);

    return ob_get_clean();
}
add_shortcode('my_first_shortcode', 'my_first_shortcode_function');
