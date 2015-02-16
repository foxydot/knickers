<?php
/**
 * Single Product Sale Flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post, $product;
=======
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
?>
<?php if ( $product->is_on_sale() ) : ?>

	<?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'woocommerce' ) . '</span>', $post, $product ); ?>

<<<<<<< HEAD
<?php endif; ?>
=======
<?php endif; ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
