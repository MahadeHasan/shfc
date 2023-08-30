<?php
$prefix = 'genz-';

function genz_font_family_css_var($font_families, $prefix = 'genz-')
{
  $css_vars = [];
  if (empty($font_families)) return $css_vars;

  foreach ($font_families as $key => $value) {
    if (empty($value)) continue;
    $options = Genz\Google_Fonts::font_family_options();
    if (empty($value['family']) && !array_key_exists($value['family'], $options)) continue;

    $css_vars[] = '--' . $prefix . $value['id'] . ': ' . $options[$value['family']] . '; ';
  }

  return  $css_vars;
}

function genz_font_size_css_var($prefix = 'genz-')
{
  $font_sizes = genz_get_default_font_sizes();
  $css_vars = [];
  if (empty($font_sizes)) return $css_vars;

  foreach ($font_sizes as $value) {
    $field_id = genz_get_field_id_by_prefix($value['id']);
    $field_value = get_theme_mod($field_id);
    if (empty($field_value)) continue;
    $css_vars[] = '--' . $prefix . $value['id'] . ': ' . $field_value . 'px; ';
  }

  return  $css_vars;
}

function genz_color_css_var($type, $prefix = 'genz-')
{
  $css_vars = [];
  $function_name = "genz_get_default_colors_{$type}";
  if (!function_exists($function_name)) return $css_vars;
  $colors = call_user_func($function_name);


  foreach ($colors as $color) {
    $field_id = genz_get_field_id_by_prefix($color['id'], $type . '_');
    $field_value = get_theme_mod($field_id);
    if (empty($field_value)) continue;
    $css_vars[] = '--' . $prefix . $color['id'] . ': ' . $field_value . '; ';
  }

  return  $css_vars;
}

function genz_dynamic_styles()
{
  $css = '';

  //genz_font_family Font Size
  $css .= ':root{'
    . implode("\n", genz_font_family_css_var(get_theme_mod('genz_font_family', []))) .
    implode("\n", genz_font_size_css_var()) .
    implode("\n", genz_color_css_var('text')) .
    '}';

  //preloader_logo
  $preloader_logo_size = get_theme_mod('preloader_logo_size', '150');
  if (!empty($preloader_logo_size)) {
    $css .= '.preloader-logo {--genz-preloader-logo-size: ' . $preloader_logo_size . 'px;}';
  }

  //Logo
  $logo_size = get_theme_mod('logo_size', '150');
  $logo_size_sm = get_theme_mod('logo_size_sm', '100');
  if (!empty($logo_size)) {
    $css .= '.header-logo {--genz-logo-size: ' . $logo_size . 'px;}';
  }
  if (!empty($logo_size_sm)) {
    $css .= '.mobile-logo {--genz-logo-size-sm: ' . $logo_size_sm . 'px;}';
  }

  //Theme Light
  $css .= '[data-theme="light"]{
      ' . implode("\n", genz_color_css_var('text_light')) . '
    }';

  return $css;
}
