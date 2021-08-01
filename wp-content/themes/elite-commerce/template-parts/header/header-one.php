<?php
/**
 * Header one Style Template
 *
 * @package Elite Commerce
 */
$elite_commerce_header_top_text = elite_commerce_gtm( 'elite_commerce_header_top_text' );
$elite_commerce_phone           = elite_commerce_gtm( 'elite_commerce_header_phone' );
$elite_commerce_email           = elite_commerce_gtm( 'elite_commerce_header_email' );
$elite_commerce_address         = elite_commerce_gtm( 'elite_commerce_header_address' );
$elite_commerce_open_hours      = elite_commerce_gtm( 'elite_commerce_header_open_hours' );

$elite_commerce_button_text   = elite_commerce_gtm( 'elite_commerce_header_button_text' );
$elite_commerce_button_link   = elite_commerce_gtm( 'elite_commerce_header_button_link' );
$elite_commerce_button_target = elite_commerce_gtm( 'elite_commerce_header_button_target' ) ? '_blank' : '_self';
?>
<div class="header-wrapper main-header-one<?php echo ! $elite_commerce_button_text ? ' button-disabled' : ''; ?>">
	<?php if ( $elite_commerce_header_top_text || $elite_commerce_phone || $elite_commerce_email || $elite_commerce_address || $elite_commerce_open_hours || has_nav_menu( 'social' ) ) : ?>
	<div id="top-header" class="main-top-header-one dark-top-header">
		<div class="site-top-header-mobile">
			<div class="container">
				<button id="header-top-toggle" class="header-top-toggle" aria-controls="header-top" aria-expanded="false">
					<i class="fas fa-bars"></i><span class="menu-label"> <?php esc_html_e( 'Top Bar', 'elite-commerce' ); ?></span>
				</button><!-- #header-top-toggle -->
				<div id="site-top-header-mobile-container">
				<?php if ( $elite_commerce_header_top_text ) : ?>
					<div id="quick-info" class="text-aligncenter">
	                	<p><?php echo esc_html( $elite_commerce_header_top_text ); ?></p>
					</div>
				<?php endif; ?>
					<?php if ( $elite_commerce_phone || $elite_commerce_email || $elite_commerce_address || $elite_commerce_open_hours ) : ?>
						<div id="quick-contact">
							<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
						</div>
					<?php endif; ?>

					<?php if ( has_nav_menu( 'social' ) ): ?>
						<div id="top-social" class="pull-left">
							<div class="social-nav no-border">
								<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'elite-commerce' ); ?>">
									<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
									?>
								</nav><!-- .social-navigation -->
							</div>
						</div><!-- #top-social -->
					<?php endif; ?>
				</div><!-- #site-top-header-mobile-container-->

				<?php get_template_part( 'template-parts/third-party/woocommerce-currency-switcher' ); ?>

				<?php get_template_part( 'template-parts/third-party/translatepress-language-switcher' ); ?>
				
			</div><!-- .container -->
		</div><!-- .site-top-header-mobile -->

		<div class="site-top-header">
			<div class="container">
				<?php if ( $elite_commerce_header_top_text ) : ?>
					<div id="quick-info" class="pull-left">
		            	<p><?php echo esc_html( $elite_commerce_header_top_text ); ?></p>
					</div>
				<?php endif; ?>
				<div id="quick-contact" class="layout-one pull-left">
					<?php get_template_part( 'template-parts/header/quick-contact' ); ?>
				</div><!-- #quick-contact -->
				<div class="top-head-right pull-right">
				
					<?php if ( has_nav_menu( 'social' ) ): ?>
					<div id="top-social" class="pull-left">
						<div class="social-nav no-border">
							<nav id="social-primary-navigation" class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'elite-commerce' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
									) );
								?>
							</nav><!-- .social-navigation -->
						</div>
					</div><!-- #top-social -->
					<?php endif; ?>

					<?php get_template_part( 'template-parts/third-party/woocommerce-currency-switcher' ); ?>

					<?php get_template_part( 'template-parts/third-party/translatepress-language-switcher' ); ?>
				</div><!-- .container -->
			</div><!-- .site-top-header -->
		</div><!-- .site-top-header -->
	</div><!-- .#top-header -->
	<?php endif; ?>

	<header id="masthead" class="site-header clear-fix">
		<div class="container">
			<div class="site-header-main">
				<div class="site-branding">
					<?php get_template_part( 'template-parts/header/site-branding' ); ?>
				</div><!-- .site-branding -->

				<div class="right-head pull-right">
					<div class="header-search-wrapper pull-left">
						<?php get_template_part( 'template-parts/header/product-cat-search' ); ?>
					</div><!-- .header-search -->

					<?php if ( elite_commerce_gtm( 'elite_commerce_header_login_on' ) ) : ?>
					<div class="login-register pull-left">
						<a href="<?php echo esc_url( elite_commerce_gtm( 'elite_commerce_header_login_link' ) ); ?>" class="account-login"<?php echo elite_commerce_gtm( 'elite_commerce_header_login_target' ) ? ' target="_blank"' : ''; ?>><i class="<?php echo esc_attr( elite_commerce_gtm( 'elite_commerce_header_login_icon' ) ); ?>"></i></a>
					</div><!-- .login-register -->
					<?php endif; ?>

					<?php if ( function_exists( 'elite_commerce_woocommerce_header_cart' ) ) : ?>
					<div class="cart-contents pull-left">
						<?php elite_commerce_woocommerce_header_cart(); ?>
					</div>
					<?php endif; ?>

					<?php if ( $elite_commerce_phone ) : ?>
						<div class="mobile-off no-margin pull-right">
							<div class="contact-wrapper">
								<div class="contact-icon pull-left"><i class="fas fa-headphones"></i></div><!-- .contact-icon -->

								<div class="header-info">
									<h5><a href="tel:<?php echo preg_replace( '/\s+/', '', esc_attr( $elite_commerce_phone ) ); ?>"><?php echo esc_html( $elite_commerce_phone ); ?></a></h5>
									
									<?php if ( $elite_commerce_phone_text = elite_commerce_gtm( 'elite_commerce_header_phone_text' ) ) : ?>
									<span><?php echo esc_html( $elite_commerce_phone_text ); ?></span>
									<?php endif; ?>
		                    	</div><!-- .header-info -->
			                </div><!-- .contact-wrapper -->
						</div><!-- .mobile-off.ff-grid-2.no-margin -->
					<?php endif; ?>
				</div><!-- .right-head -->
			</div><!-- .site-header-main -->
		</div><!-- .container -->
	</header><!-- #masthead -->
	<div id="main-nav" class="clear-fix">
		<div class="nav-inner-wrapper box-shadow clear-fix<?php echo elite_commerce_gtm( 'elite_commerce_primary_menu_dark' ) ? ' dark-nav' : ''; ?>">
			<div class="container">
				<div class="row">
					<?php 
					$display_cats = elite_commerce_gtm( 'elite_commerce_primary_menu_cat_list' );

					if ( $display_cats ) : ?>
					<div class="ff-grid-3 no-margin main-cat-toggle pull-left">
						<?php get_template_part( 'template-parts/header/product-category-list' ); ?>
					</div>
					<?php endif; ?>
					
					<div class="ff-grid-<?php echo $display_cats ? 9 : 12; ?> nav-wrapper-section no-margin pull-right">
						<div class="pull-left">
							<?php get_template_part( 'template-parts/navigation/navigation-primary' ); ?>
						</div>
						<?php if ( $elite_commerce_button_text ) : ?>
							<a target="<?php echo esc_attr( $elite_commerce_button_target );?>" href="<?php echo esc_url( $elite_commerce_button_link );?>" class="ff-button header-button  pull-right"><?php echo esc_html( $elite_commerce_button_text );?></a>
							<?php endif; ?>
						</div><!-- .top-head-right -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!--.nav-inner-wrapper -->
	</div><!-- .main-nav -->
</div><!-- .header-wrapper -->
