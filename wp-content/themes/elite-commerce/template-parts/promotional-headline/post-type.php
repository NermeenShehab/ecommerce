<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Elite Commerce
 */
if ( elite_commerce_gtm( 'elite_commerce_promotional_headline_page' ) ) {
	$elite_commerce_args = array(
		'page_id' => absint( elite_commerce_gtm( 'elite_commerce_promotional_headline_page' ) ),
	);
} 

// If $elite_commerce_args is empty return false
if ( empty( $elite_commerce_args ) ) {
	return;
}

$elite_commerce_args['posts_per_page'] = 1;
$elite_commerce_args['post_type'] = 'page';

$elite_commerce_loop = new WP_Query( $elite_commerce_args );

while ( $elite_commerce_loop->have_posts() ) :
	$elite_commerce_loop->the_post();
	?>
	<div id="promotional-headline-section" class="section text-aligncenter promotional-headline-section overlay-enabled" <?php echo has_post_thumbnail() ? 'style="background-image: url( ' .esc_url( get_the_post_thumbnail_url() ) . ' )"' : ''; ?>>
	<div class="promotion-inner-wrapper section-promotion">
		<div class="container">
			<div class="promotion-content">
				<div class="promotion-description">
					<?php the_title( '<h2>', '</h2>' ); ?>

					<?php elite_commerce_display_content(); ?>
				</div><!-- .promotion-description -->
			</div><!-- .promotion-content -->
		</div><!-- .container -->
	</div><!-- .promotion-inner-wrapper" -->
</div><!-- .section -->
<?php
endwhile;

wp_reset_postdata();
