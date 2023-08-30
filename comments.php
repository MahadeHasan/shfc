<?php

/**
 * The template for displaying comments
 *
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */

if (post_password_required()) {
	return;
}
$comments_number = absint(get_comments_number());
?>
<div class="mb-50">
	<div id="comments" class="comments-area mt-30">

		<?php if (have_comments()) : ?>
			<h3 class="text-heading-4 color-gray-300">
				<?php
				if (!have_comments()) {
					esc_attr_e('Leave a comment', 'genz');
				} elseif (1 === $comments_number) {
					/* translators: %s: Post title. */
					printf(esc_attr_x('1 Comment on &ldquo;%s&rdquo;', 'comments title', 'genz'), get_the_title());
				} else {
					printf(
						/* translators: 1: Number of comments, 2: Post title. */
						_nx(
							'%1$s Comment on &ldquo;%2$s&rdquo;',
							'%1$s Comments on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'genz'
						),
						number_format_i18n($comments_number),
						get_the_title()
					);
				}

				?>
			</h3>
			<div class="box-comments mt-0 border-gray-800">
				<ol class="comment-list list-comments-single">
					<?php
					wp_list_comments(array(
						'style'       => 'ol',
						'short_ping'  => true,
						'max_depth'  => 3,
						'avatar_size' => 74,
						'walker' => new Genz_Walker_Comment()
					));
					?>
				</ol><!-- .comment-list -->
			</div>
			<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
				<nav class="navigation comment-navigation" role="navigation">

					<h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'genz'); ?></h1>
					<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'genz')); ?></div>
					<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'genz')); ?></div>
				</nav><!-- .comment-navigation -->
			<?php endif; // Check for comment navigation 
			?>

			<?php if (!comments_open() && get_comments_number()) : ?>
				<p class="no-comments"><?php _e('Comments are closed.', 'genz'); ?></p>
			<?php endif; ?>

		<?php endif; // have_comments()  
		?>

		<?php comment_form(); ?>

	</div><!-- #comments -->
</div>