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


	<div class="products__wrap">

		<aside class="aside aside-nav">
			<?php aside_menu_primary(); ?>
		</aside>

		<div class="products__inner">

			<div
				class="cart wishlist_table wishlist_view traditional products-loop products__loop <?php echo $no_interactions ? 'no-interactions' : ''; ?> <?php echo $enable_drag_n_drop ? 'sortable' : ''; ?> "
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
								<?php wc_product_class('product-card product-card__loop'); ?>
								data-row-id="<?php echo esc_attr( $item->get_product_id() ); ?>"
							>

								<?php if ( $show_remove_product ) : ?>
									<div class="product-remove position">
										<a href="<?php echo esc_url( add_query_arg( 'remove_from_wishlist', $item->get_product_id() ) ); ?>" class="remove remove_from_wishlist" title="<?php echo esc_html( apply_filters( 'yith_wcwl_remove_product_wishlist_message_title', __( 'Remove this product', 'yith-woocommerce-wishlist' ) ) ); ?>"></a>
									</div>
								<?php endif; ?>

								<a href="<?php echo $product->get_permalink(); ?>" title="<?php echo $product->get_title(); ?>" class="product-card__wrap">
									<figure class="product-card__thumb">
										<?php echo $product->get_image('thumbnail'); ?>
									</figure>
									<div class="product-card__name"><?php echo $product->get_title(); ?></div>
									<div class="product-card__prices">
										<?php
											$price = $product->get_price();
											$regular_price = $product->get_regular_price();
											$sale_price = $product->get_sale_price();

											// $product->is_type( $type ) checks the product type, string/array $type ( 'simple', 'grouped', 'variable', 'external' ), returns boolean
											if ( $product->is_type( 'variable' ) ) {
												if($price) { ?>
													<div class="product-card__price"><?php echo $price; ?><ins>₽</ins></div>
												<?php } 
											} else {
												if($sale_price) {?>
													<div class="product-card__price product-card__newprice"><?php echo $sale_price; ?><ins>₽</ins></div>
													<div class="product-card__price product-card__oldprice"><?php echo $regular_price; ?><ins>₽</ins></div>
												<?php } else { 
													if($price) { ?>
													<div class="product-card__price"><?php echo $price; ?><ins>₽</ins></div>
													<?php }
												}
											}
										?>
									</div>
								</a>
								<?php if($price) { ?>
									<?php woocommerce_template_loop_add_to_cart(); ?>
								<?php } ?>

							</div>

						<?php
						endif;
					endforeach;
				else :
				?>
					<div>
						<div class="wishlist-empty"><?php echo esc_html( apply_filters( 'yith_wcwl_no_product_to_remove_message', __( 'В список желаний ничего не добавлено', 'yith-woocommerce-wishlist' ), $wishlist ) ); ?></div>
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

		</div>
	</div>