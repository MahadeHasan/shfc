<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package genz
 */

get_header();


$blog_column = is_active_sidebar('sidebar1') ? 8 : 12;

get_template_part('template-parts/content/before');
?>

 
<div class="box-list-posts-index  mt-70">
	<div class="row">
		<div class="col-lg-<?php print esc_attr($blog_column); ?>">
			<?php
			if (have_posts()) { ?>

				<h2 class="lh-1 color-linear d-inline-block mb-10"><?php echo esc_attr__("Recent posts", "genz") ?></h2>
				<p class="text-lg color-gray-500"><?php echo esc_attr__("Don't miss the latest trends", "genz") ?> </p>

				<div class="box-list-posts mt-70">
					<?php // Load posts loop.
					$count = 1;
					while (have_posts()) {
						the_post();
						if ($count == 1) {
							get_template_part('template-parts/post/grid-view');
						} else {
							get_template_part("template-parts/content/content", get_post_format());
						}
						$count++;
					}  ?>

					<!-- box-list-posts -->
					<?php get_template_part("template-parts/common/post-navigation"); ?>
					<!-- nav -->
				</div>
			<?php } else {

				// If no content, include the "No posts found" template.
				get_template_part('template-parts/content/content-none');
			}  ?>
		</div>
		<!--col-lg-8  -->
		<?php if (is_active_sidebar('sidebar1')) : ?>
			<div class="col-lg-4">
				<div class="sidebar">
					<?php dynamic_sidebar('sidebar1'); ?>
				</div>
				<!-- sidebar -->
			</div>
		<?php endif; ?>
	</div>
	<!-- row -->
</div>
<?php
get_template_part('template-parts/content/after');
get_footer(); ?>