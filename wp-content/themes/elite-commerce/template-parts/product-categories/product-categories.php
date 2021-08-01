<?php
/**
 * The template for displaying Product Categories
 *
 * @package Elite Commerce
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	// Bail if WooCommerce is not installed
	return;
}

$elite_commerce_visibility = elite_commerce_gtm( 'elite_commerce_product_categories_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_visibility ) ) {
	return;
}

?>
<div id="product-categories-section" class="section product-categories-section layout-3">
	<div class="section-categoriess">
		<div class="container">
			<div class="section-title-wrapper clear-fix">
				<?php elite_commerce_section_title( 'product_categories' ); ?>
				
				<?php
				$elite_commerce_button_text   = elite_commerce_gtm( 'elite_commerce_product_categories_button_text' );
				$elite_commerce_button_link   = elite_commerce_gtm( 'elite_commerce_product_categories_button_link' );
				$elite_commerce_button_target = elite_commerce_gtm( 'elite_commerce_product_categories_button_target' ) ? '_blank' : '_self';

				if ( $elite_commerce_button_text ) : ?>
					<div class="cat-more-wrapper">
						<a href="<?php echo esc_url( $elite_commerce_button_link ); ?>" class="more-link" target="<?php echo esc_attr( $elite_commerce_button_target ); ?>"><?php echo esc_html( $elite_commerce_button_text ); ?></a>
					</div><!-- .more-wrapper -->
				<?php endif; ?>
			</div><!-- .section-title-wrapper -->

			<div class="section-carousel-wrapper">
				<div class="product-category-block-list clear-fix">
					<div class="row">
						<?php
							$elite_commerce_args = array(
								'taxonomy' => 'product_cat',
								'orderby'  => 'include',
								'include'  => elite_commerce_gtm( 'elite_commerce_product_categories_category' ),
							);

							$elite_commerce_product_categories = get_terms( $elite_commerce_args );

							if ( ! empty( $elite_commerce_product_categories ) && ! is_wp_error( $elite_commerce_product_categories ) ) {
								foreach ( $elite_commerce_product_categories as $elite_commerce_term ) {
								?>
								<div class="products-category-item ff-grid-3">
									<div class="item-inner-wrapper inner-block-shadow">
										<?php
										$elite_commerce_thumbnail_id = get_term_meta( $elite_commerce_term->term_id, 'thumbnail_id', true );

										if ( $elite_commerce_thumbnail_id ) :
										?>
										<div class="products-category-thumb-wrap">
											<?php echo wp_get_attachment_image( $elite_commerce_thumbnail_id, 'elite-commerceduct-category', false, array( 'class' => 'elite-commerceducts-category' ) ); ?>
										</div>
										<?php endif; ?>

										<div class="products-category-content">
											<h3>
												<a href="<?php echo esc_url( get_term_link( $elite_commerce_term ) ); ?>" rel="bookmark"><?php echo esc_html( $elite_commerce_term->name ) . '<span class="category-count">' . absint( $elite_commerce_term->count ) . '</span>'; ?></a>
											</h3>
										</div><!-- .products-category-content -->
									</div><!-- .item-inner-wrapper -->
								</div><!-- .products-category-item -->
								<?php
								}
							}
						?>
					</div><!-- .row -->
				</div><!-- .product-category-block-list -->
			</div><!-- .section-carousel-wrapper -->
		</div><!-- .container -->
	</div><!-- .latest-posts-section -->
</div><!-- .section-latest-posts -->
