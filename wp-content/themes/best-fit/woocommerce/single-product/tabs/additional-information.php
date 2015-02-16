<?php
/**
 * Additional Information tab
<<<<<<< HEAD
 * 
=======
 *
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
<<<<<<< HEAD
	// Exit if accessed directly
	exit;
=======
	exit; // Exit if accessed directly
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
}

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional Information', 'woocommerce' ) );
<<<<<<< HEAD
=======

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
?>

<?php if ( $heading ): ?>
	<h2><?php echo $heading; ?></h2>
<?php endif; ?>

<<<<<<< HEAD
<?php $product->list_attributes(); ?>
=======
<?php $product->list_attributes(); ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
