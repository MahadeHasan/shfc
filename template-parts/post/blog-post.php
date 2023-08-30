<?php

$args = array(
    'post_type' => 'post',

);
$query = new WP_Query($args);

if ($query->have_posts()) : ?> 
    <?php while ($query->have_posts()) :    $query->the_post(); ?> 
        <?php get_template_part('template-parts/post/'); ?> 
    <?php endwhile; ?> 
<?php endif;
wp_reset_postdata();
?>