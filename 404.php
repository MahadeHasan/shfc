<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

get_header();

?>
<?php get_template_part('template-parts/content/before')  ?>


<div class="box-page-404">
	<div class="text-center mb-150 mt-100">
		<div class="box-404 row">
			<div class="col-lg-6">
				<div class="image-404"><img src="<?php echo get_theme_file_uri('assets/imgs/page/404/404.svg') ?>" alt="<?php echo esc_attr(bloginfo('name')) ?>"></div>
			</div>
			<div class="col-lg-6">
				<div class="info-404 text-start mt-60">
					<h2 class="color-linear mb-20"><?php echo esc_attr__('Don\'t be spooked !', 'genz') ?></h2>
					<p class="text-xl color-gray-500"><?php echo esc_attr__('The page you’re looking for has slipped in to an unknown realm. Click the button below to go back to the homepage.', 'genz') ?></p>
					<div class="mt-25"><a class="btn btn-linear hover-up" href="<?php echo esc_attr(home_url('/')); ?>"><?php echo esc_attr__('Homepage', 'genz') ?></a></div>
				</div>
			</div>
		</div>
	</div>
</div>



<?php get_template_part('template-parts/content/after'); ?>
<?php get_footer(); ?>