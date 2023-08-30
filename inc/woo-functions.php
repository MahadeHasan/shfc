<?php
// Change number or products per row to 3
add_filter('loop_shop_columns', 'eventor_loop_columns');
if (!function_exists('eventor_loop_columns')) {
	function eventor_loop_columns()
	{
		return 3; // 3 products per row
	}
}

function eventor_get_cart_icon($extra_class = '')
{
	$output = '';
	$header_cart_icon = genz_get_option('header_cart_icon', 'on');
	if ($header_cart_icon == 'off') return false;
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
		$classes = [
			'cart-icon',
			$extra_class
		];
		$count = WC()->cart->cart_contents_count;
		$output .= '<div class="' . join(' ', array_filter($classes)) . '"><a class="cart-contents" href="' . wc_get_cart_url() . '"><i class="pe-7s-cart primary-color"></i>';
		if ($count > 0) {
			$output .= '<span class="cart-contents-count">' . esc_html($count) . '</span>';
		}
		$output .= '</a></div>';
	}

	return $output;
}

/**
 * Add Cart icon and count to header if WC is active
 */
function my_wc_cart_count()
{
	$output = '';
	if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {

		$count = WC()->cart->cart_contents_count;
		$output .= '<a class="cart-contents" href="' . wc_get_cart_url() . '" title="' . __('View your shopping cart', 'eventor') . '"><i class="pe-7s-cart primary-color"></i>';
		if ($count > 0) {

			$output .= '<span class="cart-contents-count">' . esc_html($count) . '</span>';
		}
		$output .= '</a>';
	}
}
add_action('your_theme_header_top', 'my_wc_cart_count');

add_filter('woocommerce_account_menu_item_classes', 'eventor_woo_account_menu_item_classes', 10, 2);

