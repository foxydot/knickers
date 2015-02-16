<?php
/**
 * Customer new account email
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

echo sprintf( __( "Thanks for creating an account on %s. Your username is <strong>%s</strong>.", 'woocommerce' ), $blogname, $user_login ) . "\n\n";

if ( get_option( 'woocommerce_registration_generate_password' ) === 'yes' && $password_generated )
	echo sprintf( __( "Your password is <strong>%s</strong>.", 'woocommerce' ), $user_pass ) . "\n\n";

echo sprintf( __( 'You can access your account area to view your orders and change your password here: %s.', 'woocommerce' ), get_permalink( wc_get_page_id( 'myaccount' ) ) ) . "\n\n";

echo "\n****************************************************\n\n";

<<<<<<< HEAD
echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
=======
echo apply_filters( 'woocommerce_email_footer_text', get_option( 'woocommerce_email_footer_text' ) );
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
