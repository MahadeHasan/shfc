<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

?>
</div>
<!-- footer ======================-->
<?php get_template_part('template-parts/footer/site-footer'); ?>
<!-- footer ======================-->

<div class="progressCounter progressScroll hover-up hover-neon-2">
  <div class="progressScroll-border">
    <div class="progressScroll-circle"><span class="progressScroll-text"><i class="fi-rr-arrow-small-up"></i></span></div>
  </div>
</div>

<?php wp_footer() ?>

</body>

</html>