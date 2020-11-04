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

?>

	<footer id="colophon" class="site-footer">
		<div class="site-footer__widgets">
			<div class="container">
				<div class="row">
					<!-- Wodgets -->
					<div class="col-12 col-lg-3 order-2 order-lg-1">
						<?php dynamic_sidebar( 'footer-widget-1' ); ?>
					</div>
					<div class="col-12 col-lg-6 order-3 order-lg-2">
						<?php dynamic_sidebar( 'footer-widget-2' ); ?>
					</div>
					<div class="col-12 col-lg-3 order-1 order-lg-3">
						<?php dynamic_sidebar( 'footer-widget-3' ); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="site-footer__info">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<?php echo get_theme_mod( 'footer_text' ); ?>
					</div>
					<div class="col-md-6 d-none d-lg-block">
						<ul class="nav nav-social d-flex align-items-center justify-content-end mb-0 text-white">
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="fab fa-twitter"></i>
								</a>
							</li>
							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="fab fa-facebook-square"></i>
								</a>
							</li>
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
