<?php
/**
 * Adds Theme page
 *
 * @package Elite Commerce
 */

function elite_commerce_about_admin_style( $hook ) {
	if ( 'appearance_page_elite-commerce-about' === $hook ) {
		wp_enqueue_style( 'elite-commerce-theme-about', get_theme_file_uri( 'css/theme-about.css' ), null, '1.0' );
	}
}
add_action( 'admin_enqueue_scripts', 'elite_commerce_about_admin_style' );

/**
 * Add theme page
 */
function elite_commerce_menu() {
	add_theme_page( esc_html__( 'About Theme', 'elite-commerce' ), esc_html__( 'About Theme', 'elite-commerce' ), 'edit_theme_options', 'elite-commerce-about', 'elite_commerce_about_display' );
}
add_action( 'admin_menu', 'elite_commerce_menu' );

/**
 * Display About page
 */
function elite_commerce_about_display() {
	$theme = wp_get_theme();
	?>
	<div class="wrap about-wrap full-width-layout">
		<h1><?php echo esc_html( $theme ); ?></h1>
		<div class="about-theme">
			<div class="theme-description">
				<p class="about-text">
					<?php
					// Remove last sentence of description.
					$description = explode( '. ', $theme->get( 'Description' ) );

					array_pop( $description );

					$description = implode( '. ', $description );

					echo esc_html( $description . '.' );
				?></p>
				<p class="actions">
					<a href="https://fireflythemes.com/themes/elite-commerce" class="button button-secondary" target="_blank"><?php esc_html_e( 'Info', 'elite-commerce' ); ?></a>

					<a href="https://fireflythemes.com/documentation/elite-commerce/" class="button button-primary" target="_blank"><?php esc_html_e( 'Documentation', 'elite-commerce' ); ?></a>

					<a href="https://demo.fireflythemes.com/elite-commerce" class="button button-primary green" target="_blank"><?php esc_html_e( 'Demo', 'elite-commerce' ); ?></a>

					<a href="https://fireflythemes.com/support" class="button button-secondary" target="_blank"><?php esc_html_e( 'Support', 'elite-commerce' ); ?></a>
				</p>
			</div>

			<div class="theme-screenshot">
				<img src="<?php echo esc_url( $theme->get_screenshot() ); ?>" />
			</div>

		</div>

		<?php
			elite_commerce_main_screen();
		?>

		<div class="return-to-dashboard">
			<?php if ( current_user_can( 'update_core' ) && isset( $_GET['updated'] ) ) : ?>
				<a href="<?php echo esc_url( self_admin_url( 'update-core.php' ) ); ?>">
					<?php is_multisite() ? esc_html_e( 'Return to Updates', 'elite-commerce' ) : esc_html_e( 'Return to Dashboard &rarr; Updates', 'elite-commerce' ); ?>
				</a> |
			<?php endif; ?>
			<a href="<?php echo esc_url( self_admin_url() ); ?>"><?php is_blog_admin() ? esc_html_e( 'Go to Dashboard &rarr; Home', 'elite-commerce' ) : esc_html_e( 'Go to Dashboard', 'elite-commerce' ); ?></a>
		</div>
	</div>
	<?php
}

/**
 * Output the main about screen.
 */
function elite_commerce_main_screen() {
	if ( isset( $_GET['page'] ) && 'elite-commerce-about' === $_GET['page'] && ! isset( $_GET['tab'] ) ) {
	?>
		<div class="feature-section two-col">
			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Theme Customizer', 'elite-commerce' ); ?></h2>
				<p><?php esc_html_e( 'All Theme Options are available via Customize screen.', 'elite-commerce' ) ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" class="button button-primary"><?php esc_html_e( 'Customize', 'elite-commerce' ); ?></a></p>
			</div>

			<div class="col card">
				<h2 class="title"><?php esc_html_e( 'Got theme support question?', 'elite-commerce' ); ?></h2>
				<p><?php esc_html_e( 'Get genuine support from genuine people. Whether it\'s customization or compatibility, our seasoned developers deliver tailored solutions to your queries.', 'elite-commerce' ) ?></p>
				<p><a href="https://fireflythemes.com/support" class="button button-primary"><?php esc_html_e( 'Support Forum', 'elite-commerce' ); ?></a></p>
			</div>
		</div>
	<?php
	}
}
