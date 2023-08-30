<?php

/**
 * The template part for displaying results in search pages
 *
 */

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('card-list-posts card-list-posts-small border-bottom border-gray-800 pb-30 mb-30 wow animate__animated animate__fadeIn') ?>>
  <?php if (in_array(get_post_type(), ['post'])) : ?>
    <div class="card-image hover-up pt-2">
      <div class="box-author mb-20">
        <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['width' => 48, 'height' => 48]); ?>
        <div class="author-info lh-1">
          <h6 class="color-gray-700"><?php the_author_posts_link(); ?></h6>
          <span class="color-gray-700 text-sm"><?php the_date(); ?></span>
        </div>
      </div>
      <?php
      $categories = get_the_terms($post->ID, 'category');
      if (!empty($categories[0]->name)) :  ?>
        <a class="btn btn-tag bg-gray-800 hover-up" href="<?php echo esc_attr(get_category_link($categories[0]->term_id)); ?>">
          <?php echo esc_attr($categories[0]->name); ?>
        </a>
      <?php endif; ?>
    </div>
    <!-- card-image -->
  <?php endif; ?>
  <div class="card-info">
    <a href="<?php the_permalink() ?>">
      <h3 class="mb-20 color-white"><?php the_title(); ?></h3>
    </a>
    <p class="color-gray-500"><?php the_excerpt() ?></p>
    <div class="row mt-20">
      <div class="col-7">
        <?php echo genz_post_tags() ?>
      </div>
      <div class="col-5 text-end"><span class="color-gray-700 text-sm timeread"><?php echo genz_get_post_reading_time() ?></span></div>
    </div>
  </div>
  <!-- card-info -->
</div>
<!-- card-list-posts -->