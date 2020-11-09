<?php

function sobercheck_cta( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title' => '',
        'button_text' => 'Contact Us',
        'link' => '',
    ), $atts ) );

    ob_start();
    ?>

    <div class="sc-cta">
        <h2><?php echo ! empty( $title ) ? $title : ''; ?></h2>
        <a class="btn btn-primary" href="<?php echo ! empty( $link ) ? esc_url( $link ) : ''; ?>"><?php echo ! empty( $button_text ) ? $button_text : ''; ?></a>
    </div>

    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_cta', 'sobercheck_cta' );