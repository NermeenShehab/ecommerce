<div class="tab-cols">
    <div class="two-col">
        <div class="col bordered-right">
            <h2 class="col-title"> <?php esc_html_e('Get Started in 3 Easy Steps', 'cww-portfolio'); ?></h2>
            <h3 class="col-subtitle"><?php esc_html_e('1. Install the recommended plugins', 'cww-portfolio'); ?></h3>
            <div class="recommended-plugins">
                <?php
                $config             = CWW_Portfolio_Companion_Plugin::$config;
                $cww_plugins        = $config['plugins'];

                foreach ($cww_plugins as $slug => $plugin) {
                    $state = CWW_Portfolio_Companion_Plugin::get_plugin_state($slug);

                    $plugin_is_ready = $state['installed'] && $state['active'];
                    if ( ! $plugin_is_ready) {
                        if ($state['installed']) {
                            $cww_link       = CWW_Portfolio_Companion_Plugin::get_activate_link($slug);
                            $label          = $plugin['activate']['label'];
                            $btn_class      = "activate";
                        } else {
                            $cww_link       = CWW_Portfolio_Companion_Plugin::get_install_link($slug);
                            $label          = $plugin['install']['label'];
                            $btn_class      = "install-now";
                        }
                    }

                    $cww_title      = $plugin['title'];
                    $description    = $plugin['description'];
                    ?>
                    <div class="cww_install_notice <?php if ($plugin_is_ready) {
                        echo 'blue';
                    } ?>">
                        <h3 class="rp-plugin-title"><?php echo esc_html($cww_title) ?></h3>
                        <?php
                        printf('<p>%1$s</p>', esc_html($description));
                        if ( ! $plugin_is_ready) {
                            printf('<a class="%1$s button" href="%2$s">%3$s</a>', esc_attr($btn_class), esc_url($cww_link), esc_html($label));
                        } else {
                            esc_html_e('Plugin is installed and active.', 'cww-portfolio');
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
            <h3 class="col-subtitle">
                <?php
                $customize_link = add_query_arg(
                    array(
                        'url' => get_home_url(),
                    ),
                    network_admin_url('customize.php')
                );

                printf('2. <a class="button" href="%s"> %s </a> your site', esc_url($customize_link), esc_html__('Customize', 'cww-portfolio')); ?></h3>
            <h3 class="col-subtitle"><?php esc_html_e('3. Enjoy! :)', 'cww-portfolio'); ?></h3>
        </div>
        <div class="col">
        
        </div>
    </div>
</div>
