<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite Commerce
 */

$elite_commerce_slider_args = elite_commerce_get_section_args( 'slider' );

$elite_commerce_loop = new WP_Query( $elite_commerce_slider_args );

while ( $elite_commerce_loop->have_posts() ) :
	$elite_commerce_loop->the_post();
	?>
	<article id="post-<?php echo esc_attr( get_the_ID() ); ?>" class="swiper-slide type-post caption-animate text-alignleft <?php echo has_post_thumbnail() ? 'has-post-thumbnail' : ''; ?>">
		<div class="slider-image-wrapper">
			<?php
			$elegane_commerce_style = elite_commerce_gtm( 'elite_commerce_slider_style' );
			if ( 'style-three' === $elegane_commerce_style ) :
				$elite_commerce_second_image = elite_commerce_gtm( 'elite_commerce_slider_second_custom_image_' . $elite_commerce_loop->current_post );

				if ( $elite_commerce_second_image ) :
				?>
				<div class="feature-two-img"><img src="<?php echo esc_url( $elite_commerce_second_image ); ?>" /></div>
			<?php endif;
			endif; ?>

			<div class="slider-content-image featured-image">
				<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( 'elite-commerce-slider' );
				} else {
					echo '<img class="wp-post-image no-thumb" src="' . trailingslashit( esc_url( get_template_directory_uri() ) ) . 'images/no-thumb-1920x900.jpg">';
				}
				?>
			</div><!-- .featured-image -->
		</div><!-- .slider-image-wrapper -->

		<div class="slider-content-wrapper">
			<div class="container">
				<div class="slider-title-wrap">
				<?php the_title( '<h2 class="slider-title">', '</h2><!-- .slider-title -->' ); ?>
				</div><!-- .slider-title-wrap -->
				<div class="slider-content-inner-wrapper">
					<div class="slider-content clear-fix">
						<?php the_excerpt(); ?>
					</div><!-- .entry-content -->
				</div><!-- .slider-content-wrapper -->
			</div><!-- .entry-container -->
		</div><!-- .slider-content-wrapper -->

	</article><!-- .hentry -->
<?php
endwhile;

wp_reset_postdata();
