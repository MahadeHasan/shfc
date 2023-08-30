<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage genz
 * @since genz 1.0
 */

get_header();

?>
<?php get_template_part('template-parts/content/before')  ?>
	<?php if (have_posts()) : ?> 
		<?php while (have_posts()) : ?>
			<?php the_post(); ?>
			<?php get_template_part('template-parts/content/content', get_post_format()); ?>
		<?php endwhile; ?>
	
	<?php else : ?>
		<?php get_template_part('template-parts/content/content-none'); ?>
	<?php endif; ?>
<?php get_template_part('template-parts/content/after'); ?>
<?php get_footer(); ?>
