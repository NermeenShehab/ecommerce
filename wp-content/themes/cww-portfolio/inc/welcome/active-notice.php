<div id="cww_start_with_homepage">
    <div class="cww-container-fluid">
        <div class="cww-row reverse">
            <div class="cww-col">
                <div class="title">
                    <h1 class="">
						<?php
                        $theme_ob = wp_get_theme();

						printf(
							esc_html__(
								'Thank you for installing %s','cww-portfolio'
							),
							apply_filters( 'cww_portfolio_start_with_front_page_name', $theme_ob->get( 'Name' ) )
						);
						?>
                    </h1>
                    
                </div>

                <div>
                    <span>
                        <?php
                        $cww_label = esc_html__('Let\'s Get Started', 'cww-portfolio' );                        

                        if ( CWW_Portfolio_Companion_Plugin::$plugin_state['installed'] ) {
	                        $cww_link = CWW_Portfolio_Companion_Plugin::get_activate_link();
                        } else {
	                        $cww_link = CWW_Portfolio_Companion_Plugin::get_install_link();
                        }

                        if ( CWW_Portfolio_Companion_Plugin::$plugin_state['installed'] && CWW_Portfolio_Companion_Plugin::$plugin_state['active'] ) {
                            $cww_label  = esc_html__('View Welcome Page', 'cww-portfolio' );
                            $cww_link   = get_admin_url().'themes.php?page=cww-welcome';
                        }

                        printf( '<a class="button button-hero button-primary" href="%1$s" onclick="window.location=this.href;this.href=\'javascript:void(0)\';">%2$s</a>', esc_url( $cww_link ), $cww_label );
                        ?>
                    </span>
                    <span>
                        <button class="button-link maybe-later">
                            <?php esc_html_e( 'Maybe later', 'cww-portfolio' ); ?>
                        </button>
                    </span>
                </div>
                <div>
                    <p class="description"><?php esc_html_e( 'This action will install the CWW Companion plugin','cww-portfolio' ); ?>
                    </p>
                </div>

            </div>
            <div class="cww-col fit">
                <div class="image-wrapper"
                     style="background-image: url('<?php echo esc_url( get_template_directory_uri() . "/inc/welcome/assets/css/homepage-preview.jpg" ) ?>');">
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        jQuery('.cww-start-with-front-page-notice').on('click', '.notice-dismiss', function () {
            jQuery.post(
                ajaxurl,
                {
                    value: 1,
                    action: "companion_disable_popup",
                    companion_disable_popup_wpnonce: '<?php echo wp_create_nonce( "companion_disable_popup" ); ?>'
                }
            )
        });

        jQuery('.maybe-later').on('click', function () {
            var $notice = jQuery(this).closest('.notice.is-dismissible');
            $notice.slideUp('fast', function () {
                $notice.remove();
            });
        });

    </script>
</div>