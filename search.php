<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

get_header();


get_template_part('template-parts/content/before');
?>

<div class="row align-items-end mt-50">
	<div class="col-lg-12 text-center">
		<div class="d-inline-block position-relative">
			<h1 class="color-white mb-10">
				<?php
				printf(
					/* translators: %s: Search term. */
					esc_html__('Search results "%s"', 'genz'),
					'<span class="page-description search-term">' . esc_html(get_search_query()) . '</span>'
				);
				?>
			</h1>
		</div>
		<p class="color-gray-500 text-base mb-20">
			<?php
			$found = sprintf(
				esc_html(
					/* translators: %d: The number of search results. */
					_n(
						'We found %d result  for',
						'We found %d results for',
						(int) $wp_query->found_posts,
						'genz'
					)
				),
				(int) $wp_query->found_posts
			);

			echo sprintf(
				'%s "%s" keyword',
				$found,
				esc_html(get_search_query())
			);
			?>
		</p>
	</div>
	<!-- col-lg-12 -->
 
	<div class="col-lg-12">
		<div class="border-bottom border-gray-800 mt-30 mb-30"></div>
	</div>
	<!-- col-lg-12 -->


</div>
<!-- row -->
<?php if (have_posts()) : ?>
	<div class="box-list-posts mt-40">
		<div class="row">

			<div class="col-lg-8 m-auto">
				<div class="box-list-posts mt-30">
					<?php
					// Start the Loop.
					while (have_posts()) {
						the_post();
						/*
							* Include the Post-Format-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Format name) and that will be used instead.
							*/
						get_template_part('template-parts/content/content', 'search');
					} // End the loop.

					get_template_part('template-parts/common/post-navigation');
					// If no content, include the "No posts found" template. 
					?>
				</div>
				<!-- box-list-posts -->
			</div>
			<!-- col-lg-8 -->

		</div>
		<!-- row -->
	</div>
	<!-- box-list-posts -->
<?php else :
	get_template_part('template-parts/content/content-none');
endif; ?>


<?php
get_template_part('template-parts/content/after');

get_footer();
