<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields )
{
  array_push($fields['billing']['billing_country']['class'], "hidden"); // Добавляем класс для скрытия поля.
  return $fields;
}