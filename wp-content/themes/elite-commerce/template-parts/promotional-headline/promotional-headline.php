<?php
/**
 * Template part for displaying Hero Content
 *
 * @package Elite Commerce
 */

$elite_commerce_visibility = elite_commerce_gtm( 'elite_commerce_promotional_headline_visibility' );

if ( ! elite_commerce_display_section( $elite_commerce_visibility ) ) {
	return;
}

get_template_part( 'template-parts/promotional-headline/post-type' );
