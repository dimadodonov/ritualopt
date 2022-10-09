<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

if ( ! function_exists( 'mi_start_loop' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function mi_start_loop() {

        echo '<div class="products-loop products__loop">';
    
    }
}
add_action( 'woocommerce_before_shop_loop', 'mi_start_loop', 35, 2);

if ( ! function_exists( 'mi_end_loop' ) ) {
    /**
     * Product columns wrapper close.
     *
     * @return  void
     */
    function mi_end_loop() {

        echo '</div>';
    
    }
}
add_action( 'woocommerce_after_shop_loop', 'mi_end_loop', 40 );