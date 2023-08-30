<?php
include __DIR__ . '/helpers.php';
include __DIR__ . '/demo-data.php';
include __DIR__ . '/google-fonts-functions.php';
include __DIR__ . '/Google_Fonts.php';
include __DIR__ . '/settings-pages.php';
include __DIR__ . '/dynamic-styles.php';

if (function_exists('is_woocommerce')) {
    include __DIR__ . '/woo-functions.php';
    include __DIR__ . '/control-woocommerce.php';
}

if(!function_exists('genz_option_name')){
	function genz_option_name(){
		$option_name = 'theme_mods_' . get_option( 'stylesheet' );

		return $option_name;
	}
}


if (!function_exists('genz_gutenberg_styles')) {
    function genz_gutenberg_styles()
    {
        wp_enqueue_style('genz-gutenberg-google-fonts', Genz\Google_Fonts::get_google_fonts_url(), [], GENZ_VERSION);
        wp_enqueue_style('genz-gutenberg', get_theme_file_uri('/assets/css/style-editor.css'), false, GENZ_VERSION, 'all');

        wp_add_inline_style('genz-gutenberg', genz_dynamic_styles());
    }
    add_action('enqueue_block_editor_assets', 'genz_gutenberg_styles');
}

if (!function_exists('genz_customize_add_setting')) {
    add_action('customize_register', 'genz_customize_add_setting');
    function genz_customize_add_setting(WP_Customize_Manager $wp_customize)
    {
        $wp_customize->add_setting(
            'logo_dark',
            array(
                'sanitize_callback' => static function ($value) {
                    return intval($value);
                }
            )

        );

        $wp_customize->add_control(new WP_Customize_Media_Control(
            $wp_customize,
            'logo_dark',
            array( // setting id
                'label'    => esc_attr__('Logo dark', 'genz'),
                'frame_title' => esc_attr__('Select dark logo', 'genz'),
                'mime_type' => 'image',
                'section'  => 'title_tagline',
                'priority' => 9,
            )
        ));
        $wp_customize->add_setting(
            'logo_dimension_link',
            array(
                'sanitize_callback' => static function ($value) {
                    return $value;
                }
            )

        );
        $wp_customize->add_control(new WP_Customize_Control(
            $wp_customize,
            'logo_dimension_link',
            array( // setting id
                'description'    => sprintf(esc_attr__('Set your logo size %s', 'genz'), '<a href="' . admin_url('/customize.php?autofocus[section]=header') . '">here</a>'),
                'type' => 'hidden',
                'section'  => 'title_tagline',
                'priority' => 9,
            )
        ));
    }
}



if (!function_exists('genz_customize_add_partials')) {
    add_action('customize_register', 'genz_customize_add_partials');
    function genz_customize_add_partials(WP_Customize_Manager $wp_customize)
    {
        /**
         * add partials for components 
         * partials added to customize settings from customizer quickly
         *
         * @since genz 1.0.1
         *
         * @param $wp_customize an instance of WP_Customize_Manager class
         * @return void
         */

        // Abort if selective refresh is not available.
        if (!isset($wp_customize->selective_refresh)) {
            return;
        }

        $partials = genz_get_partials();

        global $wp_customize;
        foreach ($partials as $settings_id => $selector) {
            $wp_customize->selective_refresh->add_partial($settings_id, array(
                'selector' => $selector
            ));
        }
    }
}

if (!function_exists('genz_get_partials')) {
    function genz_get_partials()
    {

        $partials = array(
            'custom_logo'         => '.header-logo',
            'footer'              => '.footer-bottom',
            'subscribe'           => '[data-settings-id="subscribe"]',
            'search'              => '[data-settings-id="search"]',

        );

        return $partials;
    }
}

