<?php
/**
 * Install demos page
 *
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class CWW_Install_Demos {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_page' ), 999 );
	}

	/**
	 * Add sub menu page for the custom CSS input
	 *
	 * @since 1.0.0
	 */
	public function add_page() {

		add_submenu_page(
			'themes.php',
			esc_html__( 'CWW Demo Import', 'cww-companion' ),
			esc_html__( 'Import Demos', 'cww-companion' ),
			'manage_options',
			'cww-install-demos',
			array( $this, 'create_admin_page' )
		);
	}

	/**
	 * Settings page output
	 *
	 * @since 1.0.0
	 */
	public function create_admin_page() {

		// Theme branding
		$theme = wp_get_theme();
		$brand = $theme->name; ?>

		<div class="cww-demo-wrap wrap">

			<h2><?php echo esc_attr( $brand ); ?> - <?php esc_attr_e( 'Install Demos', 'cww-companion' ); ?></h2>

			<div class="theme-browser rendered">

				<?php
				// Vars
				$demos = CWW_Demos::get_demos_data();
				
				$categories = CWW_Demos::get_demo_all_categories( $demos ); ?>

				<?php if ( ! empty( $categories ) ) : ?>
					<div class="cww-header-bar">
						<nav class="cww-navigation">
							<ul>
								<li class="active"><a href="#all" class="cww-navigation-link"><?php esc_html_e( 'All', 'cww-companion' ); ?></a></li>
								<?php foreach ( $categories as $key => $name ) : ?>
									<li><a href="#<?php echo esc_attr( $key ); ?>" class="cww-navigation-link"><?php echo esc_html( $name ); ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
						<div clas="cww-search">
							<input type="text" class="cww-search-input" name="cww-search" value="" placeholder="<?php esc_html_e( 'Search demos...', 'cww-companion' ); ?>">
						</div>
					</div>
				<?php endif; ?>

				<div class="themes wp-clearfix">

					<?php
					// Loop through all demos
					foreach ( $demos as $demo => $key ) {
						
						$theme = get_stylesheet();
						
						
						

                        $image_path = 'https://codeworkweb.com/demo-importer/'.$theme.'-demos/screenshot.png';

						// Vars
						$item_categories = CWW_Demos::get_demo_item_categories( $key );
						$demo_slug = CWW_Demos::get_demos_data()[ $demo ];
                        $preview_url = isset($demo_slug['preview_url']) ? $demo_slug['preview_url'] : '#';
                        $is_pro = isset($demo_slug['is_premium']) ? $demo_slug['is_premium'] : false;
						$opt_id = 'theme_mods_'.get_stylesheet();
						$options = get_option($opt_id);
						if (!empty($options[$demo])) {
				            $imported_class = 'imported';
				            $status = __( 'Imported', 'cww-companion' );
						}elseif($is_pro == true){
							$imported_class = 'imported';
							$status = __( 'Pro', 'cww-companion' );
						}else{
				            $imported_class = 'not-imported';
				            $status = __( 'Not Imported', 'cww-companion' );
						}
						
                        ?>
						<div class="theme-wrap <?php echo esc_attr($imported_class);?>" data-categories="<?php echo esc_attr( $item_categories ); ?>" data-name="<?php echo esc_attr( strtolower( $demo ) ); ?>">
                            
							<div class="theme cww-open-popup" data-demo-id="<?php echo esc_attr( $demo ); ?>">

								<div class="theme-screenshot">
									<div class="cww-tag"><?php echo $status;?></div>
									<img src="<?php echo esc_url( $image_path ); ?>" />
									

									<div class="demo-import-loader preview-all preview-all-<?php echo esc_attr( $demo ); ?>"></div>

									<div class="demo-import-loader preview-icon preview-<?php echo esc_attr( $demo ); ?>"><i class="custom-loader"></i></div>
								</div>

								<div class="theme-id-container">
		
									<h2 class="theme-name" id="<?php echo esc_attr( $demo ); ?>"><span><?php echo ucwords( $demo ); ?></span></h2>

									<div class="theme-actions">
										<div class="import-now button button-primary"><?php _e( 'Import Demo', 'cww-companion' )?></div>
										<a class="button button-primary" href="<?php echo esc_url( $preview_url ); ?>" target="_blank"><?php _e( 'Live Preview', 'cww-companion' ); ?></a>
									</div>

								</div>

							</div>

						</div>

					<?php } ?>

				</div>

			</div>

		</div>

	<?php }
}
new CWW_Install_Demos();