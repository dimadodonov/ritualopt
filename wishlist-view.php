<?php
/**
 * Wishlist page template - Standard Layout
 *
 * @author  Your Inspiration Themes
 * @package YITH WooCommerce Wishlist
 * @version 3.0.0
 */

/**
 * Template variables:
 *
 * @var $wishlist                      \YITH_WCWL_Wishlist Current wishlist
 * @var $wishlist_items                array Array of items to show for current page
 * @var $wishlist_token                string Current wishlist token
 * @var $wishlist_id                   int Current wishlist id
 * @var $users_wishlists               array Array of current user wishlists
 * @var $pagination                    string yes/no
 * @var $per_page                      int Items per page
 * @var $current_page                  int Current page
 * @var $page_links                    array Array of page links
 * @var $is_user_owner                 bool Whether current user is wishlist owner
 * @var $show_price                    bool Whether to show price column
 * @var $show_dateadded                bool Whether to show item date of addition
 * @var $show_stock_status             bool Whether to show product stock status
 * @var $show_add_to_cart              bool Whether to show Add to Cart button
 * @var $show_remove_product           bool Whether to show Remove button
 * @var $show_price_variations         bool Whether to show price variation over time
 * @var $show_variation                bool Whether to show variation attributes when possible
 * @var $show_cb                       bool Whether to show checkbox column
 * @var $show_quantity                 bool Whether to show input quantity or not
 * @var $show_ask_estimate_button      bool Whether to show Ask an Estimate form
 * @var $show_last_column              bool Whether to show last column (calculated basing on previous flags)
 * @var $move_to_another_wishlist      bool Whether to show Move to another wishlist select
 * @var $move_to_another_wishlist_type string Whether to show a select or a popup for wishlist change
 * @var $additional_info               bool Whether to show Additional info textarea in Ask an estimate form
 * @var $price_excl_tax                bool Whether to show price excluding taxes
 * @var $enable_drag_n_drop            bool Whether to enable drag n drop feature
 * @var $repeat_remove_button          bool Whether to repeat remove button in last column
 * @var $available_multi_wishlist      bool Whether multi wishlist is enabled and available
 * @var $no_interactions               bool
 */

if ( ! defined( 'YITH_WCWL' ) ) {
	exit;
} // Exit if accessed directly
?>

<div
	class="cart wishlist_table wishlist_view traditional product-item__wrap products-container <?php echo $no_interactions ? 'no-interactions' : ''; ?> <?php echo $enable_drag_n_drop ? 'sortable' : ''; ?> "
	data-pagination="<?php echo esc_attr( $pagination ); ?>" data-per-page="<?php echo esc_attr( $per_page ); ?>" data-page="<?php echo esc_attr( $current_page ); ?>"
	data-id="<?php echo esc_attr( $wishlist_id ); ?>" data-token="<?php echo esc_attr( $wishlist_token ); ?>">

	<?php
	if ( $wishlist && $wishlist->has_items() ) :
		foreach ( $wishlist_items as $item ) :
			// phpcs:ignore Generic.Commenting.DocComment
			/**
			 * @var $item \YITH_WCWL_Wishlist_Item
			 */
			global $product;

			$product      = $item->get_product();
			$product_id = $product->get_id();
			$availability = $product->get_availability();
			$stock_status = isset( $availability['class'] ) ? $availability['class'] : false;

			if ( $product && $product->exists() ) : ?>

				<div
					id="yith-wcwl-row-<?php echo esc_attr( $item->get_product_id() ); ?>"
					<?php wc_product_class('products-item wishlist-item'); ?>
					data-row-id="<?php echo esc_attr( $item->get_product_id() ); ?>"
				>

					<div class="product-card__wrap">

						<?php if ( $show_remove_product ) : ?>
							<div class="product-remove position">
								<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ); ?>" class="remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>"></a>
							</div>
						<?php endif; ?>

						<figure class="product-card__thumb">

							<div class="product-card__badge badge">
								<?php
									if( has_term( 'featured', 'product_visibility', $product_id ) ) {
										echo '<div class="badge__item">Хит продаж</div>';
									}
									if( $product->is_on_sale() ) {
										echo '<div class="badge__item sale">Скидка</div>';
									}
								?>
							</div>
							<a href="<?php echo $product->get_permalink(); ?>">
								<?php echo $product->get_image(); ?>
							</a>
						</figure>

						<div class="product-card__name"><a href="<?php echo $product->get_permalink(); ?>" title="<?php echo $product->get_title(); ?>"><?php echo $product->get_title(); ?></a></div>

						<div class="product-card__prices">
							<?php		
							$start_price = $product->get_price();
							$price = $product->get_regular_price();
							?>
							<div class="product-card__price"><?php if(!$price) { ?>от<?php } ?><ins><?php echo $start_price; ?></ins>руб</div>
						</div>	

						<div class="product-card__detals">			
							<?php woocommerce_template_loop_add_to_cart(); ?>
						</div>
					</div>

				</div>

			<?php
			endif;
		endforeach;
	else :
	?>
		<div>
			<div colspan="<?php echo esc_attr( $column_count ); ?>" class="wishlist-empty"><?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'В список желаний ничего не добавлено', 'yith-woocommerce-wishlist' ), $wishlist ) ); ?></div>
		</div>
	<?php
	endif;

	if ( ! empty( $page_links ) ) :
	?>
		<div class="pagination-row wishlist-pagination">
			<div><?php echo $page_links; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
		</div>
	<?php endif ?>

</div>