//Author Profile Picture
add_filter('ctrlbp_meta_boxes', function ($meta_boxes) {
    $meta_boxes[] = [
        'title' => esc_attr__('Genz profile settings', 'genz'),
        'id' => 'genz-user-info',
        'type' => 'user',
        'fields' => [
            [
                'name' => esc_attr__('Enable Custom Profile picture', 'genz'),
                'id' => 'genz_custom_profile_picture',
                'type' => 'checkbox',
                'desc' => 'Yes'
            ],
            [
                'name' => esc_attr__('Custom Profile picture', 'genz'),
                'id' => 'genz_profile_picture',
                'type' => 'single_image',
                'max_file_uploads' => 1,
                'max_file_size' => '1mb',
                'image_size' => 'full',
                'visible' => ['genz_custom_profile_picture', '=', true]
            ],
            [
                'name'  => esc_attr__('Welcome Text', 'genz'),
                'id'    => 'welcome_text',
                'type'  => 'text',
                'std'   =>  esc_attr__('Hello Everyone!', 'genz'),
                'class' => 'ctrlbp-col-6'
            ],
            [
                'name'  => esc_attr__('Author Quote Text', 'genz'),
                'id'    => 'author_quote_text',
                'type'  => 'textarea',
                'std'   =>  esc_attr__('I\'m Steven, a lover of technology, business and experiencing new things', 'genz'),
                'class' => 'ctrlbp-col-6'
            ],
            [
                'name'       => esc_attr__('Social Media Link', 'genz'),
                'id'         => 'social_links',
                'type'       => 'group',  // Group!
                'clone'      => true,     // Clone whole group?
                'sort_clone' => true,     // Drag and drop clones to reorder them?
                'max_clone' => 8,     // Drag and drop clones to reorder them?
                'group_title' => '{#}. {title}',
                'class' => 'ctrlbp-col-6',
                'fields'     => [
                    [
                        'name' => esc_attr__('Title', 'genz'),
                        'id'   => 'title',
                    ],
                    [
                        'name' => esc_attr__('Social Link', 'genz'),
                        'id'   => 'social_link',
                        'type' => 'text',
                    ],
                ],
                'std' => [
                    [
                        'title' => esc_attr__('Facebook', 'genz'),
                        'social_link' => esc_url('https://www.facebook.com/'),
                    ],
                    [
                        'title' => esc_attr__('Facebook', 'genz'),
                        'social_link' => esc_url('https://www.twitter.com/'),
                    ],
                    [
                        'title' => esc_attr__('Facebook', 'genz'),
                        'social_link' => esc_url('https://www.linkedin.com/'),
                    ],
                ],
            ],
        ]
    ];

    return $meta_boxes;
});

add_filter('get_avatar_url', function ($url, $id_or_email) {
    if (is_object($id_or_email) && isset($id_or_email->comment_ID)) {
        $id_or_email = $id_or_email->user_id;
    }
    if (!function_exists('ctrlbp_meta')) return $url;

    $custom_profile_picture = ctrlbp_meta('genz_custom_profile_picture', ['object_type' => 'user'], $id_or_email);
    if (empty($custom_profile_picture) ||  !$custom_profile_picture) return $url;

    $attachment = ctrlbp_meta('genz_profile_picture', ['object_type' => 'user'], $id_or_email);
    if (!is_wp_error($attachment) && !empty($attachment['ID'])) {
        $url = wp_get_attachment_image_url($attachment['ID'], 'thumbnail');
    }

    return $url;
}, 10, 2);

//Author mdeta fn
if (!function_exists('genz_user_custom_meta')) {
    function genz_user_custom_meta($user_id = null)
    {
        $user_meta_data = [];
        if (!function_exists('ctrlbp_meta')) return $user_meta_data;

        $welcome_text = ctrlbp_meta('welcome_text', ['object_type' => 'user'], $user_id);
        $user_meta_data['welcome_text'] = $welcome_text;

        $quote_text = ctrlbp_meta('author_quote_text', ['object_type' => 'user'], $user_id);
        $user_meta_data['quote_text'] = $quote_text;

        $social_links = ctrlbp_meta('social_links', ['object_type' => 'user'], $user_id);
        $user_meta_data['social_links'] = $social_links;

        return $user_meta_data;
    }
}

//Author Role
function get_author_role()
{
    global $authordata;
    $author_roles = $authordata->roles;
    $author_role = array_shift($author_roles);
    return $author_role;
}

if (!function_exists('genz_get_option')) {
    function genz_get_option($option_id, $default = null)
    {
        return get_theme_mod($option_id, $default);
    }
}
