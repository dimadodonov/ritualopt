<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

function woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 12;
	return $args;
}

add_filter( 'woocommerce_output_related_products_args', 'main_related_products_args', 20 );
  function main_related_products_args( $args ) {
	$args['posts_per_page'] = 12; // 4 related products
	return $args;
}

// скрываем бейдж распродажи
// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );

// remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
// remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

add_action('wp_footer', 'pmqv_wc_atc_ajax'); function pmqv_wc_atc_ajax() { if(!is_singular('product')) { wp_enqueue_script('wc-add-to-cart-variation', '/wp-content/plugins/woocommerce/assets/js/frontend/add-to-cart-variation.js'); } }