<?php
/**
 * WooCommerce Currency switcher
 *
 * @package Elite Commerce
 */

if ( ! class_exists( 'WOOCS_STARTER' ) ) {
	return;
}
?>
<div class="currency-switcher pull-right">
<?php echo do_shortcode( '[woocs]' ); ?>
</div>
