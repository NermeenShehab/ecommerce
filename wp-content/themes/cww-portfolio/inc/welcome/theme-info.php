<?php
$cww_tabs = apply_filters( 'cww_portfolio_info_page_tabs', array(
	'getting-started' => array(
		'title'   => esc_html__( 'Getting started', 'cww-portfolio' ),
		'partial' => get_template_directory() . "/inc/welcome/tabs/getting-started.php",
	),
	'demo-import' => array(
		'title'   => esc_html__( 'Demo Import', 'cww-portfolio' ),
		'partial' => get_template_directory() . "/inc/welcome/tabs/demo-import.php",
	),

) );

if ( ! isset( $cww_tabs[ $currentTab ] ) ) {
	$currentTab = 'getting-started';
}

?>


<div class="wrap about-wrap full-width-layout cww-page">
    <h1><?php echo apply_filters( 'cww_portfolio_thankyou_message',
			__( 'Thanks for choosing CWW Portfolio!', 'cww-portfolio' ) ); ?></h1>
    <p><?php _e( 'We\'re glad you chose our theme and we hope it will help you create a beautiful site in no time!<br> If you have any suggestions, don\'t hesitate to leave us some feedback.',
			'cww-portfolio' ); ?></p>

	<?php if ( $theme_logo_url = apply_filters( 'cww_portfolio_theme_logo_url', get_theme_file_uri('/inc/welcome/assets/css/logo.png') ) ): ?>
        <img class="site-badge" src="<?php echo esc_url( $theme_logo_url ); ?>">
	<?php endif; ?>

    <h2 class="nav-tab-wrapper wp-clearfix">

		<?php foreach ( $cww_tabs as $tabID => $cww_portfolio_tab ): ?>
            <a href="?page=cww-welcome&tab=<?php echo esc_attr($tabID); ?>"
               class="nav-tab <?php echo( $tabID === $currentTab ? 'nav-tab-active' : '' ) ?>"><?php echo esc_html($cww_portfolio_tab['title']); ?></a>
			<?php $first = false; ?>
		<?php endforeach; ?>
    </h2>

    <div class="tab-group">
        <div class="tab-item tab-item-active">
			<?php
			if ( isset( $cww_tabs[ $currentTab ]['partial'] ) ) {
				require $cww_tabs[ $currentTab ]['partial'];
			} else {
				call_user_func( $cww_tabs[ $currentTab ]['callback'] );
			}
			?>
        </div>
    </div>
</div>
