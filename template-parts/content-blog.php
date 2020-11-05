<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sober_Check
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="sc-posts__featured--img">
		<?php sobercheck_post_thumbnail(); ?>
	</div>
    
	<header class="entry-header">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<a href="<?php the_permalink(); ?>" class="sc-posts__read-more btn-link text-primary">Read More</a>
</article><!-- #post-<?php the_ID(); ?> -->
