<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite Commerce
 */

$elite_commerce_visibility = elite_commerce_gtm( 'elite_commerce_testimonial_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_visibility ) ) {
	return;
}
?>
<div id="testimonial-section" class="testimonial-section section">
	<div class="section-testimonial testimonial-layout-3">
		<div class="container">
			<?php elite_commerce_section_title( 'testimonial' ); ?>
			
			<div class="section-carousel-wrapper">
				<?php get_template_part( 'template-parts/testimonial/post-type' ); ?>
			</div><!-- .section-carousel-wrapper -->
		</div><!-- .container -->
	</div><!-- .section-testimonial  -->
</div><!-- .section -->
