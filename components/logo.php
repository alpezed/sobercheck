<a class="navbar-brand" href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
    <?php
    if ( has_custom_logo() ) {
        echo wp_get_attachment_image( get_theme_mod( 'custom_logo' ), 'full' );
    } else {
        if ( is_front_page() && is_home() ) :
            ?>
            <h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
            <?php
        else :
            ?>
            <p class="site-title"><?php bloginfo( 'name' ); ?></p>
            <?php
        endif;
        $sobercheck_description = get_bloginfo( 'description', 'display' );
        if ( $sobercheck_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo $sobercheck_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
            <?php
        endif;
    }
    ?>
</a>