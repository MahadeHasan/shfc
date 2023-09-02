<?php
$post_query = new WP_Query($args);

if($post_query->have_posts()){
    while($post_query->have_posts()){
        $post_query->the_post();
        get_template_part('template-parts/content/content');
    }
    wp_reset_postdata();
}
?>