<?php
extract(wp_parse_args($args, [
    'about_image' => '',
    'floting_image_switch' => '',
    'floting_image1' => '',
    'floting_image2' => '',
    'about_sub_title' => '',
    'about_title' => '',
    'about_description' => '',
    'about_typewrite' => '',
    'social_links' => '',
    'show_subscription_form' => '',
    'email_placeholder' => '',
    'button_text' => '',
    'custom_button_' => [],
]));

$mc_form_args = array(
    'mailchimp_form_email_placeholder' => $email_placeholder,
    'mailchimp_form_button_text' => $button_text
);

$alt_text = get_bloginfo('name');

$class =  ($floting_image_switch == 'yes') ? 'banner-home3 bg-gray-850' : '';

?>
<!-- banner banner-home3 bg-gray-850 -->

<div class="banner <?php echo esc_attr($class) ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 p-0 mx-auto">
                <div class="row">
                    <div class="col-lg-6 pt-90">
                        <span class="text-sm-bold color-gray-600 wow animate__animated animate__fadeInUp"><?php echo esc_attr($about_sub_title) ?></span>
                        <h1 class="color-white mt-10 mb-20 wow animate__animated animate__fadeInUp">
                            <?php echo esc_attr($about_title) ?>
                            <?php $about_typewrite = explode(',', $about_typewrite);
                            $typewrites = [];
                            foreach ($about_typewrite as $typewrite) {
                                $typewrites[] = '&quot;' . $typewrite . '&quot;';
                            }
                            ?>
                            <a class="typewrite color-linear" href="#" data-period="3000" data-type="[<?php echo implode(', ', $typewrites) ?>]"></a>

                        </h1>
                        <div class="row">
                            <div class="col-lg-9">
                                <p class="text-base color-gray-600 wow animate__animated animate__fadeInUp">
                                    <?php echo esc_attr($about_description) ?>
                                </p>

                                <?php if (is_array($custom_button_) && !empty($custom_button_)) : ?>
                                    <div class="custom_button">
                                        <?php foreach ($custom_button_ as $button) :

                                            $button = wp_parse_args($button, [
                                                'custom_button_link'            =>         '',
                                                'custom_button_text'            =>         '',
                                            ]);
                                            if (empty($button['custom_button_text']) || empty($button['custom_button_link'])) continue;
                                        ?>
                                            <a class="btn btn-linear btn-lg wow animate__ animate__zoomIn me-3 mt-30" href="<?php echo esc_attr($button['custom_button_link']) ?>">
                                                <?php echo esc_attr($button['custom_button_text']) ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif ?>
                                <!-- custom_button -->
                            </div>
                        </div>
                        <!-- row -->

                        <?php if ($show_subscription_form && function_exists('control_email_subscriber_form')) : ?>
                            <div class="box-subscriber mt-40 mb-40 wow animate__animated animate__fadeInUp">
                                <div class="inner-subscriber bg-gray-800">
                                    <?php echo control_email_subscriber_form($mc_form_args) ?>
                                </div>
                                <div id="mc-response" class="mc-response mt-15"></div>
                            </div>
                        <?php endif ?>

                        <!-- box-subscriber -->
                        <?php if ($social_link_switch == 'yes') :   ?>
                            <?php if (!empty($social_links)) :  ?>
                                <div class="box-socials">
                                    <?php foreach ($social_links as $social_link) :  ?>
                                        <?php if (!isset($social_link['social_link']) || empty($social_link['social_link'])) continue; ?>
                                        <a class="bg-gray-800 hover-up" href="<?php echo esc_url($social_link['social_link']) ?>"><?php echo genz_get_social_link_svg($social_link['social_link'], 30); ?></a>
                                    <?php endforeach; ?>
                                </div>
                                <!-- box-socials -->
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <!-- col-lg-6 -->
                    <div class="col-lg-6 text-center">
                        <?php if ($floting_image_switch == 'yes') : ?>
                            <div class="banner-img no-bg position-relative">
                                <div class="banner-1 shape-1"><img src="<?php echo esc_url($floting_image1['url']) ?>" alt="<?php echo esc_attr($alt_text) ?>"></div>
                                <div class="banner-2 shape-2"><img src="<?php echo esc_url($floting_image2['url']) ?>" alt="<?php echo esc_attr($alt_text) ?>"></div>
                            </div>
                        <?php else : ?><div class="banner-img position-relative wow animate__animated animate__fadeIn">
                                <img src="<?php echo esc_url($about_image['url']) ?>" alt="<?php echo esc_attr($alt_text); ?>">
                                <div class="pattern-1">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/imgs/template/pattern-1.svg" alt="<?php echo esc_attr($alt_text) ?>">
                                </div>
                                <div class="pattern-2">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/imgs/template/pattern-2.svg" alt="<?php echo esc_attr($alt_text) ?>">
                                </div>
                                <div class="pattern-3">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/imgs/template/pattern-3.svg" alt="<?php echo esc_attr($alt_text) ?>">
                                </div>
                                <div class="pattern-4">
                                    <img src="<?php echo get_template_directory_uri() ?>/assets/imgs/template/pattern-4.svg" alt="<?php echo esc_attr($alt_text) ?>">
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                    <!-- col-lg-6 -->
                </div>

            </div>
        </div>
    </div>
</div>