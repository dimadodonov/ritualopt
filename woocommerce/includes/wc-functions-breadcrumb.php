<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}


// Remove default WooCommerce breadcrumbs and add Yoast ones instead
// remove_action( 'woocommerce_before_main_content','woocommerce_breadcrumb', 20, 0 );

// add_action( 'woocommerce_before_main_content','my_yoast_breadcrumb', 20, 0);

if (!function_exists('my_yoast_breadcrumb') ) {
    function my_yoast_breadcrumb() {
        if(is_product()) : 
        yoast_breadcrumb('<div class="container"><div class="breadcrumbs__wrap"><div id="breadcrumbs" class="breadcrumbs">','</div></div></div>');
        endif;
    }
}