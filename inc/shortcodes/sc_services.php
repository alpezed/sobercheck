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
    ), $atts ) );

    ob_start();
    ?>

    <div class="sc-services-item">
        <h5 class="title-bullet"><?php echo ! empty( $title ) ? $title : ''; ?></h5>
        <?php echo do_shortcode( $content ); ?>
    </div>

    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_service', 'sobercheck_services_item' );