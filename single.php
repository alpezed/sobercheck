<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Sober_Check
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="container">
			<?php
				while ( have_posts() ) :
					the_post();

					get_template_part( 'template-parts/content', 'single' );

					// the_post_navigation(
					// 	array(
					// 		'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'sobercheck' ) . '</span> <span class="nav-title">%title</span>',
					// 		'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'sobercheck' ) . '</span> <span class="nav-title">%title</span>',
					// 	)
					// );

				endwhile; // End of the loop.
			?>
		</div>
	</main><!-- #main -->

<?php
get_footer();
