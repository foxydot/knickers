<?php

add_filter('get_product_search_form','msdlab_product_search_form');
function msdlab_product_search_form($content){
    $content = preg_replace('@value="Search"@i','value="&#xF002;"',$content);
    return $content;
}

function woocommerce_output_related_products() {
woocommerce_related_products(4,2); // Display 4 products in rows of 2
}



if ( ! function_exists( 'woocommerce_subcategory_thumbnail' ) ) {

    /**
     * Show subcategory thumbnails.
     *
     * @access public
     * @param mixed $category
     * @subpackage  Loop
     * @return void
     */
    function woocommerce_subcategory_thumbnail( $category ) {
        $small_thumbnail_size   = apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
        $dimensions             = function_exists('wc_get_image_size')?wc_get_image_size( $small_thumbnail_size ):array('width'=>'','height'=>'');
        $thumbnail_id           = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );
        if(!$thumbnail_id){$args = array(
                'posts_per_page' => 1,
                'product_cat' => $category->slug,
                'post_type' => 'product',
            );
            $products = get_posts($args);
            $thumbnail_id = get_post_thumbnail_id($products[0]->ID);
        }

        if ( $thumbnail_id ) {
            $image = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
            $image = $image[0];
        } else {
            $image = wc_placeholder_img_src();
        }

        if ( $image ) {
            // Prevent esc_url from breaking spaces in urls for image embeds
            // Ref: http://core.trac.wordpress.org/ticket/23605
            $image = str_replace( ' ', '%20', $image );
            echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_attr( $dimensions['height'] ) . '" />';
        }
    }
}