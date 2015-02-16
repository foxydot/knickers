<?php
/**
 * Customer Reset Password email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.0.0
 */

<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
=======
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php _e( 'Someone requested that the password be reset for the following account:', 'woocommerce' ); ?></p>
<p><?php printf( __( 'Username: %s', 'woocommerce' ), $user_login ); ?></p>
<p><?php _e( 'If this was a mistake, just ignore this email and nothing will happen.', 'woocommerce' ); ?></p>
<p><?php _e( 'To reset your password, visit the following address:', 'woocommerce' ); ?></p>
<p>
    <a href="<?php echo esc_url( add_query_arg( array( 'key' => $reset_key, 'login' => rawurlencode( $user_login ) ), wc_get_endpoint_url( 'lost-password', '', get_permalink( wc_get_page_id( 'myaccount' ) ) ) ) ); ?>">
			<?php _e( 'Click here to reset your password', 'woocommerce' ); ?></a>
</p>
<p></p>

<<<<<<< HEAD
<?php do_action( 'woocommerce_email_footer' ); ?>
=======
<?php do_action( 'woocommerce_email_footer' ); ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
