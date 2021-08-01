<?php
/**
 *  Customizer custom controllers
 * 
 * 
 */ 


add_action( 'customize_controls_enqueue_scripts', 'cww_companion_enqueue_custom_scripts');
if( ! function_exists('cww_companion_enqueue_custom_scripts')):
function cww_companion_enqueue_custom_scripts() {
    
    wp_enqueue_style('cww-companion-customizer-style',CWW_COMP_URL . '/inc/customizer/assets/css/customizer-styles.css');

}
endif;



add_action( 'customize_register', 'cww_companion_custom_customize_register' );
function cww_companion_custom_customize_register( $wp_customize ) {

  if ( ! class_exists( 'WP_Customize_Control' ) ) {
    return; 
  }

  class CWW_Portfolio_Customize_Pro_Info extends WP_Customize_Control {
       public function render_content() { ?>
         <div class="cww-pro-msg-wrapp" style="display: none;">
            <div class="label"><?php echo esc_html( $this->label ); ?></div>
             
            <?php if($this->description): ?>
            <div class="customizer-desc-wrapp">
              <?php echo esc_html( $this->description ); ?>
            </div>  
          <?php endif; ?>
          
         </div>
        
  <?php     
    }     

  }

}