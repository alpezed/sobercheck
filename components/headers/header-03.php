<header id="masthead" class="site-header site-header--header-03 header shadow site-header--sticky">
	<nav id="header" class="navbar navbar-expand-lg navbar-light bg-white sticky-nav">
		<div class="container-fluid">
			<?php get_template_part( 'components/logo' ); ?>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php _e( 'Toggle navigation', 'sobercheck' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="d-none d-lg-flex navbar-nav-main">
				<div class="site-header--phone">
                    <a href="tel:<?php echo sc_get_setting( 'phone_number' ); ?>"><?php printf( esc_html__( 'Call us on %s', 'sobercheck' ), sc_get_setting( 'phone_number' ) ) ?></a>
                </div>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav><!-- /#header -->

	<div id="navbar" class="collapse navbar-collapse sc-mobile-menu">
		<?php
			/** Loading WordPress Custom Menu (theme_location) **/
			wp_nav_menu(
				array(
                    'theme_location' => 'primary-menu',
					'container'      => '',
					'menu_class'     => 'navbar-nav',
					'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
					'walker'         => new WP_Bootstrap_Navwalker(),
                )
			);
			?>
		<h2 class="site-header__phone-mobile"><?php echo sc_get_setting( 'phone_number' ); ?></h2>
	</div><!-- /.navbar-collapse -->
</header><!-- #masthead -->
