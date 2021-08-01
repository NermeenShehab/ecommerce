<?php
/**
 * Template part for displaying Post Types Slider
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Elite Commerce
 */

$elite_commerce_wwd_args = elite_commerce_get_section_args( 'wwd' );

$elite_commerce_loop = new WP_Query( $elite_commerce_wwd_args );

if ( $elite_commerce_loop->have_posts() ) :
	?>
	<div class="wwd-block-list">
		<div class="row">
		<?php

		while ( $elite_commerce_loop->have_posts() ) :
			$elite_commerce_loop->the_post();
			$count = absint( $elite_commerce_loop->current_post );
			$icon  = elite_commerce_gtm( 'elite_commerce_wwd_custom_icon_' . $count );
			$image = elite_commerce_gtm( 'elite_commerce_wwd_custom_image_' . $count );
			?>
			<div class="wwd-block-item post-type ff-grid-3">
				<div class="wwd-block-wrapper">
					<div class="wwd-block-inner">
						<?php if ( $icon ) : ?>
						<a class="wwd-fonts-icon" href="<?php the_permalink(); ?>" >
							<i class="<?php echo esc_attr( $icon ); ?>"></i>
						</a>
						<?php elseif ( $image ) : ?>
						<a class="wwd-image" href="<?php echo esc_url( $more_link ); ?>">
							<img src="<?php echo esc_url( $image ); ?>" title="<?php echo esc_attr( $title ); ?>"/>
						</a>
						<?php endif; ?>

						<div class="wwd-block-inner-content">
							<?php the_title( '<h3 class="wwd-item-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h3>'); ?>

							<?php elite_commerce_display_content(); ?>
						</div><!-- .wwd-block-inner-content -->
					</div><!-- .wwd-block-inner -->
				</div><!-- .wwd-block-wrapper -->
			</div><!-- .wwd-block-item -->
		<?php
		endwhile;
		?>
		</div><!-- .row -->
	</div><!-- .wwd-block-list -->
<?php
endif;

wp_reset_postdata();
