<?php
/*
* Theme Name: Genz
* Template Name: Single Post Without Sidebar
* Template Post Type: post
* Theme URI: https://themeforest.net/user/themeperch/portfolio
* Author: Themeperch
* Author URI: https://themeforest.net/user/themeperch/portfolio
* Description: 
* Version: 1.0
* Requires at least: 5.0
* Tested up to: 6.1.1
* Requires PHP: 7.0 
*/

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

get_header();

$post_id = get_the_ID();
$author_id = get_post_field('post_author', $post_id);
$author_posts_url = get_author_posts_url($author_id);
?>
<main class="main">
	<div class="cover-home3">
		<div class="container">
			<div class="row">
				<div class="col-xl-10 col-lg-12 mx-auto">
					<div class="pt-30 border-bottom border-gray-800 pb-20">
						<div class="box-breadcrumbs">
							<?php echo genz_custom_breadcrumbs(); ?>
						</div>
					</div>
					<!-- breadcrumbs -->

					<div class="row mt-50 align-items-end">
						<div class="col-lg-8 m-auto text-center">
							<?php genz_post_title(); ?>
						</div>
					</div>
					<!-- row -->

					<div class="row mt-30">
						<div class="col-lg-12">
							<div class="image-detail mb-30">
								<?php if (has_post_thumbnail()) : ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('genz-1009x450-cropped', ['class' => 'bdrd16']); ?>
									</a>
								<?php endif ?>
							</div>
						</div>
						<!-- col-lg-12 -->
						<div class="col-lg-8 m-auto">
							<div class="row mb-40">
								<div class="col-md-6 mb-10">
									<div class="box-author">
										<?php echo get_avatar(get_the_author_meta('ID', $author_id), 64, '', '', ['width' => 48, 'height' => 48]); ?>
										<div class="author-info lh-1">
											<h6 class="color-gray-500">
												<a href="<?php echo esc_url($author_posts_url) ?>"><?php echo get_the_author_meta('display_name', $author_id) ?></a>
											</h6>
											<span class="color-gray-700 text-sm mr-15"><?php echo get_the_date('', $post_id); ?></span>
											<span class="color-gray-700 text-sm"><?php echo genz_get_post_reading_time(); ?></span>
										</div>
										<!-- author-info -->
									</div>
								</div>
								<!-- col-md-6 -->
								<div class="col-md-6 text-start text-md-end">
									<div class="d-inline-block pt-10">
										<?php
										if (function_exists('genz_post_share_links')) {
											echo genz_post_share_links(esc_attr__('Share', 'genz'), 'd-flex align-item-center');
										}
										?>
									</div>
								</div>
								<!-- col-md-6 -->
							</div>
							<!-- row -->
							<div class="content-detail border-gray-800">
								<?php the_content(); ?>
							</div>
							<!-- content-detail -->
							<div class="box-tags">
								<?php echo genz_post_tags_style2(); ?>
							</div>
							<!-- box-form-comments -->
							<?php
							//If comments are open or there is at least one comment, load up the comment template.
							if (comments_open() || get_comments_number()) {
								comments_template();
							}
							?>
						</div>
						<!-- col-lg-8 -->
					</div>
					<!-- row -->
				</div><!-- #col-xl-10 -->
			</div><!-- row -->
		</div><!-- #container -->
	</div><!-- #cover-home1 -->
</main><!-- #main -->
<?php
get_footer();
