<?php

function sobercheck_teams( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title' => '',
        'style' => '01',
        'num_posts' => 6
    ), $atts ) );

    $id = 'sc-team-' . rand();

    ob_start();

    $args = array(
        'post_type' => 'sc_team',
        'no_found_rows' => true,
        'post_status' => 'publish',
        'posts_per_page' => ! empty( $num_posts ) ? $num_posts : 6
    );

    $query = new WP_Query( $args );
    ?>

    <div id="<?php echo esc_attr( $id ); ?>" class="sc-teams<?php echo ! empty( $style ) ? ' style-' . $style : ''; ?>">
        <?php while( $query->have_posts() ) : $query->the_post(); ?>
            <div <?php post_class( 'sc-teams__item' ); ?>>
                <div class="sc-teams__flip-box">
                    <div class="flipper">
                        <div class="front">
                            <?php
                            if ( has_post_thumbnail() ) {
                                the_post_thumbnail( 'sc-team-thumb' );
                            }
                            ?>
                        </div>
                        <div class="back">
                            <div class="inner">
                                <?php if ( ! empty( get_field( 'quote' ) ) ) { ?> 
                                    <div class="sc-teams__quote">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="48" height="48"
                                            viewBox="0 0 48 48">
                                            <defs>
                                                <clipPath id="a">
                                                    <path class="icon" d="M24,20H18l4-8H16V0H28V12l-4,8ZM8,20H2l4-8H0V0H12V12L8,20Z" transform="translate(0 0)" />
                                                </clipPath>
                                            </defs>
                                            <rect width="48" height="48" fill="transparent" />
                                            <path class="icon" d="M24,20H18l4-8H16V0H28V12l-4,8ZM8,20H2l4-8H0V0H12V12L8,20Z" transform="translate(10 14)" fill="currentColor" />
                                        </svg>
                                        <h2><?php the_field( 'quote' ); ?></h2>
                                    </div>
                                <?php } ?>
                                <div class="sc-teams__content"><?php the_content(); ?></div>
                                <ul class="sc-teams__contacts">
                                    <?php if ( ! empty( get_field( 'position' ) ) ) { ?> 
                                        <li><i class="fas fa-phone-alt"></i> <?php the_field( 'position' ); ?></li>
                                    <?php } ?>
                                    <?php if ( ! empty( get_field( 'email' ) ) ) { ?> 
                                        <li><i class="fas fa-envelope"></i> <?php the_field( 'email' ); ?></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 class="sc-teams__title"><?php the_title(); ?></h5>
                <div class="sc-teams__position"><?php the_field( 'position' ); ?></div>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_teams', 'sobercheck_teams' );