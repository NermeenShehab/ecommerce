<?php
/**
 * Template part for displaying Featured Product
 *
 * @package Elite Commerce
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

$elite_commerce_enable = elite_commerce_gtm( 'elite_commerce_featured_product_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_enable ) ) {
	return;
}


if ( 'custom-pages' === $elite_commerce_enable ) {
	// Bail if custom pages is selected, and current page is not in list.
	if (  ! in_array( get_the_ID(), explode( ',', elite_commerce_gtm( 'elite_commerce_featured_product_custom_pages' ) ) ) ) {
		return;
	}
}

if ( $elite_commerce_id = elite_commerce_gtm( 'elite_commerce_featured_product_product' ) ) {
	$elite_commerce_args = array(
		'post_type' => 'product',
		'p'         => absint( $elite_commerce_id ),
	);
}
// If $elite_commerce_args is empty return false
if ( empty( $elite_commerce_args ) ) {
	return;
}

$elite_commerce_args['posts_per_page'] = 1;

$elite_commerce_loop = new WP_Query( $elite_commerce_args );

while ( $elite_commerce_loop->have_posts() ) :
	$elite_commerce_loop->the_post();

	$elite_commerce_subtitle      = elite_commerce_gtm( 'elite_commerce_featured_product_custom_subtitle' );
	?>

	<div id="featured-product-section" class="featured-product-section section content-position-right default">
		<div class="section-featured-page">
			<div class="container">
				<div class="row">
					<?php if ( has_post_thumbnail() ) : ?>
					<div class="ff-grid-6 featured-page-thumb">
						<?php the_post_thumbnail( 'elite-commerce-hero', array( 'class' => 'alignnone' ) );?>
					</div>
					<?php endif; ?>

					<div class="ff-grid-6 featured-page-content">
						<div class="featured-page-section">
							<div class="section-title-wrap text-alignleft clear-fix">
								<?php if ( $elite_commerce_subtitle ) : ?>
								<p class="section-top-subtitle"><?php echo esc_html( $elite_commerce_subtitle ); ?></p>
								<?php endif; ?>

								<?php the_title( '<h2 class="section-title"><a href="' . esc_url( get_permalink() ) .'">', '</a></h2>' ); ?>
							</div>

							<div class="clear-fix"><?php
							woocommerce_template_loop_rating();

							elite_commerce_display_content(); ?>
						</div>
						</div><!-- .featured-page-section -->
					</div><!-- .ff-grid-6 -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .section-featured-page -->
	</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