function eventor_woo_account_menu_item_classes($classes, $endpoint)
{
	if (in_array('is-active', $classes)) $classes[] = 'active';

	return $classes;
}

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
function eventor_add_to_cart_fragment($fragments)
{

	ob_start();
	$count = WC()->cart->cart_contents_count;
?><a class="cart-contents" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'eventor'); ?>"><i class="pe-7s-cart primary-color"></i><?php
																																										if ($count > 0) {
																																										?>
			<span class="cart-contents-count"><?php echo esc_html($count); ?></span>
		<?php
																																										}
		?></a><?php

				$fragments['a.cart-contents'] = ob_get_clean();

				return $fragments;
			}
			add_filter('woocommerce_add_to_cart_fragments', 'eventor_add_to_cart_fragment');

			function woocommerce_template_loop_product_title()
			{
				echo '<div class="caption-title"><h3 class="title fs-4 mb-2">' . get_the_title() . '</h3></div>';
			}

			/**
			 * Sets a new image size for our single product images
			 *
			 */
			function eventor_single_image_size($size)
			{

				$size['width'] = genz_get_option('single_image_width', 525);
				$size['height'] = genz_get_option('single_image_height', 715);

				return $size;
			} // wptt_single_image_size
			add_filter('woocommerce_get_image_size_shop_single', 'eventor_single_image_size');

			/**
			 * Sets a new image size for our single product images
			 *
			 */
			function eventor_get_image_size_shop_catalog($size)
			{

				$size['width'] = genz_get_option('catalog_image_width', 350);
				$size['height'] = genz_get_option('catalog_image_height', 475);

				return $size;
			} // wptt_single_image_size
			add_filter('woocommerce_get_image_size_shop_catalog', 'eventor_get_image_size_shop_catalog');
			/**
			 * Sets a new image size for our single product images
			 *
			 */
			function eventor_get_image_size_shop_thumbnail($size)
			{

				$size['width'] = 150;
				$size['height'] = 180;

				return $size;
			} // wptt_single_image_size
			add_filter('woocommerce_get_image_size_shop_thumbnail', 'eventor_get_image_size_shop_thumbnail');

			function eventor_product_signup_url()
			{
				global $woocommerce, $post;
				$checkout_url = $woocommerce->cart->get_checkout_url() . '?add-to-cart=' . $post->ID;
				return $checkout_url;
			}

			if (!function_exists('woocommerce_form_field')) {

				function woocommerce_form_field($key, $args, $value = null)
				{
					$defaults = array(
						'type'              => 'text',
						'label'             => '',
						'description'       => '',
						'placeholder'       => '',
						'maxlength'         => false,
						'required'          => false,
						'autocomplete'      => false,
						'id'                => $key,
						'class'             => array('form-group'),
						'label_class'       => array(),
						'input_class'       => array('form-control'),
						'return'            => false,
						'options'           => array(),
						'custom_attributes' => array(),
						'validate'          => array(),
						'default'           => '',
					);

					$args = wp_parse_args($args, $defaults);
					$args = apply_filters('woocommerce_form_field_args', $args, $key, $value);

					$args['placeholder'] = $args['label'];
					$args['label'] = '';

					if ($args['required']) {
						$args['class'][] = 'validate-required';
						$required = ' <abbr class="required" title="' . esc_attr__('required', 'eventor') . '">*</abbr>';
					} else {
						$required = '';
					}

					$args['maxlength'] = ($args['maxlength']) ? 'maxlength="' . absint($args['maxlength']) . '"' : '';

					$args['autocomplete'] = ($args['autocomplete']) ? 'autocomplete="' . esc_attr($args['autocomplete']) . '"' : '';

					if (is_string($args['label_class'])) {
						$args['label_class'] = array($args['label_class']);
					}

					if (is_null($value)) {
						$value = $args['default'];
					}

					// Custom attribute handling
					$custom_attributes = array();

					if (!empty($args['custom_attributes']) && is_array($args['custom_attributes'])) {
						foreach ($args['custom_attributes'] as $attribute => $attribute_value) {
							$custom_attributes[] = esc_attr($attribute) . '="' . esc_attr($attribute_value) . '"';
						}
					}

					if (!empty($args['validate'])) {
						foreach ($args['validate'] as $validate) {
							$args['class'][] = 'validate-' . $validate;
						}
					}

					$field = '';
					$label_id = $args['id'];
					$field_container = '<div class="form-row %1$s" id="%2$s">%3$s</div>';

					switch ($args['type']) {
						case 'country':

							$countries = 'shipping_country' === $key ? WC()->countries->get_shipping_countries() : WC()->countries->get_allowed_countries();


							if (1 === sizeof($countries)) {

								$field .= '<strong>' . current(array_values($countries)) . '</strong>';

								$field .= '<input type="hidden" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="' . current(array_keys($countries)) . '" ' . implode(' ', $custom_attributes) . ' class="country_to_state" readonly="readonly" />';
							} else {

								$field = '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="country_to_state country_select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . '>' . '<option value="">' . esc_html__('Select a country&hellip;', 'eventor') . '</option>';

								foreach ($countries as $ckey => $cvalue) {
									$field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . $cvalue . '</option>';
								}


								$field .= '</select>';

								$field .= '<noscript><input type="submit" name="woocommerce_checkout_update_totals" value="' . esc_attr__('Update country', 'eventor') . '" /></noscript>';
							}

							break;
						case 'state':

							/* Get Country */
							$country_key = 'billing_state' === $key ? 'billing_country' : 'shipping_country';
							$current_cc  = WC()->checkout->get_value($country_key);
							$states      = WC()->countries->get_states($current_cc);

							if (is_array($states) && empty($states)) {

								$field_container = '<p class="form-row %1$s" id="%2$s" style="display: none">%3$s</p>';

								$field .= '<input type="hidden" class="hidden" name="' . esc_attr($key)  . '" id="' . esc_attr($args['id']) . '" value="" ' . implode(' ', $custom_attributes) . ' placeholder="' . esc_attr($args['placeholder']) . '" />';
							} elseif (is_array($states)) {

								$field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="state_select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder']) . '" ' . $args['autocomplete'] . '>
						<option value="">' . __('Select a state&hellip;', 'eventor') . '</option>';

								foreach ($states as $ckey => $cvalue) {
									$field .= '<option value="' . esc_attr($ckey) . '" ' . selected($value, $ckey, false) . '>' . $cvalue . '</option>';
								}

								$field .= '</select>';
							} else {

								$field .= '<input type="text" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($value) . '"  placeholder="' . esc_attr($args['placeholder']) . '" ' . $args['autocomplete'] . ' name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" ' . implode(' ', $custom_attributes) . ' />';
							}

							break;
						case 'textarea':

							$field .= '<textarea name="' . esc_attr($key) . '" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' ' . (empty($args['custom_attributes']['rows']) ? ' rows="2"' : '') . (empty($args['custom_attributes']['cols']) ? ' cols="5"' : '') . implode(' ', $custom_attributes) . '>' . esc_textarea($value) . '</textarea>';

							break;
						case 'checkbox':

							$field = '<label class="checkbox ' . implode(' ', $args['label_class']) . '" ' . implode(' ', $custom_attributes) . '>
						<input type="' . esc_attr($args['type']) . '" class="input-checkbox ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" value="1" ' . checked($value, 1, false) . ' /> '
								. $args['label'] . $required . '</label>';

							break;
						case 'password':
						case 'text':
						case 'email':
						case 'tel':
						case 'number':

							$field .= '<input type="' . esc_attr($args['type']) . '" class="input-text ' . esc_attr(implode(' ', $args['input_class'])) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" placeholder="' . esc_attr($args['placeholder']) . '" ' . $args['maxlength'] . ' ' . $args['autocomplete'] . ' value="' . esc_attr($value) . '" ' . implode(' ', $custom_attributes) . ' />';

							break;
						case 'select':

							$options = $field = '';

							if (!empty($args['options'])) {
								foreach ($args['options'] as $option_key => $option_text) {
									if ('' === $option_key) {
										// If we have a blank option, select2 needs a placeholder
										if (empty($args['placeholder'])) {
											$args['placeholder'] = $option_text ? $option_text : __('Choose an option', 'eventor');
										}
										$custom_attributes[] = 'data-allow_clear="true"';
									}
									$options .= '<option value="' . esc_attr($option_key) . '" ' . selected($value, $option_key, false) . '>' . esc_attr($option_text) . '</option>';
								}

								$field .= '<select name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '" class="select ' . esc_attr(implode(' ', $args['input_class'])) . '" ' . implode(' ', $custom_attributes) . ' data-placeholder="' . esc_attr($args['placeholder']) . '" ' . $args['autocomplete'] . '>
							' . $options . '
						</select>';
							}

							break;
						case 'radio':

							$label_id = current(array_keys($args['options']));

							if (!empty($args['options'])) {
								foreach ($args['options'] as $option_key => $option_text) {
									$field .= '<input type="radio" class="input-radio ' . esc_attr(implode(' ', $args['input_class'])) . '" value="' . esc_attr($option_key) . '" name="' . esc_attr($key) . '" id="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '"' . checked($value, $option_key, false) . ' />';
									$field .= '<label for="' . esc_attr($args['id']) . '_' . esc_attr($option_key) . '" class="radio ' . implode(' ', $args['label_class']) . '">' . $option_text . '</label>';
								}
							}

							break;
					}

					if (!empty($field)) {



						$field_html = '';


						if ($args['label'] && 'checkbox' != $args['type']) {
							$field_html .= '<label for="' . esc_attr($label_id) . '" class="' . esc_attr(implode(' ', $args['label_class'])) . '">' . $args['label'] . $required . '</label>';
						}

						$field_html .= $field;

						if ($args['description']) {
							$field_html .= '<span class="description">' . esc_html($args['description']) . '</span>';
						}

						$container_class = 'form-row form-group ' . esc_attr(implode(' ', $args['class']));
						$container_id = esc_attr($args['id']) . '_field';

						$after = !empty($args['clear']) ? '<div class="clear"></div>' : '';

						$field = sprintf($field_container, $container_class, $container_id, $field_html) . $after;
					}

					$field = apply_filters('woocommerce_form_field_' . $args['type'], $field, $key, $args, $value);



					if ($args['return']) {
						return $field;
					} else {
						echo genz_return_data($field);
					}
				}
			}
			if (!function_exists('eventor_product_list')) :
				function eventor_product_list()
				{
					$product_list = get_post_meta(get_the_ID(), 'product_list', true);
					if (!empty($product_list)) {
						foreach ($product_list as $key => $value) {
							echo '<li><span><strong>' . esc_attr($value['title']) . '</strong> : </span>' . esc_attr($value['desc']) . '</li>';
						}
					}
				}
			endif;

			add_action('woocommerce_show_page_title', 'eventor_woocommerce_show_page_title');
			function eventor_woocommerce_show_page_title()
			{
				return false;
			}

			/**
			 * Change the add to cart text on single product pages
			 */

			function eventor_cart_button_text()
			{

				global $woocommerce;
				foreach ($woocommerce->cart->get_cart() as $cart_item_key => $values) {
					$_product = $values['data'];

					if (get_the_ID() == $values['product_id']) {
						return sprintf(_x('%s', 'Added to cart text', 'eventor'), genz_get_option('added_to_cart_text', 'Already in cart'));
					}
				}
				return sprintf(_x('%s', 'Add to cart text', 'eventor'), genz_get_option('add_to_cart_text', 'Add to cart'));
			}
			add_filter('woocommerce_product_single_add_to_cart_text', 'eventor_cart_button_text');

			/**
			 * Change the add to cart text on product archives
			 */
			function eventor_archive_custom_cart_button_text()
			{

				global $product, $post;

				if (function_exists('wc_get_product')) {
					$product = wc_get_product($post->ID);
					$product_type = WC_Product_Factory::get_product_type($post->ID);

					if ($product_type == 'external') {
						return sprintf(_x('%s', 'Add to cart text for external product', 'eventor'), genz_get_option('external_add_to_cart_text', 'Buy product'));
					} elseif ($product_type == 'grouped') {
						return sprintf(_x('%s', 'Add to cart text for Grouped product', 'eventor'), genz_get_option('grouped_add_to_cart_text', 'View products'));
					} elseif ($product_type == 'simple') {
						return sprintf(_x('%s', 'Add to cart text for Simple product', 'eventor'), genz_get_option('archive_add_to_cart_text', 'Add to cart'));
					} elseif ($product_type == 'variable') {
						return sprintf(_x('%s', 'Add to cart text for Variable product', 'eventor'), genz_get_option('variable_add_to_cart_text', 'Select options'));
					} else {
						return _x('Read more', 'Add to cart text by default',  'eventor');
					}
				} else {

					$product_type = $product->product_type;

					switch ($product_type) {
						case 'external':
							return sprintf(_x('%s', 'Add to cart text for external product', 'eventor'), genz_get_option('external_add_to_cart_text', 'Buy product'));
							break;
						case 'grouped':
							return sprintf(_x('%s', 'Add to cart text for Grouped product', 'eventor'), genz_get_option('grouped_add_to_cart_text', 'View products'));
							break;
						case 'simple':
							return sprintf(_x('%s', 'Add to cart text for Simple product', 'eventor'), genz_get_option('archive_add_to_cart_text', 'Add to cart'));
							break;
						case 'variable':
							return sprintf(_x('%s', 'Add to cart text for Variable product', 'eventor'), genz_get_option('variable_add_to_cart_text', 'Select options'));
							break;
						default:
							return _x('Read more', 'Add to cart text by default', 'eventor');
					}
				}
			}
			add_filter('woocommerce_product_add_to_cart_text', 'eventor_archive_custom_cart_button_text');


			if (!function_exists('woocommerce_content')) {

				/**
				 * Output WooCommerce content.
				 *
				 * This function is only used in the optional 'woocommerce.php' template.
				 * which people can add to their themes to add basic woocommerce support.
				 * without hooks or modifying core templates.
				 *
				 */
				function woocommerce_content1()
				{



					if (is_singular('product')) {

						while (have_posts()) : the_post();

							wc_get_template_part('content', 'single-product');

						endwhile;
					} else { ?>

			<?php if (apply_filters('woocommerce_show_page_title', true)) : ?>

				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>

			<?php endif; ?>

			<?php do_action('woocommerce_archive_description'); ?>

			<?php if (have_posts()) : ?>

				<?php do_action('woocommerce_before_shop_loop'); ?>

				<?php woocommerce_product_loop_start(); ?>

				<?php eventor_product_subcategories(); ?>

				<div class="row">
					<?php $count = 1;
							$column = eventor_loop_columns(); ?>
					<?php while (have_posts()) : the_post(); ?>

						<div class="col-lg-<?php echo (12 / $column) ?> col-sm-<?php echo (12 / $column) ?>">
							<?php wc_get_template_part('content', 'product'); ?>
						</div>
						<?php
								$clearfix = $count % $column == 0 ? '<div class="clearfix"></div>' : '';
								echo genz_return_data($clearfix);
						?>
						<?php $count++; ?>
					<?php endwhile; // end of the loop. 
					?>
				</div>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action('woocommerce_after_shop_loop'); ?>

			<?php elseif (!eventor_product_subcategories(array('before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)))) : ?>

				<?php wc_get_template('loop/no-products-found.php'); ?>

<?php endif;
					}
				}
			}

			if (!function_exists('eventor_product_subcategories')) {

				/**
				 * Display product sub categories as thumbnails.
				 *
				 * @subpackage	Loop
				 * @param array $args
				 * @return null|boolean
				 */
				function eventor_product_subcategories($args = array())
				{
					global $wp_query;

					$defaults = array(
						'before'        => '<div class="product-categories-carousel owl-carousel" data-column="' . eventor_loop_columns() . '">',
						'after'         => '</div>',
						'force_display' => false
					);

					$args = wp_parse_args($args, $defaults);

					extract($args);

					// Main query only
					if (!is_main_query() && !$force_display) {
						return;
					}

					// Don't show when filtering, searching or when on page > 1 and ensure we're on a product archive
					if (is_search() || is_filtered() || is_paged() || (!is_product_category() && !is_shop())) {
						return;
					}

					// Check categories are enabled
					if (is_shop() && '' === get_option('woocommerce_shop_page_display')) {
						return;
					}

					// Find the category + category parent, if applicable
					$term 			= get_queried_object();
					$parent_id 		= empty($term->term_id) ? 0 : $term->term_id;

					if (is_product_category()) {
						$display_type = get_woocommerce_term_meta($term->term_id, 'display_type', true);

						switch ($display_type) {
							case 'products':
								return;
								break;
							case '':
								if ('' === get_option('woocommerce_category_archive_display')) {
									return;
								}
								break;
						}
					}

					// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( https://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
					$product_categories = get_categories(apply_filters('woocommerce_product_subcategories_args', array(
						'parent'       => $parent_id,
						'menu_order'   => 'ASC',
						'hide_empty'   => 0,
						'hierarchical' => 1,
						'taxonomy'     => 'product_cat',
						'pad_counts'   => 1
					)));

					if (!apply_filters('woocommerce_product_subcategories_hide_empty', false)) {
						$product_categories = wp_list_filter($product_categories, array('count' => 0), 'NOT');
					}

					if ($product_categories) {
						echo genz_return_data($before);

						foreach ($product_categories as $category) {

							wc_get_template('content-product_cat.php', array(
								'category' => $category
							));
						}

						// If we are hiding products disable the loop and pagination
						if (is_product_category()) {
							$display_type = get_woocommerce_term_meta($term->term_id, 'display_type', true);

							switch ($display_type) {
								case 'subcategories':
									$wp_query->post_count    = 0;
									$wp_query->max_num_pages = 0;
									break;
								case '':
									if ('subcategories' === get_option('woocommerce_category_archive_display')) {
										$wp_query->post_count    = 0;
										$wp_query->max_num_pages = 0;
									}
									break;
							}
						}

						if (is_shop() && 'subcategories' === get_option('woocommerce_shop_page_display')) {
							$wp_query->post_count    = 0;
							$wp_query->max_num_pages = 0;
						}

						echo genz_return_data($after);

						return true;
					}
				}
			}

			if (class_exists('YITH_WCWL')) :
				add_action('woocommerce_after_add_to_cart_button', 'eventor_woocommerce_after_add_to_cart_button');
				function eventor_woocommerce_after_add_to_cart_button()
				{

					echo do_shortcode('[yith_wcwl_add_to_wishlist label="" product_added_text="" icon="fa fa-heart-o" already_in_wishslist_text="" browse_wishlist_text=""]');
				}
			endif;
