<?php

/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> <?php genz_color_mode_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <?php wp_head(); ?>
</head>

<body <?php body_class('home-1'); ?>>
  <?php wp_body_open(); ?>
  <div class="position-relative h-100 overflow-x-hidden">
    <?php get_template_part('template-parts/header/preloader'); ?>
    <?php get_template_part('template-parts/header/site-header'); ?>