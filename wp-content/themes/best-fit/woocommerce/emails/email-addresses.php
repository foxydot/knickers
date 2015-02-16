<?php
/**
 * Email Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
<<<<<<< HEAD
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
=======
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1

?><table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">

	<tr>

		<td valign="top" width="50%">

			<h3><?php _e( 'Billing address', 'woocommerce' ); ?></h3>

			<p><?php echo $order->get_formatted_billing_address(); ?></p>

		</td>

<<<<<<< HEAD
		<?php if ( get_option( 'woocommerce_ship_to_billing_address_only' ) === 'no' && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>
=======
		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1

		<td valign="top" width="50%">

			<h3><?php _e( 'Shipping address', 'woocommerce' ); ?></h3>

			<p><?php echo $shipping; ?></p>

		</td>

		<?php endif; ?>

	</tr>

<<<<<<< HEAD
</table>
=======
</table>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
