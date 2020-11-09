<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Sober_Check
 */

$social_links = sc_get_setting( 'social_link' );
?>
	<?php get_template_part( 'components/footer', 'cta' ); ?>
	<footer id="colophon" class="main-footer site-footer sc-footer-area">
		<div class="footer-widgets">
			<div class="container">
				<?php get_template_part( 'components/footers/footer', sc_get_setting( 'footer_widget_style' ) ); ?>
			</div>
		</div>
		<div class="footer-info">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php echo get_theme_mod( 'footer_text' ); ?>
					</div>
					<div class="col-md-6 d-none d-lg-block">
						<ul class="nav nav-social d-flex align-items-center justify-content-end mb-0 text-white">
							<?php foreach ( $social_links as $social ) { ?>
								<li class="nav-item">
									<a href="<?php echo ! empty( $social[ 'link_url' ] ) ? esc_url( $social[ 'link_url' ] ) : ''; ?>" class="nav-link" title="<?php echo ! empty( $social[ 'title' ] ) ? esc_html( $social[ 'title' ] ) : ''; ?>">
										<i class="<?php echo ! empty( $social[ 'icon_class' ] ) ? esc_html( $social[ 'icon_class' ] ) : ''; ?>"></i>
									</a>
								</li>
							<?php } ?>
						</ul>
					</div>
				</div>
			</div><!-- .container -->
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
