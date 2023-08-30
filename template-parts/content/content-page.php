<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

$display_title = get_post_meta(get_the_ID(), 'display_title');
$display_title = !empty($display_title[0]) ? $display_title[0] : false;
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content text-xl color-gray-500">

		<?php if ($display_title) : ?>
			<h1 class="color-linear mt-70  text-center d-block mb-30"><?php the_title(); ?></h1>
		<?php endif ?>
		<div class="">
			<?php the_content(); ?>
		</div>
		<?php
		wp_link_pages(
			array(
				'before'   => '<nav class="page-links" aria-label="' . esc_attr__('Page', 'genz') . '">',
				'after'    => '</nav>',
				/* translators: %: Page number. */
				'pagelink' => esc_html__('Page %', 'genz'),
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if (get_edit_post_link()) : ?>
		<div class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Post title. Only visible to screen readers. */
					esc_html__('Edit %s', 'genz'),
					'<span class="screen-reader-text">' . get_the_title() . '</span>'
				),
				'<span class="edit-link color-gray-500">',
				'</span>'
			);
			?>
		</div><!-- .entry-footer -->
	<?php endif; ?>
</div>