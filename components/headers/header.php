<header id="masthead" class="site-header header site-header--sticky">
	<div class="site-header__topbar px-3 d-none d-lg-block">
		<div class="container-fluid">
			<div class="site-header__topbar--phone text-right"><?php echo sc_get_setting( 'phone_number' ); ?></div>
		</div>
	</div>

	<nav id="header" class="navbar navbar-expand-lg navbar-light shadow py-0 bg-white sticky-nav">
		<div class="container-fluid">
			<?php get_template_part( 'components/logo' ); ?>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="<?php _e( 'Toggle navigation', 'sobercheck' ); ?>">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="d-none d-lg-flex navbar-nav-main">
				<ul class="nav navbar-nav nav-menu-right align-items-center d-none d-lg-flex order-2 mr-2">
					<li class="nav-item">
						<a href="#" class="nav-link">My Cart (2)</a>
					</li>
					<li class="nav-item">
						<a href="#" class="nav-link">Account</a>
					</li>
				</ul>
				<form class="form-inline form-navbar my-2 my-lg-0 order-2" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<svg xmlns="http://www.w3.org/2000/svg" width="17.274" height="17.274" viewBox="0 0 17.274 17.274">
						<g transform="translate(-3.5 -3.5)">
							<path class="nav-icon" d="M17.709,11.1a6.6,6.6,0,1,1-6.6-6.6,6.6,6.6,0,0,1,6.6,6.6Z"
								transform="translate(0 0)" />
							<path class="nav-icon" d="M28.566,28.566l-3.591-3.591" transform="translate(-9.206 -9.206)" />
						</g>
					</svg>
					<input class="form-control" name="s" type="text" placeholder="Search">
				</form>
				<?php
					/** Loading WordPress Custom Menu (theme_location) **/
					wp_nav_menu(
						array(
                            'theme_location' => 'primary-menu',
							'container'      => '',
							'menu_class'     => 'navbar-nav ml-4 mr-auto order-1',
							'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
							'walker'         => new WP_Bootstrap_Navwalker(),
                        )
					);
					?>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container -->
	</nav><!-- /#header -->

	<form class="sc-search form-navbar d-block d-lg-none" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<svg xmlns="http://www.w3.org/2000/svg" width="18.996" height="19" viewBox="0 0 18.996 19">
			<path d="M23.273,22.118,17.99,16.785a7.529,7.529,0,1,0-1.143,1.158l5.249,5.3a.813.813,0,0,0,1.148.03A.818.818,0,0,0,23.273,22.118Zm-11.2-4.111a5.945,5.945,0,1,1,4.2-1.741A5.908,5.908,0,0,1,12.073,18.007Z" transform="translate(-4.5 -4.493)" fill="#868080" />
		</svg>
		<input class="form-control" name="s" type="text" placeholder="Search">
	</form>

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
