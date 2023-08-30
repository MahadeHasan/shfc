<?php
add_filter('woocommerce_post_class', 'eventor_woocommerce_product_class', 10, 2);
function eventor_woocommerce_product_class($classes, $product)
{
    return $classes;
}

add_filter('woocommerce_product_loop_title_classes', 'eventor_product_loop_title_classes');
function eventor_product_loop_title_classes($classes)
{
    $classes .= ' fs-4';
    return $classes;
}

add_filter('woocommerce_sale_flash', 'eventor_woocommerce_sale_flash');
function eventor_woocommerce_sale_flash()
{
    return '<span class="onsale m-15 small d-inline-flex align-items-center justify-content-center rounded-circle">' . esc_html__('Sale!', 'eventor') . '</span>';
}

add_filter('woocommerce_loop_add_to_cart_args', function ($args) {
    $args['class'] .= ' loop-add-to-cart';
    return $args;
});

add_filter('woocommerce_output_related_products_args', 'eventor_related_products_args', 20);
function eventor_related_products_args($args)
{

    $columns = 3;
    $posts_per_page = genz_get_option('related_product', 6);
    $product_column = genz_get_option('related_product_column', $columns);

    $args['posts_per_page'] = $posts_per_page;
    $args['columns'] = $product_column;
    return $args;
}

/**
 * Change number of upsells output
 */
add_filter('woocommerce_upsell_display_args', 'eventor_change_number_related_products', 20);

function eventor_change_number_related_products($args)
{
    $columns = 4;
    $args['posts_per_page'] = $columns * 1;
    $args['columns'] = $columns;

    return $args;
}

add_filter('woocommerce_dropdown_variation_attribute_options_args', function ($args) {
    $args['class'] = 'form-select form-select-sm';
    return $args;
});

add_filter('wp_get_attachment_image_attributes', function ($attr) {
    $attr['class'] .= ' img-fluid';
    return $attr;
});

add_filter('wc_add_to_cart_message_html', 'eventor_wc_add_to_cart_message', 10, 3);

/**
 * Add to cart messages.
 *
 * @param int|array $products Product ID list or single product ID.
 * @param bool      $show_qty Should qty's be shown? Added in 2.6.0.
 * @param bool      $return   Return message rather than add it.
 *
 * @return mixed
 */
function eventor_wc_add_to_cart_message($message, $products, $show_qty)
{
    $titles = array();
    $count  = 0;

    if (!is_array($products)) {
        $products = array($products => 1);
        $show_qty = false;
    }

    if (!$show_qty) {
        $products = array_fill_keys(array_keys($products), 1);
    }

    foreach ($products as $product_id => $qty) {
        /* translators: %s: product name */
        $titles[] = apply_filters('woocommerce_add_to_cart_qty_html', ($qty > 1 ? absint($qty) . ' &times; ' : ''), $product_id) . apply_filters('woocommerce_add_to_cart_item_name_in_quotes', sprintf(_x('&ldquo;%s&rdquo;', 'Item name in quotes', 'eventor'), strip_tags(get_the_title($product_id))), $product_id);
        $count   += $qty;
    }

    $titles = array_filter($titles);
    /* translators: %s: product name */
    $added_text = sprintf(_n('%s has been added to your cart.', '%s have been added to your cart.', $count, 'eventor'), wc_format_list_of_items($titles));

    // Output success messages.
    if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
        $return_to = apply_filters('woocommerce_continue_shopping_redirect', wc_get_raw_referer() ? wp_validate_redirect(wc_get_raw_referer(), false) : wc_get_page_permalink('shop'));
        $message   = sprintf('<a href="%s" tabindex="1" class="button wc-forward">%s</a> %s', esc_url($return_to), esc_html__('Continue shopping', 'eventor'), esc_html($added_text));
    } else {
        $message = sprintf('<p class="small mb-0">%3$s</p><hr /><a href="%1$s" tabindex="1" class="btn btn-sm btn-linear wc-forward">%2$s</a>', esc_url(wc_get_cart_url()), esc_html__('View cart', 'eventor'), esc_html($added_text));
    }


    $message = apply_filters('eventor_add_to_cart_message_html', $message, $products, $show_qty);

    return $message;
}

