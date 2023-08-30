<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package genz
 */

if (!is_active_sidebar('sidebar1')) {
    return;
}
?>

<?php dynamic_sidebar('sidebar1'); ?>

 
 
               