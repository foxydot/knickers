<?php
/**
 * External product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
=======
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
?>

<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<p class="cart">
	<a href="<?php echo esc_url( $product_url ); ?>" rel="nofollow" class="single_add_to_cart_button button alt"><?php echo $button_text; ?></a>
</p>

<<<<<<< HEAD
<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
=======
<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
