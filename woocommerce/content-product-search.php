<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit();

global $product;
$product_id = $product->get_id();

// Ensure visibility.
if (empty($product) || !$product->is_visible()) {
    return;
}

$product_published = $product->get_date_created();
$post_id = get_the_ID();
?>

<div <?php wc_product_class('product-search'); ?>>
    <a href="<?php echo $product->get_permalink(); ?>" title="<?php echo $product->get_title(); ?>" class="product-search__wrap">
		<figure class="product-search__thumb">
			<?php echo $product->get_image('thumbnail'); ?>
		</figure>
		<div class="product-search__inner">
			<div class="product-search__name"><?php echo $product->get_title(); ?></div>
			<?php
				$price = $product->get_price();
				$regular_price = $product->get_regular_price();
				$sale_price = $product->get_sale_price();

				// $product->is_type( $type ) checks the product type, string/array $type ( 'simple', 'grouped', 'variable', 'external' ), returns boolean
				if ( $product->is_type( 'variable' ) ) {
					if($price) { ?>
						<div class="product-search__prices">
							<div class="product-search__price"><?php echo number_format($price, 0, ' ', ' '); ?><ins>₽</ins></div>
						</div>
					<?php } 
				} else {
					if($sale_price) {?>
						<div class="product-search__prices">
							<div class="product-search__price product-card__newprice"><?php echo number_format($sale_price, 0, ' ', ' '); ?><ins>₽</ins></div>
							<div class="product-search__price product-card__oldprice"><?php echo number_format($regular_price, 0, ' ', ' '); ?><ins>₽</ins></div>
						</div>
					<?php } else { 
						if($price) { ?>
							<div class="product-search__prices">
								<div class="product-search__price"><?php echo number_format($price, 0, ' ', ' '); ?><ins>₽</ins></div>
							</div>
						<?php }
					}
				}
			?>
		</div>
	</a>
	
</div>
