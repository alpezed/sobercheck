<?php

function sobercheck_services( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'style' => '01'
    ), $atts ) );

    return '<div class="sc-services' . ( isset( $style ) ? ' style-' . $style : '' ) . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'sc_services', 'sobercheck_services' );

function sobercheck_services_item( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title' => '',
        'style' => '01',
        'info' => '',
        'link' => '#',
        'color' => '',
        'shadow' => 1
    ), $atts ) );

    $id = 'sc-service-item-' . rand();

    ob_start();
    ?>
    <?php if ( ! empty( $shadow ) && $shadow === 1 ) { ?>
        <style>
            #<?php echo $id; ?>.sc-services-item {
                box-shadow: 0 5px 10px rgba(0, 0, 0, 0.16);
            }
        </style>
    <?php } ?>
    <?php if ( ! empty( $color ) ) : ?>
    <style>
        #<?php echo $id; ?>.style-02:hover::before {
            background: <?php echo $color; ?>;
        }

        #<?php echo $id; ?>.style-02 .sc-services-item--link {
            color: <?php echo $color; ?>;
        }
    </style>
    <?php endif; ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="sc-services-item<?php echo ! empty( $style ) ? ' style-' . $style : ''; ?>">
        <?php
            switch ( $style ) {
                case '01':
                    ?>
                    <h5 class="title-bullet"><?php echo ! empty( $title ) ? $title : ''; ?></h5>
                    <?php echo do_shortcode( $content ); ?>
                    <?php
                    break;
                case '02':
                    ?>
                        <h4 class="sc-services-item--title"><?php echo ! empty( $title ) ? $title : ''; ?></h4>
                        <div class="sc-services-item--info"><?php echo ! empty( $info ) ? $info : ''; ?></div>
                        <div class="sc-services-item--description"><?php echo do_shortcode( $content ); ?></div>
                        <div class="sc-services-item--cta">
                            <a href="<?php echo ! empty( $link ) ? esc_url( $link ) : ''; ?>" class="sc-services-item--link">
                                <span class="text d-none d-sm-block"><?php _e( 'ENTER SITE', 'sobercheck' ); ?></span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="25.546" height="25.546" viewBox="0 0 25.546 25.546">
                                    <defs>
                                        <style>
                                            .cta {
                                                fill: none;
                                                stroke: currentColor;
                                                stroke-linecap: round;
                                                stroke-linejoin: round;
                                                stroke-width: 2px;
                                            }
                                        </style>
                                    </defs>
                                    <g transform="translate(-2 -2)">
                                        <path class="cta" d="M26.546,14.773A11.773,11.773,0,1,1,14.773,3,11.773,11.773,0,0,1,26.546,14.773Z"
                                            transform="translate(0 0)" />
                                        <path class="cta" d="M18,21.418l4.709-4.709L18,12" transform="translate(-3.227 -1.936)" />
                                        <path class="cta" d="M12,18h9.418" transform="translate(-1.936 -3.227)" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    <?php
                    break;
            }
        ?>
    </div>
    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_service', 'sobercheck_services_item' );