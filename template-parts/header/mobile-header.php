<?php
$args = wp_parse_args($args, array(
    'copyright_text'            => get_theme_mod('copyright_text', 'Genz ©Created by'),
    'copyright_author_link'     => get_theme_mod('copyright_author_link', 'http://jthemes.com'),
    'copyright_author_text'     => get_theme_mod('copyright_author_text', 'JThemes.com'),

));
extract($args);
$logo_dark = get_theme_mod('logo_dark', GENZ_URI . '/assets/imgs/template/logo-dark.svg');
if (intval($logo_dark)) {
    $logo_dark = wp_get_attachment_url($logo_dark);
}
?>

<div class="mobile-header-active mobile-header-wrapper-style perfect-scrollbar bg-gray-900">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-content-area">
            <div class="mobile-logo border-gray-800">
                <a class="d-flex align-items-center justify-content-between" href="<?php echo esc_attr(home_url('/')); ?>">

                    <img class="logo-mobile logo-white img-fluid" alt="<?php echo esc_attr(bloginfo('name')) ?>" src="<?php echo genz_get_logo(); ?>">
                    <img class="logo-mobile logo-dark img-fluid" alt="<?php echo esc_attr(bloginfo('name')) ?>" src="<?php echo esc_url($logo_dark); ?>">
                    <div class="burger-icon burger-icon-white">
                        <button type="button" class="btn-close text-reset" aria-label="Close"></button>
                    </div>

                </a>
            </div>
            <!-- mobile-logo -->
            <div class="perfect-scroll">
                <div class="mobile-menu-wrap mobile-header-border">
                    <nav class="mt-15">
                        <?php
                        wp_nav_menu(array(
                            'menu_class'      => 'mobile-menu font-heading',
                            'container'      => '',
                            'theme_location' => 'primary',
                            'depth'          => 2,
                            'fallback_cb'    => 'genz_primary_menu_fallback',
                        ));
                        ?>
                    </nav>

                </div>
                <!-- mobile menu -->

                <div class="site-copyright color-gray-400 mt-30">
                    <?php echo esc_attr($copyright_text)  ?>
                    <a class="copyright" href="<?php echo esc_url($copyright_author_link) ?>" target="_blank"> <?php echo esc_attr($copyright_author_text) ?></a>
                </div>
            </div>
            <!-- perfect-scroll -->
        </div>
        <!-- mobile-header-content-area -->
    </div>
</div>