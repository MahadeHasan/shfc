<?php
$title = get_post_meta(get_the_ID(), 'hire_me_title', true);
$content = get_post_meta(get_the_ID(), 'hire_me_content', true);
if (empty($content)) return;
?>
<h3 class="color-white mt-50 mb-30 wow animate__animated animate__fadeIn"><?php echo esc_attr($title) ?></h3>
<div class="text-lg color-gray-500 wow animate__animated animate__fadeIn"><?php echo wpautop($content) ?></div>