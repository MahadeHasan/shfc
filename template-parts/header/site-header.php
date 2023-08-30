<?php

/**
 * Displays the site header.
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */



global $genz_header;
extract($genz_header);
$navbar_right = ($display_search || $display_button) ? true : false;
$logo_dark = get_theme_mod('logo_dark', GENZ_URI . '/assets/imgs/template/logo-dark.svg');
if (intval($logo_dark)) {
    $logo_dark = wp_get_attachment_url($logo_dark);
}

?>

<header class="header sticky-bar bg-gray-900">
    <div class="container">
        <div class="main-header">
            <div class="header-logo">
                <a class="d-flex" href="<?php echo esc_attr(home_url('/')); ?>">
                    <img class="logo-white img-fluid" alt="<?php echo esc_attr(bloginfo('name')) ?>" src="<?php echo genz_get_logo(); ?>">
                    <img class="logo-dark img-fluid" alt="<?php echo esc_attr(bloginfo('name')) ?>" src="<?php echo esc_url($logo_dark); ?>">
                </a>
            </div>
            <!-- logo -->
            <div class="<?php echo has_nav_menu('primary') ? 'header-nav' : 'add-header-nav' ?>">
                <?php
                wp_nav_menu(array(
                    'menu_class'     => 'main-menu',
                    'container'      => 'nav',
                    'container_class' => 'nav-main-menu d-none d-xl-block',
                    'theme_location' => 'primary',
                    'depth'          => 2,
                    'fallback_cb'    => 'genz_primary_menu_fallback',
                ));
                ?>
            </div>
            <!-- header-nav -->
            <?php get_template_part('template-parts/header/header-right'); ?>
            <!-- Header-right -->

        </div>
        <!-- main-header -->
    </div>
    <!-- container -->
</header>

<!-- mobile header -->
<?php get_template_part('template-parts/header/mobile-header'); ?>