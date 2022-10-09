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

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
  function yith_wcwl_get_items_count() {
    ob_start();
    ?>
		<a href="<?php echo esc_url( YITH_WCWL()->get_wishlist_url() ); ?>" class="fixed-btn__item">
			<div class="fixed-btn__inner">
				<svg><use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/files/sprite.svg#icon--favorite"/></svg>
				<?php $favoriteWcwl = yith_wcwl_count_all_products(); ?>
        <div class="count yith-wcwl-items-count <?php if ($favoriteWcwl > 0) { echo ' active';} ?>"><?php echo esc_html( yith_wcwl_count_all_products() ); ?></div>
			</div>
		</a>
    <?php
    return ob_get_clean();
  }

  add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
  function yith_wcwl_ajax_update_count() {
    wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
    ) );
  }

  add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
  add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_enqueue_custom_script' ) ) {
  function yith_wcwl_enqueue_custom_script() {
    wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              $('.yith-wcwl-items-count').html( data.count ).addClass('active');
            } );
          } );
        } );
      "
    );
  }

  add_action( 'wp_enqueue_scripts', 'yith_wcwl_enqueue_custom_script', 20 );
}