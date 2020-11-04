<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Sober_Check
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<section class="error-404 not-found">
						<h1 class="error-404__title display-1"><?php esc_html_e( '404', 'sobercheck' ); ?></h1>
						
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'sobercheck' ); ?></h1>
						</header><!-- .page-header -->

						<div class="page-content">
							<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'sobercheck' ); ?></p>
						</div><!-- .page-content -->
					</section><!-- .error-404 -->
				</div>
			</div>
		</div>

	</main><!-- #main -->

<?php
get_footer();
