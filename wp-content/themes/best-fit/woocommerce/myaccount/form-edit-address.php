<?php
/**
 * Edit address form
 *
<<<<<<< HEAD
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
=======
 * @author      WooThemes
 * @package     WooCommerce/Templates
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
<<<<<<< HEAD
    exit;
=======
	exit; // Exit if accessed directly
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
}

global $current_user;

$page_title = ( $load_address === 'billing' ) ? __( 'Billing Address', 'woocommerce' ) : __( 'Shipping Address', 'woocommerce' );

get_currentuserinfo();
<<<<<<< HEAD
=======

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
?>

<?php wc_print_notices(); ?>

<?php if ( ! $load_address ) : ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

<?php else : ?>

	<form method="post">

		<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title ); ?></h3>

<<<<<<< HEAD
=======
		<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
		<?php foreach ( $address as $key => $field ) : ?>

			<?php woocommerce_form_field( $key, $field, ! empty( $_POST[ $key ] ) ? wc_clean( $_POST[ $key ] ) : $field['value'] ); ?>

		<?php endforeach; ?>

<<<<<<< HEAD
=======
		<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
		<p>
			<input type="submit" class="button" name="save_address" value="<?php _e( 'Save Address', 'woocommerce' ); ?>" />
			<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
			<input type="hidden" name="action" value="edit_address" />
		</p>

	</form>

<<<<<<< HEAD
<?php endif; ?>
=======
<?php endif; ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
