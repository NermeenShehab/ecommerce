<?php
/**
 * Displays header site branding
 *
 * @package Elite Commerce
 */
$elite_commerce_enable = elite_commerce_gtm( 'elite_commerce_header_image_visibility' );

if ( elite_commerce_display_section( $elite_commerce_enable ) ) : ?>
<div id="custom-header">
	<?php is_header_video_active() && has_header_video() ? the_custom_header_markup() : ''; ?>

	<div class="custom-header-content">
		<div class="container clear-fix">
			<div class="left-custom-header pull-left text-alignleft">
				<?php elite_commerce_header_title(); ?>
			</div><!-- .right-custom-header -->
			<div class="left-custom-header pull-right">
			<?php get_template_part( 'template-parts/header/breadcrumb' ); ?>
			</div><!-- .right-custom-header -->
		</div> <!-- .container -->
	</div>  <!-- .custom-header-content -->
</div>
<?php
endif;
