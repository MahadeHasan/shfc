<?php
$terms =  get_terms('portfolio_cat');
if (empty($terms)) return;
?>
<div class="row text-center filter-nav">
    <div class="col-lg-12">

        <span class="wow animate__animated animate__fadeInUp" data-wow-delay=".0s">
            <span class="btn btn-border-linear btn-filter hover-up" data-filter=""><?php echo esc_attr__('All', 'genz') ?></span>
        </span>
        <?php
        //print_r($terms);
        foreach ($terms as $term) { ?>
            <span class="wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <span class="btn btn-border-linear btn-filter hover-up" data-filter="<?php echo esc_attr($term->slug) ?>"><?php echo esc_attr($term->name) ?></span>
            </span>
        <?php }
        ?>

    </div>
</div>