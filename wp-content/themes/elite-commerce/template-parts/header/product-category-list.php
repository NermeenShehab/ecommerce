<?php
/**
 * List Product Categories using WooCommerce Widget
 *
 * @package Elite Commerce
 */

if ( ! class_exists( 'WooCommerce' ) ) {
	return;
}

?>
<div class="nav-category-menu nav-category">
	<button id="category-toggle" class="nav-category-button"><i class="fas fa-list"></i><?php esc_html_e( ' All Categories', 'elite-commerce' ); ?></button>
	<div class="category-toggle-container displaynone">
		<?php the_widget( 'WC_Widget_Product_Categories', 'title=&count=1' ); ?>
	</div><!-- .category-toggle-container -->
</div>
