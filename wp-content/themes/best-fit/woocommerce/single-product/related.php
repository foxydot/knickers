<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();
$related = array_slice(array_merge( $upsells, $product->get_related() ),0,3);
if ( sizeof( $upsells ) > 0 || sizeof( $related ) > 0 ){
    $meta_query = WC()->query->get_meta_query();

    $args = array(
        'post_type'           => 'product',
        'ignore_sticky_posts' => 1,
        'no_found_rows'       => 1,
        'posts_per_page'      => $posts_per_page,
        'orderby'             => $orderby,
        'post__in'            => $related,
        'post__not_in'        => array( $product->id ),
        'meta_query'          => $meta_query
    );
    
    $products = new WP_Query( $args );
}

=======
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

<<<<<<< HEAD
    <div class="upsells products">

        <h2><?php _e( 'You may also like&hellip;', 'woocommerce' ) ?></h2>

        <?php woocommerce_product_loop_start(); ?>

            <?php while ( $products->have_posts() ) : $products->the_post(); ?>

                <?php wc_get_template_part( 'content', 'product' ); ?>

            <?php endwhile; // end of the loop. ?>

        <?php woocommerce_product_loop_end(); ?>

    </div>
=======
	<div class="related products">

		<h2><?php _e( 'Related Products', 'woocommerce' ); ?></h2>

		<?php woocommerce_product_loop_start(); ?>

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php wc_get_template_part( 'content', 'product' ); ?>

			<?php endwhile; // end of the loop. ?>

		<?php woocommerce_product_loop_end(); ?>

	</div>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1

<?php endif;

wp_reset_postdata();