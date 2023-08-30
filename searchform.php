<?php

/**
 * The searchform.php template.
 *
 * Used any time that get_search_form() is called.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_unique_id/
 * @link https://developer.wordpress.org/reference/functions/get_search_form/
 *
 * @package WordPress
 * @subpackage scissors
 * @since scissors 1.0
 */

/*
 * Generate a unique ID for each form and a string containing an aria-label
 * if one was passed to get_search_form() in the args array.
 */
$scissors_unique_id = wp_unique_id('search-form-');

$genz_aria_label = !empty($args['aria_label']) ? 'aria-label="' . esc_attr($args['aria_label']) . '"' : '';
?>
<form role="search" <?php echo genz_return_data($genz_aria_label); ?> method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
	<div class="input-group">
		<label class="screen-reader-text" for="<?php echo esc_attr($genz_unique_id); ?>">
			<?php _e('Search&hellip;', 'scissors'); ?></label>
		<input type="search" id="<?php echo esc_attr($genz_unique_id); ?>" class="search-field form-control bg-gray-850 border-gray-800 color-gray-500" value="<?php echo get_search_query(); ?>" name="s" />
		<input type="submit" class="search-submit btn btn-linear btn-load-more btn-radius-8 hover-up" value="<?php echo esc_attr_x('Search', 'submit button', 'scissors'); ?>" />
	</div>
</form>