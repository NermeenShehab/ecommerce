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

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>
<li <?php wc_product_class( 'swiper-slide', $product ); ?>>
	<div class="product-section-item product-item-wrapper inner-block-shadow">
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
		<div class="product-thumb zoom-effect">
			<?php woocommerce_show_product_loop_sale_flash(); ?>
			
			<a href="<?php the_permalink();?>" class="product-image-link">
				<?php woocommerce_template_loop_product_thumbnail(); ?>
			</a><!-- .product-image-link -->
			
			<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

			<div class="add-to-cart-button-wrapper">
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</div><!-- .product-thumb -->

		<?php do_action( 'woocommerce_before_shop_loop_item_title' ); ?>
	
		<div class="product-item-details">
			<div class="product-title"><?php woocommerce_template_loop_product_link_open(); ?><?php woocommerce_template_loop_product_title(); ?><?php woocommerce_template_loop_product_link_close(); ?></div>

			<?php do_action( 'woocommerce_shop_loop_item_title' ); ?>
			
			<?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>

			<div class="product-price-container">
				<?php woocommerce_template_loop_price(); ?>
			</div><!-- .product-action-container -->

			<div class="product-ratings">
				<?php woocommerce_template_loop_rating(); ?>
			</div>

			<div class="add-to-cart-button-wrapper">
				<?php woocommerce_template_loop_add_to_cart(); ?>
			</div>
		</div><!-- .product-item-details -->

	</div><!-- .product-item-wrapper -->
</li>
