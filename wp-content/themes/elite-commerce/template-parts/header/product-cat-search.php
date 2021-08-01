<?php
/**
 * List Product Categories using WooCommerce Widget
 *
 * @package Elite Commerce
 */
if ( ! class_exists( 'WooCommerce' ) ) {
	get_search_form();

	return;
}
?>
<div class="primary-category-search-wrapper">
	<a href="#" id="category-search-toggle" class="menu-search-toggle"><span class="screen-reader-text"><?php esc_html_e( 'Search Products...', 'elite-commerce' ); ?></span><i class="fas fa-search"></i><i class="far fa-times-circle"></i></a>
	<div id="category-search-container" class="search-container displaynone">
		<div class="advance-product-search">
			<form method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php 
				$cat_args = array(
					'orderby'    => 'name',
					'order'      => 'asc',
					'hide_empty' => false,
				);
			 
				$product_categories = get_terms( 'product_cat', $cat_args );

				$selected_cat = isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '';

				if( ! empty( $product_categories ) ) : 
				?>
				<div class="advance-search-wrap">
					<select class="select_products" name="product_cat">
						<option value=""><?php esc_html_e( 'All Categories', 'elite-commerce' ); ?></option>
						<?php foreach ( $product_categories as $key => $category ) : ?>
							<option value="<?php echo esc_attr( $category->slug ); ?>" <?php selected( $selected_cat, $category->slug ); ?>><?php echo esc_html( $category->name ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<?php endif; ?>

				<div class="advance-search-form">
					<label>
						<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'elite-commerce' ); ?></span>
						<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search Products...', 'elite-commerce' ); ?>" value="<?php the_search_query(); ?>" name="s" />
					</label>
					<input type="hidden" name="post_type" value="product">
					<input type="submit" class="search-submit" value="&#xf002;" />			
				</div><!-- .advance-search-form -->
			</form><!-- .woocommerce-product-search -->
		</div><!-- .advance-product-search -->
</div><!-- #search-container -->
</div><!-- .primary-search-wrapper -->
