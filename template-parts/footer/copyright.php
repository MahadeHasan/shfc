<?php

/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */


$args = wp_parse_args($args, array(
    'copyright_text'            => get_theme_mod('copyright_text', 'Genz ©Created by'),
    'copyright_author_link'     => get_theme_mod('copyright_author_link', 'http://jthemes.com'),
    'copyright_author_text'     => get_theme_mod('copyright_author_text', 'JThemes.com'),

));
extract($args);


?>
<div class="footer-bottom border-gray-800">
    <div class="row align-items-center">
        <div class="col-lg-5">
            <p class="text-base color-white wow animate__animated animate__fadeIn">
                <?php echo esc_attr($copyright_text)  ?>
                <a class="copyright" href="<?php echo esc_url($copyright_author_link) ?>" target="_blank"> <?php echo esc_attr($copyright_author_text) ?></a>
            </p>
        </div>
        <div class="col-lg-7 text-center text-lg-end">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'footer',
                    'container'      => false,
                    'menu_class'    => 'list-unstyled d-inline-flex flex-wrap gap-2 gap-lg-4 footer-social',
                    'depth'          => 1,
                    'link_before'    => '<span>',
                    'link_after'     => '</span>',
                    'fallback_cb'    => false,
                )
            );
            ?>
        </div>
    </div>
</div>