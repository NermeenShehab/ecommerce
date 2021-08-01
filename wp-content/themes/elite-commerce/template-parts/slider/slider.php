<?php
/**
 * Template part for displaying Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite Commerce
 */

$elite_commerce_visibility = elite_commerce_gtm( 'elite_commerce_slider_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_visibility ) ) {
	return;
}

$slider_class = 'ff-grid-12';

if( is_active_sidebar( 'sidebar-slider-left' ) ) {
	$slider_class = 'ff-grid-8';
}

?>
<div id="slider-section" class="section slider-section overlay-enabled  no-padding style-one">
	<div class="container">
		<div class="row">
			<?php if( is_active_sidebar( 'sidebar-slider-left' ) ) : ?>
				<div class="ff-grid-4 slider-left-widgetarea">
					<?php dynamic_sidebar( 'sidebar-slider-left' ); ?>
				</div><!-- .ff-grid-3 -->
			<?php endif; ?>

			<div class="<?php echo esc_attr( $slider_class ); ?>">
				<div class="slider slider-section-wrapper">
					<div class="swiper-wrapper">
						<?php get_template_part( 'template-parts/slider/post', 'type' ); ?>
					</div><!-- .swiper-wrapper -->

					<div class="swiper-pagination"></div>

				    <div class="swiper-button-prev"></div>
				    <div class="swiper-button-next"></div>
				</div><!-- .slider -->
			</div><!-- .ff-grid-12 -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</div> <!-- .slider-section
 -->
