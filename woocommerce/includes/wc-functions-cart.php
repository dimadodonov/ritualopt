<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}


// add_filter('woocommerce_currency_symbol', 'change_existing_currency_symbol', 10, 2);

function change_existing_currency_symbol( $currency_symbol, $currency ) {
    switch( $currency ) {
        case 'RUB': $currency_symbol = 'руб'; break;
    }
    return $currency_symbol;
}

add_filter( 'formatted_woocommerce_price', 'span_custom_prc', 10, 5 );
function span_custom_prc( $number_format, $price, $decimals, $decimal_separator, $thousand_separator){
    return '<span class="def_price"><ins data-defpr="'.$number_format.'">'.$number_format.'</ins></span>';
}


/**
 * Show cart contents / total Ajax
 */

add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment', 10, 1 );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    $cartEmpty = wp_kses_data(WC()->cart->get_cart_contents_count()); ?>
        <div class="count cart-customlocation<?php if ($cartEmpty > 0) { echo ' active';} ?>"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></div>
    <?php $fragments['.cart-customlocation'] = ob_get_clean();
    return $fragments;
}

/**
 * @snippet       Добавление кнопки очистки корзины
 * @author        Миша Рудрастых
 * @url           https://misha.agency/woocommerce/kak-dobavit-knopku-ochistit-korzinu.html
 */
add_action( 'woocommerce_cart_actions', 'true_empty_cart_btn' );
 
function true_empty_cart_btn(){
 
	echo '<a class="empty_cart button" href="' . wc_get_cart_url() . '?empty-cart">Очистить корзину</a>';
 
}
 
add_action( 'init', 'true_empty_cart' );
function true_empty_cart() {
 
	if ( isset( $_GET[ 'empty-cart' ] ) ) {
		WC()->cart->empty_cart();
	}
 
}

/**
 * @snippet       Изображения товаров на странице оформления заказа
 * @author        Миша Рудрастых
 * @url           https://misha.agency/woocommerce/izobrazheniya-tovarov-pri-oformlenii-zakaza.html
 */
// add_filter( 'woocommerce_cart_item_name', 'true_checkout_product_images', 25, 2 );
 
function true_checkout_product_images( $name, $cart_item ) {
 
	// ничего не делаем, если находимся не на странице оформления заказа
	if ( ! is_checkout() ) {
		return $name;
	}
 
	$product = $cart_item[ 'data' ];
	$image = $product->get_image( array( 50, 50 ), array( 'class' => 'alignleft' ) );
 
	// объединяем изображение с названием товара
	return $image . $name;
 
}

