<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Elite Commerce
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
			<section class="error-404 not-found">
				<?php
				$elite_commerce_enable = elite_commerce_gtm( 'elite_commerce_header_image_visibility' );

				if ( ! elite_commerce_display_section( $elite_commerce_enable ) ) : ?>
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'elite-commerce' ); ?></h1>
				</header><!-- .page-header -->
				<?php endif; ?>

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'elite-commerce' ); ?></p>

					<?php
					get_search_form();
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
