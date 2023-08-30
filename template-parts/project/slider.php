<div class="wow animate__animated animate__fadeIn mt-30 mb-50">
    <div class="swiper-container swiper-group-2 overflow-hidden">
        <div class="swiper-wrapper">

            <?php $slides = get_post_meta(get_the_ID(), 'slider_images'); ?>

            <?php
            foreach ($slides as $attachment_id) :
                $attachment_url = wp_get_attachment_image_url($attachment_id, 'genz-1133x510-cropped');
                if (empty($attachment_url)) continue;
            ?>
                <div class="swiper-slide">
                    <div class="image-detail mb-30">
                        <img class="bdrd16" src="<?php echo esc_url($attachment_url); ?>" alt="<?php the_title(); ?>">
                    </div>
                </div>
            <?php endforeach ?>

        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>