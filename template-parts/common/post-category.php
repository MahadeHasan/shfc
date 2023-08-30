<?php

genz_sticky_bage();

$categories = get_the_terms(get_the_ID(), 'category');

if(empty($categories)) return;

foreach ($categories as $category) :
    if($category == null) continue; ?>

    <a class="btn btn-tag bg-gray-800 hover-up mb-1" href="<?php echo esc_attr(get_category_link($category->term_id)); ?>">
        <?php echo esc_attr($category->name); ?>
    </a>

<?php endforeach ?> 