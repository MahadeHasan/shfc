<?php

/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

?>

<div class="no-results not-found  mt-40 pb-30 row">
	<div class="page-content default-max-width col-lg-8 mx-auto">

		<div class="page-header text-center">
			<?php if (!is_search()) : ?> 
				<h1 class="page-title color-linear d-inline-block mb-30"><?php esc_html_e('Nothing here', 'genz'); ?></h1>
			<?php endif; ?>
		</div><!-- .page-header -->	

		<?php if (is_home() && current_user_can('publish_posts')) : ?>

			<?php
			printf(
				'<p class="text-center">' . wp_kses(
					/* translators: %s: Link to WP admin new post page. */
					__('Ready to publish your first post? <a href="%s">Get started here</a>.', 'genz'),
					array(
						'a' => array(
							'href' => array(),
						),
					)
				) . '</p>',
				esc_url(admin_url('post-new.php'))
			);
			?>

		<?php elseif (is_search()) : ?>

			<p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'genz'); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'genz'); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .page-content -->
</div><!-- .no-results -->