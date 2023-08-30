<?php
$args = wp_parse_args($args, array(
  'disable_preloader' => get_theme_mod('disable_preloader', false),
  'preloader_image' => get_theme_mod('preloader_image')
));
extract(($args));

if ($disable_preloader) return;


if ($preloader_image) {
  $preloader_image = wp_get_attachment_image_url($preloader_image);
} else {
  $preloader_image = GENZ_ASSETS . '/imgs/template/favicon.svg';
}

?>

<div id="preloader-active">
  <div class="preloader d-flex align-items-center justify-content-center">
    <div class="preloader-inner position-relative">
      <div class="text-center">
        <div class="preloader-logo">
          <img class="mb-10 header-logo" src="<?php echo esc_url($preloader_image) ?>" alt="<?php bloginfo('name') ?>">
        </div>
        <div class="preloader-dots"></div>
      </div>
    </div>
  </div>
</div>