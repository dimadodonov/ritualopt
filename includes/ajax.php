<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_add_product', 'add_product');
add_action('wp_ajax_nopriv_add_product', 'add_product');

function add_product() {

     // Check for nonce security      
     if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
         die ( 'Busted!');
     }

    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'page_id' => sanitize_post($_POST['id'])
    );

    $hitsLoop = new WP_Query( $args );

    $json_data['out'] = ob_start(); ?>

        <?php if ($hitsLoop->have_posts()) : ?>

            <?php while ($hitsLoop->have_posts()) :

                $hitsLoop->the_post();
                global $product;

			    wc_get_template_part( 'content', 'single-product-popup' );

            endwhile; ?>
            
        <?php endif; ?>

    <?php $json_data['out'] = ob_get_clean();
    wp_send_json( $json_data );
    wp_die();
}


add_action('wp_ajax_add_product_in_popup', 'add_product_in_popup');
add_action('wp_ajax_nopriv_add_product_in_popup', 'add_product_in_popup');
function add_product_in_popup() {

     // Check for nonce security      
     if ( ! wp_verify_nonce( $_POST['nonce'], 'search-nonce' ) ) {
         die ( 'Busted!');
     }

    $productId = sanitize_post($_POST['productId']);
    $quantity = sanitize_post($_POST['quantity']);
    $variationId = sanitize_post($_POST['variationId']);

    $json_data['out'] = ob_start();
    
    global $woocommerce;
    $woocommerce->cart->add_to_cart( $productId, $quantity, $variationId);

    $json_data['out'] = ob_get_clean();
    wp_send_json( $json_data );
    wp_die();
}
