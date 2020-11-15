<?php
function sobercheck_featured_products_slider( $atts ) {
	global $woocommerce_loop;

	extract( shortcode_atts( array(
		'cats' 				=> '',
		'style' 			=> '01',
		'tax' 				=> 'product_cat',
		'limit' 			=> '-1',
		'loop'				=> 'true',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
	), $atts ) );

    $id = 'sc-product-slider-' . rand();
    
	$cats 		= ( ! empty( $cats ) )                  ? explode( '|', $cats )         : '';
	$style      = ! empty( $style )                     ? $style 						: '';
	$order 		= ( strtolower( $order ) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 	= ! empty( $orderby )					? $orderby 						: 'date';

	ob_start();

	// setup query
    $tax_query = array();
    // Category Parameter 
    if ( ! empty( $cats ) ) {
        $tax_query[] = array( 
            'taxonomy' 	=> $tax,
            'field' 	=> 'id',
            'terms' 	=> $cats
        );
    }

    $args = array(
        'post_type'				=> 'product',
        'post_status' 			=> 'publish',
        'ignore_sticky_posts'	=> 1,
        'posts_per_page' 		=> $limit,
        'tax_query' 			=> $tax_query,
        'order'					=> $order,
        'orderby'				=> $orderby,
    );

	// query database
    $products = new WP_Query( $args );
    
    $styles = array();

    $styles['width'] = '100%';

	if ( $products->have_posts() ) : ?>
        <div id="<?php echo $id; ?>" class="sc-product-slider sobercheck-swiper style-<?php echo $style; ?>" data-lg-items="4" data-lg-gutter="28" data-centered="1" data-queue-init="0">

            <?php
            $product_terms_args = array(
                'taxonomy'   => $taxonomy,
				'hide_empty' => true,
            );
            
            $terms = array();

            foreach ( $cats as $category ) {
                $term = get_term_by( 'term_taxonomy_id', $category, $taxonomy );
                if ( ! empty( $term ) ) {
                    $terms[] = $term->term_id;
                }
            }

            $product_terms_args['include'] = $terms;

            $product_terms = get_terms( $product_terms_args );
            
            if ( ! empty( $product_terms ) ) : ?>
                <div class="filter-wrapper" data-ajax="<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>">
                    <?php foreach ( $product_terms as $term ) { ?> 
                        <a href="javascript:void(0);" data-filter="<?php echo esc_attr( $term->slug ); ?>" class="filter-wrapper__item btn <?php echo absint( $cats[0] ) === $term->term_id ? 'btn-primary' : ''; ?>"><?php echo esc_html( $term->name ); ?></a>
                    <?php } ?>
                </div>
            <?php endif; ?>

            <div class="swiper-container">
                <div class="swiper-wrapper products">
                    <?php
                    while ( $products->have_posts() ) : $products->the_post(); 
                    
                    $prod_term_list = wp_get_post_terms( get_the_ID(), 'product_cat', array( 'fields' => 'ids' ) );
                    $styles['display'] = ( ! in_array( $cats[0], $prod_term_list ) ? 'none' : '' );
                    ?>
                        <div <?php wc_product_class( 'swiper-slide sc-product-slider__item', $product ); ?> style="<?php do_style( $styles, true ); ?>">
                            <?php
                            /**
                             * Hook: woocommerce_before_shop_loop_item.
                             *
                             * @hooked woocommerce_template_loop_product_link_open - 10
                             */
                            do_action( 'woocommerce_before_shop_loop_item' );

                            /**
                             * Hook: woocommerce_before_shop_loop_item_title.
                             *
                             * @hooked woocommerce_show_product_loop_sale_flash - 10
                             * @hooked woocommerce_template_loop_product_thumbnail - 10
                             */
                            do_action( 'woocommerce_before_shop_loop_item_title' );

                            /**
                             * Hook: woocommerce_shop_loop_item_title.
                             *
                             * @hooked woocommerce_template_loop_product_title - 10
                             */
                            do_action( 'woocommerce_shop_loop_item_title' );

                            /**
                             * Hook: woocommerce_after_shop_loop_item_title.
                             *
                             * @hooked woocommerce_template_loop_rating - 5
                             * @hooked woocommerce_template_loop_price - 10
                             */
                            do_action( 'woocommerce_after_shop_loop_item_title' );

                            /**
                             * Hook: woocommerce_after_shop_loop_item.
                             *
                             * @hooked woocommerce_template_loop_product_link_close - 5
                             * @hooked woocommerce_template_loop_add_to_cart - 10
                             */
                            do_action( 'woocommerce_after_shop_loop_item' );
                            ?>
                        </div>
                    <?php endwhile; ?>
                </div>
                <!-- Add navigation buttons -->
                <div class="swiper-button-prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.371" height="16.39" viewBox="0 0 9.371 16.39"><path fill="#fff" d="M14.071,14.388l6.2-6.2a1.166,1.166,0,0,0,0-1.654,1.181,1.181,0,0,0-1.659,0l-7.027,7.022a1.169,1.169,0,0,0-.034,1.615l7.056,7.071a1.171,1.171,0,0,0,1.659-1.654Z" transform="translate(-11.246 -6.196)"></path></svg>
                </div>
                <div class="swiper-button-next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="9.371" height="16.39" viewBox="0 0 9.371 16.39"><path fill="#fff" d="M17.793,14.388l-6.2-6.2a1.166,1.166,0,0,1,0-1.654,1.181,1.181,0,0,1,1.659,0l7.027,7.022a1.169,1.169,0,0,1,.034,1.615l-7.056,7.071A1.171,1.171,0,1,1,11.6,20.59Z" transform="translate(-11.246 -6.196)"></path></svg>
                </div>
            </div>
		</div>
	<?php endif;
	wp_reset_postdata();
	$output = ob_get_clean();
    return $output;
}
add_shortcode( 'sc_products_slider', 'sobercheck_featured_products_slider' );