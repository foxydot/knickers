<?php
/**
 * Customer note email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails/Plain
 * @version     2.0.0
 */
<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
=======

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1

echo $email_heading . "\n\n";

echo __( "Hello, a note has just been added to your order:", 'woocommerce' ) . "\n\n";

echo "----------\n\n";

echo wptexturize( $customer_note ) . "\n\n";

echo "----------\n\n";

echo __( "For your reference, your order details are shown below.", 'woocommerce' ) . "\n\n";

echo "****************************************************\n\n";

do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text );

echo sprintf( __( 'Order number: %s', 'woocommerce'), $order->get_order_number() ) . "\n";
echo sprintf( __( 'Order date: %s', 'woocommerce'), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ) . "\n";

do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text );

echo "\n" . $order->email_order_items_table( $order->is_download_permitted(), true, '', '', '', true );

echo "----------\n\n";

if ( $totals = $order->get_order_item_totals() ) {
	foreach ( $totals as $total ) {
		echo $total['label'] . "\t " . $total['value'] . "\n";
	}
}

echo "\n****************************************************\n\n";

do_action( 'woocommerce_email_after_order_table', $order, $sent_to_admin, $plain_text );

<<<<<<< HEAD
echo __( 'Your details', 'woocommerce' ) . "\n\n";

if ( $order->billing_email )
	echo __( 'Email:', 'woocommerce' ); echo $order->billing_email . "\n";

if ( $order->billing_phone )
	echo __( 'Tel:', 'woocommerce' ); ?> <?php echo $order->billing_phone . "\n";

wc_get_template( 'emails/plain/email-addresses.php', array( 'order' => $order ) );

echo "\n****************************************************\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
=======
do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text );

echo "\n****************************************************\n\n";

echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
