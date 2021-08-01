<?php

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return; 
}

class CWW_Portfolio_FrontPageSection extends WP_Customize_Section {

	protected $show_title = true;


	protected function render() {
		
		if ( CWW_Portfolio_Companion_Plugin::$plugin_state['installed'] &&  CWW_Portfolio_Companion_Plugin::$plugin_state['active']) {
			return;
		}

		?>

        <li id="accordion-section-<?php echo esc_attr( $this->id ); ?>"
            class="accordion-section control-section control-section-<?php echo esc_attr( $this->type ); ?> companion-needed-section">
            <style>
                #accordion-section-<?php echo esc_attr($this->id);?> h3.accordion-section-title:after {
                    display: none;
                }

                #accordion-section-<?php echo esc_attr($this->id);?> li.install-companion {
                    padding: 10px 20px;
                    text-align: center;
                    font-size: 16px;
                    color: #6d6d6d;
                    line-height: 150%;
                }
            </style>
			<?php if ( $this->show_title ): ?>
                <h3 class="accordion-section-title" tabindex="0">
					<?php echo esc_html( $this->title ); ?>
                    <span class="screen-reader-text"><?php esc_html_e( 'Press return or enter to open this section',
							'cww-portfolio' ); ?></span>
                </h3>
			<?php endif; ?>
            <div class="sections-list-reorder">
                <ul id="page_full_rows" class="list list-order">
                    <li class="">
                        <div class="customize-control-ope-info">
                            <p style="text-align: center;padding: 10px;font-size: 1em;background: #b9dbf7;">
								<?php esc_html_e( 'Please Install the CWW Companion Plugin to Enable All the Theme Features',
									'cww-portfolio' ) ?>
                                <span style="display: block">
								<?php
								
								if ( CWW_Portfolio_Companion_Plugin::$plugin_state['installed'] ) {
									$cww_link  = CWW_Portfolio_Companion_Plugin::get_activate_link();
									$cww_label = esc_html__( 'Activate now', 'cww-portfolio' );
								} else {
									$cww_link  = CWW_Portfolio_Companion_Plugin::get_install_link();
									$cww_label = esc_html__( 'Install now', 'cww-portfolio' );
								}
								printf( '<a class="button button-primary" href="%1$s">%2$s</a>', esc_url( $cww_link ),$cww_label );
								?>
                            </span>
                            </p>
                        </div>

                    </li>
                </ul>
            </div>
            <script type="text/javascript">
                jQuery(function ($) {
                    jQuery('.companion-needed-section,.companion-needed-section > *').off();
                    jQuery('body').on('click', '.companion-needed-section h3', function (event) {
                        event.preventDefault();
                        event.stopPropagation();
                    });
                })
            </script>
        </li>

		<?php

	}
}
