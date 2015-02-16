<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

<<<<<<< HEAD
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
=======
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
?>
<ul class="woocommerce-error">
	<?php foreach ( $messages as $message ) : ?>
		<li><?php echo wp_kses_post( $message ); ?></li>
	<?php endforeach; ?>
<<<<<<< HEAD
</ul>
=======
</ul>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
