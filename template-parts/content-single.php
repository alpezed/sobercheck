<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Sober_Check
 */

?>

<div class="row">
    <div class="col-12">
        <header class="entry-header">
            <?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
            <?php do_action( 'sc_back_button' ); ?>
        </header><!-- .entry-header -->

        <div class="row flex-sm-row flex-column-reverse align-items-center">
            <div class="col-md-8">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php sobercheck_post_thumbnail(); ?>
                </article><!-- #post-<?php the_ID(); ?> -->		
            </div>

            <div class="col-md-4">
                <div class="entry-meta flex-row justify-content-between flex-row-reverse d-flex d-sm-block">
                    <?php
                    sobercheck_posted_on();
                    sobercheck_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            </div>
        </div>
    </div>
</div>

<div class="entry-content">
    <?php
    the_content(
        sprintf(
            wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'sobercheck' ),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            wp_kses_post( get_the_title() )
        )
    );

    wp_link_pages(
        array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'sobercheck' ),
            'after'  => '</div>',
        )
    );
    ?>
</div><!-- .entry-content -->