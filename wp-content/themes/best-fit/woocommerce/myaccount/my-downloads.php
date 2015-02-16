<?php
/**
 * My Orders
 *
 * Shows recent orders on the account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
<<<<<<< HEAD
    exit;
=======
	exit; // Exit if accessed directly
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
}

if ( $downloads = WC()->customer->get_downloadable_products() ) : ?>

<<<<<<< HEAD
=======
	<?php do_action( 'woocommerce_before_available_downloads' ); ?>

>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
	<h2><?php echo apply_filters( 'woocommerce_my_account_my_downloads_title', __( 'Available downloads', 'woocommerce' ) ); ?></h2>

	<ul class="digital-downloads">
		<?php foreach ( $downloads as $download ) : ?>
			<li>
				<?php
					do_action( 'woocommerce_available_download_start', $download );

					if ( is_numeric( $download['downloads_remaining'] ) )
						echo apply_filters( 'woocommerce_available_download_count', '<span class="count">' . sprintf( _n( '%s download remaining', '%s downloads remaining', $download['downloads_remaining'], 'woocommerce' ), $download['downloads_remaining'] ) . '</span> ', $download );

					echo apply_filters( 'woocommerce_available_download_link', '<a href="' . esc_url( $download['download_url'] ) . '">' . $download['download_name'] . '</a>', $download );

					do_action( 'woocommerce_available_download_end', $download );
				?>
			</li>
		<?php endforeach; ?>
	</ul>

<<<<<<< HEAD
<?php endif; ?>
=======
	<?php do_action( 'woocommerce_after_available_downloads' ); ?>

<?php endif; ?>
>>>>>>> 5ec0834fd204a926bf216a4361cc6ea50af56fe1
