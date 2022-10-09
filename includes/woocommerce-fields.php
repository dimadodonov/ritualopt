<?php 

if ( ! defined( 'ABSPATH')) {
    exit;
}

/**
 * Register new field to project.
 *
 * @link https://wpruse.ru/woocommerce/custom-fields-in-products/
 */

add_action( 'woocommerce_product_options_general_product_data', 'art_woo_add_custom_fields' );

function art_woo_add_custom_fields() {
    global $product, $post;

    echo '<div class="options_group">';// Группировка полей 

        // текстовое поле
        woocommerce_wp_text_input( array(
        'id'                => '_text_youtube_field',
        'label'             => __( 'Youtube', 'woocommerce' ),
        'placeholder'       => 'ID Youtube видео',
        'desc_tip'          => 'true',
        // 'custom_attributes' => array( 'required' => 'required' ),
        'description'       => __( 'Для работы видео необходим ID Youtube видео, пример "ioGbAXDCc00"', 'woocommerce' ),
        ) );
    
    echo '</div>';
}

add_action( 'woocommerce_process_product_meta', 'nm_woo_custom_fields_save', 10 );
function nm_woo_custom_fields_save( $post_id ) {

    // Вызываем объект класса
    $product = wc_get_product( $post_id );     
       
	// Сохранение текстового поля
	$text_field = isset( $_POST['_text_youtube_field'] ) ? sanitize_text_field( $_POST['_text_youtube_field'] ) : '';
	$product->update_meta_data( '_text_youtube_field', $text_field );

	// Сохраняем все значения
	$product->save();
}