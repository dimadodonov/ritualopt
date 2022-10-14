<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */

add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
remove_filter( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

// Отключение уведомлений вукомерса
// add_filter( 'wc_add_to_cart_message', 'remove_add_to_cart_message' );

// function remove_add_to_cart_message() {
//     return;
// }

// add_filter( 'wc_add_to_cart_message', 'empty_wc_add_to_cart_message', 10, 2 );

// function empty_wc_add_to_cart_message( $message, $product_id ) {
//     return '';
// };


// Отключаем отображение кол-во товара на странице
// add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() { 
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}

// Отключаем сортировку по цене и т/д
// remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
// remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
