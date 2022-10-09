<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

// Способ 2. Добавляем цену за единицу товара прямо в колонку с количеством
// https://misha.agency/woocommerce/dobavlenie-czeny-za-ediniczu-tovara-v-email.html

// add_filter( 'woocommerce_email_order_item_quantity', 'truemisha_quantity_and_price', 25, 2 );
 
function truemisha_quantity_and_price( $qty, $item ) {
 
	$price = wc_price( ( $item->get_total() / $item->get_quantity() ) );
 
	return $price . ' × ' . $qty;
 
}