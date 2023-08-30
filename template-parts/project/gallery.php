<?php
$images = get_post_meta(get_the_ID(), 'gallery_images');
if (empty($images)) return;
$desc = get_post_meta(get_the_ID(), 'gallery_desc', true);
?>

<div class="row mt-50" data-masonry='{"percentPosition": true }'>
    <?php
    foreach ($images as $key => $attachment_id) :
        $image_size = $key == 0 ? 'genz-525x674-cropped' : 'genz-597x314-cropped';
        $attachment_url = wp_get_attachment_image_url($attachment_id, $image_size);
        if (empty($attachment_url)) continue;
    ?>
        <?php if ($key == 0) : ?>
            <div class="col-lg-6">
                <img class="img-bdrd-16 mb-30" src="<?php echo esc_url($attachment_url); ?>" alt="<?php the_title(); ?>">
            </div>
        <?php else : ?>
            <div class="col-lg-6 ">
                <img class="img-bdrd-16 mb-20" src="<?php echo esc_url($attachment_url); ?>" alt="<?php the_title(); ?>">
            </div>
        <?php endif; ?>
    <?php endforeach ?>


</div>
<p class="text-center text-lg color-gray-500 wow animate__animated animate__fadeIn"><?php echo esc_attr($desc) ?></p>