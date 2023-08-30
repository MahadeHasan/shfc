<?php

/**
 * The template for displaying author info below posts.
 *
 * @package WordPress
 * @subpackage Genz
 * @since Genz 1.0
 */
$args = genz_user_custom_meta(get_the_author_meta('ID'));

$args = wp_parse_args($args, array(
	'welcome_text' => '',
	'quote_text' => '',
	'social_links' => []
));
extract($args);
?>

<?php if ((bool) get_the_author_meta('description') && (bool) get_theme_mod('show_author_bio', true)) : ?>
	<div class="banner banner-home4 bg-gray-850">
		<div class="container">
			<div class="row align-items-start">
				<div class="col-xl-1"></div>
				<div class="col-xl-10 col-lg-12">
					<div class="pt-20">
						<div class="box-banner-4">
							<div class="banner-image">
								<?php echo get_avatar(get_the_author_meta('ID'), 209, '', '', ['width' => 209, 'height' => 209]); ?>
							</div>
							<div class="banner-info">
								<?php if (!empty($welcome_text)) : ?>
									<span class="text-sm-bold color-gray-600"><?php echo esc_attr($welcome_text);  ?></span>
								<?php endif ?>
								<?php if (!empty($quote_text)) : ?>
									<h3 class="color-linear d-inline-block mt-10 mb-15"><?php echo esc_attr($quote_text); ?></h3>
								<?php endif ?>

								<?php if (!empty($social_links)) :  ?>
									<div class="box-socials admin-social">
										<?php foreach ($social_links as $social_link) :  ?>
											<a class="bg-gray-800 hover-up" href="<?php echo esc_url($social_link['social_link']) ?>">
												<?php echo genz_get_social_link_svg($social_link['social_link'], 18, false); ?>
											</a>
										<?php endforeach; ?>
									</div>
									<!-- box-socials -->
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endif ?>