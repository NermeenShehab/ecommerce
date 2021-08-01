<?php
/**
 * Template part for displaying Service
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite Commerce
 */

$elite_commerce_visibility = elite_commerce_gtm( 'elite_commerce_wwd_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_visibility ) ) {
	return;
}
?>
<div id="wwd-section" class="wwd-section page style-one section">
	<div class="section-wwd">
		<div class="container">
			<?php elite_commerce_section_title( 'wwd' ); ?>
			
			<div class="section-carousel-wrapper">
				<?php
				get_template_part( 'template-parts/wwd/post-type' );
				?>
			</div>
		</div><!-- .container -->
	</div><!-- .section-wwd  -->
</div><!-- .section -->
