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

//wp post query shortcode
function shfc_render_posts_template($atts)
{
    $attributes = shortcode_atts(array(
                                    //field_id , default value
        'post__in' => shfc_get_option('post__in', []),
        'posts_per_page' => shfc_get_option('posts_per_page', -1),
    ), $atts, 'shfc_posts');
    //extract($attributes);

    ob_start();

    // include template with the arguments (The $args parameter was added in v5.5.0)
    get_template_part('template-parts/shortcode/posts-template', '', $attributes);

    return ob_get_clean();
}
add_shortcode('shfc_posts', 'shfc_render_posts_template');


//User value shortcode 

function shfc_render_user_bio_fn($atts){
    $atts = shortcode_atts(
        array(
            'user_id'   => shfc_get_option('user_id',null),
        ),$atts, 'shfc_user_bio'
    );

    ob_start();
    get_template_part('template-parts/shortcode/user-template', '', $atts);
    return ob_get_clean();

}
add_shortcode('shfc_user_bio','shfc_render_user_bio_fn');


//register settings page
if(!function_exists('shfc_register_settings_page')){
	add_filter('ctrlbp_settings_pages', 'shfc_register_settings_page');
	function shfc_register_settings_page($settings_pages){
		$settings_pages[] = [
			'id'          => 'shfc-setting-fields',
			'option_name' => 'shfc_data',
			'menu_title'  => esc_attr__( 'Shortcode Generator', 'shfc' ),
			'priority'    => 15,
			//'parent'      => 'options-general.php',
            'icon_url' => 'dashicons-share-alt',
			'customizer'  => false, // THIS       
			'customizer_only'  => false, // THIS 
		];
		return $settings_pages;
	}
}

//post shortcode meta fields
if(!function_exists('shfc_fields')){
	add_filter('ctrlbp_meta_boxes', 'shfc_fields');
	function shfc_fields($meta_boxes){
		$meta_boxes[] = [
			'id'             => 'general',
			'settings_pages' => 'shfc-setting-fields',
			'style' => 'seamless',        
			'fields'         => [
				[
                    //field_id
					'id'   => 'post__in',
					'type' => 'select_advanced',
					'name' => esc_attr__('Specify posts to retrive', 'shfc'),
					'options' => array_column(get_posts( [ 'posts_per_page' => '-1' ] ), 'post_title', 'ID'),
                    'multiple' => true
				],
                [
                    //field_id
					'id'   => 'posts_per_page',
					'type' => 'number',
					'name' => esc_attr__('Post per page', 'shfc'),
				],
                [
                    //field_id
					'id'   => 'user_id',
					'type' => 'select',
					'name' => esc_attr__('user id', 'shfc'),
                    'options' =>  array_column(get_users(array( 'fields' => array( 'ID', 'display_name' ))), 'display_name', 'ID')
				],
			]
		];
		return $meta_boxes;
	}
}

function shfc_get_option($field_id, $default){
    $options = get_option('shfc_data', []);

    if(!isset($options[$field_id])) return $default;
    return $options[$field_id];
}
// print_r( get_option('shfc_data'));

///////////////////////////////////////////////////////////////

