<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.

if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart product-form" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		
		<?php woocommerce_template_single_price(); ?>

		<div class="product-group">

		<?php

		do_action( 'woocommerce_before_add_to_cart_quantity' );
		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action( 'woocommerce_after_add_to_cart_quantity' );

		?>
		<div class="product-wishlist-single">
			<?php echo do_shortcode( '[yith_wcwl_add_to_wishlist]' ); ?>
		</div>
		<?php
		
		$id = $product->get_id();
        if( has_term( 'product_term', 'product_cat', $id )) {
            $quantity = 10;
            $args['quantity'] = 10;
        }
        else {
            $quantity = 1;
            $args['quantity'] = 1;
        }

		if( WC()->cart->find_product_in_cart( WC()->cart->generate_cart_id( $id ) ) ) : 
		
		?>

			<a 
				href="<?php echo esc_url( wc_get_cart_url() ); ?>" 
				data-quantity="<?php echo isset( $args['quantity'] ) ? $args['quantity'] : $quantity; ?>" 
				class="product-card-btn btn btn-order product_type_simple add_to_cart_button"
				data-product_id="<?php echo $product->get_id(); ?>"
				data-product_sku=""
				aria-label="Добавить &quot;<?php echo $product->get_name(); ?>&quot; в корзину" rel="nofollow"
				>
                <span class="product-card-btn__text">
                    <?php echo $product->add_to_cart_text(); ?>
                </span>
			</a>

		<?php else: ?>

			<a 
				href="<?php echo $product->add_to_cart_url(); ?>" 
				data-quantity="<?php echo isset( $args['quantity'] ) ? $args['quantity'] : $quantity; ?>" 
				class="btn btn-order product_type_simple add_to_cart_button ajax_add_to_cart"
				data-product_id="<?php echo $product->get_id(); ?>"
				data-product_sku=""
				aria-label="Добавить &quot;<?php echo $product->get_name(); ?>&quot; в корзину" rel="nofollow"
				>
				<span>
					<?php echo $product->add_to_cart_text(); ?>
				</span>
			</a>
		
		<?php endif; ?>

		</div>
		
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>