<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_action('wp_ajax_add_product', 'add_product');
add_action('wp_ajax_nopriv_add_product', 'add_product');

function add_product() {

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

// Аctivate the ajax handler 
add_action('wp_ajax_pmqv_prod_in_popup', 'pmqv_prod_in_popup');
add_action('wp_ajax_nopriv_pmqv_prod_in_popup', 'pmqv_prod_in_popup');


$pmqv_plugin_dir = plugin_dir_path(__FILE__);

function pmqv_prod_in_popup()
{

    if (!wp_verify_nonce($_POST['nonce'], 'pmqv-nonce')) {
        wp_die('');
    }
    global $product, $wpdb, $post, $woocommerce;
    if (!class_exists('woocommerce')) {
        return FALSE;
    }


    $product_id = !empty($_POST['prodIdToSend']) ? absint(esc_attr($_POST['prodIdToSend'])) : false;

    if ($product_id > 0) :

        wp('p=' . $product_id . '&post_type=product');

        ob_start();

        if (!$product || is_array($product) || $product->get_id() !== $product_id) {
            $product = wc_get_product($product_id);

            wc_get_template_part( 'content', 'single-product-popup' );
        }

        echo ob_get_clean();
    endif;
    wp_die();
}