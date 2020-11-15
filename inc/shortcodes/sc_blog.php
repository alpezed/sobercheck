<?php

function sobercheck_blog( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title' => '',
        'style' => '01',
        'num_posts' => 6
    ), $atts ) );

    $id = 'sc-post-' . rand();

    ob_start();

    $args = array(
        'post_type' => 'post',
        'no_found_rows' => true,
        'post_status' => 'publish',
        'posts_per_page' => ! empty( $num_posts ) ? $num_posts : 6
    );

    $query = new WP_Query( $args );
    ?>

    <div id="<?php echo esc_attr( $id ); ?>" class="sc-posts<?php echo ! empty( $style ) ? ' style-' . $style : ''; ?> swiper-container">
        <div class="swiper-wrapper">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="swiper-slide">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="sc-posts__meta-wrapper">
                            <?php sobercheck_posted_on();  ?>
                        </div>
                        
                        <div class="sc-posts__content">
                            <header class="entry-header">
                                <?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div><!-- .entry-content -->

                            <a href="<?php the_permalink(); ?>" class="sc-posts__read-more btn-link text-primary">Read More</a>
                        </div>
                    </article><!-- #post-<?php the_ID(); ?> -->
                </div>
            <?php endwhile; ?>
        </div>
        <!-- Add Pagination -->
        <div class="swiper-pagination"></div>

        <!-- Add navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
        <?php wp_reset_postdata(); ?>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_blog', 'sobercheck_blog' );