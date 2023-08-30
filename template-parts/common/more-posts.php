<?php
$args = wp_parse_args($args, [
    'alignment'     => 'text-center',
    'more_post_btn_text'     => 'Show More Posts',
]);

extract($args);

?>
<div class="<?php echo esc_attr($alignment) ?>">
    <a href="<?php echo  get_post_type_archive_link('post') ?>" class="btn btn-linear btn-load-more wow animate__ animate__zoomIn animated">
        <?php echo esc_attr($more_post_btn_text) ?>
        <i class="fi-rr-arrow-small-right"></i>
    </a>
</div>