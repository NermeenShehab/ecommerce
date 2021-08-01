<?php
/**
 * The template for displaying Woo Products Showcase
 *
 * @package Elite Commerce
 */

if ( ! class_exists( 'WooCommerce' ) ) {
    // Bail if WooCommerce is not installed
    return;
}

$elite_commerce_visibility = elite_commerce_gtm( 'elite_commerce_products_listing_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_visibility ) ) {
	return;
}

if ( 'custom-pages' === $elite_commerce_visibility ) {
	// Bail if custom pages is selected, and current page is not in list.
	if (  ! in_array( get_the_ID(), explode( ',', elite_commerce_gtm( 'elite_commerce_products_listing_custom_pages' ) ) ) ) {
		return;
	}
}

$elite_commerce_carousel = elite_commerce_gtm( 'elite_commerce_products_listing_enable_slider' );
?>
<div id="products-listing-section" class="section products-listing-section<?php echo $elite_commerce_carousel ? ' carousel-enabled' : ''; ?>">
	<div class="section-listings">
		<div class="container">
			<div class="section-title-wrapper">
				<?php elite_commerce_section_title( 'products_listing' ); ?>
				
				<?php
				$elite_commerce_button_text   = elite_commerce_gtm( 'elite_commerce_products_listing_button_text' );
				$elite_commerce_button_link   = elite_commerce_gtm( 'elite_commerce_products_listing_button_link' );
				$elite_commerce_button_target = elite_commerce_gtm( 'elite_commerce_products_listing_button_target' ) ? '_blank' : '_self';

				if ( $elite_commerce_button_text ) : ?>
					<div class="cat-more-wrapper">
						<a href="<?php echo esc_url( $elite_commerce_button_link ); ?>" class="more-link" target="<?php echo esc_attr( $elite_commerce_button_target ); ?>"><?php echo esc_html( $elite_commerce_button_text ); ?></a>
					</div><!-- .more-wrapper -->
				<?php endif; ?>
			</div> <!-- .section-title-wrapper -->
			
			<?php 
				$number                  = elite_commerce_gtm( 'elite_commerce_products_listing_number' );
				$columns                 = elite_commerce_gtm( 'elite_commerce_products_listing_columns' );
				$paginate                = elite_commerce_gtm( 'elite_commerce_products_listing_paginate' );
				$elite_commerce_orderby = isset( $_GET['orderby'] ) ? $_GET['orderby'] : elite_commerce_gtm( 'elite_commerce_products_listing_orderby' );
				$product_filter          = elite_commerce_gtm( 'elite_commerce_products_listing_products_filter' );
				$featured                = elite_commerce_gtm( 'elite_commerce_products_listing_featured' );
				$abletone_order          = elite_commerce_gtm( 'elite_commerce_products_listing_order' );
				$skus                    = elite_commerce_gtm( 'elite_commerce_products_listing_skus' );
				$category                = elite_commerce_gtm( 'elite_commerce_products_listing_category' );

				$shortcode = '[products';

				if ( $number ) {
					$shortcode .= ' limit="' . esc_attr( $number ) . '"';
				}

				if ( $columns ) {
					$shortcode .= ' columns="' . absint( $columns ) . '"';
				}

				if ( $paginate ) {
					$shortcode .= ' paginate="' . esc_attr( $paginate ) . '"';
				}

				if ( $elite_commerce_orderby ) {
					$shortcode .= ' orderby="' . esc_attr( $elite_commerce_orderby ) . '"';
				}

				if ( $abletone_order ) {
					$shortcode .= ' order="' . esc_attr( $abletone_order ) . '"';
				}

				if ( $product_filter && 'none' !== $product_filter ) {
					$shortcode .= ' ' . esc_attr( $product_filter ) . '="true"';
				}

				if ( $skus ) {
					$shortcode .= ' skus="' . esc_attr( $skus ) . '"';
				}

				if ( $category ) {
					$shortcode .= ' category="' . esc_attr( $category ) . '"';
				}

				if ( $featured ) {
					$shortcode .= ' visibility="featured"';
				}

				$shortcode .= ']';
			?>

			<div class="products-listing-block-list clear-fix<?php echo $elite_commerce_carousel ? ' swiper-carousel-enabled normal-carousel' : ''; ?>">
				<div class="products-wrapper">
					<?php echo do_shortcode( $shortcode ); ?>
				</div><!-- .products-wrapper -->

				<?php
				// Navigation.
				if ( $elite_commerce_carousel && elite_commerce_gtm( 'elite_commerce_products_listing_slider_navigation' ) ) : ?>
				<div class="next-prev-wrap">
					<div class="swiper-button-prev"></div>
				    <div class="swiper-button-next"></div>
				</div>
				<?php endif; ?>

				<?php
				// Pagination.
				if ( $elite_commerce_carousel && elite_commerce_gtm( 'elite_commerce_products_listing_slider_pagination' ) ) : ?>
			    <div class="swiper-pagination"></div>
				<?php endif; ?>
			</div><!-- .products-listing-block-list -->
		</div><!-- .container -->
	</div><!-- .section-listings -->
</div><!-- .products-listing-section -->
