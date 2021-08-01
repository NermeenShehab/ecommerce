<div class="tab-cols">
    

    <div class="about-wrap ocdi wrap" style="display: block;margin: auto;max-width: 600px;">
        <?php 
        $slug  = "cww-companion";
        $state = CWW_Portfolio_Companion_Plugin::get_plugin_state($slug);
            
        $plugin_is_ready = $state['installed'] && $state['active'];
        if ( ! $plugin_is_ready) {
         ?>
        <div class="cww_install_notice ">
            <h3 class="rp-plugin-title"><?php esc_html_e('CWW Companion', 'cww-portfolio'); ?></h3>
            <p><?php esc_html_e('Please make sure to activate all the recommended plugins to make demo work correctly.', 'cww-portfolio'); ?></p>
            <?php
           
            
            if ($state['installed']) {
                $cww_link = CWW_Portfolio_Companion_Plugin::get_activate_link($slug);
                $label        = esc_html__('Activate', 'cww-portfolio');
                $btn_class    = "activate";
            } else {
                $cww_link = CWW_Portfolio_Companion_Plugin::get_install_link($slug);
                $label        = esc_html__('Install', 'cww-portfolio');
                $btn_class    = "install-now";
            }
            
            ?>
            <a class="<?php echo esc_attr($btn_class); ?> button" href="<?php echo esc_url($cww_link); ?>"><?php echo esc_html($label); ?></a>
        </div>
        <?php } ?>
        
    </div>
</div>

<?php 

if( class_exists('CWW_Companion')){

    $demoData = new CWW_Install_Demos;
    $demoData->create_admin_page();
}