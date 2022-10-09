<?php

if ( ! defined( 'ABSPATH')) {
    exit;
}

global $product;

function woocommerce_custom_add_to_cart_class ( $html, $product, $args ) {
    $product_id = $product->get_id();
    // Define the classes to be added
    $class = "btn btn-order btn-order-loop";
    $class_added = "btn btn-order btn-order-loop added";

    if (
        $product->is_type('simple') &&
        $product->is_purchasable() &&
        $product->is_in_stock() &&
        WC()->cart->find_product_in_cart(
            WC()->cart->generate_cart_id($product->get_id())
        )
    ) {
        $args['class'] = $args['class']." {$class_added}";
        $html = sprintf( '<a href="%s" data-quantity="%s" class="%s" %s><span>%s</span></a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 0 ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( 'В корзине' )
        );
    }  else {      
        $quantity = 1;
        $args['quantity'] = 1;

        $args['class'] = $args['class']." {$class}";
        $html = sprintf( '<a href="%s" data-quantity="%s" class="%s" %s><span>%s</span></a>',
            esc_url( $product->add_to_cart_url() ),
            esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : $quantity ),
            esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
            isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
            esc_html( 'Купить' ),
        );
    }

    // Return Add to cart button
    return $html;
}

add_filter( "woocommerce_loop_add_to_cart_link", "woocommerce_custom_add_to_cart_class", 10, 3 );

// для страниц каталога товаров, категорий товаров и т д
add_filter( 'woocommerce_product_add_to_cart_text', 'truemisha_product_btn_text', 20, 2 );
 
function truemisha_product_btn_text( $text, $product ) {
 
	if( 
	   $product->is_type( 'simple' )
	   && $product->is_purchasable()
	   && $product->is_in_stock()
	   && WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) )
	) {
 
		$text = 'В корзине';
 
	}
    else {
        $text = 'В корзину';
    }
 
	return $text;
 
}

add_filter( 'woocommerce_product_add_to_cart_url', 'truemisha_product_cart_url', 20, 2 );
function truemisha_product_cart_url( $url, $product ) {
 
	if( 
	   $product->is_type( 'simple' )
	   && $product->is_purchasable()
	   && $product->is_in_stock()
	   && WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $product->get_id() ) )
	) {
 
		$url = wc_get_cart_url();
 
	}
 
	return $url;
 
}


add_action('wp_footer','custom_jquery_add_to_cart_script');

function custom_jquery_add_to_cart_script(){
    if ( is_home() || is_shop() || is_product_category() || is_product_tag() || is_product() || 
is_tax() || is_page('compare') ): // Only for archives pages
        $new_text = __( 'В корзине', 'woocommerce' );
        $new_link = wc_get_cart_url();
        ?>
            <script type="text/javascript">
                // Ready state
                (function($){
                    $(document).on('click', 'a.add_to_cart_button', function(){
                        $this = $(this);
                        $( document.body ).on( 'added_to_cart', function(){
                            $this.attr('href', '<?php echo $new_link; ?>').removeClass('add_to_cart_button ajax_add_to_cart');
                            $this.find('span').text('<?php echo $new_text; ?>');
                        });
                    });

                })(jQuery); // "jQuery" Working with WP (added the $ alias as argument)
            </script>
        <?php
    endif;
}