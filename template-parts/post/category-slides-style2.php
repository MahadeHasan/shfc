<div class="box-topics box-topics-2 border-gray-800 bg-gray-850">
    <div class="row">
        <div class="col-lg-12">
            <div class="box-swiper">
                <div class="swiper-container swiper-group-6">
                    <div class="swiper-wrapper">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'name',
                            'order'   => 'ASC'
                        ));
                        $img_size = !empty($args['img_size']) ? $args['img_size'] : 'full';
                        foreach ($categories as $category) :
                            $count = $category->category_count;
                            $text = sprintf(_n('%s Article', '%s Articles', $count, 'genz'), $count);
                            $cat_image = genz_category_image($category->term_id, 'category_image', $img_size);

                            if (empty($cat_image)) {
                                $cat_image = get_template_directory_uri() . '/assets/imgs/page/homepage1/sport.png';
                            }
                        ?>
                            <div class="swiper-slide">
                                <div class="card-style-1">
                                    <a href="<?php echo esc_attr(get_category_link($category->term_id)); ?>">
                                        <div class="card-image">
                                            <img class="h-100 object-fit-cover" src="<?php echo esc_url($cat_image) ?>" alt="<?php echo esc_attr($category->name) ?>">
                                            <div class="card-info">
                                                <div class="info-bottom">
                                                    <h6 class="color-white mb-5"><?php echo esc_attr($category->name) ?></h6>
                                                    <p class="text-xs color-gray-500"><?php echo esc_attr($text); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- box-swiper -->

                <div class="swiper-button-prev swiper-button-prev-style-2"></div>
                <div class="swiper-button-next swiper-button-next-style-2"></div>
            </div>
        </div>
        <!-- col-lg-12 -->
    </div>
    <!-- row -->
</div>
<!-- box-topics -->