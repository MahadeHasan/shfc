<div class="row mt-50 align-items-end">
    <div class="col-lg-8 m-auto text-center">
        <h2 class="color-linear"><?php the_title(); ?></h2>
    </div>
</div>

<?php get_template_part('template-parts/project/slider') ?>


<div class="row">
    <div class="col-lg-8">
        <div class="content-detail border-gray-800 text-lg color-gray-500">
            <?php the_content(); ?>
            <?php get_template_part('template-parts/project/gallery') ?>
            <?php get_template_part('template-parts/project/hire-me') ?>
        </div>
        <?php get_template_part('template-parts/project/skills') ?>
    </div>
    <div class="col-lg-4">
        <div class="sidebar">

            <?php get_template_part('template-parts/project/informations') ?>

            <?php get_template_part('template-parts/project/share') ?>
        </div>
    </div>
</div>