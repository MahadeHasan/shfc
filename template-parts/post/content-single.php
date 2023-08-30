<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

$blog_column = is_active_sidebar('sidebar1') ? '8' : '12';

?>

<div class="pt-30 border-bottom border-gray-800 pb-20">
	<div class="box-breadcrumbs">
		<?php echo genz_custom_breadcrumbs(); ?>
	</div>
</div>
<!-- breadcrumbs -->

<!-- Author Bioand Post Title -->
<div class="row mt-50 align-items-end">
	<div class="col-lg-9 col-md-8">
		<?php genz_post_title(); ?>
		<div class="box-author">
			<?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['width' => 48, 'height' => 48]); ?>
			<div class="author-info lh-1">
				<h6 class="color-gray-500"><?php the_author_posts_link(); ?></h6>
				<span class="color-gray-700 text-sm mr-15"><?php the_date(); ?></span>
				<span class="color-gray-700 text-sm"><?php echo genz_get_post_reading_time(); ?></span>
			</div>
			<!-- author-info -->
		</div>
		<!-- box-author -->
	</div>
	<!-- col-lg-9 -->
	<div class="col-lg-3 col-md-4">
		<?php
		if (function_exists('genz_post_share_links')) {
			echo genz_post_share_links(esc_attr__('Share', 'genz'), 'box-share border-gray-800');
		}
		?>
	</div>
	<!-- col-lg-3 -->
</div>
<!-- row -->

<div class="row  mt-50">
	<div class="col-lg-<?php echo esc_attr($blog_column); ?>">
		<div class="content-detail border-gray-800">
			<?php
			the_content();

			wp_link_pages(
				array(
					'before'   => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'genz') . '">',
					'after'    => '</nav>',
					'pagelink' => esc_html__('Page %', 'genz'),
				)
			);
			?>
		</div>
		<div class="box-tags">
			<?php echo genz_post_tags_style2(); ?>
		</div>
		<!-- box-tags -->

		<!-- box-form-comments -->
		<?php
		//If comments are open or there is at least one comment, load up the comment template.
		if (comments_open() || get_comments_number()) {
			comments_template();
		}
		?>
	</div>
	<?php if (is_active_sidebar('sidebar1')) : ?>
		<div class="col-lg-4">
			<div class="sidebar">
				<?php get_sidebar(); ?>
			</div>
			<!-- sidebar -->
		</div>
	<?php endif; ?>
</div>
<!-- Post Single Content -->