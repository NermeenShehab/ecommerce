<?php
/**
 * Template for displaying search forms in Elite Commerce
 *
 * @package Elite Commerce
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'elite-commerce' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search ...', 'elite-commerce' ); ?>" value="<?php the_search_query(); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="&#xf002;" />
</form>
