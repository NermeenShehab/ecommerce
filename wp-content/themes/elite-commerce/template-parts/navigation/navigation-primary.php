<?php
/**
 * Displays Primary Navigation
 *
 * @package Elite Commerce
 */

if ( ! elite_commerce_gtm( 'elite_commerce_primary_menu_on' ) ) {
	// Bail if primary menu is disabled.
	return;
}
?>

<button id="primary-menu-toggle" class="menu-primary-toggle menu-toggle" aria-controls="primary-menu" aria-expanded="false">
	<i class="fas fa-bars"></i><span class="menu-label"><?php esc_html_e( 'Menu', 'elite-commerce' ); ?></span>
</button>

<div id="site-header-menu" class="site-primary-menu">
	<nav id="site-primary-navigation" class="main-navigation site-navigation custom-primary-menu" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'elite-commerce' ); ?>">
		<?php wp_nav_menu( array(
			'theme_location'	=> 'menu-1',
			'container_class'	=> 'primary-menu-container',
			'menu_class'		=> 'primary-menu',
		) ); ?>
	</nav><!-- #site-primary-navigation.custom-primary-menu -->
</div><!-- .site-header-main -->
