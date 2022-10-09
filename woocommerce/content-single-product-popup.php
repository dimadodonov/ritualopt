<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
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

defined( 'ABSPATH' ) || exit;

global $product;
$product_id = $product->get_id();

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

		<div class="container">
			<div class="product__wrap">

				<div class="product__row">
					<div class="product-gallery">
						<div class="product-gallery__wrap">

							<?php
								$product_image_id = $product->get_image_id();
								$product_gallery_ids = $product->get_gallery_image_ids();

								if( $product_image_id ) :
							?>

							<div class="swiper product-slider product-slider-big">
								<div class="swiper-wrapper">
									<div class="swiper-slide">

										<a href="<?php echo wp_get_attachment_image_url( $product_image_id, 'full' ); ?>" data-fancybox="gallery">
											<figure class="product-slider__item">
												<?php
													if ( $product->get_image_id() ) :
														echo wp_get_attachment_image( $product_image_id, 'woocommerce_thumbnail' );
													endif;
												?>
											</figure>
										</a>

									</div>

									<?php
										if( $product_gallery_ids ) :
											foreach( $product_gallery_ids as $product_gallery_id ) : ?>
												<div class="swiper-slide">

													<a href="<?php echo wp_get_attachment_image_url( $product_gallery_id, 'full' ); ?>" data-fancybox="gallery">
														<figure class="product-card-slide">
															<?php
																if ( $product->get_image_id() ) :
																	echo wp_get_attachment_image( $product_gallery_id, 'woocommerce_thumbnail' );
																endif;
															?>
														</figure>
													</a>

												</div>
											<?php endforeach;
										endif;
									?>
								</div>
							</div>

							<?php else : ?>

								<div class="swiper product-slider product-slider-big">
									<div class="swiper-wrapper">
										<div class="swiper-slide">

											<figure class="product-slider-thumbs__item">
												<?php echo woocommerce_placeholder_img('woocommerce_single'); ?>
											</figure>

										</div>
									</div>
								</div>

							<?php endif; ?>

						</div>
					</div>
					<div class="product-summary">
						<div class="product-title"><h1><?php echo $product->get_title(); ?></h1></div>
						<?php woocommerce_template_single_add_to_cart(); ?>
					</div>
				</div>
			</div>
		</div>

	</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>