add_filter('woocommerce_loop_add_to_cart_link', 'eventor_loop_add_to_cart_link', 10, 3);
function eventor_loop_add_to_cart_link($output, $product, $args)
{
    if (isset($args['class'])) {
        $args['class'] = $args['class'] . ' btn btn-linear';
    }

    $output = apply_filters(
        'eventor_loop_add_to_cart_link', // WPCS: XSS ok.
        sprintf(
            '<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
            esc_url($product->add_to_cart_url()),
            esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
            esc_attr(isset($args['class']) ? $args['class'] : 'button'),
            isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
            wp_kses_post($product->add_to_cart_text())
        ),
        $product,
        $args
    );
    return $output;
}

add_filter('woocommerce_product_add_to_cart_text', 'eventor_product_add_to_cart_text');
function eventor_product_add_to_cart_text($button_text)
{
    return '<i class="pe-7s-cart"></i> <span>' . $button_text . '</span>';
}

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
if (!function_exists('woocommerce_template_loop_product_link_open')) {
    /**
     * Insert the opening anchor tag for products in the loop.
     */
    function woocommerce_template_loop_product_link_open()
    {
        global $product;

        $link = apply_filters('woocommerce_loop_product_link', get_the_permalink(), $product);

        echo '<div class="card-image"><a href="' . esc_url($link) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';
    }
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 15);
if (!function_exists('woocommerce_template_loop_product_link_close')) {
    /**
     * Insert the closing anchor tag for products in the loop.
     */
    function woocommerce_template_loop_product_link_close()
    {
        echo '</a></div><div class="card-body pb-0">';
    }
}

add_action('woocommerce_after_shop_loop_item_title', 'eventor_after_shop_loop_item_title_after', 99);
function eventor_after_shop_loop_item_title_after()
{
}

add_action('woocommerce_after_shop_loop_item', 'eventor_template_loop_add_to_cart_before', 5);
function eventor_template_loop_add_to_cart_before()
{
    echo '<div class="product-footer pt-15"><div class="fs-6 d-flex align-items-center gap-4 mt-10">';
}
add_action('woocommerce_after_shop_loop_item', 'eventor_template_loop_add_to_cart_after', 99);
function eventor_template_loop_add_to_cart_after()
{
    echo '</div></div>';
    echo '</div>';
}


add_filter('woocommerce_before_widget_product_list', function () {
    return '<div class="product_list_widget d-grid gap-20">';
});

add_filter('woocommerce_after_widget_product_list', function () {
    return '</div>';
});

add_action('woocommerce_before_shop_loop', function () {
    echo '<div class="d-grid d-sm-flex align-items-start justify-content-between gap-10 mb-20">';
}, 15);
add_action('woocommerce_before_shop_loop', function () {
    echo '</div>';
}, 35);

add_filter('single_product_archive_thumbnail_size', function ($size) {
    $size = genz_get_option('product_thumbnail_size', 'investment-400x400-crop');
    return $size;
});

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
add_action('woocommerce_shop_loop_item_title', 'genz_woocommerce_template_loop_product_title', 10);
if (!function_exists('genz_woocommerce_template_loop_product_title')) {

    /**
     * Show the product title in the product loop. By default this is an H2.
     */
    function genz_woocommerce_template_loop_product_title()
    {
        echo '<a href="' . get_permalink() . '"><h4 class="color-white mb-10 ' . esc_attr(apply_filters('woocommerce_product_loop_title_classes', 'woocommerce-loop-product__title')) . '">' . get_the_title() . '</h4></a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}


add_filter('woocommerce_product_review_comment_form_args', 'genz_woocommerce_product_review_comment_form_args');
function genz_woocommerce_product_review_comment_form_args($comment_form)
{
    $comment_form['class_submit'] = 'btn btn-linear';
    return $comment_form;
}
