<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

/**
 * Enqueue scripts and styles.
 */

add_action( 'wp_enqueue_scripts', 'mi_style' );
function mi_style() {
    $css_update_time = filemtime(get_stylesheet_directory(). '/assets/css/app.min.css');
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/assets/css/app.min.css?ver=18.10.22', array(), $css_update_time, 'all' );
}

add_action( 'wp_enqueue_scripts', 'mi_scripts' );
function mi_scripts() {
    wp_enqueue_script( 'app-js', get_template_directory_uri() . '/assets/js/app.min.js?ver=18.10.22', array(), null, true );
    wp_localize_script('app-js', 'search_form', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('search-nonce')
    ));

    if (is_page('contacts')) {
        wp_enqueue_script( 'maps_yandex', 'https://api-maps.yandex.ru/2.1/?lang=ru-RU&amp;apikey=921e8a03-bf8e-4fc3-9642-3ad9c8a7ff00', array( 'jquery' ), '2.1', true );
    }
}