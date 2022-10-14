<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_search_ajax', 'search_ajax_action_callback');
add_action('wp_ajax_nopriv_search_ajax', 'search_ajax_action_callback');

function search_ajax_action_callback() {
    $arg = array(
        'post_type' => array(
            'product',
            'post',
            // 'page'
        ),
        'post_status' => 'publish',
        's'           => sanitize_post($_POST['s']),
    );
    $query_ajax = new WP_Query( $arg );
    $json_data['out'] = ob_start();


    if ( $query_ajax->have_posts() ) {
        
        echo '<div class="search-result__wrap"><div class="products__loop">';

        while ( $query_ajax->have_posts() ) {
            $query_ajax->the_post();
            wc_get_template_part( 'content', 'product-search' );
        }

        // echo '</div></div><div class="search-result__link"><a class="btn btn-accent" href="' . site_url( '/catalog' ) . '" title="Перейти в каталог">Перейти в каталог</a></div>';

    }
    else {
        ?>
        <div class="search-result__wrap">
            <div class="search-result-noitem">
                К сожалению, на Ваш поисковый запрос ничего не найдено.
            </div>
        </div>
        <?php
    }

    $json_data['out'] = ob_get_clean();
    wp_send_json( $json_data );
    wp_die();
}