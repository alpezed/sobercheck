<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sober_Check
 */

get_header();
?>

	<main id="primary" class="site-main container">
		<div class="container">
			<div class="row">
				<div class="col-lg-7">
					<?php
					if ( is_home() && ! is_front_page() ) :
						?>
						<header class="blog-header-title">
							<h1 class="page-title"><?php single_post_title(); ?></h1>
							<p><?php _e( 'Unsure about anything? Watch our step-by-step videos that will help explain everything. Downloadable PDFs are also available.', 'sobercheck' ); ?></p>
						</header>
						<?php
					endif;
					?>
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<?php if ( have_posts() ) : ?>
						<div class="sc-posts">
							<?php
								/* Start the Loop */
								while ( have_posts() ) :
									the_post();

									/*
									* Include the Post-Type-specific template for the content.
									* If you want to override this in a child theme, then include a file
									* called content-___.php (where ___ is the Post Type name) and that will be used instead.
									*/
									get_template_part( 'template-parts/content', 'blog' );

								endwhile;
							?>

						</div>

						<?php
							the_posts_navigation( array(
								'prev_text' => __( '<span class="post-navigation__prev"><svg xmlns="http://www.w3.org/2000/svg" width="9.371" height="16.39" viewBox="0 0 9.371 16.39"><path fill="#fff" d="M14.071,14.388l6.2-6.2a1.166,1.166,0,0,0,0-1.654,1.181,1.181,0,0,0-1.659,0l-7.027,7.022a1.169,1.169,0,0,0-.034,1.615l7.056,7.071a1.171,1.171,0,0,0,1.659-1.654Z" transform="translate(-11.246 -6.196)"/></svg></span>', 'sobercheck' ),
								'next_text' => __( '<span class="post-navigation__next"><svg xmlns="http://www.w3.org/2000/svg" width="9.371" height="16.39" viewBox="0 0 9.371 16.39"><path fill="#fff" d="M17.793,14.388l-6.2-6.2a1.166,1.166,0,0,1,0-1.654,1.181,1.181,0,0,1,1.659,0l7.027,7.022a1.169,1.169,0,0,1,.034,1.615l-7.056,7.071A1.171,1.171,0,1,1,11.6,20.59Z" transform="translate(-11.246 -6.196)"/></svg></span>', 'sobercheck' ),
								'screen_reader_text' => __( 'Posts navigation', 'sobercheck' )
							) );
						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>
				</div>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
