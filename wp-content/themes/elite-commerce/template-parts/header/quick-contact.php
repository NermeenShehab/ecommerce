<?php
/**
 * Header Search
 *
 * @package Elite Commerce
 */

$elite_commerce_phone      = elite_commerce_gtm( 'elite_commerce_header_phone' );
$elite_commerce_email      = elite_commerce_gtm( 'elite_commerce_header_email' );
$elite_commerce_address    = elite_commerce_gtm( 'elite_commerce_header_address' );
$elite_commerce_open_hours = elite_commerce_gtm( 'elite_commerce_header_open_hours' );

if ( $elite_commerce_phone || $elite_commerce_email || $elite_commerce_address || $elite_commerce_open_hours ) : ?>
	<div class="inner-quick-contact">
		<ul>
			<?php if ( $elite_commerce_phone ) : ?>
				<li class="quick-call">
					<span><?php esc_html_e( 'Phone', 'elite-commerce' ); ?></span><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $elite_commerce_phone ) ); ?>"><?php echo esc_html( $elite_commerce_phone ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $elite_commerce_email ) : ?>
				<li class="quick-email"><span><?php esc_html_e( 'Email', 'elite-commerce' ); ?></span><a href="<?php echo esc_url( 'mailto:' . esc_attr( antispambot( $elite_commerce_email ) ) ); ?>"><?php echo esc_html( antispambot( $elite_commerce_email ) ); ?></a> </li>
			<?php endif; ?>

			<?php if ( $elite_commerce_address ) : ?>
				<li class="quick-address"><span><?php esc_html_e( 'Address', 'elite-commerce' ); ?></span><?php echo esc_html( $elite_commerce_address ); ?></li>
			<?php endif; ?>

			<?php if ( $elite_commerce_open_hours ) : ?>
				<li class="quick-open-hours"><span><?php esc_html_e( 'Open Hours', 'elite-commerce' ); ?></span><?php echo esc_html( $elite_commerce_open_hours ); ?></li>
			<?php endif; ?>
		</ul>
	</div><!-- .inner-quick-contact -->
<?php endif; ?>

