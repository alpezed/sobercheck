<?php

function sobercheck_pdf_list( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'title' => '',
        'link' => '#',
        'view_text' => esc_html__( 'View', 'sobercheck' ),
        'download_text' => esc_html__( 'Download', 'sobercheck' ),
    ), $atts ) );

    ob_start();

    $link = ! empty( $link ) ? esc_url( $link ) : '';
    ?>

    <div class="sc-pdf-list">
        <h4><?php echo ! empty( $title ) ? $title : ''; ?></h4>
        <div class="sc-pdf-list__btn"><a class="sc-pdf-list__link" href="<?php echo $link ?>"><?php echo esc_html( $view_text ); ?></a> <a class="sc-pdf-list__link" href="<?php echo $link ?>"><?php echo esc_html( $download_text ); ?></a></div>
    </div>

    <?php
    $output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_pdf_list', 'sobercheck_pdf_list' );